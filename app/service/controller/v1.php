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

					case 'delete':
						$result = $reports->delete('tb_satker', ['id_satker' => $input['id']]);
						$this->errorMsg = ($result['success']) ? 
											array('status' => 'success', 'message' => array(
												'title' => 'Sukses',
												'text' => 'Data telah dihapus',
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
						$data['datetime'] = date('Y-m-d H:i:s');
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
						$form = $reports->getDataTabel('tb_document_upload', ['id_document_upload', $input['id_document_upload']]);
						$data = $reports->paramsFilter($form, $input);
						$file_upload = [];
						foreach ($_FILES as $key => $value) {
							$upload = $this->uploadImage($value, 'IMG');
							if ($upload['status'] == 'success') {
								array_push($file_upload, $upload['UploadFile']);
							}
						}

						$data['file_upload'] = implode(',', $file_upload);
						$result = $reports->save_update('tb_document_upload', $data);
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

			case 'kebakaran':
				switch ($action) {
					case 'form':
						$input = $this->postValidate();
						$data = $reports->getFormCekKebakaranSatker($input['satker']);
						$this->succesMsg['data'] = $data;
						$this->showResponse($this->succesMsg);
						break;

					case 'entry':
						$input = $this->inputValidate();
						$form = $reports->getDataTabel('tb_cek_kebakaran', ['id_cek_kebakaran', $input['id_cek_kebakaran']]);
						$data = $reports->paramsFilter($form, $input);
						$data['datetime'] = date('Y-m-d H:i:s');
						$result = $reports->save_update('tb_cek_kebakaran', $data);
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
						/**
						 * Dikarenakan upload file terlebih dahulu, 
						 * maka kita simpan data cek kebakaran sebelum upload file
						 */
						$input = $this->postValidate();
						$formEntry = $reports->getDataTabel('tb_cek_kebakaran', ['id_cek_kebakaran', $input['cek_id']]);
						$dataEntry = $reports->paramsFilter($formEntry, $input);
						$dataEntry['id_cek_kebakaran'] = $input['cek_id'];
						$result = $reports->save_update('tb_cek_kebakaran', $dataEntry);

						$formUpload = $reports->getDataTabel('tb_document_upload', ['id_document_upload', $input['id_document_upload']]);
						$dataUpload = $reports->paramsFilter($formUpload, $input);
						$file_upload = [];
						foreach ($_FILES as $key => $value) {
							$upload = $this->uploadImage($value, 'IMG');
							if ($upload['status'] == 'success') {
								array_push($file_upload, $upload['UploadFile']);
							}
						}

						$dataUpload['file_upload'] = implode(',', $file_upload);
						$result = $reports->save_update('tb_document_upload', $dataUpload);
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

			case 'laporan':
				$input = $this->postValidate();
				$input = $reports->paramsFilter(['page' => 1, 'size' => 10, 'cari' => '', 'group' => '', 'tanggal' => ''], $input);
				switch ($action) {
					case 'tahanan':
						$data = $reports->getListLaporanTahanan($input);
						$this->succesMsg['data'] = $data;
						$this->showResponse($this->succesMsg);
						break;

					case 'kebakaran':
						$data = $reports->getListLaporanKebakaran($input);
						$this->succesMsg['data'] = $data;
						$this->showResponse($this->succesMsg);
						break;
					
					default:
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
				}
				break;

			case 'statistik':
				$input = $this->postValidate();
				$input = $reports->paramsFilter(['page' => 1, 'size' => 10, 'cari' => '', 'group' => '', 'start_date' => date('Y-m-d'), 'end_date' => date('Y-m-d')], $input);
				switch ($action) {
					case 'tahanan':
					case 'kebakaran':
						$data = ($action == 'tahanan') ? $reports->getListJumlahLaporanTahanan($input) : $reports->getListJumlahLaporanKebakaran($input);
						$statistik = [
							'labels' => [],
							'values' => []
						];
						
						/**
						 * Urutkan data berdasarkan kolom jumlah_laporan
						 * array_column => Ambil data pada kolom tertentu
						 * array_multisort => urutkan data array, berdasarkan kolom
						 */
						$data_contents = $data['contents'];
						$order_by_jumlah = array_column($data_contents, 'jumlah_laporan');
						array_multisort($order_by_jumlah, SORT_DESC, $data_contents);

						// Data Original
						foreach ($data['contents'] as $key => $value) {
							$statistik['labels'][$key] = $value['nama_satker'];
							$statistik['values'][$key] = intval($value['jumlah_laporan']);
						}

						// Data Order
						foreach ($data_contents as $key => $value) {
							$statistik['labels'][$key] = $value['nama_satker'];
							$statistik['values'][$key] = intval($value['jumlah_laporan']);
						}

						$data = [];
						$data['statistik'] = $statistik;
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
