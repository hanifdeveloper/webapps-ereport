<?php

namespace app\ereport\controller;

use app\ereport\controller\main;

class management extends main{
	
	public function __construct(){
		parent::__construct();
		$this->modul = $this->link($this->getProject().$this->getController());
		$group = $this->userSession['group_user'];
		$this->data['pilihan_group'] = $this->pilihan_group;
		$this->data['group'] = $group;
		if (!empty($group)) {
			$this->data['pilihan_group'] = [$group => $this->pilihan_group[$group]];
		}
	}

	public function index(){
		$this->redirect($this->getController().'/satker');
	}

	public function satker(){
		$this->data['page_title'] = 'Management Satker';
		$this->data['breadcrumb'] = '<li>Management</li><li><a href="'.$this->modul.'/'.__FUNCTION__.'">Satker</a></li>';
		$this->showView('satker', $this->data, 'appui');
	}

	public function user(){
		$this->data['page_title'] = 'Management User';
		$this->data['breadcrumb'] = '<li>Management</li><li><a href="'.$this->modul.'/'.__FUNCTION__.'">User</a></li>';
		$this->showView('user', $this->data, 'appui');
	}

}
?>