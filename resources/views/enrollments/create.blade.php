@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Catat Pendaftaran Baru</h2>

        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Peserta</label>
                <select name="participant_id"
                    class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Pilih Peserta --</option>
                    @foreach ($participants as $participant)
                        <option value="{{ $participant->id }}">{{ $participant->name }} ({{ $participant->email }})</option>
                    @endforeach
                </select>
                @error('participant_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Pilih Kelas <span class="font-normal text-gray-500 text-xs">(Tahan tombol CTRL/Command untuk memilih
                        lebih dari satu)</span>
                </label>
                <select name="course_ids[]" multiple
                    class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline h-40">
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" class="py-1 px-2 hover:bg-pink-100">
                            {{ $course->name }} ({{ $course->instructor }})
                        </option>
                    @endforeach
                </select>
                @error('course_ids')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('enrollments.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                <button type="submit"
                    class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Pendaftaran
                </button>
            </div>
        </form>
    </div>
@endsection
