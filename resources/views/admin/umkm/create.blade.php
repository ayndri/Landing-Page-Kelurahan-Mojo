@extends('layouts.admin')
@section('title', 'Tambah UMKM')

@push('styles')
<style>#map-picker { height: 350px; border-radius: 12px; overflow: hidden; position: relative; z-index: 0; }</style>
@endpush

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow p-8">
        <form method="POST" action="{{ route('admin.umkm.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @include('admin.umkm._form')
            <div class="pt-4 border-t flex gap-3">
                <button type="submit" class="bg-amber-500 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-amber-600 transition text-sm">
                    Simpan UMKM
                </button>
                <a href="{{ route('admin.umkm.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@include('admin.tanaman._map_script')
@endsection
