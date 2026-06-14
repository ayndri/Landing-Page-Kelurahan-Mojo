<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>{{ $title }}</title>
<style>
  @page { size: A4; margin: 8mm; }
  * { box-sizing: border-box; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  html, body { margin: 0; padding: 0; }
  body { font-family: "Segoe UI", Arial, sans-serif; color: #1f2937; background: #f1f5f9; }

  /* Bar alat (hanya tampil di layar, hilang saat cetak) */
  .toolbar {
    position: sticky; top: 0; z-index: 10;
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
    background: #0f172a; color: #fff; padding: 12px 18px;
    font-size: 14px;
  }
  .toolbar .info { opacity: .8; font-size: 13px; }
  .toolbar button {
    background: #16a34a; color: #fff; border: none; cursor: pointer;
    font-size: 14px; font-weight: 600; padding: 9px 18px; border-radius: 8px;
  }
  .toolbar button:hover { background: #15803d; }
  .toolbar a { color: #cbd5e1; text-decoration: none; font-size: 13px; }
  .toolbar a:hover { color: #fff; }

  .sheet { padding: 16px; display: flex; flex-direction: column; align-items: center; gap: 16px; }

  .page {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 5mm;
    width: 194mm;
    height: 281mm;
    background: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,.12);
  }

  .card {
    position: relative;
    border: 1.4px dashed #94a3b8;   /* garis bantu potong */
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    padding: 8mm 5mm 4mm;
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
  .card .qr { width: 70mm; height: 70mm; line-height: 0; }
  .card .qr svg { width: 70mm; height: 70mm; display: block; }
  .card .nama   { font-size: 24px; font-weight: 800; line-height: 1.15; }
  .card .sub    { font-size: 14px; color: #64748b; margin-top: 1mm; }
  .card .sub.italic { font-style: italic; }
  .card .note   { font-size: 12px; color: #374151; margin-top: 2.5mm; line-height: 1.4; max-width: 84mm; }
  .card .note b { color: #15803d; }

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

  @media print {
    .toolbar { display: none; }
    .sheet { padding: 0; gap: 0; }
    .page { box-shadow: none; page-break-after: always; }
    .page:last-child { page-break-after: auto; }
    body { background: #fff; }
  }
</style>
</head>
<body>
  <div class="toolbar">
    <span>{{ count($cards) }} barcode • 4 per halaman A4</span>
    <span class="info">Cetak skala 100% (Actual size), jangan "Fit to page".</span>
    <span style="display:flex;align-items:center;gap:16px;">
      <a href="javascript:window.close()">Tutup</a>
      <button onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
    </span>
  </div>

  <div class="sheet">
    @php $pages = array_chunk($cards, 4); @endphp
    @foreach($pages as $group)
    <section class="page">
      @foreach($group as $c)
      <div class="card">
        @if(!empty($c['brand']))
          <div class="brand" style="background: {{ $c['accent'] }}">{{ $c['brand'] }}</div>
        @endif
        <div class="body">
          @if(!empty($c['badge']))
            <div class="jenis" style="background: {{ $c['badgeColor'] }}">{{ $c['badge'] }}</div>
          @endif
          <div class="qr">{!! QrCode::size(300)->margin(1)->generate($c['qrUrl']) !!}</div>
          <div class="nama" style="color: {{ $c['accent'] }}">{{ $c['title'] }}</div>
          @if(!empty($c['subtitle']))
            <div class="sub {{ $c['subtitleStyle'] === 'italic' ? 'italic' : '' }}">{{ $c['subtitle'] }}</div>
          @endif
          @if(!empty($c['note']))
            <div class="note"><b>{{ $c['note']['label'] }}:</b> {{ $c['note']['text'] }}</div>
          @endif
        </div>
        <div class="foot">
          <div class="scan">📷 {{ $c['scan'] }}</div>
          <div class="brandrow">
            <img class="logo" src="{{ asset('images/logo-untag.png') }}" alt="Logo UNTAG Surabaya" />
            <div class="kkn">
              <b>KKN NR 11</b>
              <span>UNTAG SURABAYA</span>
            </div>
          </div>
          <div class="id">{{ $c['code'] }}</div>
        </div>
      </div>
      @endforeach
      @for($i = count($group); $i < 4; $i++)
        <div class="card empty"></div>
      @endfor
    </section>
    @endforeach
  </div>

  <script>
    // Buka dialog cetak otomatis setelah halaman + gambar siap.
    window.addEventListener('load', () => setTimeout(() => window.print(), 400));
  </script>
</body>
</html>
