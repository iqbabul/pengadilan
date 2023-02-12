<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->model('Model_login');
		$this->load->model('Model_user');

	}
	public function index()
	{
		$this->load->view('login');
	}

	public function auth(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => base64_encode($password)
			);
		$cek = $this->Model_login->cek_login($where)->num_rows();
		if($cek > 0){
			$access = $this->Model_login->getAccess($username)->row();
			if($access->id_access == 1){
				$login = $this->Model_login->getLogin($access->id_login)->row();
				$data_session = array(
					'id_user' => $login->id_user,
					'status' => "login"
					);
				$this->session->set_userdata($data_session);
				redirect(base_url("admin/dashboard"));
				
			}elseif($access->id_access == 2){
				$event = $this->Model_login->getEvent($access->id_login)->row();
				if($event->status != 1 ){
					echo "Anda bukan tim penilai acara ini";
				}else{
					$login = $this->Model_login->getLogin($access->id_login)->row();
					$data_session = array(
						'id_user' => $login->id_user,
						'status' => "login"
						);
					$this->session->set_userdata($data_session);
					redirect(base_url("admin/dashboard"));	
				}

			}else{echo "error";}
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
