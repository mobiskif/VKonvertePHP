<?php
require_once 'State.php';
require_once 'Action.php';
require_once 'Zakaz.php';
class Context extends classVisible {
	public $state;
	public $action;
	function __construct() {
		parent::__construct();
		if (isset($_REQUEST ["state"])) {
			$this->state = new $_REQUEST ["state"];
			saveObj($this->state);
		}
		elseif (isset($_COOKIE ["State"])) {
			$this->state = loadObj($_COOKIE ["State"]);
		}
		else $this->state = new stateZero;
		
		if (isset($_REQUEST ["submit"])) {
			$this->state = $this->state->handle();
			$this->state->zakaz->setAddress();
			saveObj($this->state);
		}
		elseif (isset($_REQUEST ["submit_file"])) {
			//var_dump($_FILES);
			$uploaddir = 'uploads/';
			$uploadfile = $uploaddir . $this->state->zakaz->id."_".basename($_FILES['userfile']['name']);
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
				$this->state = $this->state->handle();
				$this->state->zakaz->file=$uploadfile;
				saveObj($this->state);
			} else {
				//echo "Возможная атака с помощью файловой загрузки!\n";
			}
				
				
		}
		
		if (isset($_REQUEST ["action"])) {
			$this->action = new $_REQUEST ["action"];
			$this->action->do_action($this->state->zakaz);
			$this->state->zakaz->setAddress();
			saveObj($this->state);
		}	
	}
}
?>