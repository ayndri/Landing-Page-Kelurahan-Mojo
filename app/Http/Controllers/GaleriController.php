<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('urutan')->orderByDesc('created_at')->get();
        $kategoris = $galeris->pluck('kategori')->filter()->unique()->sort()->values();

        return view('galeri.index', compact('galeris', 'kategoris'));
    }
}
