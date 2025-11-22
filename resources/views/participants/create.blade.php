@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Tambah Peserta Baru</h2>

        <form action="{{ route('participants.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-pink-500 @enderror">
                @error('name')
                    <p class="text-pink-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-pink-500 @enderror">
                @error('email')
                    <p class="text-pink-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Telepon</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-pink-500 @enderror">
                @error('phone')
                    <p class="text-pink-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                <textarea name="address" id="address"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-pink-500 @enderror">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-pink-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('participants.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                <button type="submit"
                    class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
