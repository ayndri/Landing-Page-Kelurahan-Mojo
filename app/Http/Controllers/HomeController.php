<?php

namespace App\Http\Controllers;

use App\Models\RwProfile;
use App\Models\Plant;
use App\Models\Umkm;
use App\Models\Pengumuman;
use App\Models\Galeri;
use App\Models\Agenda;
use App\Models\Rt;

class HomeController extends Controller
{
    public function index()
    {
        $rwProfiles = RwProfile::orderBy('rw_number')->get()->keyBy('rw_number');
        $plantCount = Plant::count();
        $umkmCount  = Umkm::count();
        $plants        = Plant::latest()->take(4)->get();
        $umkm          = Umkm::latest()->take(3)->get();
        $pengumumans   = Pengumuman::orderByDesc('is_penting')->orderByDesc('tanggal')->take(3)->get();
        $galeris       = Galeri::orderBy('urutan')->orderByDesc('created_at')->take(8)->get();
        $agendas       = Agenda::upcoming()->take(4)->get();

        return view('home', compact('rwProfiles', 'plantCount', 'umkmCount', 'plants', 'umkm', 'pengumumans', 'galeris', 'agendas'));
    }

    public function rwProfile($rw)
    {
        $validRw = [9, 10, 11, 12, 13];
        if (!in_array((int)$rw, $validRw)) {
            abort(404);
        }

        $profile  = RwProfile::where('rw_number', $rw)->first();
        $rts      = Rt::where('rw_number', $rw)->orderBy('rt_number')->get();
        $agendas  = Agenda::upcoming()
                        ->where(function ($q) use ($rw) {
                            $q->where('rw_number', $rw)->orWhereNull('rw_number');
                        })
                        ->take(5)->get();

        // Tanaman & UMKM milik RW ini (lewat pemilik / user.rw_number)
        $ownedByRw = fn ($q) => $q->whereHas('user', fn ($u) => $u->where('rw_number', $rw));

        $plants     = Plant::where($ownedByRw)->latest()->take(6)->get();
        $umkm       = Umkm::where($ownedByRw)->latest()->take(6)->get();
        $plantCount = Plant::where($ownedByRw)->count();
        $umkmCount  = Umkm::where($ownedByRw)->count();

        return view('rw.profile', compact(
            'profile', 'rw', 'rts', 'agendas',
            'plants', 'umkm', 'plantCount', 'umkmCount'
        ));
    }
}
