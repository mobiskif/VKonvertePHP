<?php
class mySQL_Model{
    function __construct() {
    }
	function sql_select($q, $type = "xml", $r) {
		$mysql = mysql_connect($this->hostname, $this->user, $this->pass);
		mysql_select_db( $this->dbname );
		mysql_query("set names utf8"); //SET character_set_server=koi8r;
		$result = mysql_query( stripcslashes($q) );
		if ($result === true) {
			$n = mysql_affected_rows();
			if ($n==1) $r= '<?xml version="1.0" encoding="utf-8"?> <query><row>'.stripcslashes($q).'</row></query>';
			else if ($n==0){	
				$nearid=isset($r["nearid"]) ? $r["nearid"] : "none";
				$name=isset($r["name"]) ? $r["name"] : "none";
				$query=stripcslashes("insert into users values ('', '', '".$name."', '".$nearid."')");
				$result = mysql_query($query);
				$r= '<?xml version="1.0" encoding="utf-8"?> <query><row>'.$query.'</row></query>';
			}
		}
		else if ($result === false) {
			$r= '<?xml version="1.0" encoding="utf-8"?> <query><row>Bad SQL query:'.$q.'</row></query>';
		}
		else {
		if ($type=="xml") {
			$r ='<?xml version="1.0" encoding="utf-8"?> ';
			$r.='<query>';
			while ($obj=mysql_fetch_object($result)){
				$vars=get_object_vars($obj);
				$keys=array_keys($vars);
				$r.='<row>';
				foreach ($keys as $k) {
					$r.='<'.$k.'>';
					$r.=mb_convert_encoding($obj->$k,"UTF8", "CP1251");
					$r.='</'.$k.'>';		
				}
				$r.='</row>';
			}
			$r.='</query>';
		}
		else {
			$r ='<table>';
			while ($obj=mysql_fetch_object($result)){
				$vars=get_object_vars($obj);
				$keys=array_keys($vars);
				$r.='<tr>';
				foreach ($keys as $k) {
					//$r.=mb_detect_encoding ($obj->$k);
					//$r.='<td>'.mb_convert_encoding($obj->$k,"UTF8", "CP1251").'</td>';
					//$r.='<td>'.mb_convert_encoding($obj->$k,"cp-1251","auto").'</td>';
					//iconv('UTF-8', 'ASCII', $obj->$k);
					$r.='<td>'.$obj->$k.'</td>';

				}
				$r.='</tr>';
			}
			$r.='</table>';
		}
		}
		return $r;
	}
}
?>