@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Peserta</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Informasi lengkap biodata peserta.</p>
                </div>
                <div>
                    <a href="{{ route('participants.index') }}"
                        class="text-pink-600 hover:text-pink-900 text-sm font-bold">Kembali</a>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $participant->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $participant->email }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">No. Handphone</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $participant->phone }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $participant->address }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Kelas yang Diikuti</h3>
            @if ($participant->enrollments->isEmpty())
                <p class="text-gray-500 text-sm">Peserta ini belum terdaftar di kelas manapun.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($participant->enrollments as $enrollment)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-pink-600">{{ $enrollment->course->name }}</p>
                                <p class="text-xs text-gray-500">Instruktur: {{ $enrollment->course->instructor }}</p>
                            </div>
                            <span class="text-xs text-gray-400">
                                Daftar pada: {{ $enrollment->created_at->format('d M Y') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
