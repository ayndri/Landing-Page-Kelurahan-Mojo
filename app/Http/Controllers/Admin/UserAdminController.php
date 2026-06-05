<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        abort_unless(Auth::user()->isSuperAdmin(), 403);
        $users = User::withCount(['plants', 'umkm'])
            ->orderByRaw("CASE WHEN role = 'super_admin' THEN 0 ELSE 1 END")
            ->orderBy('rw_number')
            ->orderBy('name')
            ->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_unless(Auth::user()->isSuperAdmin(), 403);
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        abort_unless(Auth::user()->isSuperAdmin(), 403);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|string|min:8',
            'role'      => 'required|in:super_admin,rw_admin',
            'rw_number' => 'nullable|integer|in:9,10,11,12,13',
        ]);

        if ($validated['role'] === 'super_admin') {
            $validated['rw_number'] = null;
        }

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        abort_unless(Auth::user()->isSuperAdmin(), 403);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        abort_unless(Auth::user()->isSuperAdmin(), 403);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
            'password'  => 'nullable|string|min:8',
            'role'      => 'required|in:super_admin,rw_admin',
            'rw_number' => 'nullable|integer|in:9,10,11,12,13',
        ]);

        if ($validated['role'] === 'super_admin') {
            $validated['rw_number'] = null;
        }

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        abort_unless(Auth::user()->isSuperAdmin(), 403);

        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
