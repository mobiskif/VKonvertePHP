<?php
class Zakaz {//extends classVisible {
	public $id = null;
	public $konvert = "Post";
	public $papeer = "Classic";
	public $file = null;
	public $to = "Петров Петр Петрович, 72001 Киев, ул. Гоголя 36, кв. 12";
	public $from = "Иванов Иван Иванович, 85014 Москва, ул. Пушкина 12, кв. 36";
	
	public function setAll() {
		//var_dump($_REQUEST);
		if (isset ( $_REQUEST ["from"] )) {
			$this->from = $_REQUEST["from"];
		}
		if (isset ( $_REQUEST ["to"] )) {
			$this->to = $_REQUEST["to"];
		}
		if (isset ( $_REQUEST ["konvert"] )) {
			$this->konvert = $_REQUEST ["konvert"];
		}
		if (isset ( $_REQUEST ["papeer"] )) {
			$this->papeer = $_REQUEST ["papeer"];
		}
		if (isset ( $_FILES ["userfile"] ["name"] )) {
			$this->file = $_FILES ["userfile"] ["name"];
		}
	}
	function getID() {
		if (file_exists ( "id.txt" )) return file_get_contents ( "id.txt" );
		else return 0;
	}
	function setID() {
		$a = 1 + ( int ) $this->getID ();
		if (file_put_contents ( "id.txt", $a )) $this->id = $a;
		else $this->id = 0;
	}
	function setKonvert($var) {
		$this->konvert = $var;
	}
	function setPapeer($var) {
		$this->papeer = $var;
	}
	function setFile($var) {
		$this->file = $var;
	}
}
//class zakazPost extends Zakaz {}

?>