<?php

namespace app\ereport\controller;

use app\defaults\controller\application;

class main extends application{
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->redirect('dashboard');
	}

}
?>
