<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_penilaian');
		$this->load->model('Model_kriteria');
    }

	public function index()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$data['alternatif'] = $this->Model_alternatif->getAll()->result();
		$this->load->view('layout/header',$data);
		$this->load->view('admin/alternatif',$data);
		$this->load->view('layout/footer');
	}

    public function input(){
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$data['alternatif'] = $this->Model_alternatif->getById($this->input->post('id'))->row();
		$data['kriteria'] = $this->Model_kriteria->getAll()->result();
		$this->load->view('layout/header',$data);
		$this->load->view('admin/penilaian',$data);
		$this->load->view('layout/footer');

    }
    public function edit(){
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
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
        //echo $count;
        for($i=0; $i<$count; $i++){
            $data = array(
                'id_criteria' => $this->input->post('kriteria')[$i],
                'id_alternative' => $this->input->post('alternatif'),
                'id_user' => $id_user,
                'value' =>$this->input->post('nilai')[$i],
            );
            $this->Model_penilaian->insert($data);
        }
        redirect(base_url('admin/penilaian'));
    }
}
