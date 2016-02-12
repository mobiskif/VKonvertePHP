<?php
//require_once ('mysql_model.php');
//require_once ( '_include.php' );

class Model {//extends mySQL_Model
	public $keywords;
	public $mainpath;
	function __construct() {
		$this->title="ВКонверте. Фото из смартфона - почтой в конверте.";
		$this->description="ВКонверте: отправить файл, фотографию, документ в почтовом конверте прямо из смартфона.";
		$this->mainpath = [
			"Подписать конверт"=>"stateOne",
			"Вложить файл"=>"stateTwo",
			"Оплатить"=>"stateThree"
			];
		$this->keywords = [
			"ВКонверте",
			/*
			"конверт",
			"в конверте",
			"отправить файл по почте",
			"отправить документ по почте",
			"отправить фотографию по почте",
			"отправить в конверте",
			"отправить из мобилки",
			"оправить из смартфона",
			"фото из смартфона",
			"почтой в конверте",
			"распечатать файл",
			"распечатать в конверт",
			"распечатать из мобилки",
			"распечатать из смартфона",
			"файл в конверте",
			"документ в конверте",
			"фотография в конверте",
			"открытка в конверте",
			"выбрать метод оплаты",
			*/
			"Выбрать конверт",
			/*
			"Выбрать бумагу",
			"Выбрать тип отправления",
			"отправить бесплатно",
			"распечатать бесплатно",
			"через е-mail",
			"частным лицам",
			"для бизнеса",
			*/
			];
		$this->hostname="localhost";
		$this->user="root";
		$this->pass="router";
		$this->dbname="test";
	}
	function getKeywords() {
		$s="";
		foreach ($this->keywords as $i => $value) {
			$s.=($this->keywords[$i]).", ";
		}
		$s.="vkonverte";
		return $s;
	}
	function getKeywordsNav() {
		$s="<ul>";
		foreach ($this->keywords as $i => $value) {
			$s.="<li><a href=\"?action=".$value."\">".$value."</a></li> ";
		}
		$s.="</ul>";
		return $s;
	}
	function getMainPathNav($state) {
		$s='<ol id="nav">';
		foreach ($this->mainpath as $key => $value) {
			$s.='<li ';
			if (get_class($state) == $value) $s.='class="active"';
			$s.=' itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
			$s.='<a itemprop="url" href="?state='.$value.'">';
			$s.='<span itemprop="title">'.$key.'</span>';
			$s.='</a></li> ';
		}
		$s.="</ol>";
		return $s;
	}
}
?>