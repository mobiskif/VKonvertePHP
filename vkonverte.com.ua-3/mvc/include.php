<?php
const TEMPL="template";
const LOGO="ВКонверте";
const TITLE = "Фото из смартфона &mdash; почтой в конверте";
const DESCRIPTION="Отправляйте по всему миру по цене местной почты";

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
	//var_dump(get_parent_class($obj));
	setcookie (get_parent_class($obj), serialize($obj) );
}

function loadObj($s) {
	return unserialize($s);
}

?>