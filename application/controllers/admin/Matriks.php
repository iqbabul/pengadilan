<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matriks extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
		$this->load->model('Model_event');
		$this->load->model('Model_kriteria');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_penilaian');
    }

    public function event_on(){
		$data['event'] = $this->Model_event->getMaxID()->row();
		$cek = $this->Model_event->getMaxID()->num_rows();
		if($cek <= 0){
			return 0;
		}else{
			return $data['event']->id_event;
		}
	}

	public function index()
	{
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		$data['event'] = $this->Model_event->getAll()->result();
		$data['eventid'] = $this->Model_event->getById($idevent)->row();
		$data['kriteria'] = $this->Model_kriteria->getAll($idevent)->result();
		$data['alternatif'] = $this->Model_alternatif->getAll($idevent)->result();
		$data['jmlc'] = $this->Model_kriteria->getAll($idevent)->num_rows();
		$data['cek'] = $this->Model_penilaian->getEv($idevent,$id_user)->num_rows();
		$this->load->view('layout/header',$data);
		if($idevent == 0){
			$data['alert'] = "Aplikasi belum disetting oleh Admin";
			$this->load->view('admin/error',$data);
		}else{
			$this->load->view('admin/matriks',$data);
		}
		$this->load->view('layout/footer');
	}
}
