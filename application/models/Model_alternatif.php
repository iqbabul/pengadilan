<?php 
 
class Model_alternatif extends CI_Model{
	
	public $event = "saw_event";	
	public $tabel = "saw_alternatives";	

	public function getAllAdm($id){
		$this->db->select('*');
		$this->db->from($this->tabel.' a');
		$this->db->where('a.id_event', $id);
		$this->db->group_by('a.id_alternative');
		return $this->db->get();	
	}

	public function getAll($id){
		$this->db->select('*');
		$this->db->from($this->tabel.' a');
		$this->db->where('a.id_event', $id);
		$this->db->where('a.status', '1');
		$this->db->group_by('a.id_alternative');
		return $this->db->get();	
	}

	public function getById($id){
		return $this->db->get_where($this->tabel,array('id_alternative' => $id)); 		

	}

	public function getByEvent($id){
		return $this->db->get_where($this->tabel,array('id_event' => $id)); 		

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