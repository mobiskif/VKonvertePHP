<?php
require_once ('classVisible.php');
//require_once ('Model.php');
class State extends classVisible {
	public $zakaz;
	public $error="";
	function __construct() {
		parent::__construct();
		$this->zakaz= new Zakaz();
	}
	function can() {
		return TRUE;
	}
	function can_prev() {
		return TRUE;
	}
	function next() {
		if ($this->can ()) {
			$zakaz = $this->zakaz;
			$stateName = Model::nextState ( get_class ( $this ) );
			$state = new $stateName ();
			$state->zakaz = $zakaz;
			return $state;
		} 
		else return $this;
	}
	function prev() {
		if ($this->can_prev ()) {
			$zakaz = $this->zakaz;
			$stateName = Model::prevState ( get_class ( $this ) );
			$state = new $stateName ();
			$state->zakaz = $zakaz;
			return $state;
		} 
		else return $this;
	}
}
class stateZero extends State {}
class stateOne extends State {
	function can() {
		$this->zakaz->setAll ();
		saveObj ( $this->zakaz );
		if ($_REQUEST["submit"]<> get_class($this)) return true;
		else return false;
	}
}
class stateTwo extends State {
	function can() {
		$uploaddir = "uploads/";
		// var_dump ( $_FILES );
		if (isset ( $this->zakaz->file )) {
			$this->error=": файл уже вложен!";
			return true;
		}
		elseif (isset ( $_FILES ['userfile'] )) {
			$this->zakaz->setID ();
			$uploadfile = $uploaddir . $this->zakaz->id . "_" . basename ( $_FILES ['userfile'] ['name'] );
			if (move_uploaded_file ( $_FILES ['userfile'] ['tmp_name'], $uploadfile )) {
				// $this->zakaz->file = $uploadfile;
				$this->zakaz->setFile ( $_FILES ['userfile'] ['name'] );
				$this->zakaz->setAll ();
				saveObj ( $this->zakaz );
				return true;
			} 
			else {
				$this->error="Вложите файл!";
				return false;
			}
		} 
		else {
			$this->zakaz->file = null;
			return false;
		}
	}
}
class stateThree extends State {}

?>