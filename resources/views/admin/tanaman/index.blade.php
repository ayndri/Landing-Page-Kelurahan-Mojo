@extends('layouts.admin')
@section('title', 'Kelola Tanaman')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <p class="text-gray-500 text-sm">{{ $plants->total() }} tanaman terdaftar</p>
    <div class="flex items-center gap-2">
        <button type="button" id="btn-cetak-barcode" disabled
                class="bg-white border border-[#2d6a4f] text-[#2d6a4f] text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-[#2d6a4f] hover:text-white transition flex items-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:text-[#2d6a4f]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Barcode (<span id="barcode-count">0</span>)
        </button>
        <a href="{{ route('admin.tanaman.create') }}"
           class="bg-[#2d6a4f] text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-[#40916c] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Tanaman
        </a>
    </div>
</div>

@if($plants->count())
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm min-w-[700px]">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-5 py-3 w-10"><input type="checkbox" id="check-all" class="barcode-check-all w-4 h-4 accent-[#2d6a4f] align-middle"></th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Tanaman</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Jenis</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Lokasi</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Diinput oleh</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Ditambah</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($plants as $plant)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4"><input type="checkbox" value="{{ $plant->id }}" class="barcode-check w-4 h-4 accent-[#2d6a4f] align-middle"></td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        @if($plant->foto)
                            <img src="{{ Storage::url($plant->foto) }}" class="w-10 h-10 rounded-lg object-cover">
                        @else
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-lg">🌿</div>
                        @endif
                        <div>
                            <div class="font-medium text-gray-800">{{ $plant->nama }}</div>
                            @if($plant->nama_latin)
                                <div class="text-xs text-gray-400 italic">{{ $plant->nama_latin }}</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 text-gray-500">{{ $plant->jenis ?? '-' }}</td>
                <td class="px-5 py-4">
                    @if($plant->latitude && $plant->longitude)
                        <span class="text-green-600 text-xs flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            Terpetakan
                        </span>
                    @else
                        <span class="text-gray-400 text-xs">Belum ada</span>
                    @endif
                </td>
                <td class="px-5 py-4">
                    @if($plant->user)
                        <div class="text-xs font-medium text-gray-700">{{ $plant->user->name }}</div>
                        @if($plant->user->rw_number)
                            <div class="text-xs text-gray-400">RW {{ $plant->user->rw_number }}</div>
                        @endif
                    @else
                        <span class="text-gray-300 text-xs">—</span>
                    @endif
                </td>
                <td class="px-5 py-4 text-gray-400 text-xs">{{ $plant->created_at->format('d M Y') }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-2 justify-end">
                        <a href="{{ route('tanaman.show', $plant) }}" target="_blank"
                           class="text-gray-400 hover:text-blue-600 transition" title="Lihat QR">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                        <a href="{{ route('admin.tanaman.edit', $plant) }}"
                           class="text-gray-400 hover:text-[#2d6a4f] transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.tanaman.destroy', $plant) }}"
                              onsubmit="return confirm('Hapus tanaman ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $plants->links() }}</div>

<script>
(function () {
    const baseUrl = @json(route('admin.barcode.tanaman'));
    const btn = document.getElementById('btn-cetak-barcode');
    const counter = document.getElementById('barcode-count');
    const checkAll = document.getElementById('check-all');
    const boxes = () => Array.from(document.querySelectorAll('.barcode-check'));

    function refresh() {
        const selected = boxes().filter(b => b.checked);
        counter.textContent = selected.length;
        btn.disabled = selected.length === 0;
        if (checkAll) {
            checkAll.checked = selected.length > 0 && selected.length === boxes().length;
        }
    }

    boxes().forEach(b => b.addEventListener('change', refresh));
    if (checkAll) {
        checkAll.addEventListener('change', () => {
            boxes().forEach(b => { b.checked = checkAll.checked; });
            refresh();
        });
    }
    btn.addEventListener('click', () => {
        const ids = boxes().filter(b => b.checked).map(b => b.value);
        if (!ids.length) return;
        window.open(baseUrl + '?ids=' + ids.join(','), '_blank');
    });
    refresh();
})();
</script>
@else
<div class="bg-white rounded-xl shadow p-16 text-center">
    <div class="text-5xl mb-4">🌱</div>
    <h3 class="text-gray-600 font-semibold mb-2">Belum ada tanaman</h3>
    <a href="{{ route('admin.tanaman.create') }}" class="text-[#2d6a4f] text-sm hover:underline">+ Tambah tanaman pertama</a>
</div>
@endif
@endsection
