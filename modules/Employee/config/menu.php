<?php

return [
    'emp_list' => [
        'name' => 'employee',
        'slug' => 'employees',
        'order' => 1,
        'icon' => [
            'class' => 'fa fa-user-o',
            'tag' => 'i',
            'content' => '&nbsp;',
        ],
        'label' => [
            'singular_name' => 'Employee',
            'plural_name' => 'Employees',
        ],
    ],
    'all_emp' => [
        'is_child_of' => 'emp_list',
        'name' => 'employee',
        'slug' => '',
        'order' => 1,
        'icon' => '<span class="fa fa-user-o">&nbsp;</span>', // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
        'label' => [
            'singular_name' => 'All Employee',
            'plural_name' => 'All Employees',
        ],
    ],

    'add_emp' => [
        'is_child_of' => 'emp_list',
        'name' => 'create',
        'slug' => 'create',
        'order' => 2,
        'icon' => '<span class="fa fa-user-plus">&nbsp;</span>', // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
        'label' => [
            'singular_name' => 'Add Employee',
            'plural_name' => 'Add Employees',
        ],
    ],
];