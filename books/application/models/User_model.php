<?php

class User_model extends CI_Model {
	public function getUserProfile($username = false){
		// membaca semua data user dari tabel 'users'
		if ($username == false){
			$query = $this->db->get('users');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('users', array("username" => $username));
			return $query->row_array();
		}

	}

	// method untuk insert user ke tabel 'users'
	public function insertUser($username, $password, $fullname, $idrole){
		$data = array(
					"username" => $username,
					"password" => $password,
					"fullname" => $fullname,
					"idrole" => $idrole
		);
		$query = $this->db->insert('users', $data);
	}
	// method untuk membaca data role buku dari tabel 'roles'
	public function getRole(){
			$query = $this->db->get('roles');
			return $query->result_array();
	}

	// method untuk hapus data buku berdasarkan id
	public function delUser($id){
		$this->db->delete('users', array("username" => $id));
	}

	// method untuk edit data user berdasarkan tabel users
	public function updateUser($username, $password, $fullname, $idrole){
		$data = array (
			"username" => $username,
			"password" => $password,
			"fullname" => $fullname,
			"idrole" => $idrole
			);
		$query =$this->db->where('username', $username);
		$query =$this->db->update('users', $data);
	}
}

?>