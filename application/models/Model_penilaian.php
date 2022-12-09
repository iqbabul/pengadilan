<?php 
 
class Model_penilaian extends CI_Model{
	
	public $tabel = "saw_evaluations";

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		return $this->db->get(); 		
	}

	public function getEv($ev,$us){
		$this->db->select('*,saw_event.status as evstatus');
		$this->db->from($this->tabel);
		$this->db->join('saw_event','saw_event.id_event = '.$this->tabel.".id_event",'left');
		$this->db->where('saw_evaluations.id_event', $ev);
		$this->db->where('saw_evaluations.id_user', $us);
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
		$this->db->delete($this->tabel, array('id_alternative' => $id));
	}
	
}