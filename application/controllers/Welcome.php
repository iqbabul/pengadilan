<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Model_event');
		$this->load->model('Model_alternatif');
		$this->load->model('Model_score');
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
		$data['alternatif'] = $this->Model_alternatif->getAll($idevent)->result();
		$this->load->view('home',$data);
	}
}
