<?php
const TEMPL="template-old";
const LOGO="ВКонверте";
const TITLE = "Фото из смартфона &mdash; почтой в конверте";
const DESCRIPTION="Отправляйте фотографии и документы по всему миру по цене местной почты";
const URL = "http://vkonverte.com.ua";

function printArray($arr) {
	if (! is_object ( $arr ) and ! is_array ( $arr )) return $arr;
	else {
		if (is_object ( $arr )) {
			$s = "Object: ".get_class($arr)."<ul>";
			foreach ( get_object_vars ( $arr ) as $key => $value ) 
				$s .= "<li>" . $key . " = " . printArray ( $value ) . "</li>";
			$s .= "</ul>";
			return $s;
		}
		else {
			$s = "Array: <ul>";
			foreach ( $arr as $key => $value ) 
				$s .= "<li>" . $key . " = " . printArray ( $value ) . "</li>";
			$s .= "</ul>";
			return $s;
		}
	}
}


function saveObj($obj) {
	setcookie (get_parent_class($obj), serialize($obj) );
}

function loadObj($s) {
	return unserialize($s);
}

?>