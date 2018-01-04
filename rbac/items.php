<?php
return [
    'permAdminPanel' => [
        'type' => 2,
        'description' => 'Admin panel',
    ],
    'permMainSite' => [
        'type' => 2,
        'description' => 'main site',
    ],
    'user' => [
        'type' => 1,
        'description' => 'User',
        'children' => [

            'permMainSite',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Admin',
        'children' => [
            'user',
            'permAdminPanel',
            'permMainSite',
        ],
    ],
];
