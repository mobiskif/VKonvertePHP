<?php
require_once ( 'State.php' );
//require_once ( '_include.php' );
class Context { //Controller
	public $state;
	public $action;
	public $error;
	public $fields;
	public $template;

	public function __construct() {
		if (isset($_REQUEST["template"])) {
			if (file_exists($_REQUEST["template"])) {
				$this->template=$_REQUEST["template"];
				setcookie("_template", $this->template);
			}
		}
		elseif (isset($_COOKIE["_template"])) $this->template=$_COOKIE["_template"];
		else $this->template="template";

		if (isset($_REQUEST["state"])) {
			$this->setState($_REQUEST["state"]);
		}
		elseif (isset($_COOKIE["_state"])) {
			$this->setState($_COOKIE["_state"]);	//восстановить предыдущее состояние
			if (isset($_REQUEST["submit"]) or isset($_REQUEST["submit_file"])) $this->state->handle();	//перейти в следующее состояние
		}
		else $this->setState("Заполнить адрес");

		if (isset($_REQUEST["action"])) {
			$this->action=$_REQUEST["action"];
		}
		if (isset($_REQUEST["about"])) {
			$this->action="about";
		}

	}

	public function setState($s) {
		//$ts=translit($s);
		$ts=$s;
		if (class_exists($ts)) {
			setcookie("_state", $ts);
			$this->state = new $ts($this);
			$this->fields=$this->state->getFields();
		}
		elseif (isset($_COOKIE["_state"])) {
			$this->setState($_COOKIE["_state"]);	//восстановить предыдущее состояние
			if (isset($_REQUEST["submit"]) or isset($_REQUEST["submit_file"])) $this->state->handle();					//перейти в следующее состояние
		}
		else $this->setState("stateOne");
	}


}
?>