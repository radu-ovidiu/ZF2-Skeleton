<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

	public function indexAction() {

		$view = new \Zend\View\Model\ViewModel();
		$view->zend_version = \Zend\Version\Version::VERSION;
		$view->app_title = 'ZF2 Skeleton Application, with Twig Renderer';

		return $view;

	} //END FUNCTION

} //END CLASS

?>