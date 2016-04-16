<?php
require_once 'Model.php';
class classVisible {
	//public $error="";
	function __construct() {
		$this->template = isset ( $_COOKIE ["template"] ) ? $_COOKIE ["template"] : TEMPL;		
	}
	
	public function include_Header() {
		$this->template = isset ( $_COOKIE ["template"] ) ? $_COOKIE ["template"] : TEMPL;		
		header ( 'Content-Type: text/html; charset=utf-8' );
		include ($this->template . '/header.html');
	}
	function include_Content() {
		$this->template = isset ( $_COOKIE ["template"] ) ? $_COOKIE ["template"] : TEMPL;		
		$templname = $this->template . '/' . get_class ( $this ) . '.html';
		if (file_exists ( $templname )) {
			include ($templname);
			return true;
		}
		else return false;
	}
	function getContent() {
		return printArray ($this);
	}
	function getName() {
		if (get_parent_class($this) == "Action") $runame = isset ( Model::$actions [get_class ( $this )] ) ? Model::$actions [get_class ( $this )] : get_class($this);
		else $runame = isset ( Model::$states [get_class ( $this )] ) ? Model::$states [get_class ( $this )] : get_class($this);
		if (isset($this->error)) return $runame." ".$this->error; 
		else return $runame;
	}
	public function include_Footer() {
		$this->template = isset ( $_COOKIE ["template"] ) ? $_COOKIE ["template"] : "template-old";		
		include ($this->template . '/footer.html');
		include ($this->template . '/microformats.html');
	}
	
}
?>