<?php
require_once 'Model.php';
class View {
public $stateCode;
public $actionsContent;

function __construct() {
		$this->template="";
		//$this->payform=file_get_contents('elements/payform.html');
		$this->model=new Model();
		$this->keywords=$this->model->getKeywords();
		$this->title=$this->model->title;
		$this->description=$this->model->description;
		$this->actionsContent="";
}

	function show() {
		header('Content-Type: text/html; charset=utf-8');
		$this->template=$this->context->template;
		include ($this->template.'/head.html');
		//if (file_exists ($this->template.'/'.get_class($this->context->state).'.html')) $this->stateCode = include($this->template.'/'.get_class($this->context->state).'.html');
		//if (file_exists ($this->template.'/'.get_class($this->context->state).'.html')) include ($this->template.'/'.get_class($this->context->state).'.html');
		//echo "<nav>".$this->model->getKeyWordsNav()."</nav>";
		//if (file_exists ($this->template.'/'.$this->context->action.'.html'))  include ($this->template.'/'.$this->context->action.'.html');
		include ($this->template.'/layout.html');
		include ($this->template.'/footer.html');
	}
}
?>