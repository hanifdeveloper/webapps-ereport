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
			'id_cek_tahanan' => $this->createDateID(),
			'id_cek_kebakaran' => $this->createDateID(),
			'id_document_upload' => $this->createDateID(),
			'dateTime' => date('Y-m-d H:i:s'),
		));
	}

	public function createRandomID($size = 10){
        return substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", $size)), 0, $size);
	}

	public function createDateID(){
        return date('YmdHis');
	}
	
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
				'Air Mengalir', 
				'Air Tidak Mengalir',
				'Foto Penggeledahan Badan Tahanan',
				'Foto Pengecekan Jeruji',
        		'Foto Penggeledahan Barang-barang Tahanan',
				'Foto Pengecekan Jendela/Ventilasi',
        		'Foto Pengecekan Tembok/Dinding',
				'Foto Kondisi CCTV',
				'Foto Pengecekan Platfon',
			],
			'cek_kebakaran' => [
				'Foto Pengecekan Instalasi Listrik',
        		'Foto Pengecekan AC',
				'Foto Pengecekan Komputer',
        		'Foto Pengecekan Saklar/Stop Kontak',
				'Alat Pemadam Kebakaran',
			],
		];
	}

	public function getFormSatker($id = ''){
		$form = $this->getDataTabel('tb_satker', ['id_satker', $id]);
		$form['password'] = !empty($form['password']) ? FUNC::decryptor($form['password']) : 'ereport';
		$result['form'] = $form;
		$result['form_title'] = empty($id) ? 'Input Satker' : 'Edit Satker';
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
		$form = $this->getTabel('tb_cek_tahanan');
		$data = $this->getData('SELECT * FROM tb_cek_tahanan WHERE (satker_id = ?) AND (date(datetime) = ?) LIMIT 1', [$satker, date('Y-m-d')]);
		$form = ($data['count'] > 0) ? $this->paramsFilter($form, $data['value'][0]) : $form;
		$result['form_entry'] = $form;
		$result['form_upload'] = $form;
		$result['form_title'] = empty($id) ? 'Input Cek Tahanan' : 'Edit Cek Tahanan';
		$result['pilihan_kondisi'] = $this->getKondisi();
		$result['daftar_upload'] = $this->getListKategoriUpload()['cek_tahanan'];
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
		$size = 10;
		$cursor = ($page - 1) * $size;
		$dataValue = $this->getData($q_value.' LIMIT '.$cursor.','.$size, $keyValue);
		$dataCount = $this->getData($q_count, $keyValue);
		$result['number'] = $cursor + 1;
		$result['page'] = $page;
		$result['size'] = $size;
		$result['total'] = $dataCount['value'][0]['counts'];
		$result['contents'] = $dataValue['value'];
		// $result['query'] = $dataValue['query'];
		return $result;
	}

}
?>