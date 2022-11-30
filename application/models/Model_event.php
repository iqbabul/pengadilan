<?php 
 
class Model_event extends CI_Model{
	
	public $tabel = "saw_event";	

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->tabel); 
		$this->db->order_by('id_event','desc'); 
		return $this->db->get();		
	}

	public function getById($id){
		return $this->db->get_where($this->tabel, array('id_event' => $id));
	}

	public function getByStatus(){
		return $this->db->get_where($this->tabel, array('status' => '1'));
	}

	public function insert($data){
		$query = $this->db->insert($this->tabel, $data);
		return $query;
	}
	
}