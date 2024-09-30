<?php

return [
    'create_users' => false,

    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d,m,s',
            'projects' => 'c,r,u,d,m,s',
            'quotations' => 'c,r,u,d,m,s',
            'services' => 'c,r,u,d,m,s',
            'statuses' => 'c,r,u,d,m,s',
            'settings' => 'c,r,u,d,m,s',
            'roles' => 'c,r,u,d,m,s',
            'admins' => 'c,r,u,d,m,s',
            'suppliers' => 'c,r,u,d,m,s',
            'categories' => 'c,r,u,d,m,s',
            'phases' => 'c,r,u,d,m,s',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'm' => 'manage',
        's' => 'send',
    ],
];
