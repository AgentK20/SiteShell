<?php
class Home extends Page {
	public function render() {
		$this->template = "home.tpl";
		$this->title = "Welcome!";
	}
}