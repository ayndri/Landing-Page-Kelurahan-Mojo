<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Umkm;

class PlantController extends Controller
{
    public function index()
    {
        $plants = Plant::latest()->get();
        return view('rw10.tanaman.index', compact('plants'));
    }

    public function show(Plant $plant)
    {
        $plant->load('user');
        return view('rw10.tanaman.show', compact('plant'));
    }

    /** Peta umum — seluruh kelurahan */
    public function peta()
    {
        return $this->renderPeta(null);
    }

    /** Peta khusus satu RW */
    public function petaRw($rw)
    {
        $validRw = [9, 10, 11, 12, 13];
        if (!in_array((int) $rw, $validRw)) {
            abort(404);
        }

        return $this->renderPeta((int) $rw);
    }

    /** Render peta — bila $rw null tampilkan semua titik, selain itu difilter per pemilik RW */
    private function renderPeta(?int $rw)
    {
        $plantQuery = Plant::whereNotNull('latitude')->whereNotNull('longitude');
        $umkmQuery  = Umkm::whereNotNull('latitude')->whereNotNull('longitude');

        if ($rw !== null) {
            $plantQuery->whereHas('user', fn ($q) => $q->where('rw_number', $rw));
            $umkmQuery->whereHas('user', fn ($q) => $q->where('rw_number', $rw));
        }

        $plants = $plantQuery->get()->map(function ($p) {
            return [
                'id'    => $p->id,
                'nama'  => $p->nama,
                'jenis' => $p->jenis,
                'lat'   => $p->latitude,
                'lng'   => $p->longitude,
                'url'   => route('tanaman.show', $p->slug),
            ];
        });

        $umkm = $umkmQuery->get()->map(function ($u) {
            return [
                'id'    => $u->id,
                'nama'  => $u->nama_usaha,
                'jenis' => $u->jenis_usaha,
                'lat'   => $u->latitude,
                'lng'   => $u->longitude,
                'url'   => route('umkm.show', $u->id),
            ];
        });

        return view('rw10.peta', compact('plants', 'umkm', 'rw'));
    }
}
