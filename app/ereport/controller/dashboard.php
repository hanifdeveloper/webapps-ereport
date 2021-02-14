<?php

namespace app\ereport\controller;

use app\defaults\controller\application;
use comp;

class dashboard extends application{
	
	public function __construct(){
		parent::__construct();
		// $this->complaint = new \app\ereport\model\complaint();
		// $this->default_username = 'admin';
		// // $this->default_password = 'admin@ereport7';
		// $this->default_password = 'rahasiaD0ng!';

		$this->data = [
			'api_path' => $this->link('api/v1'),
			'url_path' => $this->link($this->getProject().$this->getController()),
			// 'filter_chart' => $this->complaint->getFilterChartReport(),
			// 'general_report' => $this->complaint->getGeneralReport(),
			// 'statistical_report' => $this->complaint->getStatisticalReport(),
			// // 'statistical_report' => $this->complaint->getStatisticalReport('2020-12-12', '2020-12-12'),
			// 'complaintStatusChoice' => $this->complaint->getComplaintStatusChoice(),
			// 'complaintResponseChoice' => $this->complaint->getComplaintResponseChoice(),
		];

		// $adminSession = $this->getAdminSession();
		// // echo 'method: '.$this->getMethod();die;
		// if (!in_array($this->getMethod(), ['login'])) {
		// 	if(empty($adminSession)){
		// 		$this->data['username'] = '';
		// 		$this->data['password'] = '';
		// 		// $this->data['username'] = $this->default_username;
		// 		// $this->data['password'] = $this->default_password;
		// 		$this->showView('login', $this->data, 'midone');
		// 		die;
		// 	}	
		// }
	}

	public function index(){
		// $this->data['title'] = 'E-Complaint On 7';
		// $this->showView('index', $this->data, 'midone');

		// echo '<style>pre{background-color: yellow;}</style>';
		$this->debugResponse($this->data);
	}

	// public function report($status = ''){
	// 	$this->data['title'] = 'Detail Laporan';
	// 	$this->data['listComplaint'] = $this->complaint->getListComplaint(['page' => 1, 'search' => '', 'status' => $status]);
	// 	$this->showView('report', $this->data, 'midone');

	// 	echo '<style>pre{background-color: yellow;}</style>';
	// 	// $this->debugResponse($this->data);
	// }

	// public function header($data){
	// 	$this->data += $data;
    //     $this->subView('header', $this->data);
	// }
	
	// protected function modal($id){
	// 	$this->subView('modal-'.$id, $this->data);
	// }

	// protected function script(){
	// 	header('Content-Type: application/javascript');
	// 	$this->subView('script', $this->data);
	// }

	// protected function getAdminSession(){
    //     $adminSession = $this->getSession('SESSION_LOGIN');
    //     return !empty($adminSession) ? $adminSession : [];
	// }
	
	// protected function login(){
	// 	$input = $this->post(false);
	// 	if($input){
	// 		session_regenerate_id();
	// 		if ($input['username'] == $this->default_username && $input['password'] == $this->default_password) {
	// 			$session_id = comp\FUNC::encryptor(session_id());
	// 			$this->setSession('SESSION_LOGIN', $session_id);
	// 			$this->delSession('SESSION_MESSAGE');
	// 		}else{
	// 			$this->setSession('SESSION_MESSAGE', 'Login gagal, silahkan ulangi lagi');
	// 		}
	// 	}

	// 	$this->redirect($this->link($this->getProject().'dashboard'));
	// }

	// protected function logout(){
	// 	$this->desSession();
	// 	$this->redirect($this->link($this->getProject().'dashboard'));
	// }

}
?>
