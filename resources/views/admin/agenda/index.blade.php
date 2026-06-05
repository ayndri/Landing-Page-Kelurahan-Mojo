@extends('layouts.admin')
@section('title', 'Kelola Agenda')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $agendas->count() }} agenda terdaftar</p>
    <a href="{{ route('admin.agenda.create') }}"
       class="bg-[#2d6a4f] text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-[#40916c] transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Agenda
    </a>
</div>

@if($agendas->count())
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-5 py-3 font-semibold text-gray-600">Tanggal</th>
                <th class="text-left px-5 py-3 font-semibold text-gray-600">Judul</th>
                <th class="text-left px-5 py-3 font-semibold text-gray-600">Kategori</th>
                <th class="text-left px-5 py-3 font-semibold text-gray-600">Lokasi</th>
                <th class="text-left px-5 py-3 font-semibold text-gray-600">Waktu</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($agendas as $a)
            @php
                $isPast = $a->tanggal->isPast();
                $badgeColors = [
                    'Kesehatan'   => 'bg-red-100 text-red-700',
                    'Sosial'      => 'bg-blue-100 text-blue-700',
                    'Rapat'       => 'bg-yellow-100 text-yellow-700',
                    'Olahraga'    => 'bg-green-100 text-green-700',
                    'Pendidikan'  => 'bg-purple-100 text-purple-700',
                    'Lainnya'     => 'bg-gray-100 text-gray-600',
                ];
                $badge = $badgeColors[$a->kategori] ?? 'bg-gray-100 text-gray-600';
            @endphp
            <tr class="{{ $isPast ? 'opacity-50' : '' }}">
                <td class="px-5 py-3 text-gray-700 whitespace-nowrap">
                    {{ $a->tanggal->translatedFormat('d M Y') }}
                    @if($isPast)
                        <span class="ml-1 text-xs text-gray-400">(lewat)</span>
                    @endif
                </td>
                <td class="px-5 py-3 font-medium text-gray-800">{{ $a->judul }}</td>
                <td class="px-5 py-3">
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $badge }}">{{ $a->kategori }}</span>
                </td>
                <td class="px-5 py-3 text-gray-500">{{ $a->lokasi ?: '—' }}</td>
                <td class="px-5 py-3 text-gray-500">{{ $a->waktu ?: '—' }}</td>
                <td class="px-5 py-3 text-right whitespace-nowrap">
                    <a href="{{ route('admin.agenda.edit', $a) }}"
                       class="text-[#2d6a4f] hover:underline text-xs font-medium mr-3">Edit</a>
                    <form method="POST" action="{{ route('admin.agenda.destroy', $a) }}"
                          class="inline" onsubmit="return confirm('Hapus agenda ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="bg-white rounded-xl shadow p-16 text-center">
    <div class="text-5xl mb-4">📅</div>
    <h3 class="text-gray-600 font-semibold mb-2">Belum ada agenda</h3>
    <a href="{{ route('admin.agenda.create') }}" class="text-[#2d6a4f] text-sm hover:underline">+ Tambah agenda pertama</a>
</div>
@endif
@endsection
