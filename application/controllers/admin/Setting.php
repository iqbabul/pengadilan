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
		$this->load->model('Model_alternatif');
		$this->load->model('Model_kriteria');
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
    public function umum()
	{
		$login = $this->session->userdata('id_user');
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


	public function penilai()
	{
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		// echo $idevent;
		$this->load->view('layout/header',$data);
		if($data['user']->id_access == 1){
			if($idevent == 0){
				$data['alert'] = "Anda harus mengisi data di menu Pengaturan terlebih dahulu";
				$this->load->view('admin/error',$data);
			}else{
				$data['eventD'] = $this->Model_event->getDone()->result();
				$data['eventid'] = $this->Model_event->getById($idevent)->row();
				$data['event'] = $this->Model_event->getAllAdm()->result();
				$data['alternatif'] = $this->Model_alternatif->getAllAdm($idevent)->result();
				$this->load->view('admin/adm_penilai',$data);	
			}
		}else{
			echo "error";
		}
		$this->load->view('layout/footer');
	}

	public function alternatif()
	{
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		// echo $idevent;
		$this->load->view('layout/header',$data);
		if($data['user']->id_access == 1){
			if($idevent == 0){
				$data['alert'] = "Anda harus mengisi data di menu Pengaturan terlebih dahulu";
				$this->load->view('admin/error',$data);
			}else{
				$data['eventD'] = $this->Model_event->getDone()->result();
				$data['eventid'] = $this->Model_event->getById($idevent)->row();
				$data['event'] = $this->Model_event->getAllAdm()->result();
				$data['alternatif'] = $this->Model_alternatif->getAllAdm($idevent)->result();
				$this->load->view('admin/adm_alternatif',$data);	
			}
		}else{
			$data['eventD'] = $this->Model_event->getDone()->result();
			$data['eventid'] = $this->Model_event->getById($idevent)->row();
			$data['event'] = $this->Model_event->getAll()->result();
			$data['alternatif'] = $this->Model_alternatif->getAll()->result();
			$this->load->view('admin/alternatif',$data);
		}
		$this->load->view('layout/footer');
	}


	public function kriteria(){
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		//echo $idevent;
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$data['eventid'] = $this->Model_event->getById($idevent)->row();
		$data['eventD'] = $this->Model_event->getDone()->result();
		$this->load->view('layout/header',$data);
		if($data['user']->id_access == 1){
			if($idevent == 0){
				$data['alert'] = "Anda harus mengisi data di menu Pengaturan terlebih dahulu";
				$this->load->view('admin/error',$data);
			}else{
				$data['event'] = $this->Model_event->getAllAdm()->result();
				$data['kriteria'] = $this->Model_kriteria->getAllAdm($idevent)->result();
				$this->load->view('admin/adm_kriteria',$data);	
			}
		}else{
			$data['event'] = $this->Model_event->getAll()->result();
			$data['kriteria'] = $this->Model_kriteria->getAll($idevent)->result();
			$this->load->view('admin/kriteria',$data);
		}
		$this->load->view('layout/footer');
	}

	public function simpan_alternatif(){
		$login = $this->session->userdata('id_user');
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
					'id_event' => $this->input->post('idev'),
					'name' => $this->input->post('alternatif'),
					'jabatan' => $this->input->post('jabatan'),
					'photo' => $this->upload->data('file_name'),
					'status' => '1'
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

	public function impor_kriteria(){
		$data['kriteria'] = $this->Model_kriteria->getByEvent($this->input->post('event'))->result();
		foreach($data['kriteria'] as $kriteria){
			// echo $alternatif->name;
			$impor = array(
				'id_event' => $this->input->post('ev'),
				'criteria' => $kriteria->criteria,
				'alias' => $kriteria->alias,
				'weight' => $kriteria->weight,
				'attribute' => $kriteria->attribute,
				'status' => $kriteria->status
			);
			$this->Model_kriteria->insert($impor);
		}
		redirect(base_url('admin/data/kriteria'));
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
