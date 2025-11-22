@extends('layouts.app')

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Daftar Kelas
            </h2>
            <a href="{{ route('courses.create') }}"
                class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Kelas
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($courses as $course)
                <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-bold text-pink-600">{{ $course->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">Instruktur: {{ $course->instructor }}</p>
                    <p class="text-gray-500 text-sm mb-4 truncate">{{ $course->description ?? 'Tidak ada deskripsi' }}</p>

                    <div class="flex justify-between items-center mt-4 border-t pt-2">
                        <span class="text-xs text-gray-400">{{ $course->duration }} Jam</span>
                        <div class="flex justify-center items-center whitespace-nowrap">
                            <a href="{{ route('courses.show', $course->id) }}"
                                class="text-blue-500 text-sm hover:underline mr-3">Detail</a>
                            <a href="{{ route('courses.edit', $course->id) }}"
                                class="text-yellow-500 text-sm hover:underline mr-3">Edit</a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Hapus kelas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-pink-500 text-sm hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-4 text-gray-500">
                    Belum ada kelas yang tersedia.
                </div>
            @endforelse
        </div>
    </div>
@endsection
