<?php
require_once 'LiqPay.php';
class Model {
	public static $states = [
			//"stateZero"=>"VKonverte",
			"stateOne"=>"Подпишите конверт",
			"stateTwo"=>"Вложите файл",
			"stateThree"=>"Оплатите",
	];
	public static $actions = [
			"get_Konvert"=>["Выбрать конверт",12],
			"get_Papeer"=>["Выбрать бумагу",4],
			"get_Zakaz"=>["Проверить заказ",0],
			//"set_Debug"=>["Отладка",0],
	];
	
	public static function getKeywords() {
		$s="";
		foreach (Model::$actions as $key => $value) $s.=$value[0].", ";
		$s.="VKonverte";
		return $s;
	}
	public static function getActionsNav() {
		$s='<ul class="nav">';
		foreach (Model::$actions as $key => $value) {
			$s.="<li><a href=\"?action=".$key."\">".$value[0]."</a></li>";
		}
		$s.="</ul>";
		return $s;
	}
	public static function getStatesNav($current) {
		$s='<ul class="nav">';
		foreach (Model::$states as $key => $value) {
			$s.='<li ';
			if (get_class($current) == $key) $s.='class="active"';
			$s.=' itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
			$s.='<a itemprop="url" href="?state='.$key.'">';
			$s.='<span itemprop="title">'.$value.'</span>';
			$s.='</a></li> ';
		}
		$s.="</ul>";
		return $s;
	}
	public static function getPayForm($zakaz) {
		$liqp = array (
		 'amount' => $zakaz->sum,
		 'currency' => 'UAH',
		 'description' => 'Оплата почтовых услуг',
		 //'order_id' => 'order_' . date ( 'YmdHi', time () ),
		 'order_id' => 'order_' . $zakaz->id,
		 'language' => 'en',
		 'result_url' => 'http://vkonverte.com.ua/?action=saveLiqPay&id='.$zakaz->id,
		 'type' => 'buy'
		);
		$public_key = "i2585333566";
		$private_key = "11gIelq1UB7amSrjYz7SsA1dFcyRq9ji5GJnPpHo";
		$liqpay = new LiqPay($public_key, $private_key);
		return $liqpay->cnb_form($liqp);
	}
}
?>