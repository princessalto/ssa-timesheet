<?php

return [
    'scheduler' => [
        'name' => 'scheduler',
        'slug' => 'scheduler',
        'order' => 1,
        'parent' => true,
        'icon' => [
            'class' => 'fa fa-calendar-check-o',
            'tag' => 'i',
            'content' => '&nbsp;',
        ], // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
        // 'icon' => '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>',
        'label' => [
            'singular_name' => 'Schedule',
            // 'plural_name' => '<i class="fa fa-calendar-check-o m-r-05"></i> Schedules',
            'plural_name' => 'Schedules',
        ],
        'permissionable' => true,
    ],
    'view-scheduler' => [
        'is_child_of' => 'scheduler',
        'name' => 'view-scheduler',
        'slug' => '',
        'order' => 1,
        'icon' => '<span class="fa fa-calendar">&nbsp;</span>',
        'label' => [
            'singular_name' => 'All Schedule',
            'plural_name' => 'All Schedules',
        ],
        'permissionable' => true,
    ],
    'create-scheduler' => [
        'is_child_of' => 'scheduler',
        'name' => 'create-scheduler',
        'slug' => 'create',
        'order' => 2,
        'icon' => '<span class="fa fa-calendar-plus-o">&nbsp;</span>',
        'label' => [
            'singular_name' => 'Add Schedule',
            'plural_name' => 'Add Schedules',
        ],
        'permissionable' => true,
    ],
];
