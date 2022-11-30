<?php 
 
class Model_user extends CI_Model{
	
	public $tabel = "saw_users";	

	public function cek_login($where){		
		return $this->db->get_where($this->tabel, $where);
	}	

	public function getLogin($user){
		$this->db->from($this->tabel);
		$this->db->join('saw_access', 'saw_access.id_access = '.$this->tabel.'.id_access', 'left');
		$this->db->where('username',$user);
		return $this->db->get(); 		
	}	

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->join('tb_hak_akses', 'tb_hak_akses.id_hak = '.$this->tabel.'.id_hak', 'left');
		$this->db->order_by('fullname','ASC');
		return $this->db->get(); 		
	}

	public function getHakAkses(){
		return $this->db->get('tb_hak_akses'); 				
	}

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

	public function update_password($id, $pass){ 
		$this->db->where('id_user',$id);
		$this->db->update($this->tabel, ['password' => $pass]);
	}

	public function update($id, $data){ 
		$this->db->where('id_user',$id);
		$this->db->update($this->tabel, $data);
	}
}