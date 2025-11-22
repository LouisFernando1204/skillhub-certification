<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function show(Course $course)
    {
        $course->load('enrollments.participant');

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
