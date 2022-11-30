<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
    }
	public function index()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$this->load->view('layout/header',$data);
		$this->load->view('admin/dashboard',$data);
		$this->load->view('layout/footer');
	}
}
