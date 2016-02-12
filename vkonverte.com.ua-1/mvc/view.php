<?php
class View {
	function __construct($c) {
		$this->name="Письмо в конверте";
		$this->description="Отправь письмо в бумажном конверте";
		$this->template="template0";
        $this->controller=$c;
		$this->controller->view=$this;
		$this->leftmenu=file_get_contents('elements/leftmenu.html');
		$this->topmenu=file_get_contents('elements/topmenu.html');
    }

	function show() {
		header('Content-Type: text/html; charset=utf-8'); 
		include ('elements/head.html');
		include ('elements/layout.html');
		include ('elements/foot.html');
	}
}
?>