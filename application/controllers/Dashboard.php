<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}
		$this->load->model('Dashboard_m');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['content'] = "admin/dashboard/page-dashboard";
		$data['jumlah_karyawan'] = $this->Dashboard_m->jumlah_karyawan();
		$data['jumlah_outlet'] = $this->Dashboard_m->jumlah_outlet();
		$this->load->view('admin/layout/layout',$data);
	}
}
