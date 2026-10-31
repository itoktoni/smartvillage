<?php /** Tagihan per keluarga — baca config/iuran.php + simpanan Master (localStorage). */ ?>
@php
$cfg = config('iuran');
$periode = $cfg['periode'];
$kode = $cfg['kode'];
$kategori = $cfg['kategori'];
$katLabel = $cfg['katLabel'];
$keluarga = $cfg['keluarga'];
$rp = fn($v) => 'Rp '.number_format($v, 0, ',', '.');
$waNum = fn($t) => '62'.ltrim(preg_replace('/\D/', '', $t), '0');
$badge = ['Lunas' => 'bg-green-600', 'Sebagian' => 'bg-amber-600', 'Belum' => 'bg-slate-500'];
$calc = function ($k) use ($kategori, $kode) {
    $tagih = $bayarRp = 0;
    foreach ($kategori as $kat => $nom) {
        if ($k['ikut'][$kat]) { $tagih += $nom; if ($k['bayar'][$kat]) $bayarRp += $nom; }
    }
    $sisa = $tagih - $bayarRp;
    return ['tagih' => $tagih, 'bayarRp' => $bayarRp, 'sisa' => $sisa,
        'status' => $sisa === 0 ? 'Lunas' : ($bayarRp > 0 ? 'Sebagian' : 'Belum'),
        'ref' => $kode.'-'.$k['blok'].$k['no']];
};
$totTagih = $totBayar = 0;
$perKat = ['sampah' => [0, 0], 'arisan' => [0, 0], 'keamanan' => [0, 0]];
foreach ($keluarga as $i => $k) {
    $keluarga[$i] = array_merge($k, $calc($k));
    $totTagih += $keluarga[$i]['tagih']; $totBayar += $keluarga[$i]['bayarRp'];
    foreach ($kategori as $kat => $nom) {
        if ($k['ikut'][$kat]) { $perKat[$kat][0] += $nom; if ($k['bayar'][$kat]) $perKat[$kat][1] += $nom; }
    }
}
@endphp

<x-layouts::app>
    <x-breadcrumb :items="[['url' => '/dashboard', 'label' => 'Home'], ['url' => '', 'label' => 'Tagihan Keluarga']]" />

    <div class="mt-4 space-y-4" id="tagihan-app" data-periode="{{ $periode }}" data-kode="{{ $kode }}">
        <div class="rounded-2xl border border-outline-variant bg-surface-container-lowest p-4 shadow-sm">
            <div class="flex flex-wrap items-center gap-3">
                <div class="mr-auto">
                    <h1 class="font-bold text-lg">Tagihan per Keluarga — {{ $periode }}</h1>
                    <p class="text-xs text-on-surface-variant">— = tidak ikut • config diatur di Master Iuran</p>
                </div>
                <a href="{{ route('master-ikut') }}" class="rounded-xl border border-outline-variant text-sm font-bold px-4 py-2">⚙️ Master Iuran</a>
                <div class="flex gap-2 text-center text-xs">
                    <div class="rounded-xl bg-surface-container px-3 py-1.5"><p class="text-on-surface-variant">Total</p><b id="tot-tagih">{{ $rp($totTagih) }}</b></div>
                    <div class="rounded-xl bg-surface-container px-3 py-1.5"><p class="text-on-surface-variant">Terkumpul</p><b id="tot-bayar">{{ $rp($totBayar) }}</b></div>
                    <div class="rounded-xl bg-surface-container px-3 py-1.5"><p class="text-on-surface-variant">Tunggakan</p><b id="tot-sisa">{{ $rp($totTagih - $totBayar) }}</b></div>
                </div>
            </div>
        </div>

        <x-table>
            <x-slot:head>
                <th>Keluarga</th>
                @foreach ($katLabel as $kat => $label)
                    <th>{{ $label }}<br><span class="font-normal">{{ $rp($kategori[$kat]) }}</span></th>
                @endforeach
                <th>Total</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Aksi</th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($keluarga as $i => $k)
                    <tr id="row-{{ $i }}" data-telp="{{ $k['telp'] }}" data-kk="{{ $k['kk'] }}" data-blok="{{ $k['blok'] }}" data-no="{{ $k['no'] }}" data-ref="{{ $k['ref'] }}">
                        <td><b class="font-mono">Blok {{ $k['blok'] }}-{{ $k['no'] }}</b><br><span class="text-xs">{{ $k['kk'] }}</span><br><span class="text-[10px] font-mono text-on-surface-variant">{{ $k['ref'] }}</span></td>
                        @foreach (['sampah', 'arisan', 'keamanan'] as $kat)
                            <td class="text-center text-lg c-{{ $kat }}" data-nom="{{ $kategori[$kat] }}" data-ikut="{{ $k['ikut'][$kat] }}" data-bayar="{{ $k['bayar'][$kat] }}">
                                {{ $k['ikut'][$kat] ? ($k['bayar'][$kat] ? '✅' : '❌') : '—' }}
                            </td>
                        @endforeach
                        <td class="whitespace-nowrap c-tagih">{{ $rp($k['tagih']) }}</td>
                        <td class="whitespace-nowrap font-bold c-sisa">{{ $rp($k['sisa']) }}</td>
                        <td><span class="c-status text-[11px] px-2 py-0.5 rounded-full text-white {{ $badge[$k['status']] }}">{{ $k['status'] }}</span></td>
                        <td class="c-aksi"></td>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>

        <div class="rounded-2xl border border-outline-variant bg-surface-container-lowest p-4 text-xs shadow-sm">
            <p class="font-bold mb-2">Rekap per kategori (hanya peserta ikut)</p>
            <div class="grid grid-cols-3 gap-2 text-center">
                @foreach ($katLabel as $kat => $label)
                    <div class="rounded-xl bg-surface-container p-2" id="rekap-{{ $kat }}">
                        <p class="text-on-surface-variant">{{ $label }}</p>
                        <p class="font-bold"><span class="r-bayar">{{ $rp($perKat[$kat][1]) }}</span> / <span class="r-tagih">{{ $rp($perKat[$kat][0]) }}</span></p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        (function () {
            const NOM = { sampah: 15000, arisan: 50000, keamanan: 10000 };
            const LBL = { sampah: 'Sampah', arisan: 'Arisan', keamanan: 'Keamanan' };
            const app = document.getElementById('tagihan-app');
            const periode = app.dataset.periode;
            const rp = v => 'Rp ' + v.toLocaleString('id-ID');
            const waNum = t => '62' + t.replace(/\D/g, '').replace(/^0/, '');

            // terapkan simpanan Master Iuran (localStorage) ke tabel
            try {
                const stored = JSON.parse(localStorage.getItem('master_iuran_ikut')) || {};
                Object.keys(stored).forEach(row => {
                    const tr = document.getElementById('row-' + row);
                    if (!tr) return;
                    ['sampah', 'arisan', 'keamanan'].forEach(kat => {
                        if (stored[row][kat] !== undefined) tr.querySelector('.c-' + kat).dataset.ikut = String(stored[row][kat]);
                    });
                });
            } catch (e) {}

            function refreshRow(tr) {
                const d = tr.dataset;
                let tagih = 0, bayar = 0;
                const parts = [];
                ['sampah', 'arisan', 'keamanan'].forEach(kat => {
                    const td = tr.querySelector('.c-' + kat);
                    const ikut = td.dataset.ikut === '1';
                    const lunas = td.dataset.bayar === '1';
                    td.textContent = ikut ? (lunas ? '✅' : '❌') : '—';
                    if (ikut) {
                        tagih += NOM[kat];
                        if (lunas) bayar += NOM[kat];
                        parts.push(LBL[kat] + ' ' + rp(NOM[kat]) + (lunas ? ' (lunas)' : ' (BELUM)'));
                    }
                });
                const sisa = tagih - bayar;
                const status = sisa === 0 ? 'Lunas' : (bayar > 0 ? 'Sebagian' : 'Belum');
                tr.querySelector('.c-tagih').textContent = rp(tagih);
                tr.querySelector('.c-sisa').textContent = rp(sisa);
                const badge = tr.querySelector('.c-status');
                badge.textContent = status;
                badge.className = 'c-status text-[11px] px-2 py-0.5 rounded-full text-white ' +
                    (status === 'Lunas' ? 'bg-green-600' : status === 'Sebagian' ? 'bg-amber-600' : 'bg-slate-500');
                const aksi = tr.querySelector('.c-aksi');
                if (sisa > 0) {
                    const msg = 'Yth Bpk/Ibu ' + d.kk + ' (Blok ' + d.blok + ' No.' + d.no + '), tagihan ' + periode +
                        ' [' + d.ref + ']: ' + parts.join(', ') + '. Total ' + rp(tagih) + ', sisa ' + rp(sisa) + '. Terima kasih.';
                    aksi.innerHTML = '<a target="_blank" class="inline-block rounded-lg bg-green-600 text-white text-xs font-bold px-3 py-1.5" href="https://wa.me/' + waNum(d.telp) + '?text=' + encodeURIComponent(msg) + '">Tagih WA</a>';
                } else {
                    aksi.innerHTML = '<span class="text-xs text-on-surface-variant">—</span>';
                }
            }
            function refreshTotal() {
                let t = 0, b = 0;
                const rek = { sampah: [0, 0], arisan: [0, 0], keamanan: [0, 0] };
                document.querySelectorAll('#tagihan-app tbody tr').forEach(tr => {
                    ['sampah', 'arisan', 'keamanan'].forEach(kat => {
                        const td = tr.querySelector('.c-' + kat);
                        if (td.dataset.ikut === '1') {
                            rek[kat][0] += NOM[kat];
                            if (td.dataset.bayar === '1') rek[kat][1] += NOM[kat];
                        }
                    });
                    const tagih = parseInt(tr.querySelector('.c-tagih').textContent.replace(/\D/g, '')) || 0;
                    const sisa = parseInt(tr.querySelector('.c-sisa').textContent.replace(/\D/g, '')) || 0;
                    t += tagih; b += tagih - sisa;
                });
                document.getElementById('tot-tagih').textContent = rp(t);
                document.getElementById('tot-bayar').textContent = rp(b);
                document.getElementById('tot-sisa').textContent = rp(t - b);
                Object.keys(rek).forEach(kat => {
                    const box = document.getElementById('rekap-' + kat);
                    box.querySelector('.r-bayar').textContent = rp(rek[kat][1]);
                    box.querySelector('.r-tagih').textContent = rp(rek[kat][0]);
                });
            }
            document.querySelectorAll('#tagihan-app tbody tr').forEach(refreshRow);
            refreshTotal();
        })();
    </script>
    @endpush
</x-layouts::app>
