<?php 

class Controller {
	function __construct() {
		//$this->model=$m;
		//$this->action='jopa';
	}
	function processRequest($r) {
		var_dump($_COOKIE);
		//$stateName = isset($_COOKIE["_act"]) ? $_COOKIE["_act"] : Context::STATE_A;
		//var_dump($stateName);
		//$context = new Context();
		//var_dump(Context::STATE_C);
		//$context->setState($stateName);
		
		/*
		//$action = isset($r["action"]) ? $r["action"] : $action = isset($_COOKIE["_act"]) ? $_COOKIE["_act"] : Context::STATE_A;
		//$this->action=$action;
		setcookie("_act", $context->stateName);
		$template = isset($r["template"]) ? $r["template"] : $template = isset($_COOKIE["_templ"]) ? $_COOKIE["_templ"] : $this->view->template;
		$this->view->template=$template;
		setcookie("_templ", $this->view->template);

		
		$this->processaction($action, $r);
		*/
		//setcookie("_act", $context->stateName);
		//var_dump($context->stateName);
	}
	function processaction($a,$r) {
		$this->view->result=$a." ";
		switch ($a) {
			case "upload":
				//deletcookie("_fields");
				setcookie("_fields");
				$this->view->fields=$r;
				$this->view->result.=$r['filename'];
				setcookie("_fields", json_encode($r));
				var_dump($r);
				break;
				/*******************************
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
				case "flex":
				$query=isset($r["query"]) ? $r["query"] : "select * from jos151_users";
				echo $this->model->sql_select($query, "xml", $r);
				exit;
				break;
				************************/

			default:
				$this->view->fields = isset($_COOKIE["_fields"]) ? json_decode($_COOKIE["_fields"], true) : null;
				$this->view->result.="не обрабатывается";
				var_dump($this->view->fields);
				break;
		}
	}
}
?>?>