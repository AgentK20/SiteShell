<?php
class Site {
	public $config;
	public $smarty;
	public $db;

	function __construct(){
		$this->config();
		$this->init();
		$this->render();
	}

	function path() {
		$_SERVER['REQUEST_URI_PATH'] = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
		return explode('/', trim($_SERVER['REQUEST_URI_PATH'], '/'));
	}

	function config() {
		$this->config = array(
			'db' => array(
				'host' => 'localhost',
				'port' => 3306,
				'user' => 'user',
				'pass' => 'pass',
				'db' => 'db'
			),
			'url' => 'http://svc.araeosia.com/',
			'dir' => '/media/hdd3/svc/internal/',
			'smarty' => array(
				'templateDir' => '/media/hdd3/svc/internal/templates',
				'compileDir' => '/media/hdd3/svc/internal/smarty/templates_c'
			)
		);
	}

	function render() {
		require_once($this->config['dir']."pages/Page.php");
		$path = $this->path();
		switch($path[0]){
			case NULL:
			case "":
			case "home":
				require_once($this->config['dir']."pages/Home.php");
				$page = new Home($this);
				break;
			default:
				$page = new Page($this);
				break;
		}
		$page->render();
		$this->smarty->assign('page', $page);
		$this->smarty->display('index.tpl');
	}

	function init() {
		require_once($this->config['dir']."smarty/Smarty.class.php");
		$this->smarty = new Smarty();
		$this->smarty->setTemplateDir($this->config['smarty']['templateDir']);
		$this->smarty->setCompileDir($this->config['smarty']['compileDir']);
		//$this->db = new MySQLi($this->config['db']['host'], $this->config['db']['user'], $this->config['db']['pass'], $this->config['db']['db'], $this->config['db']['port']);
	}
}
