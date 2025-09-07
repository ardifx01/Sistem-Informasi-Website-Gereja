@extends('layouts.admin.app')

@section('title', '| Manajemen Anggota Jemaat')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Anggota Jemaat') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">📋 Anggota Jemaat</h3>
                        <a href="{{ route('admin.members.create') }}"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Jemaat Baru
                        </a>
                    </div>
                    {{-- Pesan Sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    {{-- Pesan Error (jika ada) --}}
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        {{-- Tabel Anggota --}}
                        <div class="space-y-4 md:hidden">
                            @foreach ($members as $member)
                                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="font-bold text-lg text-gray-800">
                                            {{ $member->full_name }}</h4>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $member->status == 'Aktif' ? 'bg-green-100 text-green-800' : ($member->status == 'Non-aktif' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $member->status }}
                                        </span>
                                    </div>

                                    <div class="text-sm text-gray-600 space-y-1">
                                        <p><strong>Nik:</strong> {{ $member->nik ?? '-' }}</p>
                                        <p><strong>Email:</strong> {{ $member->email ?? '-' }}</p>
                                        <p><strong>JK:</strong> {{ $member->gender ?? '-' }}</p>
                                    </div>

                                    <div class="mt-4 flex flex-wrap justify-start gap-3 text-sm font-medium">
                                        <a href="{{ route('admin.members.show', $member->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">Detail</a>
                                        <a href="{{ route('admin.members.edit', $member->id) }}"
                                            class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                        <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="overflow-x-auto hidden md:block ">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Lengkap
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            NIK
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jenis Kelamin
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($members as $member)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $member->full_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $member->nik ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $member->email ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $member->gender ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $member->status == 'Aktif' ? 'bg-green-100 text-green-800' : ($member->status == 'Non-aktif' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ $member->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.members.show', $member->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mr-3">Detail</a>
                                                <a href="{{ route('admin.members.edit', $member->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                                <form action="{{ route('admin.members.destroy', $member->id) }}"
                                                    method="POST" class="inline-block"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                Belum ada anggota jemaat yang terdaftar.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $members->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
