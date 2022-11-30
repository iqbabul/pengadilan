<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
		$this->load->model('Model_event');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_penilaian');
		$this->load->model('Model_kriteria');
    }

	public function event_on(){
		$data['event'] = $this->Model_event->getByStatus()->row();
		return $data['event']->id_event;
	}

	public function index()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		$data['event'] = $this->Model_event->getAll()->result();
		$data['eventid'] = $this->Model_event->getById($idevent)->row();
		$data['alternatif'] = $this->Model_alternatif->getAll($idevent)->result();
		$this->load->view('layout/header',$data);
		$this->load->view('admin/alternatif',$data);
		$this->load->view('layout/footer');
	}

    public function input(){
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		$data['alternatif'] = $this->Model_alternatif->getById($this->input->post('id'))->row();
		$data['kriteria'] = $this->Model_kriteria->getAll($idevent)->result();
		$data['eventid'] = $this->input->post('idv');
		$this->load->view('layout/header',$data);
		$this->load->view('admin/penilaian',$data);
		$this->load->view('layout/footer');

    }
    public function edit(){
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$data['eventid'] = $this->input->post('idv') ;
		$data['alternatif'] = $this->Model_alternatif->getById($this->input->post('id'))->row();
		$this->load->view('layout/header',$data);
		$this->load->view('admin/penilaian_edit',$data);
		$this->load->view('layout/footer');

    }

    public function simpan(){
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
        $count = count($this->input->post('kriteria'));
        for($i=0; $i<$count; $i++){
            $data = array(
                'id_criteria' => $this->input->post('kriteria')[$i],
                'id_alternative' => $this->input->post('alternatif'),
                'id_event' => $this->input->post('idv'),
                'id_user' => $id_user,
                'value' =>$this->input->post('nilai')[$i],
            );
            $this->Model_penilaian->insert($data);
        }
        redirect(base_url('admin/penilaian'));
    }
}
