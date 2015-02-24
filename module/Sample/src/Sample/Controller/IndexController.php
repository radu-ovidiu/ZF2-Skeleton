<?php
// ZF2 Module / Controller :: Sample
// author: radu-ovidiu
// 2015-02-15

namespace Sample\Controller;


class IndexController extends \Zend\Mvc\Controller\AbstractActionController {


	// Default
	public function ViewAction() {

		//--
		$auth = new \Zend\Authentication\AuthenticationService();
		$logged_user = $auth->getIdentity();
		$logged_id = $logged_user['account_id'];
		//--

		//--
		$escaper = new \Zend\Escaper\Escaper('utf-8');
		$session = new \Zend\Session\Container('statistics');
		$view = new \Zend\View\Model\ViewModel();
		//--

		//-- get cookies
		$cookies = $this->getRequest()->getCookie();
		$mode = $this->params()->fromRoute('mode', 'default');
		$extra = $this->params()->fromRoute('extra', 'default');
		//--

		//--
		$data = array();
		if((string)$mode == 'sqlite3') {
			$model = new \Sample\Model\LocalModel($this->getServiceLocator());
			if((string)$extra == 'list') {
				$data = $model->readQuery('SELECT * FROM table_main_sample');
			} else {
				$data = $model->readQuery('SELECT COUNT(1) AS total FROM table_main_sample');
			} //end if else
		} //end if
		//--

		//--
		$view->app_title = 'Sample Module with Twig Renderer';
		$view->title = 'Sample Module with Twig Renderer';
		$view->mode = $mode;
		$view->extra = $extra;
		$view->data = $data;
		//--

		//--
		return $view;
		//--

	} //END FUNCTION


	// JSON Sample
	public function JsonAction() {

		//--
		$view = new \Zend\View\Model\ViewModel();
		//--

		//--
		$view->json = \UXM\Utils::json_encode(
			array(
				'status' => 'OK',
				'message' => 'JSON page Status is OK',
				'unicode_test' => 'Unicode String: ( áâãäåāăąÁÂÃÄÅĀĂĄ ćĉčçĆĈČÇďĎ èéêëēĕėěęÈÉÊËĒĔĖĚĘ ĝģĜĢĥħĤĦ ìíîïĩīĭȉȋįÌÍÎÏĨĪĬȈȊĮĳĵĲĴķĶĺļľłĹĻĽŁ ñńņňÑŃŅŇóôõöōŏőøœÒÓÔÕÖŌŎŐØŒ ŕŗřŔŖŘșşšśŝßȘŞŠŚŜțţťȚŢŤùúûüũūŭůűųÙÚÛÜŨŪŬŮŰŲ ŵŴẏỳŷÿýẎỲŶŸÝźżžŹŻŽ )'
			)
		);
		//--

		//--
		return $view;
		//--

	} //END FUNCTION


	// Bootstrap Samples
	public function BootstrapSamplesAction() {

		//--
		$view = new \Zend\View\Model\ViewModel();
		//--

		//--
		$view->app_title = 'Bootstrap Samples';
		//--

		//--
		return $view;
		//--

	} //END FUNCTION


} //END CLASS


//end of php code
?>