<?php

namespace app\ereport\controller;

use app\defaults\controller\application;

class main extends application{
	
	public function __construct(){
		parent::__construct();
		$this->reports = new \app\ereport\model\reports();
		$this->modul = $this->link($this->getProject());
		$this->data['api_path'] = $this->link('api/v1');
		$this->data['url_path'] = $this->link($this->getProject().$this->getController());
		// $userSession = $this->getSession('SESSION_LOGIN');
		$userSession = isset($_COOKIE[$this->cookie]) ?? '';
		// if (empty($userSession)) {
		// 	$this->redirect('login');
		// }
	}

	public function index(){
		$this->data['page_title'] = 'Dashboard';
		$this->data['breadcrumb'] = '<li>Polda Kalbar</li><li><a href="'.$this->modul.'">Dashboard</a></li>';
		$this->showView('index', $this->data, 'appui');
	}

	public function preloader(){
		$this->subView('preloader', $this->data);
	}

	public function header(){
		$this->subView('header', $this->data);
	}

	public function navbar(){
		$this->subView('navbar', $this->data);
	}

	public function modal(){
		$this->subView('modal', $this->data);
	}
	
	protected function script(){
		header('Content-Type: application/javascript');
		$this->subView('script', $this->data);
	}

}
?>