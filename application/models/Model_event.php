<?php 
 
class Model_event extends CI_Model{
	
	public $tabel = "saw_event";	

	public function getAllAdm(){
		$this->db->select('*');
		$this->db->from($this->tabel); 
		$this->db->order_by('id_event','desc'); 
		return $this->db->get();		
	}

	public function getMaxIDAdm(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->order_by('id_event', 'desc');
		$this->db->limit(1);
		return $this->db->get();		
	}

	public function getMaxID(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->where('status !=','0'); 
		$this->db->order_by('id_event', 'desc');
		$this->db->limit(1);
		return $this->db->get();		
	}

	public function getDone(){
		$this->db->select('*');
		$this->db->from($this->tabel); 
		$this->db->where('status','2'); 
		$this->db->order_by('id_event','desc'); 
		return $this->db->get();		
	}

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->tabel); 
		$this->db->where('status !=','0'); 
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

	public function update_event($id,$data){
		$this->db->set($data);
		$this->db->where('id_event', $id);
		$this->db->update($this->tabel);
	}
	public function delete($id){
	    $this->db->where('id_event', $id);
	    $this->db->delete($this->tabel);
	    return true;
	}

	
}