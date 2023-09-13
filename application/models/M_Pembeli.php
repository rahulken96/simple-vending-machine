<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pembeli extends CI_Model {

	public function getAllPembeli()
	{
		$this->db->from("pembeli");
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function hitungAllPembeli()
	{
		$this->db->from("pembeli");
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function simpanData($data)
	{
		$this->db->insert('pembeli',$data);
		return true;
	}
}
