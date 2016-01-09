<?php
require_once 'State.php';
require_once 'Action.php';
require_once 'Zakaz.php';
class Context  {
	public $action;
	public $state;
	function __construct() {
		//var_dump($_REQUEST);
		$this->state = isset ( $_COOKIE ["State"] ) ? loadObj ( $_COOKIE ["State"] ) : new stateZero ();
		$this->action = isset ( $_REQUEST ["action"] ) ? new $_REQUEST ["action"] : null;
		if (isset($this->action)) $this->action->do_action($this->state->zakaz);
		//var_dump($_REQUEST);
		if (isset ( $_REQUEST ["submit"] )) $this->state = $this->state->next();
		$nav = isset ( $_REQUEST ["nav"] ) ? $_REQUEST ["nav"] : null;
		switch ($nav) {
			case "home" :
				$this->state = new stateZero ();
				break;
			case "prev" :
				$this->state = $this->state->prev();
				break;			
		}				
		saveObj ( $this->state );
	}
}
?>