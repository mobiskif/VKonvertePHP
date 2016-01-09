<?php
class Action extends classVisible {
	public function do_action($zakaz) {
		$this->zakaz = $zakaz;
	}
	
}

class get_Konvert extends Action {}
class set_Konvert extends Action {
	public function do_action($zakaz) {
		$zakaz->konvert = $_REQUEST ["konvert"];
	}
}

class get_Papeer extends Action {}
class set_Papeer extends Action {
	public function do_action($zakaz) {
		$zakaz->papeer = $_REQUEST ["papeer"];
	}
}

class get_Zakaz extends Action {}

class set_Anonym extends Action {
	public function do_action($zakaz) {
		$zakaz->anonym = !$zakaz->anonym;
	}
}

class set_Template extends Action {
	public function do_action($zakaz) {
		if ($this->template=="template-new") $this->template="template-old"; 
		else $this->template="template-new";
		setcookie ("template", $this->template );
	}
}

class next extends Action {}
class prev extends Action {}

class a_stateOne extends Action {}
class a_stateTwo extends Action {public $error="";}
class a_stateThree extends Action {}

?>