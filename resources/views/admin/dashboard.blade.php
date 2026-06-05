@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-gray-600 text-sm">
        Selamat datang, <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
        @if(auth()->user()->isRwAdmin())
            — Admin RW {{ auth()->user()->rw_number }}
        @endif
    </h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    @if(auth()->user()->isSuperAdmin())
    <div class="bg-white rounded-xl shadow p-5">
        <div class="text-2xl font-extrabold text-[#2d6a4f]">{{ $stats['user_count'] }}</div>
        <div class="text-gray-500 text-sm mt-1">Total Admin</div>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <div class="text-2xl font-extrabold text-[#2d6a4f]">{{ $stats['rw_count'] }}</div>
        <div class="text-gray-500 text-sm mt-1">RW Terisi</div>
    </div>
    @endif
    <div class="bg-white rounded-xl shadow p-5">
        <div class="text-2xl font-extrabold text-green-600">{{ $stats['plant_count'] }}</div>
        <div class="text-gray-500 text-sm mt-1">Total Tanaman</div>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <div class="text-2xl font-extrabold text-amber-600">{{ $stats['umkm_count'] }}</div>
        <div class="text-gray-500 text-sm mt-1">Total UMKM</div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
        <div class="space-y-3">
            <a href="{{ route('admin.profil.edit') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-[#2d6a4f] hover:bg-green-50 transition text-sm">
                <svg class="w-5 h-5 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Profil RW
            </a>
            <a href="{{ route('admin.tanaman.create') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition text-sm">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Tanaman
            </a>
            <a href="{{ route('admin.umkm.create') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-amber-500 hover:bg-amber-50 transition text-sm">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah UMKM
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-bold text-gray-800 mb-4">Tautan Website</h3>
        <div class="space-y-3">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition text-sm">
                <span>Beranda</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
            <a href="{{ route('peta') }}" target="_blank" class="flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition text-sm">
                <span>Peta Interaktif</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>
    </div>
</div>
@endsection
