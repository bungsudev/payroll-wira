<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}
	}

	public function index()
	{
		$data['title'] = 'Absensi Karyawan';
		$data['content'] = "admin/absensi/page-absensi";
		$this->load->view('admin/layout/layout',$data);
	}
}
