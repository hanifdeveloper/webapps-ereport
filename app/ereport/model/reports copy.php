<?php
namespace app\ereport\model;

use system\Model;
use comp;

class reports extends Model{

	protected $chartColor = ['#3160D8', '#F78B00', '#D32929', '#FBC500', '#365A74', '#D2DFEA', '#91C714', '#E6F3FF', '#8DA9BE', '#607F96', '#FFEFD9', '#D8F8BC', '#E6F3FF', '#2449AF', '#284EB2', '#395EC1', '#D6E1FF', '#2e51bb', '#C6D4FD', '#E8EEFF', '#98AFF5', '#1A389F', '#142C91', '#8da3e6', '#ffd8d8', '#3b5998', '#4ab3f4', '#517fa4', '#0077b5', '#d18d96', '#c7d2ff', '#15329A', '#203FAD', '#BBC8FD', '#7F9EB9', '#1C3FAA', '#F1F5F8', '#2e51bb', '#3151BC', '#dee7ef'];
	
	public function __construct(){
		parent::__construct();
        parent::setConnection('complaint');
        parent::setDefaultValue(array(
			'idComplaint' => $this->createID(6),
			'genderType' => 'pria',
			'complaintDate' => date('Y-m-d'),
			'dateTime' => date('Y-m-d H:i:s'),

			// 'fullName' => 'Hanif Muhammad',
			// 'genderType' => 'pria',
			// 'emailAddress' => 'hanif.muhammad202@gmail.com',
			// 'phoneNumber' => '08640878',
			// 'complaintCategory' => $this->generatedValue('complaintCategory'),
			// 'complaintLocation' => $this->generatedValue('complaintLocation'),
			// 'complaintStatus' => $this->generatedValue('complaintStatus'),
			// 'complaintDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam efficitur ipsum in placerat molestie.  Fusce quis mauris a enim sollicitudin',
		));
	}
	
	public function createID($size = 10){
        return substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", $size)), 0, $size);
	}

	public function generatedValue($id){
		$complaintCategory = [];
		$complaintLocation = [];
		$complaintStatus = [];
		foreach ($this->getComplaintCategoryChoice() as $key => $value) { \array_push($complaintCategory, $key); }
		foreach ($this->getComplaintLocationChoice() as $key => $value) { \array_push($complaintLocation, $key); }
		foreach ($this->getComplaintStatusChoice() as $key => $value) { \array_push($complaintStatus, $key); }
		$result = [
			'complaintCategory' => $complaintCategory[\rand(0, 7)],
			'complaintLocation' => $complaintLocation[\rand(0, 12)],
			'complaintStatus' => $complaintStatus[\rand(0, 1)],
		];

		return $result[$id];
	}

	public function getKondisiKamarMandi(){
		return [
			'Air Mengalir',
			'Air Tidak Mengalir',
		];
	}

	public function getKondisiTembokJeruji(){
		return [
			'Baik',
			'Buruk',
			'Rusak',
		];
	}

	public function getKondisiPlatfon(){
		return [
			'Baik',
			'Buruk',
			'Rusak',
		];
	}

	public function getKondisiJendela(){
		return [
			'Baik',
			'Buruk',
			'Rusak',
		];
	}

	public function getKondisiCctv(){
		return [
			'Ada (Aktif)',
			'Ada (Tidak Aktif)',
			'Tidak Ada',
		];
	}

	public function getDocumentUpload($category){
		// $result = [
		// 	'pending' => [['text' => 'Tidak ada pilihan jawaban']],
		// 	'process' => [['text' => 'Tidak ada pilihan jawaban']],
		// 	'isDeviation' => [],
		// 	'noDeviation' => [],
		// ];
		$data = $this->getData('SELECT * FROM tb_response ORDER BY idResponse', []);
		foreach ($data['value'] as $key => $value) {
			$result[$value['complaintStatus']][$value['idResponse']] = ['text' => $value['responseName']];
		}

		return $result;
	}

	// public function getGenderChoice(){
	// 	return [
	// 		'pria' => ['text' => 'Pria'],
	// 		'wanita' => ['text' => 'Wanita'],
	// 	];
	// }

	// public function getComplaintCategoryChoice(){
	// 	// return [
	// 	// 	'C1' => ['text' => 'Pelayanan Yang Buruk'],
	// 	// 	'C2' => ['text' => 'Peyalahgunaan Wewenang'],
	// 	// 	'C3' => ['text' => 'Kekeliruan Diskresi'],
	// 	// 	'C4' => ['text' => 'Tindakan Diskriminasi'],
	// 	// 	'C5' => ['text' => 'Korupsi / Gratifikasi'],
	// 	// 	'C6' => ['text' => 'Pelanggaran HAM'],
	// 	// 	'C7' => ['text' => 'Netralitas Polri'],
	// 	// 	'C8' => ['text' => 'Transparansi Penyidikan'],
	// 	// ];

	// 	return [
	// 		'C1' => ['text' => 'Pelayanan Yang Buruk'],
	// 		'C2' => ['text' => 'Peyalahgunaan Wewenang'],
	// 		'C3' => ['text' => 'Kekerasan Polisi'],
	// 		'C4' => ['text' => 'Tindakan Diskriminasi'],
	// 		'C5' => ['text' => 'Korupsi'],
	// 		'C6' => ['text' => 'Pelanggaran HAM'],
	// 		'C7' => ['text' => 'Perilaku Buruk Polisi'],
	// 		'C8' => ['text' => 'Transparansi Penyidikan'],
	// 	];
	// }

	// public function getComplaintLocationChoice(){
	// 	return [
	// 		'L01' => ['text' => 'Singkawang'],
	// 		'L02' => ['text' => 'Pontianak'],
	// 		'L03' => ['text' => 'Bengkayang'],
	// 		'L04' => ['text' => 'Kapuas Hulu'],
	// 		'L05' => ['text' => 'Kayong Utara'],
	// 		'L06' => ['text' => 'Ketapang'],
	// 		'L07' => ['text' => 'Kubu Raya'],
	// 		'L08' => ['text' => 'Landak'],
	// 		'L09' => ['text' => 'Melawi'],
	// 		'L10' => ['text' => 'Mempawah'],
	// 		'L11' => ['text' => 'Sambas'],
	// 		'L12' => ['text' => 'Sanggau'],
	// 		'L13' => ['text' => 'Sintang'],
	// 	];
	// }

	// public function getComplaintStatusChoice(){
	// 	return [
	// 		'pending' => ['text' => 'Menunggu Proses', 'color' => $this->chartColor	[0]],
	// 		'process' => ['text' => 'Proses Kajian', 'color' => $this->chartColor[1]],
	// 		'isDeviation' => ['text' => 'Ada/terjadi penyimpangan', 'color' => $this->chartColor[2]],
	// 		'noDeviation' => ['text' => 'Tidak ada penyimpangan', 'color' => $this->chartColor[3]],
	// 	];
	// }

	// public function getFilterChartReport() {
	// 	return [
	// 		'complaintCategory' => ['text' => 'Kategori Komplain/Aduan'],
	// 		'complaintLocation' => ['text' => 'Lokasi Komplain/Aduan'],
	// 		'complaintStatus' => ['text' => 'Status Laporan'],
	// 	];
	// }

	// public function getComplaintResponseChoice(){
	// 	$result = [
	// 		'pending' => [['text' => 'Tidak ada pilihan jawaban']],
	// 		'process' => [['text' => 'Tidak ada pilihan jawaban']],
	// 		'isDeviation' => [],
	// 		'noDeviation' => [],
	// 	];
	// 	$data = $this->getData('SELECT * FROM tb_response ORDER BY idResponse', []);
	// 	foreach ($data['value'] as $key => $value) {
	// 		$result[$value['complaintStatus']][$value['idResponse']] = ['text' => $value['responseName']];
	// 	}

	// 	return $result;
	// }
	
	// public function getGeneralReport(){
	// 	// Default Value
	// 	$complaintStatus = $this->getComplaintStatusChoice();
	// 	foreach ($complaintStatus as $key => $value) {
	// 		$complaintStatus[$key]['count'] = 0;
	// 	}

	// 	// Check Database Value
	// 	$data = $this->getData('SELECT complaint.`complaintStatus`, COUNT(*) AS counts FROM `tb_complaint` complaint GROUP BY complaint.`complaintStatus`;', []);
	// 	foreach ($data['value'] as $key => $value) {
	// 		if (isset($complaintStatus[$value['complaintStatus']])) {
	// 			// $complaintStatus[$value['complaintStatus']]['count'] = comp\FUNC::rupiah(\intval($value['counts']) * 1000);
	// 			$complaintStatus[$value['complaintStatus']]['count'] = comp\FUNC::rupiah(\intval($value['counts']));
	// 		}
	// 	}
		
	// 	// return $data;
	// 	return $complaintStatus;
	// }
	
	// public function getStatisticalReport($startDate = '', $endDate = ''){
	// 	$startDate = empty($startDate) ? date('Y-m-d') : $startDate;
	// 	$endDate = empty($endDate) ? date('Y-m-d') : $endDate;
	// 	$filterDate = ($startDate != date('Y-m-d') && $endDate != date('Y-m-d')) ? ' WHERE complaintDate BETWEEN "'.$startDate.'" AND "'.$endDate.'" ' : ' '; 

	// 	/** COMPLAINT CATEGORY */
	// 	$complaintCategory = $this->getComplaintCategoryChoice();
	// 	$colorIndex = 0;
	// 	foreach ($complaintCategory as $key => $value) {
	// 		$complaintCategory[$key]['count'] = 0; //\rand(1, 100);
	// 		$complaintCategory[$key]['color'] = $this->chartColor[$colorIndex];
	// 		$colorIndex++;
	// 	}
	// 	// Check Database Value
	// 	$dataComplaintCategory = $this->getData('SELECT
	// 							complaint.`complaintCategory`,
	// 							COUNT(*) AS counts
	// 							FROM `tb_complaint` complaint'.
	// 							$filterDate.'GROUP BY complaint.`complaintCategory`;', []);

	// 	foreach ($dataComplaintCategory['value'] as $key => $value) {
	// 		if (isset($complaintCategory[$value['complaintCategory']])) {
	// 			$count = \intval($value['counts']);
	// 			$complaintCategory[$value['complaintCategory']]['count'] = comp\FUNC::rupiah($count);
	// 		}
	// 	}

	// 	/** COMPLAINT LOCATION */
	// 	$complaintLocation = $this->getComplaintLocationChoice();
	// 	$colorIndex = 0;
	// 	foreach ($complaintLocation as $key => $value) {
	// 		$complaintLocation[$key]['count'] = 0; //\rand(1, 100);
	// 		$complaintLocation[$key]['color'] = $this->chartColor[$colorIndex];
	// 		$colorIndex++;
	// 	}
	// 	// Check Database Value
	// 	$dataComplaintLocation = $this->getData('SELECT
	// 							complaint.`complaintLocation`,
	// 							COUNT(*) AS counts
	// 							FROM `tb_complaint` complaint'.
	// 							$filterDate.'GROUP BY complaint.`complaintLocation`;', []);

	// 	foreach ($dataComplaintLocation['value'] as $key => $value) {
	// 		if (isset($complaintLocation[$value['complaintLocation']])) {
	// 			$count = \intval($value['counts']);
	// 			$complaintLocation[$value['complaintLocation']]['count'] = comp\FUNC::rupiah($count);
	// 		}
	// 	}

	// 	/** COMPLAINT STATUS */
	// 	$complaintStatus = $this->getComplaintStatusChoice();
	// 	$colorIndex = 0;
	// 	foreach ($complaintStatus as $key => $value) {
	// 		$complaintStatus[$key]['count'] = 0; //\rand(1, 100);
	// 		$complaintStatus[$key]['color'] = $this->chartColor[$colorIndex];
	// 		$colorIndex++;
	// 	}
	// 	// Check Database Value
	// 	$dataComplaintStatus = $this->getData('SELECT
	// 							complaint.`complaintStatus`,
	// 							COUNT(*) AS counts
	// 							FROM `tb_complaint` complaint'.
	// 							$filterDate.'GROUP BY complaint.`complaintStatus`;', []);

	// 	foreach ($dataComplaintStatus['value'] as $key => $value) {
	// 		if (isset($complaintStatus[$value['complaintStatus']])) {
	// 			$count = \intval($value['counts']);
	// 			$complaintStatus[$value['complaintStatus']]['count'] = comp\FUNC::rupiah($count);
	// 		}
	// 	}


	// 	/** COMPLAINT RESPONSE */
	// 	$complaintResponse = $this->getComplaintResponseChoice();
	// 	foreach ($complaintResponse as $r => $response) {
	// 		$colorIndex = 0;
	// 		foreach ($response as $key => $value) {
	// 			$complaintResponse[$r][$key]['count'] = 0;
	// 			$complaintResponse[$r][$key]['percent'] = 0;
	// 			$complaintResponse[$r][$key]['color'] = $this->chartColor[$colorIndex];
	// 			$colorIndex++;
	// 		}
	// 	}
	// 	// Get Total Value Complaint Status (Detail Response)
	// 	$totalComplaintStatus = [
	// 		'isDeviation' => 0,
	// 		'noDeviation' => 0,
	// 	];
	// 	$dataComplaintResponse = $this->getData('SELECT response.`complaintStatus`,
	// 							COUNT(*) AS totals
	// 							FROM `tb_response` response
	// 							JOIN `tb_complaint` complaint ON (FIND_IN_SET(response.`idResponse`, complaint.`complaintResponse`))'.
	// 							$filterDate.'GROUP BY complaint.`complaintStatus`;', []);

	// 	foreach ($dataComplaintResponse['value'] as $key => $value) {
	// 		if (isset($totalComplaintStatus[$value['complaintStatus']])) {
	// 			$totalComplaintStatus[$value['complaintStatus']] = \intval($value['totals']);
	// 		}
	// 	}
	// 	// Check Database Value
	// 	$data = $this->getData('SELECT response.*, 
	// 							COUNT(*) AS counts 
	// 							FROM `tb_response` response 
	// 							JOIN `tb_complaint` complaint ON (FIND_IN_SET(response.`idResponse`, complaint.`complaintResponse`))'.
	// 							$filterDate.'GROUP BY response.`idResponse`;', []);

	// 	foreach ($data['value'] as $key => $value) {
	// 		if (isset($complaintResponse[$value['complaintStatus']][$value['idResponse']])) {
	// 			$count = \intval($value['counts']);
	// 			$percent = ($count/$totalComplaintStatus[$value['complaintStatus']]) * 100;
	// 			$complaintResponse[$value['complaintStatus']][$value['idResponse']]['count'] = comp\FUNC::rupiah($count);
	// 			$complaintResponse[$value['complaintStatus']][$value['idResponse']]['percent'] = comp\FUNC::rupiah($percent);
	// 		}
	// 	}

	// 	return [
	// 		// 'complaintCategory' => $filterDate,
	// 		// 'complaintCategory' => $dataComplaintCategory,
	// 		'complaintCategory' => $complaintCategory,
	// 		'complaintLocation' => $complaintLocation,
	// 		'complaintStatus' => $complaintStatus,
 	// 		'complaintResponse' => $complaintResponse,
	// 	];
	// }

	// public function getWhatsappMessage($id = '1'){
	// 	$data = $this->getData('SELECT * FROM tb_whatsapp WHERE (id = ?)', [$id]);
	// 	$result = ($data['count'] > 0) ? $data['value'][0] : [];
    //     return $result;
    // }
	
	// public function getFormUser($id = ''){
	// 	$result['form'] = $this->getDataTabel('tb_user', array('phoneNumber', $id));
	// 	$identityDocument = (!empty($result['form']['identityDocument']) && file_exists($this->dir_upload_image.$result['form']['identityDocument'])) ? $this->getUrl->baseUrl.$this->dir_upload_image.$result['form']['identityDocument'] : $this->no_user_image;
	// 	$identityDocument = $this->getUrl->baseUrl.$identityDocument;
	// 	$result['form']['identityDocument'] = $identityDocument;
	// 	$result['form_title'] = empty($id) ? 'Add User ' : 'Edit User';
	// 	$result['genderChoice'] = $this->getGenderChoice();
	// 	$result['mimes_type'] = $this->files->getMimeTypes($this->file_type_image);
	// 	$result['upload_description'] = '*) File Type : '.$this->file_type_image.', Max Size : '.($this->max_size / 1024 /1024).'Mb';
    //     return $result;
	// }
	
	// public function getFormComplaint($id = ''){
	// 	$result['form'] = $this->getDataTabel('tb_complaint', array('idComplaint', $id));
	// 	$fileAttachment = (!empty($result['form']['fileAttachment']) && file_exists($this->dir_upload_attachment.$result['form']['fileAttachment'])) ? $this->getUrl->baseUrl.$this->dir_upload_attachment.$result['form']['fileAttachment'] : $this->no_user_image;
	// 	$fileAttachment = $this->getUrl->baseUrl.$fileAttachment;
	// 	$result['form']['fileAttachment'] = $fileAttachment;
	// 	$result['form_title'] = empty($id) ? 'Add Complaint ' : 'Edit Complaint';
	// 	$result['complaintCategoryChoice'] = $this->getComplaintCategoryChoice();
	// 	$result['complaintLocationChoice'] = $this->getComplaintLocationChoice();
	// 	$result['complaintStatusChoice'] = $this->getComplaintStatusChoice();
	// 	$result['mimes_type'] = $this->files->getMimeTypes($this->file_type_attachment);
	// 	$result['upload_description'] = '*) File Type : '.$this->file_type_attachment.', Max Size : '.($this->max_size / 1024 /1024).'Mb';
    //     return $result;
	// }
	
	// public function getResponseWhatsapp($idComplaint = ''){
	// 	$formComplaint = $this->getFormComplaint($idComplaint);
	// 	$formUser = $this->getFormUser($formComplaint['form']['phoneNumber']);
	// 	$complaintCategoryChoice = $formComplaint['complaintCategoryChoice'];
	// 	$complaintLocationChoice = $formComplaint['complaintLocationChoice'];
	// 	$complaintStatusChoice = $formComplaint['complaintStatusChoice'];
	// 	$genderChoice = $formUser['genderChoice'];
	// 	$formMessage = $formComplaint['form'] + $formUser['form'] ;
	// 	$formMessage['genderType'] = $genderChoice[$formMessage['genderType']]['text'];
	// 	$formMessage['complaintCategory'] = $complaintCategoryChoice[$formMessage['complaintCategory']]['text'];
	// 	$formMessage['complaintLocation'] = $complaintLocationChoice[$formMessage['complaintLocation']]['text'];
	// 	$formMessage['complaintStatus'] = $complaintStatusChoice[$formMessage['complaintStatus']]['text'];
	// 	$formMessage['complaintDate'] = date('d M Y', \strtotime($formMessage['complaintDate']));
		
	// 	$sendWhatsapp = 'whatsapp://send/?phone={phone}&text={text}';
	// 	$whatsapp = $this->getWhatsappMessage();
	// 	$whatsappMessage = $whatsapp['message'];
	// 	foreach ($formMessage as $key => $value) { $whatsappMessage = \str_replace('{'.$key.'}', $value, $whatsappMessage); }
		
	// 	$sendMessage = \str_replace(['{phone}', '{text}'], [$whatsapp['phone'], rawurlencode($whatsappMessage)], $sendWhatsapp);
	// 	$result = [
	// 		'whatsappMessage' => $whatsappMessage,
	// 		'sendMessage' => $sendMessage,
	// 	];
    //     return $result;
	// }
	
	// public function getUserLogin($phoneNumber) {
	// 	$data = $this->getData('SELECT * FROM tb_user WHERE (phoneNumber = ?) LIMIT 1', [$phoneNumber]);
	// 	return ($data['count'] > 0) ? $data['value'][0] : [];
	// }

	// // public function getListComplaint($phoneNumber){
	// // 	$result = [];
	// // 	$complaintCategoryChoice = $this->getComplaintCategoryChoice();
	// // 	$complaintLocationChoice = $this->getComplaintLocationChoice();
	// // 	$complaintLocationStatus = $this->getComplaintStatusChoice();
	// // 	for ($i=0; $i < 5; $i++) { 
	// // 		$dataComplaint = $this->getDataTabel('tb_complaint', array('idComplaint', $phoneNumber));
	// // 		$fileAttachment = (!empty($result['form']['fileAttachment']) && file_exists($this->dir_upload_attachment.$result['form']['fileAttachment'])) ? $this->getUrl->baseUrl.$this->dir_upload_attachment.$result['form']['fileAttachment'] : $this->no_user_image;
	// // 		$fileAttachment = $this->getUrl->baseUrl.$fileAttachment;
	// // 		$dataComplaint['fileAttachment'] = $fileAttachment;
	// // 		$dataComplaint['complaintDate'] = date('d M Y', \strtotime($dataComplaint['complaintDate']));
	// // 		$dataComplaint['complaintCategory'] = $complaintCategoryChoice[$dataComplaint['complaintCategory']]['text'];
	// // 		$dataComplaint['complaintLocation'] = $complaintLocationChoice[$dataComplaint['complaintLocation']]['text'];
	// // 		$dataComplaint['complaintStatus'] = $complaintLocationStatus[$dataComplaint['complaintStatus']]['text'];
	// // 		\array_push($result, $dataComplaint);
	// // 	}
	
	// // 	return $result;
	// // }
	
	// public function getListComplaint($input){
	// 	$page = $input['page'];
	// 	$search = '%'.$input['search'].'%';
	// 	$status = '%'.$input['status'].'%';
	// 	$status = '^'.$input['status'];
	// 	$query = 'FROM `tb_user` users
	// 			JOIN `tb_complaint` complaint ON (complaint.`phoneNumber`=users.`phoneNumber`)
	// 			LEFT JOIN `tb_response` response ON (FIND_IN_SET(response.`idResponse`, complaint.`complaintResponse`))
	// 			WHERE ((users.`phoneNumber` LIKE ?) OR (users.`fullName` LIKE ?))
	// 			AND (complaint.`complaintStatus` REGEXP ?) GROUP BY complaint.`idComplaint`';

	// 	$q_value = 'SELECT users.*, complaint.*, IFNULL(GROUP_CONCAT(response.`responseName`), "") AS responseDetail '.$query.' ORDER BY complaint.`dateTime` DESC';
	// 	$q_count = 'SELECT COUNT(*) AS counts '.$query;
	// 	$idKey = [$search, $search, $status];
	// 	$limit = 10;
    //     $cursor = ($page - 1) * $limit;
	// 	// $dataValue = $this->getData($q_value.' LIMIT '.$cursor.','.$limit, $idKey);
	// 	$dataValue = $this->getData($q_value, $idKey);
	// 	$dataCount = $this->getData($q_count, $idKey);
	// 	$genderChoice = $this->getGenderChoice();
	// 	$complaintCategoryChoice = $this->getComplaintCategoryChoice();
	// 	$complaintLocationChoice = $this->getComplaintLocationChoice();
	// 	$complaintStatusChoice = $this->getComplaintStatusChoice();
	// 	foreach ($dataValue['value'] as $key => $value) {
	// 		$fileAttachment = (!empty($value['fileAttachment']) && file_exists($this->dir_upload_attachment.$value['fileAttachment'])) ? $this->getUrl->baseUrl.$this->dir_upload_attachment.$value['fileAttachment'] : $this->no_user_image;
	// 		$fileAttachment = $this->getUrl->baseUrl.$fileAttachment;
	// 		$dataValue['value'][$key]['fileAttachment'] = $fileAttachment;
	// 		$dataValue['value'][$key]['phoneNumber'] = \substr($value['phoneNumber'], 0, 5).'xxx';
	// 		$dataValue['value'][$key]['complaintDate'] = date('d M Y', \strtotime($value['complaintDate']));
	// 		$dataValue['value'][$key]['genderType'] = $genderChoice[$value['genderType']]['text'];
	// 		$dataValue['value'][$key]['complaintCategory'] = $complaintCategoryChoice[$value['complaintCategory']]['text'];
	// 		$dataValue['value'][$key]['complaintLocation'] = $complaintLocationChoice[$value['complaintLocation']]['text'];
	// 		$dataValue['value'][$key]['complaintStatusText'] = $complaintStatusChoice[$value['complaintStatus']]['text'];
	// 		$dataValue['value'][$key]['complaintStatusColor'] = $complaintStatusChoice[$value['complaintStatus']]['color'];
	// 		$dataValue['value'][$key]['responseName'] = !empty($value['responseDetail']) ? explode(',', $value['responseDetail']) : [];
	// 		$dataValue['value'][$key]['whatsapp'] = $this->getResponseWhatsapp($value['idComplaint']);
	// 	}
    //     $result['no'] = $cursor + 1;
    //     $result['page'] = $page;
    //     // $result['limit'] = $limit;
    //     $result['limit'] = ($dataCount['count'] > 0) ? $dataCount['value'][0]['counts'] : 0;
    //     $result['count'] = ($dataCount['count'] > 0) ? $dataCount['value'][0]['counts'] : 0;
	// 	$result['table'] = $dataValue['value'];
	// 	$result['label'] = 'laporan';
	// 	$result['query'] = $dataCount['query'];
	// 	$result['query'] = '';
	// 	return $result;
    // }	

}
?>