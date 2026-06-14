// =====================================================================
//  Generator PDF Barcode (QR Code) Tanaman — Kelurahan Mojo 2
//  Output: 1 PDF berisi QR Code + info tiap tanaman, 4 kartu / halaman A4.
//  Hasil cetak dipotong per kartu, lalu dilaminating & ditempel di tanaman.
//
//  Cara pakai:
//    cd c:\laragon\www\kknnr\cetak-barcode
//    node generate-pdf.cjs
//
//  Semua pengaturan ada di blok CONFIG di bawah. Daftar tanaman ada di
//  plants.json. Penjelasan lengkap "alamat" yang bisa diubah: README.md
// =====================================================================

const fs = require('fs');
const path = require('path');
const QRCode = require('qrcode');
const puppeteer = require('puppeteer-core');

// ============================ KONFIGURASI ============================
const CONFIG = {
  // Domain produksi. QR akan berisi: baseUrl + "tanaman/" + slug
  // Ganti di SINI saja kalau domain berubah.
  baseUrl: 'https://kelurahan-mojo.com/',

  // Judul kecil di atas tiap kartu (identitas program). Kosongkan ('') untuk sembunyikan.
  brand: 'TAMAN TOGA & PRODUKTIF • RW 12 — KELURAHAN MOJO',

  // Identitas penyelenggara (footer kartu, di samping logo). Kosongkan ('') untuk sembunyikan.
  orgLine1: 'KKN NR 11',
  orgLine2: 'UNTAG SURABAYA',
  logoFile: 'assets/logo-untag.png',   // logo di footer (relatif ke folder ini). '' = tanpa logo.

  perPage: 4,                         // jumlah kartu per halaman (grid 2 x 2)
  outputPdf: 'barcode-tanaman.pdf',   // nama file PDF hasil
  outputHtml: 'barcode-tanaman.html', // versi HTML (buat preview / cetak manual)

  qrSizePx: 1000,       // resolusi gambar QR (px). Makin besar = makin tajam saat dicetak.
  qrCardMm: 70,         // ukuran QR di kartu (mm)
  showLatin: true,      // tampilkan nama latin
  showJenis: true,      // tampilkan badge jenis (Buah / Sayur / Hias / Obat-TOGA ...)
  showManfaat: true,    // tampilkan ringkasan manfaat di bawah nama
  showId: true,         // tampilkan kode ID (TNM-xx) di footer
  showUrl: false,       // tampilkan teks URL kecil (biasanya tidak perlu)
  cutMarks: true,       // garis putus-putus bantu potong tiap kartu

  // Warna badge per jenis tanaman (boleh ditambah/diubah). Default: abu-abu.
  jenisColors: {
    'Buah':              '#ea580c', // oranye
    'Sayur':             '#16a34a', // hijau
    'Hias':              '#db2777', // pink
    'Obat / TOGA':       '#0d9488', // teal
    'Produktif lainnya': '#2563eb', // biru
  },

  // Lokasi browser untuk render PDF. Dipakai yang pertama ditemukan.
  chromePaths: [
    'C:/Program Files/Google/Chrome/Application/chrome.exe',
    'C:/Program Files (x86)/Google/Chrome/Application/chrome.exe',
    'C:/Program Files (x86)/Microsoft/Edge/Application/msedge.exe',
    'C:/Program Files/Microsoft/Edge/Application/msedge.exe',
  ],
};
// =====================================================================

function plantUrl(p) {
  return CONFIG.baseUrl.replace(/\/+$/, '') + '/tanaman/' + p.slug;
}

function esc(s) {
  return String(s == null ? '' : s)
    .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

function chunk(arr, n) {
  const out = [];
  for (let i = 0; i < arr.length; i += n) out.push(arr.slice(i, i + n));
  return out;
}

function jenisColor(jenis) {
  return CONFIG.jenisColors[jenis] || '#64748b';
}

function loadLogoDataUrl() {
  if (!CONFIG.logoFile) return '';
  const p = path.join(__dirname, CONFIG.logoFile);
  if (!fs.existsSync(p)) {
    console.warn(`⚠  Logo tidak ditemukan: ${CONFIG.logoFile} (footer tampil tanpa logo).`);
    return '';
  }
  const ext = path.extname(p).slice(1).toLowerCase();
  const mime = ext === 'svg' ? 'image/svg+xml' : (ext === 'jpg' ? 'image/jpeg' : `image/${ext}`);
  return `data:${mime};base64,${fs.readFileSync(p).toString('base64')}`;
}

function findChrome() {
  for (const p of CONFIG.chromePaths) {
    if (fs.existsSync(p)) return p;
  }
  return null;
}

function buildHtml(cards, logo) {
  const pages = chunk(cards, CONFIG.perPage);

  const footRow = `
        <div class="brandrow">
          ${logo ? `<img class="logo" src="${logo}" alt="Logo UNTAG Surabaya" />` : ''}
          ${(CONFIG.orgLine1 || CONFIG.orgLine2) ? `<div class="kkn">
            ${CONFIG.orgLine1 ? `<b>${esc(CONFIG.orgLine1)}</b>` : ''}
            ${CONFIG.orgLine2 ? `<span>${esc(CONFIG.orgLine2)}</span>` : ''}
          </div>` : ''}
        </div>`;

  const cardHtml = (c) => `
    <div class="card">
      ${CONFIG.brand ? `<div class="brand">${esc(CONFIG.brand)}</div>` : ''}
      <div class="body">
        ${CONFIG.showJenis && c.jenis
          ? `<div class="jenis" style="background:${jenisColor(c.jenis)}">${esc(c.jenis)}</div>` : ''}
        <img class="qr" src="${c.qr}" alt="QR ${esc(c.nama)}" />
        <div class="nama">${esc(c.nama)}</div>
        ${CONFIG.showLatin && c.nama_latin ? `<div class="latin">${esc(c.nama_latin)}</div>` : ''}
        ${CONFIG.showManfaat && c.manfaat
          ? `<div class="manfaat"><b>Manfaat:</b> ${esc(c.manfaat)}</div>` : ''}
      </div>
      <div class="foot">
        <div class="scan">📷 Pindai QR untuk info lengkap tanaman</div>
        ${footRow}
        ${CONFIG.showId ? `<div class="id">TNM-${String(c.id).padStart(3, '0')}</div>` : ''}
        ${CONFIG.showUrl ? `<div class="url">${esc(c.url)}</div>` : ''}
      </div>
    </div>`;

  // lengkapi sel kosong di halaman terakhir agar grid tetap rapi
  const pageHtml = (group) => {
    let cells = group.map(cardHtml).join('');
    for (let i = group.length; i < CONFIG.perPage; i++) cells += `<div class="card empty"></div>`;
    return `<section class="page">${cells}</section>`;
  };

  return `<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8" />
<title>Barcode Tanaman — Kelurahan Mojo 2</title>
<style>
  @page { size: A4; margin: 8mm; }
  * { box-sizing: border-box; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  html, body { margin: 0; padding: 0; }
  body { font-family: "Segoe UI", Arial, sans-serif; color: #1f2937; }

  .page {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 5mm;
    width: 194mm;
    height: 281mm;
    page-break-after: always;
  }
  .page:last-child { page-break-after: auto; }

  .card {
    position: relative;
    border: ${CONFIG.cutMarks ? '1.4px dashed #94a3b8' : '1px solid #e2e8f0'};   /* garis bantu potong */
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    padding: 8mm 5mm 4mm;   /* atas 8mm = beri jarak dari header hijau */
    text-align: center;
    overflow: hidden;
  }
  .card.empty { border-color: transparent; }

  .card .brand {
    position: absolute; top: 0; left: 0; right: 0;
    background: #166534; color: #fff;
    font-size: 8.5px; font-weight: 700; letter-spacing: .6px;
    padding: 1.8mm 2mm; line-height: 1.1;
  }

  /* isi utama mengisi ruang & merata supaya konten dekat ke garis potong */
  .card .body {
    flex: 1;
    display: flex; flex-direction: column;
    align-items: center; justify-content: space-evenly;
  }
  .card .jenis {
    color: #fff; font-size: 12px; font-weight: 700;
    padding: 1.2mm 4mm; border-radius: 999px;
    letter-spacing: .4px;
  }
  .card .qr {
    width: ${CONFIG.qrCardMm}mm;
    height: ${CONFIG.qrCardMm}mm;
    image-rendering: pixelated;     /* QR tetap tajam saat dicetak */
  }
  .card .nama   { font-size: 24px; font-weight: 800; color: #166534; line-height: 1.15; }
  .card .latin  { font-size: 14px; font-style: italic; color: #64748b; margin-top: 1mm; }
  .card .manfaat{
    font-size: 12px; color: #374151; margin-top: 2.5mm; line-height: 1.4; max-width: 84mm;
  }
  .card .manfaat b { color: #15803d; }

  /* footer: ajakan scan + logo & identitas KKN + kode TNM */
  .card .foot {
    border-top: 1px solid #e5e7eb;
    padding-top: 2.2mm;
    display: flex; flex-direction: column; align-items: center; gap: 1.6mm;
  }
  .card .scan   { font-size: 10px; color: #475569; letter-spacing: .2px; }
  .card .brandrow { display: flex; align-items: center; gap: 2mm; }
  .card .logo   { height: 9mm; width: auto; }
  .card .kkn    { text-align: left; line-height: 1.1; }
  .card .kkn b    { display: block; font-size: 11px; font-weight: 800; color: #b91c1c; letter-spacing: .4px; }
  .card .kkn span { display: block; font-size: 9px; color: #475569; letter-spacing: .3px; }
  .card .id     { font-size: 10.5px; color: #16a34a; font-weight: 700; letter-spacing: 1px; }
  .card .url    { font-size: 9px; color: #94a3b8; word-break: break-all; }
</style>
</head>
<body>
${pages.map(pageHtml).join('\n')}
</body>
</html>`;
}

(async () => {
  const plants = JSON.parse(fs.readFileSync(path.join(__dirname, 'plants.json'), 'utf8'));
  console.log(`Membaca ${plants.length} tanaman dari plants.json`);

  const logo = loadLogoDataUrl();

  // 1) generate QR code (data URL) untuk tiap tanaman
  const cards = [];
  for (const p of plants) {
    const url = plantUrl(p);
    const qr = await QRCode.toDataURL(url, {
      width: CONFIG.qrSizePx,
      margin: 1,
      errorCorrectionLevel: 'M',
    });
    cards.push({ ...p, url, qr });
  }

  // 2) susun HTML
  const html = buildHtml(cards, logo);
  const htmlPath = path.join(__dirname, CONFIG.outputHtml);
  fs.writeFileSync(htmlPath, html, 'utf8');
  console.log(`HTML dibuat: ${CONFIG.outputHtml}`);

  // 3) render ke PDF lewat browser
  const chrome = findChrome();
  if (!chrome) {
    console.warn('\n⚠  Chrome/Edge tidak ditemukan. PDF tidak dibuat otomatis.');
    console.warn('   Buka ' + CONFIG.outputHtml + ' di browser, lalu Ctrl+P > Save as PDF (A4).');
    return;
  }

  const browser = await puppeteer.launch({
    executablePath: chrome,
    headless: 'new',
    args: ['--no-sandbox'],
  });
  const page = await browser.newPage();
  await page.setContent(html, { waitUntil: 'networkidle0' });
  await page.pdf({
    path: path.join(__dirname, CONFIG.outputPdf),
    format: 'A4',
    printBackground: true,
    preferCSSPageSize: true,
  });
  await browser.close();

  const totalPages = Math.ceil(cards.length / CONFIG.perPage);
  console.log(`\n✓ Selesai: ${CONFIG.outputPdf}`);
  console.log(`  ${cards.length} tanaman • ${CONFIG.perPage}/halaman • ${totalPages} halaman`);
  console.log(`  URL contoh: ${cards[0].url}`);
})().catch((e) => {
  console.error('Gagal:', e);
  process.exit(1);
});
