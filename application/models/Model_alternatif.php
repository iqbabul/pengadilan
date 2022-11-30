<?php 
 
class Model_alternatif extends CI_Model{
	
	public $event = "saw_event";	
	public $tabel = "saw_alternatives";	

	public function getAllAdm(){
		$this->db->select('*');
		$this->db->from($this->tabel); 
		return $this->db->get();		
	}

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->tabel.' a'); 
		$this->db->join($this->event.' e', 'a.id_event = e.id_event', 'left');
		$this->db->where('e.status','1');
		$this->db->where('a.status','1');
		return $this->db->get();		
	}

	public function getById($id){
		return $this->db->get_where($this->tabel,array('id_alternative' => $id)); 		

	}

	public function insert($data){
        $query = $this->db->insert($this->tabel, $data);
        return $query;
    }

	public function delete_alternatif($id){
		$this->db->set(array('status' => '0'));
		$this->db->where('id_alternative', $id);
		$this->db->update($this->tabel);
		//$this->db->delete($this->tabel, array('id_alternative' => $id));
	}

	public function status_alternatif($id, $data){
		$this->db->set($data);
		$this->db->where('id_alternative', $id);
		$this->db->update($this->tabel);

	}
	
}