<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('Model_user');
		$this->load->model('Model_event');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_score');
    }

    public function event_on(){
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		if($data['user']->id_access == 1){
			$data['event'] = $this->Model_event->getMaxIDAdm()->row();
			$cek = $this->Model_event->getMaxIDAdm()->num_rows();
			if($cek <= 0){
				return 0;
			}else{
				return $data['event']->id_event;
			}
		}else{
			$data['event'] = $this->Model_event->getMaxID()->row();
			$cek = $this->Model_event->getMaxID()->num_rows();
			if($cek <= 0){
				return 0;
			}else{
				return $data['event']->id_event;
			}
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
	// echo $idevent;
		$this->load->view('layout/header',$data);
		if($idevent == 0){
			if($data['user']->id_access == 1){
				$data['alert'] = "Anda harus mengisi data di menu pengaturan umum terlebih dahulu";
				$this->load->view('admin/error',$data);
			}else{
				$data['alert'] = "Aplikasi belum disetting oleh Admin";
				$this->load->view('admin/error',$data);
			}
		}else{
			$data['alternatif'] = $this->Model_alternatif->getAll($idevent)->result();
			$this->load->view('admin/hasil',$data);
		}
		$this->load->view('layout/footer');
	}

	public function edit($id)
	{
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$data['eventid'] = $this->Model_event->getById($id)->row();
	// echo $idevent;
		$this->load->view('layout/header',$data);
		if($id == 0){
			if($data['user']->id_access == 1){
				$data['alert'] = "Anda harus mengisi data di menu pengaturan umum terlebih dahulu";
				$this->load->view('admin/error',$data);
			}else{
				$data['alert'] = "Aplikasi belum disetting oleh Admin";
				$this->load->view('admin/error',$data);
			}
		}else{
			$data['alternatif'] = $this->Model_alternatif->getAll($id)->result();
			$this->load->view('admin/adm_edit_hasil',$data);
		}
		$this->load->view('layout/footer');
	}

	public function simpan_edit(){
		//print_r($this->input->post());
		$data = array(
			'id_event' => $this->input->post('idev'),
			'id_alternative' => $this->input->post('idal')
		);
		// reset top
		$this->db->where('id_event',$this->input->post('idev'));
		$this->db->update('saw_result',['top'=>'0']);
		// update top
		$this->db->where($data);
		$this->db->update('saw_result',['top'=>'1']);
		$this->session->set_flashdata('success','Hasil telah diubah');
		redirect(base_url('admin/hasil/edit/'.$this->input->post('idev')));		
	}

	public function publikasi($id)
	{
		$this->db->query("UPDATE saw_result SET status = '1' WHERE id_event = '$id'");
		$this->session->set_flashdata('success','Hasil telah dipublikasi');
		redirect(base_url('admin/hasil'));		
	}
	public function privasi($id)
	{
		$this->db->query("UPDATE saw_result SET status = '0' WHERE id_event = '$id'");
		$this->session->set_flashdata('success','Hasil telah diprivasi');
		redirect(base_url('admin/hasil'));		
	}
}
