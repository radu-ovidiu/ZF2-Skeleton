<?php

//-- unixman
date_default_timezone_set('UTC');
ini_set('display_errors', '1');	// display runtime errors
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); // error reporting
ini_set('html_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', 'data/logs/phperrors.log'); // record them to a log
ini_set('default_charset', 'UTF-8'); // default charset UTF-8
//--

//-- This makes our life easier when dealing with paths. Everything is relative to the application root now.
chdir(dirname(__DIR__));
if((php_sapi_name() === 'fpm-fcgi') || (php_sapi_name() === 'cgi-fcgi')) {
    die('Zend Framework 2 with PHP-FPM or PHP-FCGI requires a Virtual Host to be set !<br>Alternatively, for development as http://127.0.0.1:8888, go to the zf2/public and type in a terminal: php -S 127.0.0.1:8888 -t ./');
} //end if
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