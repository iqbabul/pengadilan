<?php 
 
class Model_score extends CI_Model{
	
	public $tabel = "saw_score";	

	public function getAll(){
        $this->db->from($this->tabel);
		return $this->db->get();
	}
	public function delete(){
		$this->db->truncate($this->tabel);
	}

	public function getMin(){
		$this->db->select("MIN(score) as min");
		$this->db->from($this->tabel);
		return $this->db->get();
	}

	public function getMax(){
		$this->db->select("MAX(score) as max");
		$this->db->from($this->tabel);
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

	public function update_score($id,$ket){
		$this->db->set(array('ket' => $ket));
		$this->db->where('id_score', $id);
		$this->db->update($this->tabel);
	}
	
}