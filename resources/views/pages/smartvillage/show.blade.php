<?php /** @var string $slug */ /** @var array $page */ ?>

<x-layouts::app>
    <x-breadcrumb :items="[['url' => '/dashboard', 'label' => 'Home'], ['url' => '', 'label' => $page['title']]]" />

    <div class="mt-4 space-y-4">
        <div class="rounded-2xl border border-outline-variant bg-surface-container-lowest p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-3xl text-primary">{{ $page['icon'] }}</span>
                <div>
                    <h1 class="font-bold text-lg">{{ $page['title'] }}</h1>
                    <p class="text-xs text-on-surface-variant">{{ $page['desc'] }}</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mt-3">
                @foreach ($page['stats'] as [$label, $value])
                    <div class="rounded-xl bg-surface-container p-3 text-center">
                        <p class="text-[10px] uppercase tracking-wide text-on-surface-variant">{{ $label }}</p>
                        <p class="font-bold">{{ $value }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <x-table>
            <x-slot:head>
                @foreach ($page['columns'] as $col)
                    <th>{{ $col }}</th>
                @endforeach
            </x-slot:head>
            <x-slot:body>
                @foreach ($page['rows'] as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>

        <p class="text-xs text-on-surface-variant rounded-xl border border-dashed border-outline-variant p-3">
            Data dummy untuk preview menu — CRUD database + kirim WA asli tahap berikutnya.
        </p>
    </div>
</x-layouts::app>
