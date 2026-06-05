@extends('layouts.admin')
@section('title', 'Tambah Tanaman')

@push('styles')
<style>#map-picker { height: 350px; border-radius: 12px; overflow: hidden; }</style>
@endpush

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow p-8">
        <form method="POST" action="{{ route('admin.tanaman.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @include('admin.tanaman._form')
            <div class="pt-4 border-t flex gap-3">
                <button type="submit" class="bg-[#2d6a4f] text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-[#40916c] transition text-sm">
                    Simpan Tanaman
                </button>
                <a href="{{ route('admin.tanaman.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@include('admin.tanaman._map_script')
@endsection
