<?php /** Master keikutsertaan iuran — nama KK + checkbox per kategori, simpan ke localStorage. */ ?>
@php
$cfg = config('iuran');
$keluarga = $cfg['keluarga'];
$rp = fn($v) => 'Rp '.number_format($v, 0, ',', '.');
@endphp

<x-layouts::app>
    <x-breadcrumb :items="[['url' => '/dashboard', 'label' => 'Home'], ['url' => route('tagihan'), 'label' => 'Tagihan'], ['url' => '', 'label' => 'Master Iuran']]" />

    <div class="mt-4 space-y-4">
        <div class="rounded-2xl border border-outline-variant bg-surface-container-lowest p-4 shadow-sm">
            <div class="flex flex-wrap items-center gap-3">
                <div class="mr-auto">
                    <h1 class="font-bold text-lg">Master Keikutsertaan Iuran</h1>
                    <p class="text-xs text-on-surface-variant">Centang = keluarga ikut iuran itu • tersimpan otomatis di browser • <span id="save-info">belum ada perubahan</span></p>
                </div>
                <a href="{{ route('tagihan') }}" class="rounded-xl bg-primary text-on-primary text-sm font-bold px-4 py-2">← Kembali ke Tagihan</a>
                <button id="btn-reset" class="rounded-xl border border-outline-variant text-sm font-bold px-4 py-2">Reset ke bawaan</button>
            </div>
        </div>

        <x-table>
            <x-slot:head>
                <th>Blok</th>
                <th>Nama Kepala Keluarga</th>
                @foreach ($cfg['katLabel'] as $kat => $label)
                    <th class="text-center">{{ $label }}<br><span class="font-normal">{{ $rp($cfg['kategori'][$kat]) }}</span></th>
                @endforeach
                <th>Ikut</th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($keluarga as $i => $k)
                    <tr data-row="{{ $i }}">
                        <td><b class="font-mono">Blok {{ $k['blok'] }}-{{ $k['no'] }}</b></td>
                        <td class="font-bold">{{ $k['kk'] }}<br><span class="text-xs font-normal font-mono text-on-surface-variant">{{ $k['telp'] }}</span></td>
                        @foreach (['sampah', 'arisan', 'keamanan'] as $kat)
                            <td class="text-center">
                                <input type="checkbox" class="ikut-toggle w-5 h-5 accent-green-600" data-row="{{ $i }}" data-kat="{{ $kat }}"
                                    {{ $k['ikut'][$kat] ? 'checked' : '' }} aria-label="{{ $k['kk'] }} ikut {{ $kat }}">
                            </td>
                        @endforeach
                        <td class="c-count text-xs whitespace-nowrap"></td>
                    </tr>
                @endforeach
            </x-slot:body>
            <x-slot:mobile>
                <div class="p-3 space-y-2">
                    @foreach ($keluarga as $i => $k)
                        <div class="rounded-xl border border-outline-variant p-3" data-mrow="{{ $i }}">
                            <p class="font-bold text-sm">Blok {{ $k['blok'] }}-{{ $k['no'] }} — {{ $k['kk'] }}</p>
                            <div class="flex gap-4 mt-2 text-sm">
                                @foreach (['sampah' => 'Smp', 'arisan' => 'Ars', 'keamanan' => 'Kam'] as $kat => $s)
                                    <label class="inline-flex items-center gap-1">
                                        <input type="checkbox" class="ikut-toggle w-5 h-5 accent-green-600" data-row="{{ $i }}" data-kat="{{ $kat }}"
                                            {{ $k['ikut'][$kat] ? 'checked' : '' }}> {{ $s }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot:mobile>
        </x-table>
    </div>

    @push('scripts')
    <script>
        (function () {
            const KEY = 'master_iuran_ikut';
            const info = document.getElementById('save-info');
            const load = () => { try { return JSON.parse(localStorage.getItem(KEY)) || {}; } catch (e) { return {}; } };
            const save = (cfg) => { localStorage.setItem(KEY, JSON.stringify(cfg)); info.textContent = 'tersimpan ' + new Date().toLocaleTimeString('id-ID'); };
            // terapkan simpanan lama ke semua checkbox (desktop + mobile)
            const stored = load();
            if (Object.keys(stored).length) {
                document.querySelectorAll('.ikut-toggle').forEach(cb => {
                    const s = stored[cb.dataset.row];
                    if (s && s[cb.dataset.kat] !== undefined) cb.checked = s[cb.dataset.kat] === 1;
                });
                info.textContent = 'memuat simpanan browser';
            }
            function syncCount() {
                const cfg = load();
                document.querySelectorAll('tr[data-row]').forEach(tr => {
                    const row = tr.dataset.row;
                    let n = 0;
                    tr.querySelectorAll('.ikut-toggle').forEach(cb => { if (cb.checked) n++; });
                    const c = tr.querySelector('.c-count');
                    if (c) c.textContent = n + ' / 3 jenis';
                });
            }
            syncCount();
            document.querySelectorAll('.ikut-toggle').forEach(cb => {
                cb.addEventListener('change', () => {
                    const cfg = load();
                    const row = cb.dataset.row;
                    cfg[row] = cfg[row] || {};
                    // samakan semua checkbox baris yg sama (desktop + mobile)
                    document.querySelectorAll('.ikut-toggle[data-row="' + row + '"][data-kat="' + cb.dataset.kat + '"]').forEach(x => { x.checked = cb.checked; });
                    ['sampah', 'arisan', 'keamanan'].forEach(kat => {
                        const el = document.querySelector('.ikut-toggle[data-row="' + row + '"][data-kat="' + kat + '"]');
                        cfg[row][kat] = el && el.checked ? 1 : 0;
                    });
                    save(cfg);
                    syncCount();
                });
            });
            document.getElementById('btn-reset').addEventListener('click', () => {
                if (!confirm('Kembalikan ke bawaan?')) return;
                localStorage.removeItem(KEY);
                location.reload();
            });
        })();
    </script>
    @endpush
</x-layouts::app>
