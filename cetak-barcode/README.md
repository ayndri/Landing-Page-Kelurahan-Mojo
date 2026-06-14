# Cetak Barcode (QR Code) Tanaman — Kelurahan Mojo 2

Folder ini berisi alat untuk membuat **1 file PDF** berisi QR Code + info tiap
tanaman. PDF dicetak, dipotong per kartu, lalu **dilaminating** dan ditempel di
masing-masing tanaman. Setiap QR kalau dipindai akan membuka halaman detail
tanaman di website.

- **4 kartu per halaman** (grid 2 × 2, kertas A4)
- **22 tanaman → 6 halaman**
- QR berisi link: `https://kelurahan-mojo.com/tanaman/<slug>`

### Isi tiap kartu
1. **Judul program** (header hijau, mis. "TAMAN TOGA & PRODUKTIF • RW 12")
2. **Badge jenis** berwarna — Buah (oranye), Sayur (hijau), Hias (pink),
   Obat/TOGA (teal), Produktif lainnya (biru)
3. **QR Code** → ke halaman detail tanaman
4. **Nama** tanaman + **nama latin**
5. **Ringkasan manfaat** singkat
6. Footer: ajakan **"Pindai QR untuk info lengkap"**, **logo + KKN R 11 UNTAG
   SURABAYA**, dan kode `TNM-001`

## Isi folder

| File | Keterangan |
|------|------------|
| `generate-pdf.cjs` | Skrip pembuat PDF. Semua pengaturan ada di blok `CONFIG` di atas file. |
| `plants.json` | **Daftar tanaman** — sumber data yang dipakai. Edit di sini. |
| `barcode-tanaman.pdf` | **Hasil akhir** — file yang dicetak. |
| `barcode-tanaman.html` | Versi HTML (buat preview di browser / cetak manual). |
| `assets/logo-untag.png` | Logo UNTAG Surabaya yang tampil di footer kartu. Ganti file ini untuk mengganti logo. |

## Cara membuat ulang PDF

```powershell
cd c:\laragon\www\kknnr\cetak-barcode
node generate-pdf.cjs
```

Setiap dijalankan, `barcode-tanaman.pdf` dan `.html` ditimpa dengan data terbaru
dari `plants.json`.

---

## Apa saja yang bisa disesuaikan (dan di mana "alamat"-nya)

### 1. Ganti domain / alamat QR
File: `generate-pdf.cjs` → `CONFIG.baseUrl`

```js
baseUrl: 'https://kelurahan-mojo.com/',
```

QR otomatis jadi `baseUrl + "tanaman/" + slug`. Cukup ubah di **satu tempat ini**,
semua QR ikut berubah saat di-generate ulang.

### 2. Ganti judul/identitas di kartu
File: `generate-pdf.cjs` → `CONFIG.brand`

```js
brand: 'TAMAN TOGA & PRODUKTIF • RW 12 — KELURAHAN MOJO',
```

Kosongkan (`brand: ''`) kalau tidak mau ada header.

### 2b. Logo & identitas penyelenggara (footer)
File: `generate-pdf.cjs` → `CONFIG`

```js
orgLine1: 'KKN R 11',
orgLine2: 'UNTAG SURABAYA',
logoFile: 'assets/logo-untag.png',   // '' = tanpa logo
```

- **Ganti logo** → timpa file `assets/logo-untag.png` (boleh `.png`/`.jpg`/`.svg`,
  paling rapi yang berbentuk persegi/bulat & latar transparan).
- **Ganti teks** → ubah `orgLine1` / `orgLine2`. Kosongkan salah satunya bila perlu.

### 3. Atur urutan & penempatan kartu
File: `plants.json`

Urutan tanaman di PDF **persis mengikuti urutan di `plants.json`** (dari atas ke
bawah, mengisi kartu kiri-atas → kanan-atas → kiri-bawah → kanan-bawah, lalu
halaman berikutnya). Jadi untuk menyesuaikan penaruhan:

- **Pindahkan posisi** sebuah tanaman → geser barisnya ke atas/bawah di `plants.json`.
- **Kelompokkan per area/RW** → susun urutannya sesuai lokasi fisik supaya saat
  cetak, satu halaman = satu area (memudahkan saat menempel di lapangan).
- **Tambah tanaman** → tambahkan satu objek baru (`nama`, `nama_latin`, `slug`,
  `jenis`, `manfaat`, `lokasi`). Pastikan `slug` sama dengan yang ada di website.
- **Hapus tanaman** → hapus barisnya.
- Kolom `lokasi` bebas diisi catatan (mis. "depan balai RW 12") sebagai pengingat
  posisi fisik; saat ini tidak ditampilkan di kartu, tapi membantu menyusun urutan.

#### Kolom di `plants.json`

| Kolom | Wajib? | Fungsi |
|-------|--------|--------|
| `id` | ya | Jadi kode `TNM-001` di kartu. |
| `nama` | ya | Nama tanaman (judul besar). |
| `nama_latin` | tidak | Ditampilkan miring di bawah nama. |
| `slug` | ya | Penentu link QR. **Harus sama** dengan slug di website. |
| `jenis` | tidak | Jadi badge berwarna (Buah/Sayur/Hias/Obat-TOGA/Produktif lainnya). |
| `manfaat` | tidak | Ringkasan manfaat singkat di kartu. |
| `lokasi` | tidak | Catatan posisi fisik (tidak tampil di kartu). |

> Catatan: `plants.json` adalah **salinan** data per 13 Juni 2026. Kalau data di
> website sudah berubah, lihat **bagian "Sinkron dari database"** di bawah.

### 4. Ubah jumlah kartu per halaman & tampilan
File: `generate-pdf.cjs` → `CONFIG`

| Pengaturan | Fungsi | Default |
|-----------|--------|---------|
| `perPage` | Jumlah kartu per halaman | `4` |
| `qrCardMm` | Ukuran QR di kartu (mm) | `42` |
| `qrSizePx` | Resolusi gambar QR (makin besar makin tajam dicetak) | `700` |
| `showLatin` | Tampilkan nama latin | `true` |
| `showJenis` | Tampilkan badge jenis berwarna | `true` |
| `showManfaat` | Tampilkan ringkasan manfaat | `true` |
| `showId` | Tampilkan kode `TNM-001` di bawah QR | `true` |
| `showUrl` | Tampilkan teks URL kecil | `false` |
| `cutMarks` | Garis putus-putus bantu potong | `true` |
| `jenisColors` | Warna badge per jenis | (lihat file) |

> Kalau `perPage` diubah, atur juga `grid-template-rows`/`columns` pada bagian
> `.page { ... }` di dalam `generate-pdf.cjs` (cari komentar "grid 2 x 2").

### 5. Sinkron dari database (kalau data tanaman berubah)
`plants.json` tidak otomatis ikut database. Untuk memperbaruinya, jalankan dari
folder proyek `kknnr`:

```powershell
cd c:\laragon\www\kknnr
php artisan tinker --execute="echo App\Models\Plant::orderBy('id')->get(['id','nama','nama_latin','slug','jenis','manfaat'])->toJson(JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);"
```

Salin hasilnya ke `cetak-barcode/plants.json` (tambahkan kolom `"lokasi": ""`
bila perlu), lalu jalankan ulang `node generate-pdf.cjs`.

---

## Tips cetak & laminating

1. Cetak `barcode-tanaman.pdf` di kertas A4, **skala 100% (Actual size)**, jangan
   "Fit to page" supaya ukuran QR akurat.
2. Potong mengikuti **garis putus-putus** tiap kartu.
3. Laminating tiap kartu, beri lubang/tali atau tempel di papan kecil dekat tanaman.
4. **Tes scan dulu** 1 kartu pakai kamera HP sebelum cetak massal — pastikan
   membuka halaman tanaman yang benar (butuh website sudah online di
   `https://kelurahan-mojo.com`).
