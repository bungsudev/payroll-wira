<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		ob_start();
		$this->load->model('Auth_model');
	}

	public function index(){
		if($this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('dashboard');
		}
		$data['title'] = 'Login';
		$this->load->view('auth/page-login',$data);
	}

	function check_username_avalibility()  
      {  
           if(!filter_var($_POST["username"], FILTER_VALIDATE_DOMAIN))  
           {  
                echo '<label class="text-danger"><span class="feather-x"></span> Invalid Username</span></label>';  
           }  
           else  
           {  
                if($this->Auth_model->is_username_available($_POST["username"]))  
                {  
                     echo '<label class="text-danger"><span class="feather-x"></span> Username Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="feather-check"></span> Username Available</label>';  
                }  
           }  
      }

	public function proses_tambah(){
		$this->Auth_model->insert_user();
		$this->session->set_flashdata('message','Akun berhasil didaftarkan, Silahkan Login.');
		redirect(base_url().'auth');
	}

	public function proses_hapus(){
		$this->Auth_model->hapus_user($this->input->get('id'));
		$this->session->set_flashdata('message','Berhasil Menghapus Data.');
		redirect(base_url('auth'));
	}

	public function proses_edit(){
		$this->Auth_model->edit_user();
		$this->session->set_flashdata('message','Berhasil Mengedit Data.');
		redirect(base_url('auth/profile'));
	}

	public function changepassword(){
		if($this->session->userdata('username')){
			$data['user'] = $this->db->get_where('User_Pass', ['username' => $this->session->userdata('username')])->row_array();
			$data['header'] = 'template/header';
			$data['title'] = 'Ganti password';
			$data['content'] = 'auth/change-password';
			$this->load->view('layout',$data);
		}else{
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}  
	}

	public function change_pass(){
		$data['user'] = $this->db->get_where('User_Pass')->row_array();
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$new_password2 = $this->input->post('new_password2');
		if($old_password != $data['user']['password_1']){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> password lama Anda salah!</div>');
			redirect('auth/changepassword');
		}else if($new_password2 != $new_password){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Konfirmasi password tidak sama!</div>');
			redirect('auth/changepassword');
		}else {
			if ($old_password == $new_password){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> password tidak boleh sama!</div>');
				redirect('auth/changepassword');
			}else{
				$password_hash =  $this->input->post('new_password');
				$this->db->set('password_1', $password_hash);
				$this->db->where('username', $this->session->userdata('username'));
				$this->db->update('User_Pass');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> password berhasil diganti!</div>');
				redirect('auth/changepassword');
			}
		}
	}

	public function profile(){
		if($this->session->userdata('username')){
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list'] = $this->Auth_model->list_user();
			$data['header'] = 'header';
			$data['footer'] = $this->load->view('footer','',TRUE);
			$this->load->view('auth/profil_view',$data);
		}else{
			redirect('auth/login');
		}	 
		
	}

	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->Auth_model->get($username);
		if(empty($user)){ 
		  $this->session->set_flashdata('message', 'Username tidak ditemukan!');
		  redirect('auth');
		}else{
		  if($password == $user->password){
			$session = array(
			  'username'=>$user->username, 
			  'nama'=>$user->nama,
			  'status'=>$user->status
			);
			if($user->status == 'Aktif'){
				$this->session->set_userdata($session);
				// var_dump($this->session->userdata('Dep_Code')); die();
				redirect('dashboard');
			}else{
				$this->session->set_flashdata('message', 'Maaf, Akun anda tidak aktif!');
				redirect('auth');
			}
		  }else{
			$this->session->set_flashdata('message', 'Password yang anda masukan salah!');
			redirect('auth');
		  }
		}
	  }

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}
	
}
