<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
	'zfctwig'=>array(
		'environment_options' => array(
			'debug' => true,
			'strict_variables' => false,
			'auto_reload' => true,
			'charset' => 'UTF-8',
			'autoescape' => 'html',
			//'cache' => 'data/cache/twig',
			'optimizations' => -1
		),
	),
	'service_manager' => array(
		'factories' => array(
			'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
		),
	),
	'db' => array(
		'driver'    => 'Pdo_Sqlite',
		'database'  => 'data/cache/test.sqlite3'
	),
);
