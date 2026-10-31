<?php /** Peta Perumahan Puri Harmoni 8 — Cibunar, Parung Panjang. Klik rumah = info pemilik. */ ?>
@php
$namaPool = ['H. Sutono','Rina Marlina','Dedi Kurniawan','Hj. Aminah','Budi Santoso','Agus Wijaya','Siti Rahayu','Joko Prasetyo','Dewi Lestari','Andi Gunawan','H. Mahmud','Yuni Astuti','Rudi Hartono','Nina Kurnia','Tono Supriadi','Siti Maimunah','H. Bakri','Eko Saputra','Sri Wahyuni','H. Idris','Warsih','Samsul Hadi','Fitriani','H. Rohmat','Nurhaliza','Dadan Ramdani','Iis Marlina','Asep Saepudin','Enok Nurlatifah','Ujang Komarudin','H. Deden','Lilis Suryani','Ocid Sutisna','H. Yayat','Kokom Komariah','Dedi Supriadi','H. Ade','Nenden Rukmana','Iwan Setiawan','Ai Maryani','H. Eman','Yayah Rokayah','Usep Suherman','H. Jaja','Emod Suherman','Suharti','H. Otong','Diah Puspita','Yadi Suryadi','H. Aceng','Imas Masitoh','Wawan Gunawan','H. Entis'];
$telp = fn($i) => '08'.str_pad(123456000 + $i * 7919, 9, '0', STR_PAD_LEFT);
// Definisi baris blok: tambah 1 baris = tambah 1 blok, koordinat rumah dihitung otomatis
$rows = [
    ['blok' => 'A1', 'x' => 30,  'y' => 96],
    ['blok' => 'M1', 'x' => 30,  'y' => 176],
    ['blok' => 'N1', 'x' => 592, 'y' => 96],
    ['blok' => 'N2', 'x' => 592, 'y' => 176],
    ['blok' => 'N6', 'x' => 592, 'y' => 256],
    ['blok' => 'M2', 'x' => 30,  'y' => 404],
    ['blok' => 'M3', 'x' => 30,  'y' => 484],
    ['blok' => 'N3', 'x' => 592, 'y' => 404],
    ['blok' => 'N4', 'x' => 592, 'y' => 484],
    ['blok' => 'N5', 'x' => 592, 'y' => 564],
];
$RW = 58; $GAP = 6; $PER = 6; // lebar rumah, gap, rumah per baris
$fill = ['dihuni' => '#ffffff', 'kontrak' => '#fef9c3', 'kosong' => '#e5e7eb'];
$stroke = ['dihuni' => '#334155', 'kontrak' => '#a16207', 'kosong' => '#9ca3af'];
$tipePool = ['30/60','30/60','30/60','30/60','28/60','28/89'];
$stPool = ['dihuni','dihuni','dihuni','dihuni','dihuni','dihuni','dihuni','kontrak','kosong','dihuni'];
$homes = []; $n = 0;
foreach ($rows as $r) {
    for ($i = 1; $i <= $PER; $i++) {
        $st = $stPool[($n * 7 + ord($r['blok'][0])) % count($stPool)];
        $homes[] = [
            'blok' => $r['blok'], 'no' => $i, 'id' => $r['blok'].'-'.$i,
            'x' => $r['x'] + ($i - 1) * ($RW + $GAP), 'y' => $r['y'],
            'pemilik' => $st === 'kosong' ? '(Kosong)' : $namaPool[$n % count($namaPool)],
            'telp' => $st === 'kosong' ? '-' : $telp($n),
            'tipe' => $tipePool[($n * 3 + $i) % count($tipePool)],
            'status' => $st,
        ];
        $n++;
    }
}
$tot = count($homes);
$dihuni = collect($homes)->where('status', 'dihuni')->count();
$kosong = collect($homes)->where('status', 'kosong')->count();
@endphp

<x-layouts::app>
    <x-breadcrumb :items="[['url' => '/dashboard', 'label' => 'Home'], ['url' => '', 'label' => 'Puri Harmoni 8']]" />

    <div class="mt-4 rounded-2xl border border-outline-variant bg-surface-container-lowest p-4 shadow-sm">
        <div class="flex flex-wrap items-center gap-3">
            <div class="mr-auto">
                <h1 class="font-bold text-lg leading-tight">Puri Harmoni 8</h1>
                <p class="text-xs text-on-surface-variant">Cibunar, Parung Panjang, Kab. Bogor — {{ $tot }} unit tampil • klik rumah untuk info pemilik</p>
            </div>
            <div class="flex gap-2 text-center text-xs">
                <div class="rounded-xl bg-surface-container px-3 py-1.5"><b>{{ $tot }}</b> unit</div>
                <div class="rounded-xl bg-surface-container px-3 py-1.5"><b>{{ $dihuni }}</b> dihuni</div>
                <div class="rounded-xl bg-surface-container px-3 py-1.5"><b>{{ $kosong }}</b> kosong</div>
            </div>
            <input id="cari" type="search" placeholder="Cari blok / nomor / nama…"
                class="rounded-xl border border-outline-variant bg-surface-container px-3 py-2 text-sm w-56" />
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mt-3">
            <div class="xl:col-span-2 relative" id="denah-wrap">
                <svg id="ph8-map" viewBox="0 0 1000 720" class="w-full h-auto select-none" role="img" aria-label="Peta Puri Harmoni 8">
                    <rect x="0" y="0" width="1000" height="720" rx="16" fill="#eef2f7"/>
                    {{-- jalan utama --}}
                    <rect x="470" y="0" width="60" height="720" fill="#cbd5e1"/>
                    <rect x="0" y="330" width="1000" height="44" fill="#cbd5e1"/>
                    <line x1="500" y1="0" x2="500" y2="720" stroke="#fff" stroke-width="3" stroke-dasharray="14 10"/>
                    <line x1="0" y1="352" x2="470" y2="352" stroke="#fff" stroke-width="3" stroke-dasharray="14 10"/>
                    <line x1="530" y1="352" x2="1000" y2="352" stroke="#fff" stroke-width="3" stroke-dasharray="14 10"/>
                    <text x="470" y="322" font-size="13" font-weight="800" fill="#475569">Jl. Puri Harmoni Raya</text>
                    <text x="462" y="140" font-size="13" font-weight="800" fill="#475569" transform="rotate(-90 462 140)">Jl. Cibunar Jagabita</text>
                    {{-- gerbang + security --}}
                    <rect x="420" y="668" width="160" height="36" rx="8" fill="#0f172a"/>
                    <text x="500" y="692" text-anchor="middle" font-size="14" font-weight="800" fill="#fff">GERBANG</text>
                    <circle cx="592" cy="686" r="13" fill="#f97316" stroke="#fff" stroke-width="3"/>
                    <text x="592" y="691" text-anchor="middle" font-size="11" font-weight="800" fill="#fff">S</text>
                    {{-- fasilitas --}}
                    <g><rect x="30" y="28" width="200" height="42" rx="8" fill="none" stroke="#15803d" stroke-width="2" stroke-dasharray="6 4"/><text x="130" y="54" text-anchor="middle" font-size="12" font-weight="800" fill="#15803d">LAPANGAN</text></g>
                    <g><rect x="230" y="256" width="200" height="50" rx="8" fill="#dcfce7" stroke="#15803d" stroke-width="2"/><text x="330" y="285" text-anchor="middle" font-size="12" font-weight="800" fill="#15803d">TAMAN RT</text></g>
                    <g><rect x="790" y="28" width="180" height="42" rx="8" fill="none" stroke="#7c3aed" stroke-width="2" stroke-dasharray="6 4"/><text x="880" y="54" text-anchor="middle" font-size="12" font-weight="800" fill="#7c3aed">PAUD</text></g>
                    <g><rect x="30" y="574" width="250" height="52" rx="8" fill="#dbeafe" stroke="#1d4ed8" stroke-width="2"/><text x="155" y="606" text-anchor="middle" font-size="13" font-weight="800" fill="#1d4ed8">MASJID</text></g>

                    {{-- baris blok: label + deret rumah (posisi otomatis) --}}
                    @foreach ($rows as $r)
                        <text x="{{ $r['x'] }}" y="{{ $r['y'] - 10 }}" font-size="13" font-weight="800" fill="#0f172a">BLOK {{ $r['blok'] }}</text>
                        <rect x="{{ $r['x'] }}" y="{{ $r['y'] + 52 }}" width="{{ $PER * $RW + ($PER - 1) * $GAP }}" height="8" rx="4" fill="#e2e8f0"/>
                    @endforeach
                    @foreach ($homes as $h)
                        <g class="rumah" transform="translate({{ $h['x'] }},{{ $h['y'] }})"
                           data-id="{{ $h['id'] }}" data-blok="{{ $h['blok'] }}" data-no="{{ $h['no'] }}"
                           data-pemilik="{{ $h['pemilik'] }}" data-telp="{{ $h['telp'] }}" data-tipe="{{ $h['tipe'] }}" data-status="{{ $h['status'] }}">
                            <title>Blok {{ $h['blok'] }} No. {{ $h['no'] }} — {{ $h['pemilik'] }}</title>
                            <rect x="0" y="0" width="{{ $RW }}" height="46" rx="6" fill="{{ $fill[$h['status']] }}" stroke="{{ $stroke[$h['status']] }}" stroke-width="2"/>
                            <text x="{{ $RW / 2 }}" y="28" text-anchor="middle" font-size="15" font-weight="800" fill="#0f172a">{{ $h['no'] }}</text>
                        </g>
                    @endforeach
                </svg>
                <div id="denah-tip" class="hidden absolute z-10 pointer-events-none rounded-xl border border-outline-variant bg-surface-container-lowest shadow-lg px-3 py-2 text-xs"></div>
                <div class="flex flex-wrap gap-3 mt-2 text-xs">
                    <span class="inline-flex items-center gap-1"><i class="w-3 h-3 inline-block rounded bg-white border border-slate-700"></i> Dihuni</span>
                    <span class="inline-flex items-center gap-1"><i class="w-3 h-3 inline-block rounded" style="background:#fef9c3;border:1px solid #a16207"></i> Kontrak</span>
                    <span class="inline-flex items-center gap-1"><i class="w-3 h-3 inline-block rounded" style="background:#e5e7eb;border:1px solid #9ca3af"></i> Kosong</span>
                </div>
                <style>
                    #ph8-map .rumah { cursor: pointer; transition: opacity .15s; }
                    #ph8-map .rumah:hover rect { stroke-width: 4; filter: drop-shadow(0 3px 6px rgb(0 0 0 / .3)); }
                    #ph8-map .rumah.active rect { stroke: #854442; stroke-width: 4; fill: #f3d9d7 !important; }
                    #ph8-map.dim .rumah { opacity: .2; }
                    #ph8-map.dim .rumah.found { opacity: 1; }
                    #ph8-map.dim .rumah.found rect { stroke: #16a34a; stroke-width: 4; }
                </style>
            </div>

            <div class="rounded-2xl border border-outline-variant bg-surface-container-lowest p-4 shadow-sm h-fit xl:sticky xl:top-20">
                <p class="font-bold mb-1">Info Pemilik Rumah</p>
                <p class="text-xs text-on-surface-variant mb-3">Klik salah satu rumah di peta, atau cari di kolom pencarian.</p>
                <div id="pemilik-detail" class="text-sm">
                    <div class="rounded-xl bg-surface-container p-4 text-center text-xs text-on-surface-variant">Belum ada rumah dipilih.</div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        (function () {
            const svg = document.getElementById('ph8-map');
            const wrap = document.getElementById('denah-wrap');
            const tip = document.getElementById('denah-tip');
            const detail = document.getElementById('pemilik-detail');
            const cari = document.getElementById('cari');
            if (!svg) return;

            function wa(telp) {
                let n = (telp || '').replace(/\D/g, '');
                if (!n || n === '-') return null;
                if (n.startsWith('0')) n = '62' + n.slice(1);
                if (n.startsWith('08')) n = '62' + n.slice(2);
                return 'https://wa.me/' + n;
            }
            const badge = { dihuni: 'bg-green-600', kontrak: 'bg-amber-600', kosong: 'bg-slate-500' };
            function show(d) {
                const link = wa(d.telp);
                detail.innerHTML =
                    '<div class="rounded-xl border border-outline-variant p-4">' +
                    '<p class="text-[11px] uppercase tracking-wide text-on-surface-variant">Blok ' + d.blok + '</p>' +
                    '<p class="text-2xl font-extrabold font-mono mb-1">No. ' + d.no + '</p>' +
                    '<span class="inline-block text-[11px] px-2 py-0.5 rounded-full text-white capitalize ' + (badge[d.status] || 'bg-slate-500') + '">' + d.status + '</span>' +
                    '<p class="text-xs text-on-surface-variant mt-3">Pemilik / Penghuni</p><p class="font-bold">' + d.pemilik + '</p>' +
                    '<div class="grid grid-cols-2 gap-2 text-xs mt-2 mb-3">' +
                    '<div class="rounded-lg bg-surface-container p-2"><p class="text-on-surface-variant">Tipe</p><p class="font-bold">' + d.tipe + '</p></div>' +
                    '<div class="rounded-lg bg-surface-container p-2"><p class="text-on-surface-variant">Telepon</p><p class="font-bold font-mono">' + d.telp + '</p></div></div>' +
                    (link ? '<a target="_blank" href="' + link + '" class="block text-center rounded-xl bg-green-600 text-white text-sm font-bold py-2">Hubungi via WhatsApp</a>' : '<p class="text-xs">Tidak ada kontak.</p>') +
                    '</div>';
            }
            svg.querySelectorAll('.rumah').forEach(g => {
                const d = g.dataset;
                g.addEventListener('click', () => {
                    svg.querySelectorAll('.rumah.active').forEach(x => x.classList.remove('active'));
                    g.classList.add('active');
                    show(d);
                });
                g.addEventListener('mouseenter', () => {
                    tip.innerHTML = '<b>Blok ' + d.blok + ' No. ' + d.no + '</b><br>' + d.pemilik + ' • ' + d.status;
                    tip.classList.remove('hidden');
                });
                g.addEventListener('mousemove', (e) => {
                    const rc = wrap.getBoundingClientRect();
                    tip.style.left = Math.min(e.clientX - rc.left + 14, rc.width - 200) + 'px';
                    tip.style.top = Math.max(e.clientY - rc.top - 10, 0) + 'px';
                });
                g.addEventListener('mouseleave', () => tip.classList.add('hidden'));
            });
            cari.addEventListener('input', () => {
                const q = cari.value.trim().toLowerCase();
                if (!q) { svg.classList.remove('dim'); svg.querySelectorAll('.found').forEach(x => x.classList.remove('found')); return; }
                svg.classList.add('dim');
                svg.querySelectorAll('.rumah').forEach(g => {
                    const d = g.dataset;
                    const hit = (d.blok + ' ' + d.blok + '-' + d.no + ' ' + d.pemilik).toLowerCase().includes(q);
                    g.classList.toggle('found', hit);
                });
            });
        })();
    </script>
    @endpush
</x-layouts::app>
