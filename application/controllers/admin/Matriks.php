<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matriks extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
		$this->load->model('Model_kriteria');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_penilaian');
    }
	public function index()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$data['kriteria'] = $this->Model_kriteria->getAll()->result();
		$data['alternatif'] = $this->Model_alternatif->getAll()->result();
		$data['jmlc'] = $this->Model_kriteria->getAll()->num_rows();
		$this->load->view('layout/header',$data);
		$this->load->view('admin/matriks',$data);
		$this->load->view('layout/footer');
	}
}
