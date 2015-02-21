<?php
// ZF2 Module
// author: radu-ovidiu
// 2014-10-10

/*** Twig set in config/application.config.php
return array(
	'modules' => array(
		...
		'Sample',
		'ZfcTwig'
		//--
	),
	'module_listener_options' => array(
		'module_paths' => array(
			'./module',
			'./vendor',
			'./vendor/zf-commons'
		),
		'config_glob_paths' => array(
			'config/autoload/{,*.}{global,local}.php'
		)
	)
);
***/

/*** Twig set in config/autoload/global.php
return array(
	'zfctwig'=>array(
		'environment_options'=>array('debug'=>true),
	)
);
***/

namespace Sample;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {

	public function onBootstrap(MvcEvent $e) {

		$serviceManager = $e->getApplication()->getServiceManager();
		$twigRenderer = $serviceManager->get('ZfcTwigRenderer');

	} //END FUNCTION

	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	} //END FUNCTION

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	} //END FUNCTION

} //END CLASS

//end of php code
?>