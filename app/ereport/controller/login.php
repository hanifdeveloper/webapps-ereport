<?php

namespace app\ereport\controller;

use app\defaults\controller\application;

class login extends application{
	
	public function __construct(){
		parent::__construct();
		$this->reports = new \app\ereport\model\reports();
		$this->data['api_path'] = $this->link('api/v1');
		$this->data['url_path'] = $this->link($this->getProject().$this->getController());
		$this->userSession = $this->getSession('SESSION_LOGIN');
		if (!empty($this->userSession)) {
			$this->redirect('main');
		}
	}

	public function index(){
		$this->data['username'] = '';
		$this->data['password'] = '';
		$this->sessionMessage = $this->getSession('SESSION_MESSAGE');
		$this->showView('index', $this->data, 'appui');
	}

	public function validate(){
		$input = $this->postValidate();
		$input = $this->reports->paramsFilter(['username' => '', 'password' => ''], $input);
		$data = $this->reports->userLogin($input);
		if (!empty($data)) {
			$this->setSession('SESSION_LOGIN', $data);
			$this->setSession('SESSION_MESSAGE', '');
		}
		else {
			$this->setSession('SESSION_MESSAGE', 'Oops login gagal');
		}
		$this->redirect('');
	}

}
?>