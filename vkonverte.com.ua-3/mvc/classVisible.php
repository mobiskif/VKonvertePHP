<?php
require_once 'Model.php';
class classVisible {
	public $runame;
	public $id;
	function __construct() {
		$this->id=uniqid();
		if (isset(Model::$states[get_class($this)])) $this->runame = Model::$states[get_class($this)];
		elseif (isset(Model::$actions[get_class($this)][0])) $this->runame = Model::$actions[get_class($this)][0];
		else $this->runame = get_class($this);
		//$this->runame=get_class($this);
	}
	
	function getContent() {
		$s = "<div>";
		$s .= printArray ($this);
		$s .= "</div>";
		return $s;
	}
	function include_() {
		$templname= TEMPL . '/' . get_class ( $this ) . '.html';
		if (file_exists ($templname)) {
			include ($templname);
			return true;
		}
		else return false;
	}
	/*
	function save() {
		setcookie (get_parent_class($this), serialize($this) );
	}
	
	function load($s) {
		return unserialize($s);
	}
	*/	
}
?>