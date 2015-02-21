<?php

//-- unixman
ini_set('display_errors', '1');	// display runtime errors
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); // error reporting
ini_set('html_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', 'data/logs/phperrors.log'); // record them to a log
//--

//-- This makes our life easier when dealing with paths. Everything is relative to the application root now.
chdir(dirname(__DIR__));
//-- Decline static file requests back to the PHP built-in webserver
if(php_sapi_name() === 'cli-server' && is_file(__DIR__.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
	return false;
} //end if
//-- Setup autoloading
require('init_autoloader.php');
//-- Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
//--

//end of php code
?>