<?php

namespace app\ereport\controller;

use app\ereport\controller\main;

class laporan extends main{
	
	public function __construct(){
		parent::__construct();
		$this->modul = $this->link($this->getProject().$this->getController());
	}

	public function index(){
		$this->redirect($this->getController().'/tahanan');
	}

	public function tahanan($detail){
		$this->data['page_title'] = 'Laporan Cek Tahanan';
		$this->data['breadcrumb'] = '<li>Laporan</li><li><a href="'.$this->modul.'/'.__FUNCTION__.'">Cek Tahanan</a></li>';

		if ($detail) {
			$data_laporan = $this->reports->getDetailCekTahananSatker($detail);
			if (empty($data_laporan)) {
				$this->redirect($this->getController().'/tahanan');
			}
			$this->data['data_laporan'] = $data_laporan;
			$this->showView('tahanan', $this->data, 'appui');
			die;
		}

		$this->data['pilihan_group'] = ['' => ['text' => 'Semua Group']] + $this->reports->getPilihanGroupSatker();
		$this->data['kategori'] = 'tahanan';
		$this->showView('kategori', $this->data, 'appui');
	}

	public function kebakaran($detail){
		$this->data['page_title'] = 'Laporan Cegah Kebakaran';
		$this->data['breadcrumb'] = '<li>Laporan</li><li><a href="'.$this->modul.'/'.__FUNCTION__.'">Cegah Kebakaran</a></li>';

		if ($detail) {
			$data_laporan = $this->reports->getDetailCekKebakaranSatker($detail);
			if (empty($data_laporan)) {
				$this->redirect($this->getController().'/kebakaran');
			}
			$this->data['data_laporan'] = $data_laporan;
			$this->showView('kebakaran', $this->data, 'appui');
			die;
		}

		$this->data['pilihan_group'] = ['' => ['text' => 'Semua Group']] + $this->reports->getPilihanGroupSatker();
		$this->data['kategori'] = 'kebakaran';
		$this->showView('kategori', $this->data, 'appui');
	}

}
?>