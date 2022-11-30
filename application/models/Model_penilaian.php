<?php 
 
class Model_penilaian extends CI_Model{
	
	public $tabel = "saw_evaluations";	

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->tabel);
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