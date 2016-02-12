<?php 
error_reporting(E_ALL);
ini_set ("display_errors", "1");

require_once ( './mvc/View.php' );
$view = new View();

require_once ( './mvc/Context.php' );
$context=new Context(); //Controller

$view->context=$context;
$view->show();

?>