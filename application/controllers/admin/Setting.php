<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
		$this->load->model('Model_event');
		$this->load->model('Model_score');
    }

    public function umum()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$data['event'] = $this->Model_event->getAllAdm()->result();
		$data['score'] = $this->Model_score->getAll()->row();
		$id_user = $data['user']->id_user;
		$this->load->view('layout/header',$data);
		$this->load->view('admin/adm_set_umum',$data);
		$this->load->view('layout/footer');
	}

    public function user()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$this->load->view('layout/header',$data);
		$this->load->view('admin/adm_set_user',$data);
		$this->load->view('layout/footer');
	}
}
