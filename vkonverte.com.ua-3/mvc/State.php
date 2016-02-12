<?php 
require_once ('classVisible.php');
class State extends classVisible {
	public $zakaz;
	public $breadcrumb;
	function __construct() {
		parent::__construct();
		$this->zakaz = isset($_COOKIE ["Zakaz"]) ? loadObj($_COOKIE ["Zakaz"]) : new zakazPost();	
	}
}

class stateZero extends State {
	public function handle() {
		return new stateOne;
	}
}
class stateOne extends State {
	public function handle() {
		return new stateTwo;
	}
}
class stateTwo extends State {
	public function handle() {
		return new stateThree;
	}
}
class stateThree extends State {
	public function handle() {
		return new stateZero;
	}
}

?>