<?php

namespace app\service\controller;

use app\defaults\controller\application;
use comp\FUNC;

class v1 extends application{ 
	
	public function __construct(){
		parent::__construct();
		$this->data['url_path'] = $this->link($this->getProject().$this->getController());
		// $reports = new \app\ereport\model\reports();
		// $reports->getTabel('tb_satker');
	}

	protected function index(){
		if (isset($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] == 'application/json') {
			$this->showResponse($this->errorMsg, 404);
		}
	}

	protected function script(){
		header('Content-Type: application/javascript');
		$this->subView('script', $this->data);
	}

	protected function ereport($method = '', $action = ''){
		$this->checkAuthToken($this->token);
		$input = $this->postValidate();
		// $this->showResponse($input);
		$reports = new \app\ereport\model\reports();
		switch ($method) {
			case 'user':
				switch ($action) {
					case 'login':
						# code...
						break;
					
					default:
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
				}
				break;

			case 'satker':
				switch ($action) {
					case 'form':
						$data = $reports->getFormSatker($input['id']);
						$this->succesMsg['data'] = $data;
						$this->showResponse($this->succesMsg);
						break;

					case 'list':
						$input = $reports->paramsFilter(['page' => 1, 'size' => 10, 'cari' => '', 'group' => ''], $input);
						$data = $reports->getListSatker($input);
						$this->succesMsg['data'] = $data;
						$this->showResponse($this->succesMsg);
						break;

					case 'save':
						$data = $reports->getFormSatker($input['id_satker']);
						$data = $reports->paramsFilter($data['form'], $input);
						$data['password'] = FUNC::encryptor($data['password']);
						$result = $reports->save_update('tb_satker', $data);
						$this->errorMsg = ($result['success']) ? 
											array('status' => 'success', 'message' => array(
												'title' => 'Sukses',
												'text' => 'Data telah disimpan',
											)) : 
											array('status' => 'error', 'message' => array(
												'title' => 'Maaf',
												'text' => $result['message'],
											)); 

						$this->showResponse($this->errorMsg);
						break;
					
					default:
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
				}
				break;

			case 'tahanan':
				switch ($action) {
					case 'form':
						$data = $reports->getFormCekTahananSatker($input['satker']);
						$this->succesMsg['data'] = $data;
						$this->showResponse($this->succesMsg);
						break;
					
					default:
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
				}
				break;
			
			default:
				// $this->showResponse($this->errorMsg, $this->errorCode);
				$this->showResponse($input);
				break;
		}
	}

	
}
?>
