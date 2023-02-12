<?php 
 
class Model_alternatif extends CI_Model{
	
	public $event = "saw_event";	
	public $tabel = "saw_alternatives";	

	public function getAllAdm($id){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->join('saw_users', 'saw_users.id_user = saw_alternatives.id_user', 'left');
		$this->db->join('saw_event', 'saw_event.id_event = saw_alternatives.id_event', 'left');
		$this->db->join('saw_position','saw_position.id_position = saw_users.id_position','left');
		$this->db->join('saw_access','saw_access.id_access = saw_position.id_access','left');
		$this->db->where('saw_event.id_event',$id);
		$this->db->where('saw_users.id_user !=','1');
		$this->db->order_by('saw_users.id_user','ASC');
		return $this->db->get(); 		
	}

	public function getAll($id){
		$this->db->select('*');
		$this->db->from($this->tabel.' a');
		$this->db->join('saw_users', 'saw_users.id_user = a.id_user', 'left');
		$this->db->join('saw_position','saw_position.id_position = saw_users.id_position','left');
		$this->db->join('saw_access','saw_access.id_access = saw_position.id_access','left');
		$this->db->where('a.id_event', $id);
		$this->db->group_by('a.id_alternative');
		return $this->db->get();	
	}

	public function getById($id){
		$this->db->select('*');
		$this->db->from($this->tabel.' a');
		$this->db->join('saw_users', 'saw_users.id_user = a.id_user', 'left');
		$this->db->where('a.id_alternative', $id);
		return $this->db->get();	

	}

	public function getByEvent($id){
		return $this->db->get_where($this->tabel,array('id_event' => $id)); 		

	}

	public function insert($data){
        $query = $this->db->insert($this->tabel, $data);
        return $query;
    }

	public function delete($id){
		// $this->db->set(array('status' => '0'));
		// $this->db->where('id_alternative', $id);
		// $this->db->update($this->tabel);
		$this->db->delete($this->tabel, array('id_alternative' => $id));
	}

	public function status_alternatif($id, $data){
		$this->db->set($data);
		$this->db->where('id_alternative', $id);
		$this->db->update($this->tabel);

	}
	
}