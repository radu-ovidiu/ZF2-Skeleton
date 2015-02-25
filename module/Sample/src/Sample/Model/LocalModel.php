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
		//--
		$this->setServiceLocator($serviceLocator);
		//--
		$config = $this->serviceLocator->get('Config');
		$config = (array) $config;
		$this->adapter = new \Zend\Db\Adapter\Adapter($config['db']);
		$this->platform = $this->adapter->getPlatform(); // $this->platform->quoteValue('myvalue');
		//--
		if((strtolower($config['db']['driver']) == 'pdo_sqlite') AND (!is_file($config['db']['database']))) {
			//--
			$this->writeQuery('BEGIN');
			$this->writeQuery(
				'CREATE TABLE "table_main_sample" ("id" character varying(10) NOT NULL, "name" character varying(100) NOT NULL, "description" text NOT NULL, "dtime" text NOT NULL )',
				array()
			);
			for($i=0; $i<9; $i++) {
				$test = $this->writeQuery(
					' INSERT INTO "table_main_sample" ("id","name","description","dtime") VALUES (?,?,?,?)',
					array(($i+1), 'Name "'.($i+1).'"', "Description '".($i+1)."'", date('Y-m-d H:i:s O'))
				);
				if($test != 1) {
					break;
				} //end if
			} //end for
			//--
			$this->writeQuery('COMMIT');
			//--
		} //end if
		//--
	} //END FUNCTION


	public function getServiceLocator() {
		//--
		return $this->serviceLocator;
		//--
	} //END FUNCTION


	public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
		//--
		$this->serviceLocator = $serviceLocator;
		//--
	} //END FUNCTION


	//=====


	public function readQuery($query, $values='') {
		//--
		if(!is_array($values)) {
			$values = array();
		} //end if
		//--
		return (array) $this->adapter->query(
			$query,
			$values
		)->toArray();
		//--
	} //END FUNCTION


	public function countQuery($query, $values='') {
		//--
		if(!is_array($values)) {
			$values = array();
		} //end if
		//--
		$arr = (array) $this->adapter->query(
			$query,
			$values
		)->toArray();
		//--
		$count = 0;
		//--
		if(is_array($arr[0])) {
			foreach($arr[0] as $key => $val) {
				$count = (int) $val; // find first row and first column value
				break;
			} //end if
		} //end if
		//--
		return (int) $count;
		//--
	} //END FUNCTION


	public function writeQuery($query, $values='') {
		//--
		if(!is_array($values)) {
			$values = array();
		} //end if
		//--
		return (int) $this->adapter->query(
			$query,
			$values
		)->count();
		//--
	} //END FUNCTION


	//=====


	public function getMicroTime() {
		//--
		list($usec, $sec) = @explode(' ', microtime());
		//--
		return ((float)$usec + (float)$sec);
		//--
	} //END FUNCTION


} //END CLASS


//end of php code
?>