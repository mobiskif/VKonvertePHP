<?php
require_once ( 'mysql_model.php' );

class Model extends mySQL_Model{
    function __construct() {
		$this->hostname="localhost";
		$this->user="root";
		$this->pass="router";
		$this->dbname="test";
    }

}
?>