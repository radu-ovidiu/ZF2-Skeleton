<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeleton Application for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
	'router' => array(
		'routes' => array(
			// The following is a route to simplify getting started creating
			// new controllers and actions without needing to create a new
			// module. Simply drop new controllers in, and you can access them
			// using the path /module/:controller/:action
			'sample' => array(
				'type'    => 'Literal',
				'options' => array(
					'route'    => '/sample',
					'defaults' => array(
						'__NAMESPACE__' => 'Sample\Controller',
						'controller'    => 'index',
						'action'        => 'view',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/[:controller[/:action]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
							),
							'defaults' => array(
							),
						),
					),
					//--
					'view' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '/index/view[/:mode[/:extra]]',
							'constraints' => array(
								'mode'    => '[a-zA-Z0-9_-]*',
								'extra'     => '[+a-zA-Z0-9_-]*',
							),
							'defaults' => array(
								'__NAMESPACE__' => 'Sample\Controller',
								'controller'    => 'index',
								'action'        => 'view'
							),
						),
					),
					//--
					'json' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '/index/json',
							'constraints' => array(
							),
							'defaults' => array(
								'__NAMESPACE__' => 'Sample\Controller',
								'controller'    => 'index',
								'action'        => 'json'
							),
						),
					),
					//--
					'bootstrap' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '/index/bootstrap',
							'constraints' => array(
							),
							'defaults' => array(
								'__NAMESPACE__' => 'Sample\Controller',
								'controller'    => 'index',
								'action'        => 'bootstrap'
							),
						),
					),
					//--
				),
			),
		),
	),
/*
	'service_manager' => array(
		'factories' => array(
			'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
		),
	),
*/
	'translator' => array(
		'locale' => 'en_US',
		'translation_file_patterns' => array(
			array(
				'type'     => 'gettext',
				'base_dir' => __DIR__ . '/../language',
				'pattern'  => '%s.mo',
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'Sample\Controller\Index' => 'Sample\Controller\IndexController',
		),
	),
	'view_manager' => array(
		'display_not_found_reason' => true,
		'display_exceptions'       => true,
		'doctype'                  => 'HTML5',
		'not_found_template'       => 'error/404',
		'exception_template'       => 'error/index',
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
);

//end of php code
?>