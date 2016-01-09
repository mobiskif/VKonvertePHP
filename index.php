<?php 
ini_set ("display_errors", "1");
error_reporting(E_ALL);
//ini_set ("include_path", "/var/www/vkonverte/vkonverte.com.ua/mvc");
require_once 'mvc/include.php';

//var_dump($_REQUEST);

require_once ('mvc/Context.php');
$context = new Context();

require_once ('mvc/View.php');
$view = new View();
//$view = new classVisible();
//$view = new stateZero();
//$view = new stateOne();
//$view = new stateTwo();
//$view = new stateThree();
//$view = new get_Papeer(); $view->do_action(new Zakaz());
//$view = new get_Konvert(); $view->do_action(new Zakaz());

$view->context=$context;
$view->include_Header();
$view->include_Content();
//echo $view->getContent();
$view->include_Footer();
?>