<?php
return array (
	'controllers' => array (
		'invokables' => array (
			'Login\Controller\Index' => 'Login\Controller\IndexController' 
		) 
	),
	'router' => array (
		'routes' => array (
		    'login' => array (
		        'type' => 'Segment',
		        'options' => array (
		            // Change this to something specific to your module
		            'route' => '/login[/type/:type]',
		            'defaults' => array (
		                '__NAMESPACE__' => 'Login\Controller',
		                'controller' => 'Index',
		                'action' => 'login'
		            ),
		            'constraints' => array (
		                'type' => '[a-zA-Z][a-zA-Z0-9_-]*'
		            )
		        )
		    ),
		), 
	),
	'view_manager' => array (
		'template_path_stack' => array (
			'Login' => __DIR__ . '/../view' 
		)
	)
);
