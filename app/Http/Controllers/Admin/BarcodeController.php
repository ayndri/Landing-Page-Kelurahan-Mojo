<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\RwProfile;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarcodeController extends Controller
{
    /** Warna badge per jenis tanaman (samakan dengan generator lama). */
    private const JENIS_COLORS = [
        'Buah'              => '#ea580c', // oranye
        'Sayur'             => '#16a34a', // hijau
        'Hias'              => '#db2777', // pink
        'Obat / TOGA'       => '#0d9488', // teal
        'Produktif lainnya' => '#2563eb', // biru
    ];

    /** Cetak barcode tanaman terpilih (bisa banyak, 4 per halaman). */
    public function tanaman(Request $request)
    {
        $ids = $this->parseIds($request);
        abort_if(empty($ids), 404, 'Tidak ada tanaman yang dipilih.');

        $user = Auth::user();
        $query = Plant::with('user')->whereIn('id', $ids);
        if (! $user->isSuperAdmin()) {
            $query->whereHas('user', fn ($q) => $q->where('rw_number', $user->rw_number));
        }

        // urutkan sesuai urutan id yang dikirim
        $plants = $query->get()->sortBy(fn ($p) => array_search($p->id, $ids))->values();
        abort_if($plants->isEmpty(), 403, 'Anda tidak punya akses ke data ini.');

        $cards = $plants->map(function ($p) {
            $rw = $p->user?->rw_number;
            return [
                'brand'      => 'TANAMAN' . ($rw ? ' • RW ' . $rw : '') . ' — KELURAHAN MOJO 2',
                'badge'      => $p->jenis,
                'badgeColor' => self::JENIS_COLORS[$p->jenis] ?? '#64748b',
                'qrUrl'      => route('tanaman.show', $p),
                'title'      => $p->nama,
                'subtitle'   => $p->nama_latin,
                'subtitleStyle' => 'italic',
                'note'       => $p->manfaat ? ['label' => 'Manfaat', 'text' => $p->manfaat] : null,
                'code'       => 'TNM-' . str_pad((string) $p->id, 3, '0', STR_PAD_LEFT),
                'scan'       => 'Pindai QR untuk info lengkap tanaman',
                'accent'     => '#166534',
            ];
        })->all();

        return view('admin.barcode.print', [
            'title' => 'Barcode Tanaman — Kelurahan Mojo 2',
            'cards' => $cards,
        ]);
    }

    /** Cetak barcode UMKM terpilih (bisa banyak, 4 per halaman). */
    public function umkm(Request $request)
    {
        $ids = $this->parseIds($request);
        abort_if(empty($ids), 404, 'Tidak ada UMKM yang dipilih.');

        $user = Auth::user();
        $query = Umkm::with('user')->whereIn('id', $ids);
        if (! $user->isSuperAdmin()) {
            $query->whereHas('user', fn ($q) => $q->where('rw_number', $user->rw_number));
        }

        $umkm = $query->get()->sortBy(fn ($u) => array_search($u->id, $ids))->values();
        abort_if($umkm->isEmpty(), 403, 'Anda tidak punya akses ke data ini.');

        $cards = $umkm->map(function ($u) {
            $rw = $u->user?->rw_number;
            return [
                'brand'      => 'UMKM' . ($rw ? ' • RW ' . $rw : '') . ' — KELURAHAN MOJO 2',
                'badge'      => $u->jenis_usaha,
                'badgeColor' => '#d97706', // amber, identitas UMKM
                'qrUrl'      => route('umkm.show', $u),
                'title'      => $u->nama_usaha,
                'subtitle'   => $u->nama_pemilik ? 'Pemilik: ' . $u->nama_pemilik : null,
                'subtitleStyle' => 'normal',
                'note'       => $u->produk ? ['label' => 'Produk', 'text' => $u->produk] : null,
                'code'       => 'UMK-' . str_pad((string) $u->id, 3, '0', STR_PAD_LEFT),
                'scan'       => 'Pindai QR untuk info lengkap UMKM',
                'accent'     => '#b45309',
            ];
        })->all();

        return view('admin.barcode.print', [
            'title' => 'Barcode UMKM — Kelurahan Mojo 2',
            'cards' => $cards,
        ]);
    }

    /** Cetak barcode profil RW (single). */
    public function rw(Request $request)
    {
        $user = Auth::user();
        $rwNumber = $user->isSuperAdmin()
            ? (int) $request->input('rw', 9)
            : $user->rw_number;

        $profile = RwProfile::firstOrNew(['rw_number' => $rwNumber]);

        $cards = [[
            'brand'      => 'PROFIL RW ' . $rwNumber . ' — KELURAHAN MOJO 2',
            'badge'      => null,
            'badgeColor' => '#166534',
            'qrUrl'      => route('rw.profile', $rwNumber),
            'title'      => 'RW ' . $rwNumber,
            'subtitle'   => $profile->nama_ketua ? 'Ketua RW: ' . $profile->nama_ketua : null,
            'subtitleStyle' => 'normal',
            'note'       => null,
            'code'       => 'RW-' . str_pad((string) $rwNumber, 3, '0', STR_PAD_LEFT),
            'scan'       => 'Pindai QR untuk buka profil RW ' . $rwNumber,
            'accent'     => '#166534',
        ]];

        return view('admin.barcode.print', [
            'title' => 'Barcode Profil RW ' . $rwNumber,
            'cards' => $cards,
        ]);
    }

    /** Ambil daftar id dari query (?ids=1,2,3 atau ?ids[]=1&ids[]=2). */
    private function parseIds(Request $request): array
    {
        $raw = $request->input('ids', []);
        if (is_string($raw)) {
            $raw = explode(',', $raw);
        }

        return collect($raw)
            ->map(fn ($v) => (int) trim((string) $v))
            ->filter(fn ($v) => $v > 0)
            ->unique()
            ->values()
            ->all();
    }
}
