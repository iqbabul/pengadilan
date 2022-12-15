<?php 
 
class Model_login extends CI_Model{
	
	public $tabel = "saw_login";	

	public function cek_login($where){		
		return $this->db->get_where($this->tabel, $where);
	}	

    public function getAccess($user){
		$this->db->from($this->tabel);
		$this->db->where('username',$user);
		return $this->db->get(); 		

    }

    public function getEvent($id){
		$this->db->from($this->tabel);
		$this->db->join('saw_event', 'saw_event.id_event = '.$this->tabel.'.id_event', 'left');
		$this->db->where('id_login',$id);
		return $this->db->get(); 		

    }

    public function getLogin($id){
		$this->db->from($this->tabel);
		$this->db->join('saw_users', 'saw_users.id_user = '.$this->tabel.'.id_user', 'left');
		$this->db->join('saw_access', 'saw_access.id_access = '.$this->tabel.'.id_access', 'left');
		$this->db->where('id_login',$id);
		return $this->db->get(); 		
	}	

	public function getAllPenilai(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->join('saw_access', 'saw_access.id_access = '.$this->tabel.'.id_access', 'left');
		$this->db->where('saw_access.id_access','2');
		$this->db->order_by('fullname','ASC');
		return $this->db->get(); 		
	}

	// public function getAccess(){
	// 	$this->db->select('*');
	// 	$this->db->from('saw_access');
	// 	$this->db->where('id_access','2');
	// 	return $this->db->get(); 		
	// }

	public function getById($id){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->join('saw_access', 'saw_access.id_access = '.$this->tabel.'.id_access', 'left');
		$this->db->where('id_user', $id);
		return $this->db->get()->row(); 		
	}

	public function getLastId(){
		$query = "SELECT MAX(id_user) as id FROM tb_user ORDER BY id_user DESC LIMIT 1";
		return $this->db->query($query)->row();
	}

	public function simpan($data){
        return $this->db->insert($this->tabel, $data);
    }

	public function delete($id){
	    $this->db->where('id_user', $id);
	    $this->db->delete($this->tabel);
	    return true;
	}

	public function update_foto($id, $foto){ 
		$this->db->where('id_user',$id);
		$this->db->update($this->tabel, ['foto' => $foto]);
	}

	public function update($id, $data){ 
		$this->db->where('id_user',$id);
		$this->db->update($this->tabel, $data);
	}
}