<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::latest()->get();
        return view('participants.index', compact('participants'));
    }

    public function create()
    {
        return view('participants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Participant::create($request->all());

        return redirect()->route('participants.index')
            ->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function show(Participant $participant)
    {
        $participant->load('enrollments.course');

        return view('participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $participant->update($request->all());

        return redirect()->route('participants.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')
            ->with('success', 'Peserta berhasil dihapus.');
    }
}
