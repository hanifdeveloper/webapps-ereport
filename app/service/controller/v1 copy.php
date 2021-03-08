<?php

namespace app\service\controller;

use app\defaults\controller\application;

class v1 extends application{ 
	
	public function __construct(){
		parent::__construct();
		$this->data['url_path'] = $this->link($this->getProject().$this->getController());
	}

	protected function index(){
		$this->showResponse($this->errorMsg, 404);
	}

	protected function script(){
		header('Content-Type: application/javascript');
		$this->subView('script', $this->data);
	}

	protected function complaint($method = '', $action = ''){
		$this->checkAuthToken($this->token);
		$input = $this->postValidate();
		$complaint = new \app\ecomplaint\model\complaint();
		switch ($method) {
			case 'user':
				switch ($action) {
					case 'form':
						// Params: phoneNumber
						$this->succesMsg['data'] = $complaint->getFormUser($input['phoneNumber']);
						$this->showResponse($this->succesMsg);
						break;

					case 'register':
						// Params: form user
						$dataUser = $complaint->getDataTabel('tb_user', ['phoneNumber', $input['phoneNumber']]);
						$dataUser = $complaint->paramsFilter($dataUser, $input);
						$dataUser['phoneNumber'] = \preg_replace('/^08/', '628', $input['phoneNumber']);
						$uploadIdentityDocument = $this->uploadImage('identityDocument', 'ktp');
						if ($uploadIdentityDocument['status'] == 'success') {
							$dataUser['identityDocument'] = $uploadIdentityDocument['UploadFile'];
						}
						
						$result = $complaint->save_update('tb_user', $dataUser);
						$this->errorCode = 200;
						$this->errorMsg = ($result['success']) ? 
											array('status' => 'success', 'message' => array(
												'title' => 'Sukses',
												'text' => 'You have Successfully Registered',
											)) : 
											array('status' => 'error', 'message' => array(
												'title' => 'Maaf',
												'text' => $result['message'],
											)); 
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;

					case 'login':
						// Params: phoneNumber
						$dataUser = $complaint->getUserLogin($input['phoneNumber']);
						$this->errorCode = 200;
						$this->errorMsg = !empty($dataUser) ? 
											array('status' => 'success', 'message' => array(
												'title' => 'Sukses',
												'text' => 'You are successfully logged in',
												'data' => $dataUser,
											)) : 
											array('status' => 'error', 'message' => array(
												'title' => 'Maaf',
												'text' => 'User not founds',
											)); 
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
					
					default:
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
				}
				break;

			case 'aduan':
				switch ($action) {
					case 'form':
						// Params: idComplaint
						$this->succesMsg['data'] = $complaint->getFormComplaint($input['idComplaint']);
						$this->showResponse($this->succesMsg);
						break;

					case 'list':
						// Params: {page, search, status}
						$this->succesMsg['data'] = $complaint->getFormComplaint();
						$this->succesMsg['data']['list'] = $complaint->getListComplaint($input);
						$this->showResponse($this->succesMsg);
						break;

					case 'save':
						$input['phoneNumber'] = \preg_replace('/^08/', '628', $input['phoneNumber']);
						$dataComplaint = $complaint->getDataTabel('tb_complaint', ['idComplaint', $input['idComplaint']]);
						$dataComplaint = $complaint->paramsFilter($dataComplaint, $input);
						$dataComplaint['complaintDate'] = date('Y-m-d', \strtotime($input['complaintDate']));
						$dataComplaint['complaintStatus'] = 'pending';
						$uploadFileAttachment = $this->uploadLampiran('fileAttachment', 'berkas');
						if ($uploadFileAttachment['status'] == 'success') {
							$dataComplaint['fileAttachment'] = $uploadFileAttachment['UploadFile'];
						}

						$dataUser = $complaint->getDataTabel('tb_user', ['phoneNumber', $input['phoneNumber']]);
						$dataUser = $complaint->paramsFilter($dataUser, $input);
						$uploadIdentityDocument = $this->uploadImage('identityDocument', 'ktp');
						if ($uploadIdentityDocument['status'] == 'success') {
							$dataUser['identityDocument'] = $uploadIdentityDocument['UploadFile'];
						}
						
						$result = $complaint->save_update('tb_user', $dataUser);
						$result = $complaint->save_update('tb_complaint', $dataComplaint);
						$whatsapp = $complaint->getResponseWhatsapp($dataComplaint['idComplaint']);
						
						$this->errorCode = 200;
						$this->errorMsg = ($result['success']) ? 
											array('status' => 'success', 'message' => array(
												'title' => 'Terima Kasih',
												'text' => 'Laporan Anda telah kami terima dan segera kami tindak lanjuti',
												'data' => $whatsapp['sendMessage'],
											)) : 
											array('status' => 'error', 'message' => array(
												'title' => 'Maaf',
												'text' => $result['message'],
												'data' => $whatsapp['sendMessage'],
											)); 
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
					
					default:
						$this->showResponse($this->errorMsg, $this->errorCode);
						break;
				}
				break;

			case 'dashboard':
				switch ($action) {
					case 'chart':
						// Params: {start date, end date}
						$this->succesMsg['input'] = $input;
						$this->succesMsg['data'] = $complaint->getStatisticalReport($input['startDate'], $input['endDate']);
						$this->showResponse($this->succesMsg);
						break;

					case 'response':
						
						$input['complaintResponse'] = (isset($input['complaintResponse']) && is_array($input['complaintResponse'])) ? \implode(",", $input['complaintResponse']) : '';
						$dataComplaint = $complaint->getDataTabel('tb_complaint', ['idComplaint', $input['idComplaint']]);
						$dataComplaint = $complaint->paramsFilter($dataComplaint, $input);

						// $this->succesMsg['input'] = $input;
						// $this->succesMsg['dataComplaint'] = $dataComplaint;
						// $this->showResponse($this->succesMsg);
						
						$result = $complaint->save_update('tb_complaint', $dataComplaint);
						$this->errorCode = 200;
						$this->errorMsg = ($result['success']) ? 
											array('status' => 'success', 'message' => array(
												'title' => 'Sukses',
												'text' => 'Perubahan telah disimpan',
											)) : 
											array('status' => 'error', 'message' => array(
												'title' => 'Maaf',
												'text' => $result['message'],
											)); 
						$this->showResponse($this->errorMsg, $this->errorCode);
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
