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

    public function index()
	{
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$data['usr'] = $this->Model_user->getAll()->result();
		$this->load->view('layout/header',$data);
		$this->load->view('admin/adm_set_user',$data);
		$this->load->view('layout/footer');
	}

	public function simpan(){
		print_r($this->input->post());
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		if($data['user']->id_access == 1){
			//print_r($this->input->post());
			$config['upload_path']   = './assets/img/user';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);	
			if ( ! $this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}else{
				$data = array(
					'fullname' => $this->input->post('fullname'),
					'tempat_lahir' => $this->input->post('tmpt'),
					'tgl_lahir' => $this->input->post('tgl'),
					'alamat' => $this->input->post('alamat'),
					'telp' => $this->input->post('telp'),
					'jenis_kelamin' => $this->input->post('jk'),
					'jabatan' => $this->input->post('jb'),
					'status' => 'on',
					'foto' => $this->upload->data('file_name')
				);	
				// print_r($data);
				$this->Model_user->simpan($data);
				$this->session->set_flashdata('alert','ditambah');
				redirect(base_url('admin/data'));
			}
		}else{
			echo "anda tidak memiliki akses halaman ini";
			// $this->load->view('/alternatif',$data);			
		}
	}
	
	public function update_user(){
		print_r($this->input->post());
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		if($data['user']->id_access == 1){
			//print_r($this->input->post());
			$config['upload_path']   = './assets/img/user';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);	
			if ( ! $this->upload->do_upload('foto')){
				$data = array(
					'fullname' => $this->input->post('fullname'),
					'id_access' => $this->input->post('akses'),
					'status' => $this->input->post('sts')
				);	
				// print_r($data);
				$this->Model_user->update($this->input->post('ids'),$data);
				$this->session->set_flashdata('alert','ditambah');
				redirect(base_url('admin/setting/user'));
			}else{
				$data = array(
					'fullname' => $this->input->post('fullname'),
					'id_access' => $this->input->post('akses'),
					'status' => $this->input->post('sts'),
					'foto' => $this->upload->data('file_name')
				);	
				// print_r($data);
				$this->Model_user->update($this->input->post('ids'),$data);
				$this->session->set_flashdata('alert','ditambah');
				redirect(base_url('admin/setting/user'));
			}
		}else{
			echo "anda tidak memiliki akses halaman ini";
			// $this->load->view('/alternatif',$data);			
		}
	}

	public function hapus_user($id){
		$this->Model_user->delete($id);
		redirect(base_url('admin/setting/user'));
	}

	public function reset_password($id){
		$reset = md5(12345);
		$data = array(
			'password' => $reset
		);
		$this->Model_user->update($id,$data);
		redirect(base_url('admin/setting/user'));

	}

}
