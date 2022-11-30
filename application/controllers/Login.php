<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->model('Model_user');

	}
	public function index()
	{
		$this->load->view('login');
	}
	function auth(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->Model_user->cek_login($where)->num_rows();
		if($cek > 0){
			$cek_status = $this->Model_user->getLogin($username)->row();
				$data_session = array(
					'nama' => $username,
					'status' => "login"
					);
				$this->session->set_userdata($data_session);
				redirect(base_url("admin/dashboard"));
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong><i class="fa fa-warning"></i> Peringatan!</strong> username atau password salah</div>');
			redirect(base_url('login'));
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
