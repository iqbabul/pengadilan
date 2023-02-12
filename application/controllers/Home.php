<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Model_event');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_kriteria');
		$this->load->model('Model_score');
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
		$idevent = empty($this->input->post('event')) ? $this->event_on() : $this->input->post('event');
		$data['event'] = $this->Model_event->getAll()->result();
		$data['eventid'] = $this->Model_event->getById($idevent)->row();
		$data['kriteria'] = $this->Model_kriteria->getAll($idevent)->result();
		$data['alternatif'] = $this->Model_alternatif->getAll($idevent)->result();
		$data['jmlc'] = $this->Model_kriteria->getAll($idevent)->num_rows();
		$data['jmlp'] = $this->db->query("SELECT * FROM saw_evaluations INNER JOIN saw_users ON saw_users.id_user = saw_evaluations.id_user WHERE id_event='$idevent' GROUP BY saw_evaluations.id_user")->num_rows();
		$data['penilai1'] = $this->db->query("SELECT * FROM saw_evaluations INNER JOIN saw_users ON saw_users.id_user = saw_evaluations.id_user WHERE saw_evaluations.id_event='$idevent' GROUP BY saw_evaluations.id_user")->result();
		$data['kriteria1'] = $this->db->query("SELECT * FROM saw_evaluations INNER JOIN saw_criterias ON saw_criterias.id_criteria = saw_evaluations.id_criteria WHERE saw_evaluations.id_event='$idevent' group by saw_evaluations.id_alternative")->result();
		$this->load->view('home',$data);
	}
}
