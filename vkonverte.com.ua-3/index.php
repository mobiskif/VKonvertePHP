<?php 
error_reporting(E_ALL);
ini_set ("display_errors", "1");
//ini_set ("include_path", "/var/www/vkonverte/vkonverte.com.ua/mvc");

require_once 'mvc/include.php';

require_once ('mvc/Context.php');
$context = new Context();


require_once ('mvc/View.php');
$view = new View();
$view->context=$context;
$view->show();
?>