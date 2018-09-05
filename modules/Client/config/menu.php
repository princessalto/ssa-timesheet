<?php

return [
    'client' => [
        'name' => 'client',
        'slug' => 'clients',
        'order' => 1,
        'icon' => [
            'class' => 'fa fa-user-circle-o',
            'tag' => 'i',
            'content' => '&nbsp;',
        ],
        'label' => [
            'singular_name' => 'Client',
            'plural_name' => 'Clients',
        ],
    ],
    'all_client' => [
        'is_child_of' => 'client',
        'name' => 'clients',
        'slug' => '',
        'order' => 1,
        'icon' => '<span class="fa fa-user-circle-o">&nbsp;</span>', // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
        'label' => [
            'singular_name' => 'All Clients',
            'plural_name' => 'All Clients',
        ],
    ],
    'create_client' => [
        'is_child_of' => 'client',
        'name' => 'create',
        'slug' => 'create',
        'order' => 2,
        'icon' => '<span class="fa fa-user-plus">&nbsp;</span>', // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
        'label' => [
            'singular_name' => 'Add Client',
            'plural_name' => 'Add Client',
        ],
    ],
];