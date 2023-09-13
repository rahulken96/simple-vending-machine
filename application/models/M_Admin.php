<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {

	public function getDataAdmin()
	{
		$this->db->from("admin");
		$query = $this->db->get();
		return $query->row();
	}

	public function cekData($username, $password)
	{		
		$this->db->from("admin");
		$this->db->where('username', $username);
		$data = $this->db->get()->num_rows();
		
		if ($data == 1) {
			$this->db->from("admin");
			$this->db->where('username', $username);
			$dataAdmin = $this->db->get()->row();
			
			if ($password == $dataAdmin->password) {
				$data = [
					'nama' => $dataAdmin->nama,
					'status' => 1,
				];
				return $data;
			}
			return 0;
		}
		return 0;
	}
}
