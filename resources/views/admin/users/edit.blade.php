@extends('layouts.admin')
@section('title', 'Edit Pengguna')

@section('content')
<div class="max-w-lg">
    <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    <div class="bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f] @error('name') border-red-400 @enderror">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f] @error('email') border-red-400 @enderror">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                <input type="password" name="password" minlength="8"
                       placeholder="Kosongkan jika tidak ingin mengubah"
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f] @error('password') border-red-400 @enderror">
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role <span class="text-red-500">*</span></label>
                <select name="role" id="roleSelect" required onchange="toggleRw(this.value)"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f] @error('role') border-red-400 @enderror">
                    <option value="rw_admin" {{ old('role',$user->role)==='rw_admin'?'selected':'' }}>Admin RW</option>
                    <option value="super_admin" {{ old('role',$user->role)==='super_admin'?'selected':'' }}>Super Admin</option>
                </select>
                @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div id="rwField">
                <label class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                <select name="rw_number"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f] @error('rw_number') border-red-400 @enderror">
                    <option value="">— Pilih RW —</option>
                    @foreach([9,10,11,12,13] as $rw)
                    <option value="{{ $rw }}" {{ old('rw_number',$user->rw_number)==$rw?'selected':'' }}>RW {{ $rw }}</option>
                    @endforeach
                </select>
                @error('rw_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-[#2d6a4f] text-white text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-[#40916c] transition">
                    Perbarui
                </button>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 px-5 py-2.5 rounded-lg hover:bg-gray-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function toggleRw(role) {
    document.getElementById('rwField').style.display = role === 'super_admin' ? 'none' : '';
}
toggleRw(document.getElementById('roleSelect').value);
</script>
@endpush
@endsection
