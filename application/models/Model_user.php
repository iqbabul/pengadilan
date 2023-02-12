<?php 
 
class Model_user extends CI_Model{
	
	public $tabel = "saw_users";	

	public function cek_login($where){		
		return $this->db->get_where($this->tabel, $where);
	}	

	public function getLogin($user){
		$this->db->from($this->tabel);
		$this->db->join('saw_login', 'saw_login.id_user = '.$this->tabel.'.id_user', 'left');
		$this->db->join('saw_access', 'saw_access.id_access = saw_login.id_access', 'left');
		$this->db->where('saw_users.id_user',$user);
		return $this->db->get(); 		
	}	

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->join('saw_position','saw_position.id_position = saw_users.id_position','left');
		$this->db->join('saw_access','saw_access.id_access = saw_position.id_access','left');
		$this->db->where('saw_users.id_user !=','1');
		$this->db->order_by($this->tabel.'.id_position','ASC');
		return $this->db->get(); 		
	}

	public function getPilihan(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->join('saw_position','saw_position.id_position = saw_users.id_position','left');
		$this->db->join('saw_access','saw_access.id_access = saw_position.id_access','left');
		$this->db->where('saw_users.id_user !=','1');
		$this->db->where('saw_users.status','on');
		$this->db->order_by('fullname','ASC');
		return $this->db->get(); 		
	}

	public function getPenilai($id){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->join('saw_login', 'saw_login.id_user = '.$this->tabel.'.id_user', 'left');
		$this->db->join('saw_position','saw_position.id_position = saw_users.id_position','left');
		$this->db->join('saw_access','saw_access.id_access = saw_position.id_access','left');
		$this->db->join('saw_event', 'saw_event.id_event = saw_login.id_event', 'left');
		$this->db->where('saw_event.id_event',$id);
		$this->db->where('saw_users.id_user !=','1');
		$this->db->where('saw_users.status','on');
		$this->db->order_by('id_login','ASC');
		return $this->db->get(); 		
	}

	public function getPenilaiAll($id)
	{
		
		return $this->db->query("SELECT * FROM saw_users LEFT JOIN saw_position ON saw_position.id_position=saw_users.id_position LEFT JOIN saw_access ON saw_access.id_access=saw_position.id_access WHERE NOT EXISTS (SELECT * FROM saw_alternatives WHERE saw_users.id_user = saw_alternatives.id_user AND id_event = '$id') AND id_user != '1' AND saw_access.id_access = '2' AND saw_users.status = 'on'");
	}
		public function getKandidatAll($id){
		return $this->db->query("SELECT * FROM saw_users LEFT JOIN saw_position ON saw_position.id_position=saw_users.id_position LEFT JOIN saw_access ON saw_access.id_access=saw_position.id_access WHERE NOT EXISTS (SELECT * FROM saw_login WHERE saw_users.id_user = saw_login.id_user AND id_event = '$id') AND id_user != '1' AND saw_access.id_access = '3' AND saw_users.status = 'on'"); 		
		// $this->db->select('*');
		// $this->db->from($this->tabel);
		// $this->db->join('saw_login', 'saw_login.id_user = '.$this->tabel.'.id_user', 'left');
		// $this->db->join('saw_access', 'saw_access.id_access = saw_login.id_access', 'left');
		// $this->db->join('saw_event', 'saw_event.id_event = saw_login.id_event', 'left');
		// $this->db->where('saw_event.id_event',$id);
		// $this->db->where('saw_users.id_user !=','1');
		// $this->db->order_by('id_login','ASC');
		// return $this->db->get(); 		
	}

	public function getAccess(){
		$this->db->select('*');
		$this->db->from('saw_access');
		$this->db->join('saw_login', 'saw_login.id_user = '.$this->tabel.'.id_user', 'left');
		$this->db->join('saw_access', 'saw_access.id_access = saw_login.id_access', 'left');
		$this->db->join('saw_event', 'saw_event.id_event = saw_login.id_event', 'left');
		$this->db->where('id_access','2');
		return $this->db->get(); 		
	}

	public function getById($id){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->join('saw_login', 'saw_login.id_user = '.$this->tabel.'.id_user', 'left');
		$this->db->join('saw_access', 'saw_access.id_access = saw_login.id_access', 'left');
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

	public function insert_penilai($data){
        return $this->db->insert('saw_login', $data);
    }

	public function delete($id){
	    $this->db->where('id_user', $id);
	    $this->db->delete($this->tabel);
	    return true;
	}

	public function delete_penilai($id){
	    $this->db->where('id_login', $id);
	    $this->db->delete('saw_login');
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