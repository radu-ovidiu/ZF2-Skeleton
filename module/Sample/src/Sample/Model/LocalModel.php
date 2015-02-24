<?php
// ZF2 Module / Model :: Sample
// author: radu-ovidiu
// 2015-02-15

namespace Sample\Model;


class LocalModel implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

	protected $serviceLocator;

	protected $adapter;
	protected $platform;


	//=====


	public function __construct($serviceLocator) {

		$this->setServiceLocator($serviceLocator);

		$config = $this->serviceLocator->get('Config');
		$config = (array) $config;
		$this->adapter = new \Zend\Db\Adapter\Adapter($config['db']);
		$this->platform = $this->adapter->getPlatform(); // $this->platform->quoteValue('myvalue');

		if((strtolower($config['db']['database']) == 'pdo_sqlite') AND (!is_file($config['db']['database']))) {
			//--
			$this->adapter->query('BEGIN');
			$this->adapter->query(
				'CREATE TABLE "table_main_sample" ("id" character varying(10) NOT NULL, "name" character varying(100) NOT NULL, "description" text NOT NULL)',
				array()
			);
			for($i=0; $i<9; $i++) {
				$this->adapter->query(
					' INSERT INTO "table_main_sample" ("id","name","description") VALUES (?,?,?)',
					array(($i+1), 'Name "'.($i+1).'"', "Description '".($i+1)."'")
				);
			} //end for
			//--
			$this->adapter->query('COMMIT');
			//--
		} //end if

	} //END FUNCTION


	public function getServiceLocator() {
		return $this->serviceLocator;
	} //END FUNCTION


	public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	} //END FUNCTION


	//=====


	public function readQuery($query, $values='') {
		if(!is_array($values)) {
			$values = array();
		} //end if
		return $this->adapter->query(
			$query,
			$values
		)->toArray();
	} //END FUNCTION


	public function writeQuery($query, $values='') {
		if(!is_array($values)) {
			$values = array();
		} //end if
		return $this->adapter->query(
			$query,
			$values
		);
	} //END FUNCTION


	public function getMicroTime() {
		list($usec, $sec) = @explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	} //END FUNCTION


} //END CLASS


//end of php code
?>