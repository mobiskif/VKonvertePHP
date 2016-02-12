<?php
require_once 'Model.php';
require_once 'include.php';
class View extends classVisible {
	public $context;
	
	function show() {
		header('Content-Type: text/html; charset=utf-8');
		if ($this->context->state->zakaz->debug) {
		//if (TRUE) {
			//echo $this->getContent();
			echo '<style> .active {font-weight: bold;} </style>';
			$this->include_();
			echo "<hr/>".printArray ($this);
		}
		else {
			include (TEMPL.'/header.html');
			$this->include_();
			include (TEMPL.'/footer.html');
		}
	}

	function getContent() {
		$s="<small>";
		//$s.="Keywords: ".$model->getKeywords()."<br/>";
		//$s.="Description: ".$model->description."<br/>";
		//$s.="Title: ".$model->title."<br/>";
		$s.="</small><style>div {border: 1px solid; overflow:auto; margin: 2px;}</style>";
		$s.="<div>";
		$s.='<a href="?action=set_Debug">Debug</a>';
		$s.=isset ($this->context->action) 
			? $this->context->action->getContent()
			: $this->context->state->getContent();
		$s.=$this->context->state->model->getStatesNav($this->context->state);
		$s.=$this->context->state->model->getActionsNav($this->context->state);
		$s.='<form action="./" method="post">';
		$s.="<input type=text name=from value=qqq /><input type=hidden name=address /> <input type=submit name=submit /></form>";
		//$s.= printArray ($this);
		$s.="</div>";		
		return $s;
	}
	
	public function include_(){		
		if (isset ($this->context->action)) {
			if (!$this->context->action->include_()) $this->context->state->include_();
		}
		else $this->context->state->include_();
	}
}
?>