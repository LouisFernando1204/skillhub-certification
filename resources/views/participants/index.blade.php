@extends('layouts.app')

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Daftar Peserta
            </h2>
            <a href="{{ route('participants.create') }}"
                class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Peserta
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. HP
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($participants as $participant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $participant->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $participant->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $participant->phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('participants.show', $participant->id) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">Lihat</a>
                                <a href="{{ route('participants.edit', $participant->id) }}"
                                    class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>

                                <form action="{{ route('participants.destroy', $participant->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus peserta ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-pink-600 hover:text-pink-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data peserta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
