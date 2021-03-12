<?php

namespace app\ereport\controller;

use app\defaults\controller\application;

class login extends application{
	
	public function __construct(){
		parent::__construct();
		$this->reports = new \app\ereport\model\reports();
		$this->data['api_path'] = $this->link('api/v1');
		$userSession = $this->getSession('SESSION_LOGIN');
		$userSession = isset($_COOKIE[$this->cookie]) ?? '';
		if (!empty($userSession)) {
			$this->redirect('main');
		}
	}

	public function index(){
		$this->data['username'] = '';
		$this->data['password'] = '';
		$this->showView('index', $this->data, 'appui');
	}

}
?>