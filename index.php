<?php

define('APPLICATION_PATH', dirname(__FILE__));
define('BASE_URL', 'http://localhost/yaf_test/');
$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>
