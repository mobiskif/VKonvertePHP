<?php
class Zakaz extends classVisible {}
class zakazPost extends Zakaz {
	public $konvert="Post";
	public $papeer="Classic";
	public $address = [
				"from" => "Иванов Иван Иванович",
				"fromwhere" => "Москва, ул. Пушкина 12, кв. 36",
				"fromindex" => "85014",
				"to" => "Петров Петр петрович",
				"towhere" => "Киев, ул. Гоголя 36, кв. 12",
				"toindex" => "72001",
	];
	public $debug = FALSE;
	public $anonym = FALSE;
	public $sum = 32.50;
	
	public function setAddress() {
		if (isset ($_REQUEST["address"])) {
			$this->address=$_REQUEST;
		}
		if (isset ($_REQUEST["konvert"])) {
			$this->konvert=$_REQUEST["konvert"];
		}
		if (isset ($_REQUEST["papeer"])) {
			$this->papeer=$_REQUEST["papeer"];
		}
		saveObj($this);
	}
}

?>