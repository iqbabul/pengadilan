<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_kriteria');
    }
	public function alternatif()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		if($data['user']->id_access == 1){
			$data['alternatif'] = $this->Model_alternatif->getAllAdm()->result();
			$this->load->view('layout/header',$data);
			$this->load->view('admin/adm_alternatif',$data);
		}else{
			$data['alternatif'] = $this->Model_alternatif->getAll()->result();
			$this->load->view('layout/header',$data);
			$this->load->view('admin/alternatif',$data);
		}
		$this->load->view('layout/footer');
	}

	public function kriteria(){
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$data['kriteria'] = $this->Model_kriteria->getAll()->result();
		$this->load->view('layout/header',$data);
		if($data['user']->id_access == 1){
			$this->load->view('admin/adm_kriteria',$data);
		}else{
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
