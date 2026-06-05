<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $mendatang = Agenda::upcoming()->paginate(10);
        $lewat     = Agenda::where('tanggal', '<', now()->startOfDay())
                        ->orderByDesc('tanggal')
                        ->take(5)
                        ->get();

        // Semua agenda untuk kalender (JSON ke JS)
        $semua = Agenda::orderBy('tanggal')->get()->map(fn ($a) => [
            'tanggal'    => $a->tanggal->format('Y-m-d'),
            'judul'      => $a->judul,
            'kategori'   => $a->kategori,
            'waktu'      => $a->waktu,
            'lokasi'     => $a->lokasi,
            'keterangan' => $a->keterangan,
        ]);

        return view('agenda.index', compact('mendatang', 'lewat', 'semua'));
    }
}
