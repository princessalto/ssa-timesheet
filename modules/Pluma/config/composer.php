<?php

return [
	[
		'views' => '*',
		'class' => 'Pluma\Composers\MenuViewComposer',
	],
	[
		'views' => '*',
        	'class' => 'Pluma\Composers\BreadcrumbViewComposer',
	],
	[
		'views' => '*',
        	'class' => 'Pluma\Composers\PageViewComposer',
	],
];