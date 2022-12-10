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
		$data['score'] = $this->Model_score->getAll()->result();
		$data['max'] = $this->Model_score->getMax()->row();
		$data['min'] = $this->Model_score->getMin()->row();
		$id_user = $data['user']->id_user;
		$this->load->view('layout/header',$data);
		$this->load->view('admin/adm_set_umum',$data);
		$this->load->view('layout/footer');
	}

	public function simpan_acara(){
		$data = array(
			'title' => $this->input->post('acara'),
			'status' => '0'
		);
		$this->Model_event->insert($data);
		redirect(base_url('admin/setting/umum'));
	}

	public function ubah_event(){
		$id = $this->input->post('id');
		$data = array(
			'title' => $this->input->post('acara'),
		);
		$this->Model_event->update_event($id,$data);
		redirect(base_url('admin/setting/umum'));

	}

	public function event_aktif($id){
		$data = array(
			'status' => '1',
		);
		$this->Model_event->update_event($id,$data);
		redirect(base_url('admin/setting/umum'));

	}

	public function event_pasif($id){
		$data = array(
			'status' => '0',
		);
		$this->Model_event->update_event($id,$data);
		redirect(base_url('admin/setting/umum'));

	}

	public function event_done($id){
		$data = array(
			'status' => '2',
		);
		$this->Model_event->update_event($id,$data);
		redirect(base_url('admin/setting/umum'));

	}

	public function update_score(){
		$this->Model_score->delete();
		$number = range($this->input->post('min'),$this->input->post('max'));
		foreach($number as $n){
			$dt = array(
				'score' => $n
			);
			$this->Model_score->insert($dt);
		}		
		redirect(base_url('admin/setting/umum'));
	}

	public function score_update(){
		$jml = count($this->input->post('sc'));
		//echo $jml."<br>";
		for($i=0;$i<$jml;$i++){
			// print_r($this->input->post('sc')[$i]);
			$this->Model_score->update_score($this->input->post('sc')[$i],$this->input->post('ket')[$i]);
		}
		redirect(base_url('admin/setting/umum'));
	}

    public function user()
	{
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$data['usr'] = $this->Model_user->getAllPenilai()->result();
		$data['access'] = $this->Model_user->getAccess()->result();
		$this->load->view('layout/header',$data);
		$this->load->view('admin/adm_set_user',$data);
		$this->load->view('layout/footer');
	}

	public function simpan_user(){
		print_r($this->input->post());
		$login = $this->session->userdata('nama');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		if($data['user']->id_access == 1){
			//print_r($this->input->post());
			$config['upload_path']   = './assets/img/user';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);	
			if ( ! $this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
				echo "$error";
			}else{
				$data = array(
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'fullname' => $this->input->post('fullname'),
					'id_access' => $this->input->post('akses'),
					'foto' => $this->upload->data('file_name')
				);	
				// print_r($data);
				$this->Model_user->simpan($data);
				$this->session->set_flashdata('alert','ditambah');
				redirect(base_url('admin/setting/user'));
			}
		}else{
			echo "anda tidak memiliki akses halaman ini";
			// $this->load->view('/alternatif',$data);			
		}
	}

	public function update_user(){
		print_r($this->input->post());
		$login = $this->session->userdata('nama');
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
