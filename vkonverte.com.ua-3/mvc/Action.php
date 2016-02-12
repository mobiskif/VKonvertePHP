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
		//saveObj ( $zakaz );
	}
}

class get_Papeer extends Action {}
class set_Papeer extends Action {
	public function do_action($zakaz) {
		$zakaz->papeer = $_REQUEST ["papeer"];
		//saveObj ( $zakaz );
	}
}

class get_Zakaz extends Action {}

class set_Anonym extends Action {
	public function do_action($zakaz) {
		$zakaz->anonym = !$zakaz->anonym;
		//saveObj ( $zakaz );
	}
}
class set_Debug extends Action {
	public function do_action($zakaz) {
		$zakaz->debug = !$zakaz->debug;
		//saveObj($zakaz);
	}
}
?>