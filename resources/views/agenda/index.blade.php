@extends('layouts.app')
@section('title', 'Agenda Kegiatan — Kelurahan Mojo 2')

@push('styles')
<style>
/* ── HERO ── */
.agenda-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(150deg, #0f2d1e 0%, #1a3d2b 40%, #2d6a4f 100%);
}
.agenda-hero-orb1 {
    position: absolute;
    right: -80px; top: -80px;
    width: 460px; height: 460px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(116,198,157,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.agenda-hero-orb2 {
    position: absolute;
    left: -80px; bottom: -60px;
    width: 340px; height: 340px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(27,67,50,0.6) 0%, transparent 70%);
    pointer-events: none;
}
.agenda-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 72rem;
    margin: 0 auto;
    padding: 3rem 1.5rem 5rem;
}

/* ── TOGGLE ── */
.view-toggle {
    display: inline-flex;
    background: #fff;
    border-radius: 9999px;
    padding: 4px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    gap: 2px;
}
.view-btn {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 8px 20px;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    transition: all 0.18s;
    color: #6b7280;
    background: transparent;
}
.view-btn.active {
    background: #2d6a4f;
    color: #fff;
    box-shadow: 0 2px 8px rgba(45,106,79,0.35);
}
.view-btn:not(.active):hover { color: #2d6a4f; }

/* ── MAIN LAYOUT ── */
.agenda-main {
    max-width: 72rem;
    margin: 0 auto;
    padding: 2.5rem 1.5rem 5rem;
}

/* ── CALENDAR ── */
.cal-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    border: 1px solid #f0f0f0;
    overflow: hidden;
}
.cal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f3f4f6;
}
.cal-nav-btn {
    width: 2.25rem; height: 2.25rem;
    border-radius: 50%;
    border: 1.5px solid #e5e7eb;
    background: #fff;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    transition: all 0.15s;
    color: #374151;
    flex-shrink: 0;
}
.cal-nav-btn:hover { background: #f0faf4; border-color: #2d6a4f; color: #2d6a4f; }
.cal-month-label {
    font-size: 1.125rem;
    font-weight: 900;
    color: #111827;
    letter-spacing: -0.01em;
}
.cal-dow {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    background: #f8fafc;
    border-bottom: 1px solid #f3f4f6;
}
.cal-dow-cell {
    text-align: center;
    padding: 0.625rem 0;
    font-size: 0.6875rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #9ca3af;
}
.cal-dow-cell.weekend { color: #dc2626; opacity: 0.7; }
.cal-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
}
.cal-cell {
    min-height: 80px;
    padding: 6px 8px 6px;
    border-right: 1px solid #f3f4f6;
    border-bottom: 1px solid #f3f4f6;
    cursor: default;
    transition: background 0.12s;
    position: relative;
}
.cal-cell:nth-child(7n) { border-right: none; }
.cal-cell.has-event { cursor: pointer; }
.cal-cell.has-event:hover { background: #f0faf4; }
.cal-cell.today .cal-day-num {
    background: #2d6a4f;
    color: #fff;
    border-radius: 50%;
}
.cal-cell.selected { background: #f0faf4; }
.cal-cell.selected .cal-day-num {
    background: #40916c;
    color: #fff;
    border-radius: 50%;
}
.cal-cell.other-month { opacity: 0.3; cursor: default !important; }
.cal-cell.other-month:hover { background: transparent !important; }
.cal-day-num {
    width: 26px; height: 26px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8125rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: 4px;
    flex-shrink: 0;
}
.cal-cell.weekend-col .cal-day-num { color: #dc2626; }
.cal-dots {
    display: flex;
    flex-wrap: wrap;
    gap: 3px;
    margin-top: 2px;
}
.cal-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    flex-shrink: 0;
}
.cal-event-label {
    font-size: 0.6rem;
    font-weight: 600;
    line-height: 1.3;
    color: #374151;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-top: 3px;
}

/* ── SELECTED DAY PANEL ── */
.selected-panel {
    border-top: 1px solid #f3f4f6;
    padding: 1.25rem 1.5rem;
    background: #f8fafc;
    display: none;
}
.selected-panel.show { display: block; }
.event-row {
    display: flex;
    align-items: stretch;
    gap: 0.875rem;
    margin-bottom: 0.625rem;
}
.event-row:last-child { margin-bottom: 0; }
.event-color-bar {
    width: 4px;
    border-radius: 9999px;
    flex-shrink: 0;
}
.event-content { flex: 1; min-width: 0; }

/* ── LEGEND ── */
.cal-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    padding: 1rem 1.5rem;
    border-top: 1px solid #f3f4f6;
    background: #fff;
}
.legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #4b5563;
}
.legend-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

/* ── LIST VIEW ── */
.list-card {
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #f0f0f0;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    overflow: hidden;
    display: flex;
    margin-bottom: 0.875rem;
}
.list-date-block {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1rem 1.125rem;
    min-width: 68px;
    flex-shrink: 0;
    color: #fff;
}
.list-card.lewat { opacity: 0.55; }
.list-card.lewat .list-date-block { background: #9ca3af !important; }
.list-body {
    flex: 1;
    padding: 0.875rem 1rem;
    min-width: 0;
}
.kategori-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.65rem;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 9999px;
    margin-bottom: 5px;
}

/* ── RESPONSIVE ── */
@media (max-width: 639px) {
    .cal-cell { min-height: 56px; padding: 4px 4px; }
    .cal-day-num { width: 22px; height: 22px; font-size: 0.75rem; }
    .cal-event-label { display: none; }
    .cal-dot { width: 6px; height: 6px; }
}
</style>
@endpush

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="agenda-hero text-white">
    <div class="agenda-hero-orb1"></div>
    <div class="agenda-hero-orb2"></div>
    <div class="agenda-hero-inner">

        {{-- Breadcrumb --}}
        <div style="font-size:0.8rem;color:rgba(209,250,229,0.6);margin-bottom:1.75rem;display:flex;align-items:center;gap:8px;">
            <a href="{{ route('home') }}" style="color:rgba(209,250,229,0.6);text-decoration:none;"
               onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(209,250,229,0.6)'">Beranda</a>
            <span style="opacity:0.4;">/</span>
            <span>Agenda</span>
        </div>

        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1.5rem;">
            <div>
                <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:9999px;padding:5px 14px;margin-bottom:1rem;font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(209,250,229,0.85);">
                    📅 Jadwal Kegiatan
                </div>
                <h1 style="font-size:clamp(2rem,4.5vw,3rem);font-weight:900;line-height:1.05;letter-spacing:-0.03em;margin:0 0 0.75rem;">
                    Agenda<br>
                    <span style="color:#74c69d;">Kelurahan Mojo 2</span>
                </h1>
                <p style="color:rgba(209,250,229,0.6);font-size:0.9375rem;line-height:1.7;max-width:32rem;margin:0;">
                    Jadwal kegiatan mendatang dan arsip kegiatan warga se-kelurahan.
                </p>
            </div>

            {{-- Stats --}}
            <div style="display:flex;gap:0.75rem;flex-shrink:0;">
                <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:1.25rem;padding:1.25rem 1.5rem;text-align:center;backdrop-filter:blur(8px);">
                    <div style="font-size:2.25rem;font-weight:900;color:#74c69d;line-height:1;">{{ $mendatang->total() }}</div>
                    <div style="font-size:0.7rem;color:rgba(209,250,229,0.55);font-weight:600;letter-spacing:0.06em;text-transform:uppercase;margin-top:5px;">Mendatang</div>
                </div>
            </div>
        </div>

        {{-- Toggle --}}
        <div style="margin-top:2rem;">
            <div class="view-toggle">
                <button class="view-btn active" id="btn-kalender" onclick="switchView('kalender')">
                    <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Kalender
                </button>
                <button class="view-btn" id="btn-daftar" onclick="switchView('daftar')">
                    <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    Daftar
                </button>
            </div>
        </div>
    </div>

    {{-- Wave --}}
    <svg style="display:block;width:100%;margin-top:-1px;" viewBox="0 0 1440 56" preserveAspectRatio="none" fill="none">
        <path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f8fafc"/>
    </svg>
</section>

{{-- ═══ MAIN CONTENT ═══ --}}
<div style="background:#f8fafc;min-height:60vh;">
<div class="agenda-main">

    {{-- ── KALENDER VIEW ── --}}
    <div id="view-kalender">
        <div class="cal-card">
            {{-- Header nav --}}
            <div class="cal-header">
                <button class="cal-nav-btn" onclick="calNav(-1)" title="Bulan sebelumnya">
                    <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div style="text-align:center;">
                    <div class="cal-month-label" id="cal-month-label">—</div>
                    <div id="cal-today-btn-wrap" style="margin-top:4px;"></div>
                </div>
                <button class="cal-nav-btn" onclick="calNav(1)" title="Bulan berikutnya">
                    <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {{-- Hari header --}}
            <div class="cal-dow">
                <div class="cal-dow-cell weekend">Min</div>
                <div class="cal-dow-cell">Sen</div>
                <div class="cal-dow-cell">Sel</div>
                <div class="cal-dow-cell">Rab</div>
                <div class="cal-dow-cell">Kam</div>
                <div class="cal-dow-cell">Jum</div>
                <div class="cal-dow-cell weekend">Sab</div>
            </div>

            {{-- Grid hari --}}
            <div class="cal-grid" id="cal-grid"></div>

            {{-- Panel acara hari dipilih --}}
            <div class="selected-panel" id="selected-panel">
                <div id="selected-date-label" style="font-weight:800;font-size:0.875rem;color:#2d6a4f;margin-bottom:0.875rem;display:flex;align-items:center;gap:6px;">
                    <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span id="selected-date-text"></span>
                </div>
                <div id="selected-events"></div>
            </div>

            {{-- Legend --}}
            <div class="cal-legend">
                @php
                    $legendKat = ['Kesehatan'=>'#dc2626','Sosial'=>'#2563eb','Rapat'=>'#d97706','Olahraga'=>'#16a34a','Pendidikan'=>'#7c3aed','Lainnya'=>'#6b7280'];
                    $emojiKat  = ['Kesehatan'=>'🏥','Sosial'=>'🤝','Rapat'=>'🗣️','Olahraga'=>'🏃','Pendidikan'=>'📚','Lainnya'=>'📌'];
                @endphp
                @foreach($legendKat as $k => $c)
                <div class="legend-item">
                    <span class="legend-dot" style="background:{{ $c }};"></span>
                    {{ $emojiKat[$k] ?? '' }} {{ $k }}
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── DAFTAR VIEW ── --}}
    <div id="view-daftar" style="display:none;">

        {{-- Mendatang --}}
        <h2 style="font-size:1.125rem;font-weight:800;color:#111827;margin:0 0 1.25rem;display:flex;align-items:center;gap:8px;">
            <span style="display:inline-block;width:4px;height:1.25rem;background:#2d6a4f;border-radius:9999px;"></span>
            Kegiatan Mendatang
        </h2>

        @forelse($mendatang as $a)
        @php
            $agColors = ['Kesehatan'=>'#dc2626','Sosial'=>'#2563eb','Rapat'=>'#d97706','Olahraga'=>'#16a34a','Pendidikan'=>'#7c3aed','Lainnya'=>'#6b7280'];
            $agEmoji  = ['Kesehatan'=>'🏥','Sosial'=>'🤝','Rapat'=>'🗣️','Olahraga'=>'🏃','Pendidikan'=>'📚','Lainnya'=>'📌'];
            $c = $agColors[$a->kategori] ?? '#6b7280';
            $e = $agEmoji[$a->kategori] ?? '📌';
        @endphp
        <div class="list-card">
            <div class="list-date-block" style="background:{{ $c }};">
                <span style="font-size:1.625rem;font-weight:900;line-height:1;">{{ $a->tanggal->format('d') }}</span>
                <span style="font-size:0.625rem;font-weight:700;text-transform:uppercase;opacity:0.85;letter-spacing:0.04em;">{{ $a->tanggal->translatedFormat('M') }}</span>
                <span style="font-size:0.625rem;opacity:0.7;margin-top:1px;">{{ $a->tanggal->format('Y') }}</span>
            </div>
            <div class="list-body">
                <span class="kategori-badge" style="background:{{ $c }}18;color:{{ $c }};">
                    {{ $e }} {{ $a->kategori }}
                </span>
                <div style="font-weight:800;font-size:0.9375rem;color:#111827;margin-bottom:4px;line-height:1.35;">{{ $a->judul }}</div>
                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    @if($a->waktu)
                    <span style="font-size:0.775rem;color:#6b7280;display:flex;align-items:center;gap:4px;">
                        <svg style="width:0.75rem;height:0.75rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $a->waktu }}
                    </span>
                    @endif
                    @if($a->lokasi)
                    <span style="font-size:0.775rem;color:#6b7280;display:flex;align-items:center;gap:4px;">
                        <svg style="width:0.75rem;height:0.75rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $a->lokasi }}
                    </span>
                    @endif
                    @if(!$a->rw_number)
                    <span style="font-size:0.65rem;font-weight:700;background:#f0faf4;color:#2d6a4f;padding:2px 8px;border-radius:9999px;">Seluruh Kelurahan</span>
                    @else
                    <span style="font-size:0.65rem;font-weight:700;background:#f0faf4;color:#2d6a4f;padding:2px 8px;border-radius:9999px;">RW {{ $a->rw_number }}</span>
                    @endif
                </div>
                @if($a->keterangan)
                <p style="font-size:0.8rem;color:#9ca3af;margin:6px 0 0;line-height:1.6;">{{ $a->keterangan }}</p>
                @endif
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:4rem 1rem;background:#fff;border-radius:1.25rem;border:1px dashed #e5e7eb;margin-bottom:1.5rem;">
            <div style="font-size:3rem;margin-bottom:0.75rem;">📅</div>
            <h3 style="font-size:1rem;font-weight:800;color:#374151;margin:0 0 6px;">Tidak ada kegiatan mendatang</h3>
            <p style="color:#9ca3af;font-size:0.875rem;margin:0;">Belum ada agenda yang dijadwalkan.</p>
        </div>
        @endforelse

        @if($mendatang->hasPages())
        <div style="margin:1.5rem 0;">{{ $mendatang->links() }}</div>
        @endif

        {{-- Arsip --}}
        @if($lewat->count())
        <h2 style="font-size:1.125rem;font-weight:800;color:#111827;margin:2rem 0 1.25rem;display:flex;align-items:center;gap:8px;">
            <span style="display:inline-block;width:4px;height:1.25rem;background:#9ca3af;border-radius:9999px;"></span>
            Arsip Kegiatan
        </h2>
        @foreach($lewat as $a)
        @php $c = $agColors[$a->kategori] ?? '#6b7280'; $e = $agEmoji[$a->kategori] ?? '📌'; @endphp
        <div class="list-card lewat">
            <div class="list-date-block" style="background:#9ca3af;">
                <span style="font-size:1.625rem;font-weight:900;line-height:1;">{{ $a->tanggal->format('d') }}</span>
                <span style="font-size:0.625rem;font-weight:700;text-transform:uppercase;opacity:0.85;letter-spacing:0.04em;">{{ $a->tanggal->translatedFormat('M') }}</span>
                <span style="font-size:0.625rem;opacity:0.7;margin-top:1px;">{{ $a->tanggal->format('Y') }}</span>
            </div>
            <div class="list-body">
                <span class="kategori-badge" style="background:{{ $c }}18;color:{{ $c }};">{{ $e }} {{ $a->kategori }}</span>
                <div style="font-weight:700;font-size:0.9rem;color:#6b7280;margin-bottom:3px;">{{ $a->judul }}</div>
                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    @if($a->waktu)<span style="font-size:0.75rem;color:#9ca3af;">🕐 {{ $a->waktu }}</span>@endif
                    @if($a->lokasi)<span style="font-size:0.75rem;color:#9ca3af;">📍 {{ $a->lokasi }}</span>@endif
                </div>
            </div>
        </div>
        @endforeach
        @endif

    </div>{{-- /view-daftar --}}

</div>{{-- /agenda-main --}}
</div>

@push('scripts')
<script>
// ── DATA ──────────────────────────────────────────────────────────────────────
const agendaData = @json($semua);

const AGENDA_COLORS = {
    'Kesehatan': '#dc2626', 'Sosial': '#2563eb', 'Rapat': '#d97706',
    'Olahraga': '#16a34a', 'Pendidikan': '#7c3aed', 'Lainnya': '#6b7280',
};
const AGENDA_EMOJI = {
    'Kesehatan':'🏥','Sosial':'🤝','Rapat':'🗣️','Olahraga':'🏃','Pendidikan':'📚','Lainnya':'📌',
};
const BULAN = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

// Kelompokkan agenda per tanggal
const byDate = {};
agendaData.forEach(a => {
    if (!byDate[a.tanggal]) byDate[a.tanggal] = [];
    byDate[a.tanggal].push(a);
});

// ── STATE ─────────────────────────────────────────────────────────────────────
const today = new Date();
today.setHours(0,0,0,0);
let calYear  = today.getFullYear();
let calMonth = today.getMonth(); // 0-based
let selectedDate = null;

// ── VIEW TOGGLE ───────────────────────────────────────────────────────────────
function switchView(v) {
    document.getElementById('view-kalender').style.display = v === 'kalender' ? '' : 'none';
    document.getElementById('view-daftar').style.display   = v === 'daftar'   ? '' : 'none';
    document.getElementById('btn-kalender').classList.toggle('active', v === 'kalender');
    document.getElementById('btn-daftar').classList.toggle('active',   v === 'daftar');
    if (v === 'kalender') renderCalendar();
}

// ── CALENDAR ──────────────────────────────────────────────────────────────────
function calNav(dir) {
    calMonth += dir;
    if (calMonth > 11) { calMonth = 0; calYear++; }
    if (calMonth < 0)  { calMonth = 11; calYear--; }
    selectedDate = null;
    renderCalendar();
}

function renderCalendar() {
    // Judul bulan
    const label = document.getElementById('cal-month-label');
    label.textContent = BULAN[calMonth] + ' ' + calYear;

    // Tombol "Hari ini" jika bukan bulan ini
    const todayWrap = document.getElementById('cal-today-btn-wrap');
    const isCurrentMonth = (calYear === today.getFullYear() && calMonth === today.getMonth());
    todayWrap.innerHTML = !isCurrentMonth
        ? `<button onclick="goToday()" style="font-size:0.7rem;font-weight:700;color:#2d6a4f;background:#f0faf4;border:1px solid #d1fae5;border-radius:9999px;padding:2px 10px;cursor:pointer;">Hari ini</button>`
        : '';

    const grid = document.getElementById('cal-grid');
    grid.innerHTML = '';

    const firstDay = new Date(calYear, calMonth, 1).getDay(); // 0=Sun
    const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();
    const daysInPrev  = new Date(calYear, calMonth, 0).getDate();

    // Bangun sel-sel (mulai Minggu=0)
    const totalCells = Math.ceil((firstDay + daysInMonth) / 7) * 7;

    for (let i = 0; i < totalCells; i++) {
        const cell = document.createElement('div');
        cell.className = 'cal-cell';

        let day, month, year, otherMonth = false;
        if (i < firstDay) {
            day = daysInPrev - firstDay + i + 1;
            month = calMonth - 1; year = calYear;
            if (month < 0) { month = 11; year--; }
            otherMonth = true;
        } else if (i >= firstDay + daysInMonth) {
            day = i - firstDay - daysInMonth + 1;
            month = calMonth + 1; year = calYear;
            if (month > 11) { month = 0; year++; }
            otherMonth = true;
        } else {
            day = i - firstDay + 1;
            month = calMonth; year = calYear;
        }

        const pad = n => String(n).padStart(2,'0');
        const dateStr = `${year}-${pad(month+1)}-${pad(day)}`;
        const cellDate = new Date(year, month, day);
        const isToday = cellDate.getTime() === today.getTime();
        const isWeekend = (i % 7 === 0 || i % 7 === 6);
        const events = byDate[dateStr] || [];

        if (otherMonth) cell.classList.add('other-month');
        if (isToday) cell.classList.add('today');
        if (isWeekend) cell.classList.add('weekend-col');
        if (selectedDate === dateStr) cell.classList.add('selected');
        if (events.length) cell.classList.add('has-event');

        // Day number
        const numEl = document.createElement('div');
        numEl.className = 'cal-day-num';
        numEl.textContent = day;
        cell.appendChild(numEl);

        // Dots + label (only current month)
        if (events.length && !otherMonth) {
            const dots = document.createElement('div');
            dots.className = 'cal-dots';
            events.slice(0, 4).forEach(ev => {
                const d = document.createElement('span');
                d.className = 'cal-dot';
                d.style.background = AGENDA_COLORS[ev.kategori] || '#6b7280';
                dots.appendChild(d);
            });
            cell.appendChild(dots);

            // Label nama kegiatan pertama (hidden on mobile via CSS)
            if (events.length === 1) {
                const lbl = document.createElement('div');
                lbl.className = 'cal-event-label';
                lbl.textContent = events[0].judul;
                cell.appendChild(lbl);
            } else {
                const lbl = document.createElement('div');
                lbl.className = 'cal-event-label';
                lbl.textContent = events.length + ' kegiatan';
                cell.appendChild(lbl);
            }
        }

        if (events.length && !otherMonth) {
            cell.addEventListener('click', () => showDayEvents(dateStr, cellDate));
        }

        grid.appendChild(cell);
    }

    // Refresh panel if selected day still in view
    if (selectedDate) {
        const [sy, sm, sd] = selectedDate.split('-').map(Number);
        if (sy === calYear && sm === calMonth + 1) {
            // keep panel open
        } else {
            document.getElementById('selected-panel').classList.remove('show');
        }
    }
}

function goToday() {
    calYear  = today.getFullYear();
    calMonth = today.getMonth();
    selectedDate = null;
    renderCalendar();
}

function showDayEvents(dateStr, dateObj) {
    // Deselect previous, select new
    document.querySelectorAll('.cal-cell.selected').forEach(c => c.classList.remove('selected'));
    selectedDate = dateStr;

    // Mark cell
    document.querySelectorAll('.cal-cell').forEach(cell => {
        const num = parseInt(cell.querySelector('.cal-day-num')?.textContent);
        const [,, d] = dateStr.split('-').map(Number);
        if (num === d && !cell.classList.contains('other-month')) {
            cell.classList.add('selected');
        }
    });

    const panel = document.getElementById('selected-panel');
    const events = byDate[dateStr] || [];

    // Format tanggal Indonesia
    const hariNames = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const hariLabel = hariNames[dateObj.getDay()];
    const [y, m, d] = dateStr.split('-').map(Number);
    document.getElementById('selected-date-text').textContent =
        `${hariLabel}, ${d} ${BULAN[m-1]} ${y}`;

    const container = document.getElementById('selected-events');
    container.innerHTML = '';

    if (!events.length) {
        container.innerHTML = '<p style="font-size:0.875rem;color:#9ca3af;margin:0;">Tidak ada kegiatan pada hari ini.</p>';
    } else {
        events.forEach(ev => {
            const color = AGENDA_COLORS[ev.kategori] || '#6b7280';
            const emoji = AGENDA_EMOJI[ev.kategori] || '📌';
            const row = document.createElement('div');
            row.className = 'event-row';
            row.innerHTML = `
                <div class="event-color-bar" style="background:${color};"></div>
                <div class="event-content">
                    <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin-bottom:3px;">
                        <span style="font-weight:800;font-size:0.9rem;color:#111827;">${ev.judul}</span>
                        <span style="font-size:0.65rem;font-weight:700;background:${color}18;color:${color};padding:2px 8px;border-radius:9999px;">${emoji} ${ev.kategori}</span>
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:10px;">
                        ${ev.waktu ? `<span style="font-size:0.775rem;color:#6b7280;">🕐 ${ev.waktu}</span>` : ''}
                        ${ev.lokasi ? `<span style="font-size:0.775rem;color:#6b7280;">📍 ${ev.lokasi}</span>` : ''}
                    </div>
                    ${ev.keterangan ? `<p style="font-size:0.8rem;color:#9ca3af;margin:4px 0 0;line-height:1.55;">${ev.keterangan}</p>` : ''}
                </div>
            `;
            container.appendChild(row);
        });
    }

    panel.classList.add('show');
    // Scroll ke panel
    panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// ── INIT ──────────────────────────────────────────────────────────────────────
renderCalendar();
</script>
@endpush

@endsection
