<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Barang extends CI_Model
{

	public function getAllBarang()
	{
		$this->db->from("barang");
		$this->db->order_by('nama', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getBarang($kode)
	{
		$this->db->from("barang");
		$this->db->like('kode_barang', $kode);
		$query = $this->db->get();
		return $query->result();
	}

	public function cekHargaBarang($uang, $kode)
	{
		$this->db->from("barang");
		$this->db->like('kode_barang', $kode);
		$hargaBarang = $this->db->get()->row()->harga;
		return $uang > $hargaBarang ? true : false;
	}

	public function cekNamaBarang($kode)
	{
		$this->db->select('nama');
		$this->db->from("barang");
		$this->db->where('kode_barang', $kode);
		$namaBarang = $this->db->get()->row()->nama;
		return $namaBarang ?? null;
	}

	public function updateStok($kode)
	{
		$this->db->from("barang");
		$this->db->like('kode_barang', $kode);
		$stok = $this->db->get()->row()->stok;
		$stok -= 1;

		$this->db->from("barang");
		$this->db->where('kode_barang', $kode);
		$this->db->update('barang', ['stok' => $stok]);
		return true;
	}

	public function hitungAllBarang()
	{
		$this->db->from("barang");
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function hitungBarang($kode)
	{
		$this->db->from("barang");
		$this->db->like('kode_barang', $kode);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function create($data)
	{
		$this->db->insert('barang',$data);
		return true;
	}
	
	public function update($kode, $data)
	{
		$this->db->from("barang");
		$this->db->where('kode_barang', $kode);
		$this->db->update('barang', $data);
		return true;
	}
	
	public function delete($kode)
	{
		$this->db->where('kode_barang', $kode);
		$this->db->delete('barang');
		return true;
	}
}
