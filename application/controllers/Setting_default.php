<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_default extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}
		$this->load->library('excel');
		$this->load->model('Logs_m');
		$this->load->model('Setting_m');
	}

	public function index(){
		$data['title'] = 'Pengaturan Awal';
		$data['content'] = "admin/setting/page-setting";
		$this->load->view('admin/layout/layout',$data);
	}

	public function get_data(){
		echo json_encode($this->Setting_m->data_setting());
	}
	
	public function get_data_detail($id_karyawan){
		echo json_encode($this->Setting_m->data_setting_detail($id_karyawan));
	}

	function simpan_setting($act, $id = ''){
		if ($act == 'Tambah') {
				echo json_encode([
					'res' => false, 
					'msg' =>  'Error'
				]);
		}else if ($act == 'Edit'){
			echo json_encode([
				'res' => $this->Setting_m->edit_setting(), 
				'msg' =>  'Data telah di edit'
			]);
		}else{
			echo json_encode([
				'res' => false, 
				'msg' =>  'Error'
			]);
		}
	}

	public function hapus_setting(){
		$this->Logs_m->save('hapus Karyawan => id : '.$_POST['id']);
		echo json_encode($this->Setting_m->hapus_setting());
	}
}
