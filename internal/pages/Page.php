<?php

class Page {
	public $mainClass;
	public $template="404.tpl";
	public $title="???";

	public function __construct($mainClass){
		$this->mainClass = $mainClass;
	}

	public function render() {
		$this->template = "404.tpl";
		$this->title = "404 Error";
	}
}
