<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RtAdminController extends Controller
{
    private function userRw(): int
    {
        return Auth::user()->rw_number;
    }

    private function isSuperAdmin(): bool
    {
        return Auth::user()->isSuperAdmin();
    }

    public function index()
    {
        if ($this->isSuperAdmin()) {
            $rts = Rt::orderBy('rw_number')->orderBy('rt_number')->get()->groupBy('rw_number');
        } else {
            $rts = Rt::where('rw_number', $this->userRw())
                     ->orderBy('rt_number')->get()->groupBy('rw_number');
        }
        return view('admin.rt.index', compact('rts'));
    }

    public function create()
    {
        $rwOptions = $this->isSuperAdmin() ? [9, 10, 11, 12, 13] : [$this->userRw()];
        return view('admin.rt.create', compact('rwOptions'));
    }

    public function store(Request $request)
    {
        $rwOptions = $this->isSuperAdmin() ? [9, 10, 11, 12, 13] : [$this->userRw()];

        $validated = $request->validate([
            'rw_number'       => 'required|integer|in:'.implode(',', $rwOptions),
            'rt_number'       => 'required|integer|min:1|max:99',
            'nama_ketua'      => 'nullable|string|max:100',
            'no_telepon'      => 'nullable|string|max:30',
            'jumlah_kk'       => 'nullable|integer|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
        ]);

        Rt::updateOrCreate(
            ['rw_number' => $validated['rw_number'], 'rt_number' => $validated['rt_number']],
            $validated
        );

        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil disimpan.');
    }

    public function edit(Rt $rt)
    {
        if (!$this->isSuperAdmin() && $rt->rw_number !== $this->userRw()) {
            abort(403);
        }
        $rwOptions = $this->isSuperAdmin() ? [9, 10, 11, 12, 13] : [$this->userRw()];
        return view('admin.rt.edit', compact('rt', 'rwOptions'));
    }

    public function update(Request $request, Rt $rt)
    {
        if (!$this->isSuperAdmin() && $rt->rw_number !== $this->userRw()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_ketua'      => 'nullable|string|max:100',
            'no_telepon'      => 'nullable|string|max:30',
            'jumlah_kk'       => 'nullable|integer|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
        ]);

        $rt->update($validated);

        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil diperbarui.');
    }

    public function destroy(Rt $rt)
    {
        if (!$this->isSuperAdmin() && $rt->rw_number !== $this->userRw()) {
            abort(403);
        }
        $rt->delete();
        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil dihapus.');
    }
}
