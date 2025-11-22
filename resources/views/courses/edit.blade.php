@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Kelas</h2>

        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Kelas</label>
                <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-pink-500 @enderror">
                @error('name')
                    <p class="text-pink-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="instructor" class="block text-gray-700 text-sm font-bold mb-2">Instruktur</label>
                <input type="text" name="instructor" id="instructor" value="{{ old('instructor', $course->instructor) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('instructor') border-pink-500 @enderror">
                @error('instructor')
                    <p class="text-pink-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="duration" class="block text-gray-700 text-sm font-bold mb-2">Durasi (jam)</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration', $course->duration) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('duration') border-pink-500 @enderror">
                @error('duration')
                    <p class="text-pink-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="description" id="description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-pink-500 @enderror">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <p class="text-pink-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                <button type="submit"
                    class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Kelas
                </button>
            </div>
        </form>
    </div>
@endsection
