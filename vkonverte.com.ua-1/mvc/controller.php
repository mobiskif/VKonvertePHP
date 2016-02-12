<?php
class Controller {
    function __construct($m) {
        $this->name="Controller";
		$this->model=$m;
    }

	function processInput($r) {
		$template = isset($r["template"]) ? $r["template"] : $template = isset($_COOKIE["_templ"]) ? $_COOKIE["_templ"] : $this->view->template;
		$this->view->template=$template;
		setcookie("_templ", $this->view->template);

		$action = isset($r["action"]) ? $r["action"] : "default"; //$action = isset($r["_action"]) ? $r["_action"] : "default";
		$this->action($action, $r);
		setcookie("_action", $action);
	}
	
	function action($a,$r) {
		$this->view->result='';
		switch ($a) {
            
			case "upload":
        		$this->view->template='template1';
                $this->view->result='Письмо отправлено';
				break;
            /*
			case "video":
				$this->view->result=file_get_contents('elements/video.html');
				break;
			case "patient":
				$this->view->result=$this->model->sql_select("select name, CONCAT('<img src=\"images/', image, '\" width=\"128\" />') as img from jos151_contact_details","table", $r);
				break;
			case "doctor":
				$this->view->result=file_get_contents('elements/doctor.html');
				break;
			case "query":
				$this->view->result=$this->model->sql_select("select * from users","table",$r);
				break;
			case "search":
				$this->view->result=$r["query"];
				break;
			case "login":
				$this->view->result=$r["login"];
				break;
			case "upload":
				$this->view->result=$r["filename"];
				break;
			case "flex":
				$query=isset($r["query"]) ? $r["query"] : "select * from jos151_users";
				echo $this->model->sql_select($query, "xml", $r);
				exit;
				break;
            */
			default:
				$this->view->result=$a;
				break;
		}
	}
	

}
?>