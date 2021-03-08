<?php

namespace app\service\controller;

use app\defaults\controller\application;
use comp\FUNC;

class v1 extends application{ 
	
	public function __construct(){
		parent::__construct();
		$this->data['url_path'] = $this->link($this->getProject().$this->getController());
	}

	protected function index(){
		// if (isset($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] == 'application/json') {
		// 	$this->showResponse($this->errorMsg, 404);
		// }
		print_r($_POST);
		print_r($_FILES);
	}

	protected function script(){
		header('Content-Type: application/javascript');
		$this->subView('script', $this->data);
	}

	protected function ereport($method = '', $action = ''){
		$this->checkAuthToken($this->token);
		$reports = new \app\ereport\model\reports();
		switch ($method) {
			case 'user':
				$input = $this->postValidate();
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
				$input = $this->postValidate();
				switch ($action) {
					case 'login':
						$input = $reports->paramsFilter(['satker' => '', 'password' => ''], $input);
						$data = $reports->satkerLogin($input);
						$this->errorMsg = !empty($data) ? 
											array('status' => 'success', 'message' => array(
												'title' => 'Sukses',
												'text' => 'Login berhasil',
											)) : 
											array('status' => 'error', 'message' => array(
												'title' => 'Maaf',
												'text' => 'Login gagal',
											)); 

						$this->showResponse($this->errorMsg);
						break;

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
						$input = $this->postValidate();
						$data = $reports->getFormCekTahananSatker($input['satker']);
						$this->succesMsg['data'] = $data;
						$this->showResponse($this->succesMsg);
						break;

					case 'entry':
						$input = $this->inputValidate();
						$form = $reports->getDataTabel('tb_cek_tahanan', ['id_cek_tahanan', $input['id_cek_tahanan']]);
						$data = $reports->paramsFilter($form, $input);
						$result = $reports->save_update('tb_cek_tahanan', $data);
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

					case 'upload':
						$input = $this->postValidate();
						// $data = $reports->getFormCekTahananSatker($input['satker']);
						// $this->succesMsg['data'] = $data;
						// $this->showResponse($this->succesMsg);
						// $form = json_decode($input['form'], true);
						print_r($_POST);
						print_r($_FILES);
						// $key = array_keys($_FILES['image']);
						// print_r($key);
						
						
						// $image = $_FILES['image'];
						// $result = $this->uploadImage($image, 'IMG');
						// $this->showResponse($result);
						break;
					
					default:
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
				}
				break;

			case 'kebakaran':
				switch ($action) {
					case 'form':
						$input = $this->postValidate();
						$data = $reports->getFormCekKebakaranSatker($input['satker']);
						$this->succesMsg['data'] = $data;
						$this->showResponse($this->succesMsg);
						break;
					
					default:
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
				}
				break;
			
			default:
				$this->showResponse($this->errorMsg, $this->errorCode);
				break;
		}
	}

	
}
?>
