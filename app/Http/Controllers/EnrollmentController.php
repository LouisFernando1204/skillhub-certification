<?php

namespace App\Http\Controllers;

use App\Models\CourseParticipant;
use App\Models\Participant;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = CourseParticipant::with(['participant', 'course'])
            ->latest()
            ->get();

        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $participants = Participant::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();

        return view('enrollments.create', compact('participants', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        foreach ($request->course_ids as $course_id) {
            $exists = CourseParticipant::where('participant_id', $request->participant_id)
                ->where('course_id', $course_id)
                ->exists();

            if (!$exists) {
                CourseParticipant::create([
                    'participant_id' => $request->participant_id,
                    'course_id' => $course_id
                ]);
            }
        }

        return redirect()->route('enrollments.index')
            ->with('success', 'Pendaftaran berhasil disimpan!');
    }

    public function destroy($id)
    {
        $enrollment = CourseParticipant::findOrFail($id);
        $enrollment->delete();

        return back()->with('success', 'Pendaftaran berhasil dibatalkan.');
    }
}
