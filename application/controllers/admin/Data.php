<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
		$this->load->model('Model_event');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_kriteria');
    }

	public function alternatif()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		$data['event'] = $this->Model_event->getAll()->result();
		$data['eventid'] = $this->Model_event->getById($idevent)->row();
		if($data['user']->id_access == 1){
			$data['alternatif'] = $this->Model_alternatif->getAllAdm($idevent)->result();
			$this->load->view('layout/header',$data);
			$this->load->view('admin/adm_alternatif',$data);
		}else{
			$data['alternatif'] = $this->Model_alternatif->getAll()->result();
			$this->load->view('layout/header',$data);
			$this->load->view('admin/alternatif',$data);
		}
		$this->load->view('layout/footer');
	}

    public function event_on(){
		$data['event'] = $this->Model_event->getMaxID()->row();
		return $data['event']->id_event;
	}

	public function kriteria(){
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		//echo $idevent;
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$data['event'] = $this->Model_event->getAll()->result();
		$data['eventid'] = $this->Model_event->getById($idevent)->row();
		$this->load->view('layout/header',$data);
		if($data['user']->id_access == 1){
			$data['kriteria'] = $this->Model_kriteria->getAllAdm($idevent)->result();
			$this->load->view('admin/adm_kriteria',$data);
		}else{
			$data['kriteria'] = $this->Model_kriteria->getAll($idevent)->result();
			$this->load->view('admin/kriteria',$data);
		}
		$this->load->view('layout/footer');
	}

	public function simpan_alternatif(){
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		if($data['user']->id_access == 1){
			//print_r($this->input->post());
			$config['upload_path']   = './assets/img/alternatif';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);	
			if ( ! $this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
				echo "$error";
			}else{
				$data = array(
					'name' => $this->input->post('alternatif'),
					'jabatan' => $this->input->post('jabatan'),
					'photo' => $this->upload->data('file_name')
				);	
				// print_r($data);
				$this->Model_alternatif->insert($data);
				$this->session->set_flashdata('alert','ditambah');
				redirect(base_url('admin/data/alternatif'));
			}
		}else{
			echo "anda tidak memiliki akses halaman ini";
			// $this->load->view('/alternatif',$data);			
		}

	}

	public function simpan_kriteria(){
		print_r($this->input->post());
		$data = array(
			'id_event' => $this->input->post('idevent'),
			'alias' => $this->input->post('alias'),
			'criteria' => $this->input->post('kriteria'),
			'weight' => $this->input->post('nilai'),
			'attribute' => $this->input->post('atribut'),
		);
		$this->Model_kriteria->insert($data);
		redirect(base_url('admin/data/kriteria'));
	}

	public function status_alternatif(){
		$id = $this->input->post('id');
		$data = array('status' => $this->input->post('status'));
		$this->Model_alternatif->status_alternatif($id, $data);
		$alert = $this->input->post('status') == '1' ? "diaktifkan" : "dipasifkan";
		$this->session->set_flashdata('alert', $alert);
		redirect(base_url('admin/data/alternatif'));
	}

	public function impor_alternatif(){
		$data['alternatif'] = $this->Model_alternatif->getByEvent($this->input->post('event'))->result();
		foreach($data['alternatif'] as $alternatif){
			// echo $alternatif->name;
			$impor = array(
				'id_event' => $this->input->post('ev'),
				'name' => $alternatif->name,
				'jabatan' => $alternatif->jabatan,
				'photo' => $alternatif->photo,
				'status' => $alternatif->status
			);
			$this->Model_alternatif->insert($impor);
		}
		redirect(base_url('admin/data/alternatif'));
	}

	public function hapus_alternatif($id){
		$this->Model_alternatif->delete_alternatif($id);
		$this->session->set_flashdata('alert','dihapus');
		redirect(base_url('admin/data/alternatif'));
	}

	public function hapus_kriteria($id){
		$this->Model_kriteria->delete_kriteria($id);
		$this->session->set_flashdata('alert','dihapus');
		redirect(base_url('admin/data/kriteria'));
	}
}
