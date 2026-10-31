<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu Configuration
    |--------------------------------------------------------------------------
    |
    | Define menu items for desktop sidebar, mobile drawer, and bottom nav.
    | Each item: route (string), icon (string), label (string)
    | Sections: label (string), items (array)
    | Bottom nav: only 5 items max, uses short label
    |
    */

    'sidebar' => [
        [
            'label' => null,
            'items' => [
                ['route' => 'dashboard', 'icon' => 'home', 'label' => 'Dashboard'],
            ],
        ],
        [
            'label' => 'Smart Village',
            'items' => [
                ['route' => 'denah', 'icon' => 'map', 'label' => 'Denah', 'match' => ['denah*']],
                ['route' => 'sv.show', 'params' => ['module' => 'iuran'], 'icon' => 'payments', 'label' => 'Iuran & Tagihan'],
                ['route' => 'tagihan', 'icon' => 'receipt_long', 'label' => 'Tagihan Keluarga'],
                ['route' => 'master-ikut', 'icon' => 'tune', 'label' => 'Master Iuran'],
                ['route' => 'sv.show', 'params' => ['module' => 'surat'], 'icon' => 'description', 'label' => 'Surat'],
                ['route' => 'sv.show', 'params' => ['module' => 'broadcast'], 'icon' => 'campaign', 'label' => 'Broadcast'],
                ['route' => 'sv.show', 'params' => ['module' => 'poling'], 'icon' => 'how_to_vote', 'label' => 'Poling'],
                ['route' => 'sv.show', 'params' => ['module' => 'warga'], 'icon' => 'group', 'label' => 'Warga & Rumah'],
                ['route' => 'sv.show', 'params' => ['module' => 'usaha'], 'icon' => 'storefront', 'label' => 'Usaha Warga'],
                ['route' => 'sv.show', 'params' => ['module' => 'papan'], 'icon' => 'event', 'label' => 'Papan Info'],
                ['route' => 'sv.show', 'params' => ['module' => 'notif'], 'icon' => 'chat', 'label' => 'Log WhatsApp'],
                ['route' => 'sv.show', 'params' => ['module' => 'laporan'], 'icon' => 'assessment', 'label' => 'Laporan'],
            ],
        ],
        [
            'label' => 'Master Data',
            'items' => [
                ['route' => 'user.getTable', 'icon' => 'manage_accounts', 'label' => 'Users', 'match' => ['user.*']],
            ],
        ],
        [
            'label' => 'CMS',
            'items' => [
                ['route' => 'cms-type.getTable', 'icon' => 'category', 'label' => 'Types', 'match' => ['cms-type.*']],
                ['route' => 'field.getTable', 'icon' => 'input', 'label' => 'Fields', 'match' => ['field.*']],
                ['route' => 'section.getTable', 'icon' => 'view_agenda', 'label' => 'Sections', 'match' => ['section.*']],
                ['route' => 'content.getTable', 'icon' => 'article', 'label' => 'Content', 'match' => ['content.*']],
                ['route' => 'category.getTable', 'icon' => 'sell', 'label' => 'Categories', 'match' => ['category.*']],
                ['route' => 'tag.getTable', 'icon' => 'label', 'label' => 'Tags', 'match' => ['tag.*']],
                ['route' => 'menu.getTable', 'icon' => 'menu', 'label' => 'Menus', 'match' => ['menu.*']],
            ],
        ],
        [
            'label' => 'Settings',
            'items' => [
                ['route' => 'settings.website', 'icon' => 'language', 'label' => 'Website'],
                ['route' => 'settings.env', 'icon' => 'settings', 'label' => 'Environment'],
                ['route' => 'native-bridge-test', 'icon' => 'phone_android', 'label' => 'NativeBridge Test'],
            ],
        ],
    ],

    'bottom_nav' => [

        ['route' => 'dashboard', 'icon' => 'home', 'label' => 'Home'],
        ['route' => 'user.getTable', 'icon' => 'group', 'label' => 'Warga'],
        ['route' => 'denah', 'icon' => 'map', 'label' => 'Denah'],
        ['route' => 'settings.website', 'icon' => 'settings', 'label' => 'Situs'],
        ['route' => 'profile.edit', 'icon' => 'person', 'label' => 'Saya'],

    ],

];
