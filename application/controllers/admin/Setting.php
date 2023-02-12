<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

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

	public function jabatan()
	{
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$data['event'] = $this->Model_event->getAllAdm()->result();
		$data['jabatan'] = $this->db->query("SELECT * FROM saw_position LEFT JOIN saw_access ON saw_access.id_access = saw_position.id_access")->result();
		$data['akses'] = $this->db->query("SELECT * FROM saw_access")->result();
		$this->load->view('layout/header',$data);
		$this->load->view('admin/adm_set_jabatan',$data);
		$this->load->view('layout/footer');
	}
	public function simpan_jabatan(){
		$jb = $this->input->post('jb');
		$access = $this->input->post('akses');
		$data = array(
			'id_access' => $access,
			'position_name' => $jb
		);

		$this->db->insert('saw_position', $data);
		redirect(base_url('admin/setting/jabatan'));
	}
	public function update_jabatan(){
		$id = $this->input->post('idp');
		$jb = $this->input->post('jb');
		$access = $this->input->post('akses');
		$data = array(
			'id_access' => $access,
			'position_name' => $jb
		);

		$this->db->where_in('id_position', $id);
		$this->db->update('saw_position', $data);
		redirect(base_url('admin/setting/jabatan'));
	}

	public function hapus_jabatan($id)
	{
		$this->db->delete('saw_position', ['id_position' => $id]);
		redirect(base_url('admin/setting/jabatan'));
	}
	public function simpan_acara(){
		$data = array(
			'title' => $this->input->post('acara'),
			'status' => '0'
		);
		$this->Model_event->insert($data);
		$this->session->set_flashdata('success','Data berhasil ditambah');
		redirect(base_url('admin/setting/umum'));
	}
	public function ubah_event(){
		$id = $this->input->post('id');
		$data = array(
			'title' => $this->input->post('acara'),
		);
		$this->Model_event->update_event($id,$data);
		$this->session->set_flashdata('success','Acara berhasil diupdate');
		redirect(base_url('admin/setting/umum'));

	}

	public function hapus_event($id)
	{
		$cek = $this->db->query("SELECT * FROM saw_evaluations WHERE id_event = '$id'")->num_rows();
		if($cek >= 1){
			$this->session->set_flashdata('error','Tidak dapat dihapus');
			redirect(base_url('admin/data'));
		}else{
			$this->Model_event->delete($id);
			$this->session->set_flashdata('success','Data berhasil dihapus');
			redirect(base_url('admin/setting/umum'));
		}
	}

	public function event_aktif($id){
		$cek = $this->db->query("SELECT * FROM saw_event WHERE status ='1'")->num_rows();
		// echo $cek;
		if($cek == 0){
			// echo "simpan";
			$data = array(
				'status' => '1',
			);
			$cek_jml = $this->db->query("SELECT sum(weight) as jml FROM saw_criterias WHERE id_event = '$id'")->row();
			if($cek_jml->jml != 100){
				$this->session->set_flashdata('error','Jumlah bobot kriteria tidak sesuai');
				redirect(base_url('admin/setting/umum'));		
			}else{
				$this->Model_event->update_event($id,$data);
				$this->session->set_flashdata('success','Acara diaktifkan');
				redirect(base_url('admin/setting/umum'));		
			}
		}else{
			$this->session->set_flashdata('error','Masih ada acara yang aktif');
			redirect(base_url('admin/setting/umum'));	
		}

	}

	public function event_pasif($id){
		$data = array(
			'status' => '0',
		);
		$this->Model_event->update_event($id,$data);
		$this->session->set_flashdata('error','Acara dipasifkan');
		redirect(base_url('admin/setting/umum'));

	}

	public function event_done($id){
		$data = array(
			'status' => '2',
		);
		$this->Model_event->update_event($id,$data);
		$this->session->set_flashdata('info','Acara Selesai');
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
		$this->session->set_flashdata('success','Skor berhasil diupdate');
		redirect(base_url('admin/setting/umum'));
	}

	public function score_update(){
		$jml = count($this->input->post('sc'));
		//echo $jml."<br>";
		for($i=0;$i<$jml;$i++){
			// print_r($this->input->post('sc')[$i]);
			$this->Model_score->update_score($this->input->post('sc')[$i],$this->input->post('ket')[$i]);
		}
		$this->session->set_flashdata('success','Keterangan berhasil diupdate');
		redirect(base_url('admin/setting/umum'));
	}


	public function penilai()
	{
		$login = $this->session->userdata('id_user');
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$data['usr'] = $this->Model_user->getPenilaiAll($idevent)->result();
		$data['penilai'] = $this->Model_user->getPenilai($idevent)->result();
		// echo $idevent;
		$this->load->view('layout/header',$data);
		if($data['user']->id_access == 1){
			if($idevent == 0){
				$data['alert'] = "Anda harus mengisi data di menu pengaturan umum terlebih dahulu";
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

	public function penilai_simpan(){
		$event = $this->input->post('idevent');
		$penilai = $this->input->post('penilai');
		$jm = count($penilai);
		for($i=0;$i<$jm;$i++){
			$cek_penilai = $this->db->query("SELECT * FROM saw_login WHERE id_event = '$event' && id_user = '$penilai[$i]'")->num_rows();
			$jml = $this->db->query("SELECT MAX(id_login) as jml FROM saw_login")->row();
			if($cek_penilai > 0){
				$this->session->set_flashdata('info','Penilai sudah dhtambahkan');
			}else{
				$urut = $jml->jml+1;
				$data = array(
					'id_event' => $event,
					'id_user' => $penilai[$i],
					'id_access' => '2',
					'username' => 'penilai'.$event.$penilai[$i],
					'password' => base64_encode('penilai'.$event.$penilai[$i]),
				);
				// print_r($data);
				$this->Model_user->insert_penilai($data);	
			}
		}
		$this->session->set_flashdata('success','Penilai berhasil dhtambahkan');
		redirect(base_url('admin/setting/penilai'));
	}

	public function penilai_hapus($id){
		$this->Model_user->delete_penilai($id);
		$this->session->set_flashdata('success','Penilai berhasil dihapus');
		redirect(base_url('admin/setting/penilai'));
	}

	public function alternatif()
	{
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		$id_user = $data['user']->id_user;
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		$data['usr'] = $this->Model_user->getAll()->result();
		// echo $idevent;
		$data['kandidat'] = $this->Model_user->getKandidatAll($idevent)->result();
		$this->load->view('layout/header',$data);
		if($data['user']->id_access == 1){
			if($idevent == 0){
				$data['alert'] = "Anda harus mengisi data di menu pengaturan umum terlebih dahulu";
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

	public function simpan_alternatif(){
		$login = $this->session->userdata('id_user');
		$data['user'] = $this->Model_user->getLogin($login)->row();
		if($data['user']->id_access == 1){
			$event = $this->input->post('idevent');
			$kandidat = $this->input->post('kandidat');
			$ket = $this->input->post('ket');
			$cek_kandidat = $this->db->query("SELECT * FROM saw_alternatives WHERE id_event = '$event' && id_user = '$kandidat'")->num_rows();
			if($cek_kandidat > 0){
				$this->session->set_flashdata('info','Kandidat sudah ditambahkan');
			}else{
				$data = array(
					'id_event' => $event,
					'id_user' => $kandidat,
					'ket' => $ket,
				);
				$this->Model_alternatif->insert($data);	
				$this->session->set_flashdata('success','Kandidat berhasil ditambahkan');
			}
			redirect(base_url('admin/setting/alternatif'));
		}else{
			echo "anda tidak memiliki akses halaman ini";
			// $this->load->view('/alternatif',$data);			
		}

	}
	// public function simpan_alternatif(){
	// 	$login = $this->session->userdata('id_user');
	// 	$data['user'] = $this->Model_user->getLogin($login)->row();
	// 	if($data['user']->id_access == 1){
	// 		$event = $this->input->post('idevent');
	// 		$kandidat = $this->input->post('kandidat');
	// 		$jm = count($kandidat);
	// 		for($i=0;$i<$jm;$i++){
	// 			$cek_kandidat = $this->db->query("SELECT * FROM saw_login WHERE id_event = '$event' && id_user = '$kandidat[$i]'")->num_rows();
	// 			if($cek_kandidat > 0){
	// 				echo $kandidat[$i]." sudah terdaftar!";
	// 			}else{
	// 				$data = array(
	// 					'id_event' => $event,
	// 					'id_user' => $kandidat[$i],
	// 				);
	// 				$this->Model_alternatif->insert($data);	
	// 			}
	// 		}
	// 		redirect(base_url('admin/setting/alternatif'));
	// 	}else{
	// 		echo "anda tidak memiliki akses halaman ini";
	// 		// $this->load->view('/alternatif',$data);			
	// 	}

	// }

	public function alternatif_hapus($id){
		$this->Model_alternatif->delete($id);
		$this->session->set_flashdata('success','kandidat berhasil dihapus');
		redirect(base_url('admin/setting/alternatif'));
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
				$data['alert'] = "Anda harus mengisi data di menu pengaturan umum terlebih dahulu";
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
		$this->session->set_flashdata('success','Kriteria berhasil ditambahkan');
		redirect(base_url('admin/setting/kriteria'));
	}

	public function status_alternatif(){
		$id = $this->input->post('id');
		$data = array('status' => $this->input->post('status'));
		$this->Model_alternatif->status_alternatif($id, $data);
		$alert = $this->input->post('status') == '1' ? "diaktifkan" : "dipasifkan";
		$this->session->set_flashdata('alert', $alert);
		redirect(base_url('admin/setting/alternatif'));
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
		$this->session->set_flashdata('success','Impor berhasil');
		redirect(base_url('admin/setting/alternatif'));
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
		$this->session->set_flashdata('success','Impor berhasil');
		redirect(base_url('admin/setting/kriteria'));
	}

	public function hapus_alternatif($id){
		$this->Model_alternatif->delete_alternatif($id);
		$this->session->set_flashdata('success','Kandidat berhasil dihapus');
		redirect(base_url('admin/setting/alternatif'));
	}

	public function hapus_kriteria($id){
		$this->Model_kriteria->delete_kriteria($id);
		$this->session->set_flashdata('success','Kriteria berhasil dihapus');
		redirect(base_url('admin/setting/kriteria'));
	}
	
}
