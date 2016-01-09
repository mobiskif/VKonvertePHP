<?php
require_once 'LiqPay.php';
class Model {
	public static $states = [ 
			//"stateZero" => "VKonverte",
			"stateOne" => "1 - Подпишите конверт",
			"stateTwo" => "2 - Вложите файл",
			"stateThree" => "3 - Оплатите" 
	];
	public static $actions = [ 
			"get_Konvert" => "Выбрать конверт",
			"get_Papeer" => "Выбрать бумагу",
			"get_Zakaz" => 	"Проверить заказ",
	]
	// "set_Debug"=>["Отладка",0],
	;
	public static function nextState($currentState) {
		$i = 0; $j=-1;
		while ( ($fruit_name = current ( Model::$states )) !== FALSE ) {
			if (key ( Model::$states ) == $currentState)
				$j = $i;
			next ( Model::$states );
			$i ++;
		}
		$kk = array_keys ( Model::$states );
		if (isset ( $kk [$j + 1] ))
			return $kk [$j + 1];
		else
			return $currentState;
	}
	public static function prevState($currentState) {
		$i = 0;
		while ( ($fruit_name = current ( Model::$states )) !== FALSE ) {
			if (key ( Model::$states ) == $currentState)
				$j = $i;
			next ( Model::$states );
			$i ++;
		}
		$kk = array_keys ( Model::$states );
		if (isset ( $kk [$j - 1] ))
			return $kk [$j - 1];
		else
			return $currentState;
	}
	public static function getKeywords() {
		$s = "";
		foreach ( Model::$actions as $key => $value )
			$s .= $value . ", ";
		$s .= "VKonverte";
		return $s;
	}
	public static function getActionsNav() {
		$s = '<ul>';
		foreach ( Model::$actions as $key => $value ) {
			$s .= "<li><a href=\"?action=" . $key . "\">" . $value  . "</a></li>";
		}
		$s .= "</ul>";
		return $s;
	}
	public static function _getStatesNav($current) {
		$s = '<ul xmlns:v="http://rdf.data-vocabulary.org/#">';
		foreach ( Model::$states as $key => $value ) {
			$s .= '<li ';
			if (get_class ( $current ) == $key)
				$s .= 'class="active"';
			$s .= ' itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
			if (get_class ( $current ) != $key)
				$s .= '<a itemprop="url" href="?action=a_' . $key . '">';
			$s .= '<span itemprop="title">' . $value . '</span>';
			if (get_class ( $current ) != $key)
				$s .= '</a>';
			$s .= '</li> ';
		}
		$s .= "</ul>";
		return $s;
	}
	public static function getStatesNav($current) {
		$state=get_class($current);
		$s = '<ul xmlns:v="http://rdf.data-vocabulary.org/#">';
		$s .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
		reset(Model::$states);
		if ($state== key(Model::$states)) $s.='<span';
		else $s .= '<a';
		$s .= ' itemprop="url" href="?nav=prev">';
		$s .= '<span itemprop="title">Prev</span>';
		if ($state== key(Model::$states)) $s.='</span>';
		else $s .= '</a>';
		$s .= '</li> ';
		$s .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
		end(Model::$states);
		//var_dump($state);
		//var_dump(key(Model::$states));
		if ($state== key(Model::$states)) $s.='<span';
		else $s .= '<a';
		$s .= ' itemprop="url" href="?nav=next">';
		$s .= '<span itemprop="title">Next</span>';
		if ($state== key(Model::$states)) $s.='</span>';
		else $s .= '</a>';
		$s .= '</li>';
		$s .= "</ul>";
		return $s;
	}
	public static function getPayForm($zakaz) {
		$liqp = array (
				'amount' => '1,75',
				'currency' => 'UAH',
				'description' => 'Оплата почтовых услуг',
				
				// 'order_id' => 'order_' . date ( 'YmdHi', time () ),
				'order_id' => 'order_' . $zakaz->id,
				'language' => 'ru',
				'result_url' => 'http://vkonverte.com.ua/?state=stateZero',
				'server_url' => 'http://vkonverte.com.ua/callback',
				
				// 'sandbox' => 0,
				'type' => 'buy' 
		);
		$public_key = "i2585333566";
		$private_key = "11gIelq1UB7amSrjYz7SsA1dFcyRq9ji5GJnPpHo";
		$liqpay = new LiqPay ( $public_key, $private_key );
		return $liqpay->cnb_form ( $liqp );
	}
}
?>