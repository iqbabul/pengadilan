<?php 
 
class Model_kriteria extends CI_Model{
	
	public $event = "saw_event";	
	public $tabel = "saw_criterias";	

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->tabel.' c'); 
		$this->db->join($this->event.' e', 'e.id_event = c.id_event', 'left');
		$this->db->where('e.status','1');
		$this->db->where('c.status','1');
		return $this->db->get();		
	}

	public function delete_kriteria($id){
		$this->db->set(array('status' => '0'));
		$this->db->where('id_criteria', $id);
		$this->db->update($this->tabel);

		// $this->db->delete($this->tabel, array('id_criteria' => $id));
	}

	public function insert($data){
		$query = $this->db->insert($this->tabel, $data);
		return $query;
	}
	
}