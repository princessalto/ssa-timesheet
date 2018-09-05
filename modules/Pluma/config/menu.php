<?php

return [
	'dashboard' => [
		'name' => 'dashboard',
		'slug' => 'dashboard',
		'order' => 1,
		'icon' => [
			'class' => 'fa fa-tachometer',
			'tag' => 'i',
			'content' => '&nbsp;',
		], // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
		'label' => [
			'singular_name' => 'Dashboard',
			'plural_name' => 'Dashboard',
		],
		'permissionable' => false,
	],

	'role' => [
		'name' => 'role',
		'slug' => 'roles',
		'parent' => true,
		'order' => 11,
		'icon' => [
            'class' => 'fa fa-check-square-o',
            'tag' => 'i',
            'content' => '&nbsp;',
        ],
		'label' => [
			'singular_name' => 'Role',
			'plural_name' => 'Roles',
		],
	],

	'view-role' => [
		'name' => 'view-role',
		'slug' => '/',
		'is_child_of' => 'role',
		// 'order' => 1,
		'icon' => [
			// 'class' => 'fa fa-check-square-o',
			'tag' => 'i',
			'content' => '&nbsp;',
		], // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
		'label' => [
			'singular_name' => 'All Role',
			'plural_name' => ' All Roles',
		],
	],

	'create-role' => [
		'name' => 'create-role',
		'slug' => 'create',
		'is_child_of' => 'role',
		// 'order' => 1,
		'icon' => [
			'class' => 'fa fa-plus',
			'tag' => 'i',
			'content' => '&nbsp;',
		], // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
		'label' => [
			'singular_name' => 'Create Role',
			'plural_name' => 'Create Role',
		],
	],

	'view-permission' => [
		'name' => 'view-permissions',
		'slug' => 'permissions',
		'is_child_of' => 'role',
		// 'order' => 1,
		'icon' => [
			'class' => 'fa fa-lock',
			'tag' => 'i',
			'content' => '&nbsp;',
		], // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
		'label' => [
			'singular_name' => 'Permission',
			'plural_name' => 'Permissions',
		],
	],

	'trash-role' => [
		'name' => 'trash-role',
		'slug' => 'trash',
		'is_child_of' => 'role',
		// 'order' => 1,
		'icon' => [
			'class' => 'fa fa-trash-o',
			'tag' => 'i',
			'content' => '&nbsp;',
		], // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
		'label' => [
			'singular_name' => 'Trash',
			'plural_name' => 'Trash',
		],
	],

	// 'settings' => [
	// 	'name' => 'settings',
	// 	'slug' => 'settings',
	// 	'parent' => true,
	// 	'order' => 999,
 //        'icon' => [
 //            'class' => 'fa fa-wrench',
 //            'tag' => 'i',
 //            'content' => '&nbsp;',
 //        ],
	// 	'label' => [
	// 		'singular_name' => 'Settings',
	// 		'plural_name' => 'Settings',
	// 	],
	// 	'permissionable' => false,
	// ],

	// 'view-settings' => [
	// 	'name' => 'view-settings',
	// 	'slug' => 'general',
	// 	'is_child_of' => 'settings',
	// 	'icon' => [
	// 		'class' => 'fa fa-cog',
	// 		'tag' => 'i',
	// 		'content' => '&nbsp;',
	// 	],
	// 	'label' => [
	// 		'singular_name' => 'General',
	// 		'plural_name' => 'General',
	// 	],
	// 	'permissionable' => false,
	// ],

	// 'view-profile' => [
	// 	'name' => 'view-profile',
	// 	'slug' => 'profile',
	// 	'is_child_of' => 'settings',
	// 	'icon' => [
	// 		'class' => 'fa fa-user-o',
	// 		'tag' => 'i',
	// 		'content' => '&nbsp;',
	// 	],
	// 	'label' => [
	// 		'singular_name' => 'Profile',
	// 		'plural_name' => 'Profile',
	// 	],
	// 	'permissionable' => false,
	// ],
];