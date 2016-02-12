<?php 
require_once 'LiqPay.php';
class AState extends Model{ //Model
	protected $context;
	protected $fields;
	public $runame;
	public function __construct($context)	{
                parent::__construct();
		$this->context=$context;
		$public_key = "i2585333566";
		$private_key = "11gIelq1UB7amSrjYz7SsA1dFcyRq9ji5GJnPpHo";
		$tovar = array(
				'amount'         => '6',
				'currency'       => 'UAH',
				'description'    => 'Оплата почтовых услуг',
				'order_id'       => 'order_'.date('YmdHi', time()),
				'type'           => 'buy'
		);

		$liqpay = new LiqPay($public_key, $private_key);
		$form = $liqpay->cnb_form($tovar);
		$sign = $liqpay->cnb_signature($tovar);

		$this->context->payform = $form;
		$this->context->signature = $sign;
		$this->runame=get_class($this);

	}

	public function getFields() {
		$fields["from"] = isset($_COOKIE["_from"]) ? $_COOKIE["_from"] : "Иванов Иван Иванович";
		$fields["fromwhere"] = isset($_COOKIE["_fromwhere"]) ? $_COOKIE["_fromwhere"] : "г. Москва, ул. Сахарова д.65 корп. 2, кв 86";
		$fields["fromindex"] = isset($_COOKIE["_fromindex"]) ? $_COOKIE["_fromindex"] : "84000";
		$fields["to"] = isset($_COOKIE["_to"]) ? $_COOKIE["_to"] : "Петрова Мария Сергеевна";
		$fields["towhere"] = isset($_COOKIE["_towhere"]) ? $_COOKIE["_towhere"] : "г. Киев, ул. Глушкова 245, кв. 134";
		$fields["toindex"] = isset($_COOKIE["_toindex"]) ? $_COOKIE["_toindex"] : "16890";
		if ( isset($_REQUEST["submit"]) ) {
			$fields["from"] = $_REQUEST["from"]; setcookie("_from", $fields["from"]);
			$fields["fromwhere"] = $_REQUEST["fromwhere"]; setcookie("_fromwhere", $fields["fromwhere"]);
			$fields["fromindex"] = $_REQUEST["fromindex"]; setcookie("_fromindex", $fields["fromindex"]);
			$fields["to"] = $_REQUEST["to"]; setcookie("_to", $fields["to"]);
			$fields["towhere"] = $_REQUEST["towhere"]; setcookie("_towhere", $fields["towhere"]);
			$fields["toindex"] = $_REQUEST["toindex"]; setcookie("_toindex", $fields["toindex"]);
		}
		return $fields;
	}
}

class stateOne extends AState {
	public function __construct($context)	{
		parent::__construct($context);
		$a= array_keys($this->mainpath);
		$this->runame=$a[0];

	}
	public function handle() {
		if ($this->checkFields($this->context->fields)) {
			$this->context->setState("stateTwo");
		}
		//else $this->context->error="Ошибка: заполните все поля!";
		else $this->runame="Ошибка: заполните все поля!";
	}
	public function checkFields($fields) {
		if (!isset($_REQUEST["submit"])) {
			return true;
		}
		else {
			if (strlen($fields["from"])<3) return false;
			if (strlen($fields["fromwhere"])<3) return false;
			if (strlen($fields["fromindex"])<3) return false;
			if (strlen($fields["to"])<3) return false;
			if (strlen($fields["towhere"])<3) return false;
			if (strlen($fields["toindex"])<3) return false;
			return true;
		}
	}
}

class stateTwo extends AState {
	public function __construct($context)	{
		parent::__construct($context);
		$this->runame="Вложить файл";
	}
	public function handle() {
		if ($this->checkFields($this->context->fields)) {
			$this->context->setState("stateThree");
		}
		//else $this->context->error="Вложите файл";
		else $this->runame="Ошибка: вложите файл!";
	}
	public function checkFields($fields) {
		if (!isset($_REQUEST["submit_file"])) return false;
		elseif (isset( $_FILES["file"])) {
			if ($_FILES["file"]["error"] > 0) {
				$this->runame="Ошибка: " . $_FILES["file"]["error"];
				return false;
			}
			else {
				$this->context->file.="Вложение: <em>" . $_FILES["file"]["name"] . "</em><br/>";
				$this->context->file.="Размер: <em>" . round($_FILES["file"]["size"] / 1024) . " КБ</em><br/>";
				//$this->context->file.="Stored in: " . $_FILES["file"]["tmp_name"];
				//move_uploaded_file($_FILES["file"]["tmp_name"], "/uploads/".$_FILES["file"]["name"]);
				if (!move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$_FILES["file"]["name"])) {
					var_dump($_FILES["file"]);
				}
				return true;
			}
		}
		else return true;
	}
}

class stateThree extends AState {
	public function __construct($context)	{
		parent::__construct($context);
		$this->runame="Оплатить";
	}
	public function handle() {
		$this->context->setState("stateOne");
	}
}


?>