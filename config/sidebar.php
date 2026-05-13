<?php

return [
    [
        'title' => null,
        'key' => 'dashboard',
        'roles' => ['admin', 'lecturer', 'student', 'koordinator'],
        'items' => [
            [
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'pattern' => 'dashboard',
                'icon' => 'fa-chart-line',
            ],
        ]
    ],
    [
        'title' => 'Thesis',
        'roles' => ['admin'],
        'items' => [
            [
                'label' => 'All Thesis',
                'route' => 'thesis.index',
                'pattern' => 'thesis*',
                'icon' => 'fa-solid fa-book-open'
            ],
            [
                'label' => 'All Results',
                'route' => 'admin.results.index',
                'pattern' => 'admin/results*',
                'icon' => 'fa-solid fa-square-poll-vertical'
            ],

        ],
    ],
    [
        'title' => 'Assessment',
        'roles' => ['lecturer'],
        'items' => [
            [
                'label' => 'Assessment',
                'route' => 'assessment.index',
                'pattern' => 'assessment*',
                'icon' => 'fa-solid fa-clipboard-check'
            ],
            [
                'label' => 'Results',
                'route' => 'results.lecturer',
                'pattern' => 'results*',
                'icon' => 'fa-solid fa-file-circle-check'
            ],
        ],
    ],
    [
        'title' => 'User Management',
        'roles' => ['admin'],
        'items' => [
            [
                'label' => 'Students',
                'route' => 'admin.users.index',
                'params' => ['type' => 'student'],
                'pattern' => 'admin/users/student*',
                'icon' => 'fa-user-graduate'
            ],
            [
                'label' => 'Lecturers',
                'route' => 'admin.users.index',
                'params' => ['type' => 'lecturer'],
                'pattern' => 'admin/users/lecturer*',
                'icon' => 'fa-chalkboard-teacher'
            ],
            [
                'label' => 'Admin',
                'route' => 'admin.users.index',
                'params' => ['type' => 'admin'],
                'pattern' => 'admin/users/admin*',
                'icon' => 'fa-user-gear'
            ],
            [
                'label' => 'Academic Year',
                'route' => 'admin.semester.index',
                'pattern' => 'admin/semester*',
                'icon' => 'fa-calendar',
                'roles' => ['admin']
            ],
        ],
    ],

    [
        'title' => 'Thesis',
        'roles' => ['student'],
        'items' => [
            [
                'label' => 'Thesis',
                'route' => 'thesis.index',
                'pattern' => 'thesis*',
                'icon' => 'fa-user-graduate'
            ],

        ],
    ],


];
