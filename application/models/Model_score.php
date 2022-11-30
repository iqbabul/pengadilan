<?php 
 
class Model_score extends CI_Model{
	
	public $tabel = "saw_score";	

	public function getAll(){
        return $this->db->get_where($this->tabel, array('id_score'=>'1'));
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