<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\UmkmProduct;

class UmkmController extends Controller
{
    public function index()
    {
        $umkm = Umkm::with('products')->latest()->get();
        return view('rw10.umkm.index', compact('umkm'));
    }

    public function show(Umkm $umkm)
    {
        $umkm->load('products');
        return view('rw10.umkm.show', compact('umkm'));
    }

    public function showProduct(Umkm $umkm, UmkmProduct $product)
    {
        return view('rw10.umkm.produk-show', compact('umkm', 'product'));
    }
}
