@extends('layouts.admin')
@section('title', 'Kelola Pengguna')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $users->count() }} pengguna terdaftar</p>
    <a href="{{ route('admin.users.create') }}"
       class="bg-[#2d6a4f] text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-[#40916c] transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Pengguna
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm min-w-[700px]">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Nama</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Email</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Role</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">RW</th>
                <th class="text-right px-5 py-3 text-gray-600 font-medium">Tanaman</th>
                <th class="text-right px-5 py-3 text-gray-600 font-medium">UMKM</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($users as $u)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-3 font-medium text-gray-800">
                    {{ $u->name }}
                    @if($u->id === auth()->id())
                        <span class="ml-1 text-xs bg-green-100 text-green-700 px-1.5 py-0.5 rounded">Anda</span>
                    @endif
                </td>
                <td class="px-5 py-3 text-gray-500">{{ $u->email }}</td>
                <td class="px-5 py-3">
                    @if($u->isSuperAdmin())
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-700">Super Admin</span>
                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">Admin RW</span>
                    @endif
                </td>
                <td class="px-5 py-3 text-gray-500">
                    {{ $u->rw_number ? 'RW '.$u->rw_number : '—' }}
                </td>
                <td class="px-5 py-3 text-right text-gray-500">{{ $u->plants_count }}</td>
                <td class="px-5 py-3 text-right text-gray-500">{{ $u->umkm_count }}</td>
                <td class="px-5 py-3">
                    <div class="flex items-center gap-2 justify-end">
                        <a href="{{ route('admin.users.edit', $u) }}"
                           class="text-gray-400 hover:text-[#2d6a4f] transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        @if($u->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                              onsubmit="return confirm('Hapus pengguna {{ $u->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
