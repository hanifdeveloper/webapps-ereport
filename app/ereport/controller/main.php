<?php

namespace app\ereport\controller;

use app\defaults\controller\application;

class main extends application{
	
	public function __construct(){
		parent::__construct();
		$this->data['chat_operator_path'] = $this->link('chat/operator');
	}

	public function index(){
		// $this->redirect('dashboard');
		// $this->getSessionLogin();
		$this->showView('login', $this->data, 'appui');
	}

}
?>
