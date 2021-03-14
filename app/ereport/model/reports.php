<?php
namespace app\ereport\model;

use system\Model;
use comp\FUNC;

class reports extends Model{
	
	public function __construct(){
		parent::__construct();
        parent::setConnection('ereport');
        parent::setDefaultValue(array(
			'id_satker' => $this->createRandomID(5),
			'id_cek_tahanan' => $this->createRandomID(10),
			'id_cek_kebakaran' => $this->createRandomID(10),
			'id_document_upload' => $this->createDateID(),
			'jumlah_tahanan' => 0,
			'surat_aktif' => 0,
			'surat_expired' => 0,
			'latitude' => 0,
			'longitude' => 0,
			'datetime' => date('Y-m-d H:i:s'),
		));

		$this->baseUrl = $this->getUrl->baseUrl;
		$this->imageUrl = $this->baseUrl.$this->dir_upload_image;
	}

	public function createRandomID($size = 10){
        return substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", $size)), 0, $size);
	}

	public function createDateID(){
        return date('YmdHis');
	}
	
	// Form Entry Cek Tahanan
	public function getKondisi(){
		return [
			'kamar_mandi' => ['Air Mengalir', 'Air Tidak Mengalir'],
			'dinding_tembok' => ['Baik', 'Retak', 'Indikasi Rusak'],
			'jeruji' => ['Baik', 'Kropos', 'Rusak Parah'],
			'material_platfon' => ['Cor Beton', 'GRC', 'Triplek'],
			'jendela_ventilasi' => ['Baik', 'Kropos', 'Indikasi Rusak'],
			'cctv' => ['Ada (Aktif)', 'Tidak Ada', 'Ada (Tidak Aktif)'],
		];
	}

	public function getKategoriUpload(){
		return [
			'cek_tahanan' => 'Cek Tahanan',
			'cek_kebakaran' => 'Cegah Kebakaran',
		];
	}

	public function getListKategoriUpload(){
		return [
			'cek_tahanan' => [
				'CT01' => 'Foto Penggeledahan Badan Tahanan',
				'CT02' => 'Foto Pengecekan Jeruji',
        		'CT03' => 'Foto Penggeledahan Barang-barang Tahanan',
				'CT04' => 'Foto Pengecekan Jendela/Ventilasi',
        		'CT05' => 'Foto Pengecekan Tembok/Dinding',
				'CT06' => 'Foto Kondisi CCTV',
				'CT07' => 'Foto Pengecekan Plafon',
			],
			'cek_kebakaran' => [
				'CK01' => 'Foto Pengecekan Instalasi Listrik',
        		'CK02' => 'Foto Pengecekan AC',
				'CK03' => 'Foto Pengecekan Komputer',
        		'CK04' => 'Foto Pengecekan Saklar/Stop Kontak',
				'CK05' => 'Alat Pemadam Kebakaran',
			],
		];
	}

	public function getPilihanSatker(){
		$result = [];
		$data = $this->getData('SELECT * FROM tb_satker ORDER BY id_satker');
		foreach ($data['value'] as $key => $value) {
			$result[$value['id_satker']] = ['text' => $value['nama_satker']];
		}

		return $result;
	}

	public function getPilihanGroupSatker(){
		$result = [];
		$data = $this->getData('SELECT * FROM tb_satker WHERE (group_satker = ?) ORDER BY id_satker', ['']);
		foreach ($data['value'] as $key => $value) {
			$result[$value['id_satker']] = ['text' => $value['nama_satker']];
		}

		return $result;
	}

	public function getFormSatker($id = ''){
		$form = $this->getDataTabel('tb_satker', ['id_satker', $id]);
		$form['password'] = !empty($form['password']) ? FUNC::decryptor($form['password']) : 'ereport';
		$result['form'] = $form;
		$result['form_title'] = empty($id) ? 'Input Satker' : 'Edit Satker';
		$result['pilihan_group'] = ['' => ['text' => '-- Group Satker --']] + $this->getPilihanGroupSatker();
		return $result;
	}

	public function getFormCekTahanan($id = ''){
		$form = $this->getDataTabel('tb_cek_tahanan', ['id_cek_tahanan', $id]);
		$result['form'] = $form;
		$result['form_title'] = empty($id) ? 'Input Cek Tahanan' : 'Edit Cek Tahanan';
		return $result;
	}

	public function getFormCekKebakaran($id = ''){
		$form = $this->getDataTabel('tb_cek_kebakaran', ['id_cek_kebakaran', $id]);
		$result['form'] = $form;
		$result['form_title'] = empty($id) ? 'Input Cek Kebakaran' : 'Edit Cek Kebakaran';
		return $result;
	}

	public function getFormCekTahananSatker($satker){
		$dataEntry = $this->getData('SELECT * FROM tb_cek_tahanan WHERE (satker_id = ?) AND (date(datetime) = ?) LIMIT 1', [$satker, date('Y-m-d')]);
		$formEntry = $this->getTabel('tb_cek_tahanan');
		$formEntry = ($dataEntry['count'] > 0) ? $this->paramsFilter($formEntry, $dataEntry['value'][0]) : $formEntry;
		$formEntry['satker_id'] = $satker;
		
		$cek_id = $formEntry['id_cek_tahanan'];
		$formUpload = $this->getTabel('tb_document_upload');
		$listUpload = $this->getListKategoriUpload()['cek_tahanan'];
		$formListUpload = [];
		foreach ($listUpload as $key => $value) {
			$formUpload['id_document_upload']++;
			$dataUpload = $this->getData('SELECT * FROM tb_document_upload WHERE (cek_id = ?) AND (category_document = ?) LIMIT 1', [$cek_id, $key]);
			if ($dataUpload['count'] > 0) {
				$dataUpload = $dataUpload['value'][0];
			}
			else {
				$dataUpload = $formUpload;
				$dataUpload['cek_id'] = $cek_id;
				$dataUpload['category_document'] = $key;
			}

			$dataUpload['category_document_text'] = $value;
			array_push($formListUpload, $dataUpload);
		}

		$result['form_entry'] = $formEntry;
		$result['form_list_upload'] = $formListUpload;
		$result['form_title'] = empty($id) ? 'Input Cek Tahanan' : 'Edit Cek Tahanan';
		$result['pilihan_kondisi'] = $this->getKondisi();
		return $result;
	}

	public function getFormCekKebakaranSatker($satker){
		$dataEntry = $this->getData('SELECT * FROM tb_cek_kebakaran WHERE (satker_id = ?) AND (date(datetime) = ?) LIMIT 1', [$satker, date('Y-m-d')]);
		$formEntry = $this->getTabel('tb_cek_kebakaran');
		$formEntry = ($dataEntry['count'] > 0) ? $this->paramsFilter($formEntry, $dataEntry['value'][0]) : $formEntry;
		$formEntry['satker_id'] = $satker;
		
		$cek_id = $formEntry['id_cek_kebakaran'];
		$formUpload = $this->getTabel('tb_document_upload');
		$listUpload = $this->getListKategoriUpload()['cek_kebakaran'];
		$formListUpload = [];
		foreach ($listUpload as $key => $value) {
			$formUpload['id_document_upload']++;
			$dataUpload = $this->getData('SELECT * FROM tb_document_upload WHERE (cek_id = ?) AND (category_document = ?) LIMIT 1', [$cek_id, $key]);
			if ($dataUpload['count'] > 0) {
				$dataUpload = $dataUpload['value'][0];
			}
			else {
				$dataUpload = $formUpload;
				$dataUpload['cek_id'] = $cek_id;
				$dataUpload['category_document'] = $key;
			}

			$dataUpload['category_document_text'] = $value;
			array_push($formListUpload, $dataUpload);
		}

		$result['form_entry'] = $formEntry;
		$result['form_list_upload'] = $formListUpload;
		$result['form_title'] = empty($id) ? 'Input Cek Kebakaran' : 'Edit Cek Kebakaran';
		return $result;
	}

	public function getListSatker($params){
		$page = $params['page'];
		$cari = '%'.$params['cari'].'%';
		$group = '%'.$params['group'].'%';
		$query = 'FROM tb_satker satker WHERE (nama_satker LIKE ?) AND (group_satker LIKE ?)';
		$q_value = 'SELECT * '.$query.' ORDER BY group_satker, id_satker';
		$q_count = 'SELECT COUNT(*) AS counts '.$query;
		$keyValue = [$cari, $group];
		$size = $params['size'];
		$cursor = ($page - 1) * $size;
		$pilihan_satker = $this->getPilihanSatker();
		
		if ($size == 0) {
			$dataValue = $this->getData($q_value, $keyValue);
		}
		else {
			$dataValue = $this->getData($q_value.' LIMIT '.$cursor.','.$size, $keyValue);
		}

		$contents = [];
		foreach ($dataValue['value'] as $key => $value) {
			$value['nama_group'] = isset($pilihan_satker[$value['group_satker']]) ? $pilihan_satker[$value['group_satker']]['text'] : '';
			unset($value['password']);
			array_push($contents, $value);
		}
		
		$dataCount = $this->getData($q_count, $keyValue);
		$result['number'] = $cursor + 1;
		$result['page'] = $page;
		$result['size'] = ($size > 0) ? $size : $dataCount['value'][0]['counts'];
		$result['total'] = $dataCount['value'][0]['counts'];
		$result['totalpages'] = ceil($result['total'] / $result['size']);
		$result['contents'] = $contents;
		// $result['query'] = $dataValue['query'];
		return $result;
	}

	public function getListLaporanTahanan($params){
		$page = $params['page'];
		$cari = '%'.$params['cari'].'%';
		$tanggal = '%'.$params['tanggal'].'%';
		$group = '%'.$params['group'].'%';
		$query = 'FROM tb_cek_tahanan tahanan
				JOIN tb_satker satker ON (tahanan.satker_id=satker.id_satker)
				WHERE (satker.nama_satker LIKE ?) AND (satker.group_satker LIKE ?)';
		$q_value = 'SELECT tahanan.*, satker.nama_satker, satker.group_satker '.$query.' ORDER BY group_satker, satker_id';
		$q_count = 'SELECT COUNT(*) AS counts '.$query;
		$keyValue = [$cari, $group];
		$size = $params['size'];
		$cursor = ($page - 1) * $size;
		$pilihan_satker = $this->getPilihanSatker();
		
		if ($size == 0) {
			$dataValue = $this->getData($q_value, $keyValue);
		}
		else {
			$dataValue = $this->getData($q_value.' LIMIT '.$cursor.','.$size, $keyValue);
		}

		$contents = [];
		foreach ($dataValue['value'] as $key => $value) {
			$value['id_laporan'] = $value['id_cek_tahanan'];
			$value['nama_group'] = isset($pilihan_satker[$value['group_satker']]) ? $pilihan_satker[$value['group_satker']]['text'] : '';
			$value['tanggal_laporan'] = FUNC::tanggal($value['datetime'], 'long_date_time');
			unset($value['password']);
			array_push($contents, $value);
		}
		
		$dataCount = $this->getData($q_count, $keyValue);
		$result['number'] = $cursor + 1;
		$result['page'] = $page;
		$result['size'] = ($size > 0) ? $size : $dataCount['value'][0]['counts'];
		$result['total'] = $dataCount['value'][0]['counts'];
		$result['totalpages'] = ceil($result['total'] / $result['size']);
		$result['contents'] = $contents;
		// $result['query'] = $dataValue['query'];
		return $result;
	}

	public function getListLaporanKebakaran($params){
		$page = $params['page'];
		$cari = '%'.$params['cari'].'%';
		$tanggal = '%'.$params['tanggal'].'%';
		$group = '%'.$params['group'].'%';
		$query = 'FROM tb_cek_kebakaran kebakaran
				JOIN tb_satker satker ON (kebakaran.satker_id=satker.id_satker)
				WHERE (satker.nama_satker LIKE ?) AND (satker.group_satker LIKE ?)';
		$q_value = 'SELECT kebakaran.*, satker.nama_satker, satker.group_satker '.$query.' ORDER BY group_satker, satker_id';
		$q_count = 'SELECT COUNT(*) AS counts '.$query;
		$keyValue = [$cari, $group];
		$size = $params['size'];
		$cursor = ($page - 1) * $size;
		$pilihan_satker = $this->getPilihanSatker();
		
		if ($size == 0) {
			$dataValue = $this->getData($q_value, $keyValue);
		}
		else {
			$dataValue = $this->getData($q_value.' LIMIT '.$cursor.','.$size, $keyValue);
		}

		$contents = [];
		foreach ($dataValue['value'] as $key => $value) {
			$value['id_laporan'] = $value['id_cek_kebakaran'];
			$value['nama_group'] = isset($pilihan_satker[$value['group_satker']]) ? $pilihan_satker[$value['group_satker']]['text'] : '';
			$value['tanggal_laporan'] = FUNC::tanggal($value['datetime'], 'long_date_time');
			unset($value['password']);
			array_push($contents, $value);
		}
		
		$dataCount = $this->getData($q_count, $keyValue);
		$result['number'] = $cursor + 1;
		$result['page'] = $page;
		$result['size'] = ($size > 0) ? $size : $dataCount['value'][0]['counts'];
		$result['total'] = $dataCount['value'][0]['counts'];
		$result['totalpages'] = ceil($result['total'] / $result['size']);
		$result['contents'] = $contents;
		// $result['query'] = $dataValue['query'];
		return $result;
	}

	public function getDetailCekTahananSatker($id){
		$dataEntry = $this->getData('SELECT tahanan.*, satker.nama_satker, satker.group_satker
									FROM tb_cek_tahanan tahanan
									JOIN tb_satker satker
									WHERE (id_cek_tahanan = ?) LIMIT 1', [$id]);

		if ($dataEntry['count'] == 0) {
			return [];
		}

		$result['data_entry'] = $dataEntry['value'][0];
		$result['data_entry']['lastupdate'] = FUNC::tanggal($result['data_entry']['datetime'], 'long_date_time');
		
		$cek_id = $result['data_entry']['id_cek_tahanan'];
		$formUpload = $this->getTabel('tb_document_upload');
		$listUpload = $this->getListKategoriUpload()['cek_tahanan'];
		$formListUpload = [];
		foreach ($listUpload as $key => $value) {
			$formUpload['id_document_upload']++;
			$dataUpload = $this->getData('SELECT * FROM tb_document_upload WHERE (cek_id = ?) AND (category_document = ?) LIMIT 1', [$cek_id, $key]);
			if ($dataUpload['count'] > 0) {
				$dataUpload = $dataUpload['value'][0];
			}
			else {
				$dataUpload = $formUpload;
				$dataUpload['cek_id'] = $cek_id;
				$dataUpload['category_document'] = $key;
			}

			$dataUpload['category_document_text'] = $value;
			$dataUpload['lastupdate'] = FUNC::moments($dataUpload['datetime']);
			$dataUpload['file_upload'] = !empty($dataUpload['file_upload']) ? explode(',', $dataUpload['file_upload']) : []; // Buat jadi array
			if (empty($dataUpload['file_upload'])) {
				$dataUpload['text_caption'] = 'Laporan belum diunggah !';
				$dataUpload['lastupdate'] = '';
			}

			foreach ($dataUpload['file_upload'] as $key => $value) {
				$dataUpload['file_upload'][$key] = $this->imageUrl.$value;
			}

			array_push($formListUpload, $dataUpload);
		}

		$result['data_list_upload'] = $formListUpload;
		return $result;
	}

	public function getDetailCekKebakaranSatker($id){
		$dataEntry = $this->getData('SELECT kebakaran.*, satker.nama_satker, satker.group_satker
									FROM tb_cek_kebakaran kebakaran
									JOIN tb_satker satker
									WHERE (id_cek_kebakaran = ?) LIMIT 1', [$id]);

		if ($dataEntry['count'] == 0) {
			return [];
		}

		$result['data_entry'] = $dataEntry['value'][0];
		$result['data_entry']['lastupdate'] = FUNC::tanggal($result['data_entry']['datetime'], 'long_date_time');
		
		$cek_id = $result['data_entry']['id_cek_kebakaran'];
		$formUpload = $this->getTabel('tb_document_upload');
		$listUpload = $this->getListKategoriUpload()['cek_kebakaran'];
		$formListUpload = [];
		foreach ($listUpload as $key => $value) {
			$formUpload['id_document_upload']++;
			$dataUpload = $this->getData('SELECT * FROM tb_document_upload WHERE (cek_id = ?) AND (category_document = ?) LIMIT 1', [$cek_id, $key]);
			if ($dataUpload['count'] > 0) {
				$dataUpload = $dataUpload['value'][0];
			}
			else {
				$dataUpload = $formUpload;
				$dataUpload['cek_id'] = $cek_id;
				$dataUpload['category_document'] = $key;
			}

			$dataUpload['category_document_text'] = $value;
			$dataUpload['lastupdate'] = FUNC::moments($dataUpload['datetime']);
			$dataUpload['file_upload'] = !empty($dataUpload['file_upload']) ? explode(',', $dataUpload['file_upload']) : []; // Buat jadi array
			if (empty($dataUpload['file_upload'])) {
				$dataUpload['text_caption'] = 'Laporan belum diunggah !';
				$dataUpload['lastupdate'] = '';
			}

			foreach ($dataUpload['file_upload'] as $key => $value) {
				$dataUpload['file_upload'][$key] = $this->imageUrl.$value;
			}

			array_push($formListUpload, $dataUpload);
		}

		$result['data_list_upload'] = $formListUpload;
		return $result;
	}

	public function satkerLogin($params){
		$satker = $params['satker'];
		$password = FUNC::encryptor($params['password']);
		$data = $this->getData('SELECT * FROM tb_satker WHERE (id_satker = ?) AND (password = ?) LIMIT 1', [$satker, $password]);
		return ($data['count'] > 0) ? $data['value'][0] : [];
	}

}
?>