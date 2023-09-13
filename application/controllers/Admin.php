<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_Admin');
		$this->load->model('M_Pembeli');
		$this->load->model('M_Barang');
		$this->load->library('session');

		if (!$this->session->login) {
			echo "<script>alert('Harap Login terlebih dahulu !'); window.location.href='". base_url() ."auth';</script>";
		}
	}

	public function index()
	{
		$data = [
			'nama' => $this->session->nama,
			'barang' => $this->M_Barang->hitungAllBarang(),
			'minuman' => $this->M_Barang->hitungBarang('MM'),
			'makanan' => $this->M_Barang->hitungBarang('MK'),
			'pembeli' => $this->M_Pembeli->hitungAllPembeli(),
			'judul_halaman'	=> 'Dashboard',
		]; 

		$this->load->view('admin/index', $data);
	}

	public function item()
	{
		$data = [
			'barang' => $this->M_Barang->getAllBarang(),
			'judul_halaman'	=> 'List Items',
		]; 

		$this->load->view('admin/item', $data);
	}

	public function tambah()
	{
		$kodeBarang = htmlspecialchars(strtoupper($this->input->post('jenis')));
		$kodeBarang = $kodeBarang. rand(4,100);
		$nama = htmlspecialchars($this->input->post('nama'));
		$harga = htmlspecialchars($this->input->post('harga'));
		$stok = htmlspecialchars($this->input->post('stok'));
		
		$data = [
			'kode_barang' => $kodeBarang,
			'nama' => $nama,
			'harga' => $harga,
			'stok' => $stok,
		];

		$this->M_Barang->create($data);
		echo "<script>alert('Barang Berhasil Ditambahkan !'); window.location.href='". base_url('admin/stok-barang') ."';</script>";
	}

	public function edit()
	{
		$kode = $this->input->post('id');
		$nama = $this->input->post('nama');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');

		$data = [
			'nama' => $nama,
			'harga' => $harga,
			'stok' => $stok,
		];

		$this->M_Barang->update($kode, $data);
		echo "<script>alert('Barang Berhasil Diubah !'); window.location.href='". base_url('admin/stok-barang') ."';</script>";
	}

	public function delete()
	{
		$kode = $this->input->get('kode');
		$this->M_Barang->delete($kode);
		echo "<script>alert('Barang Berhasil Dihapus !'); window.location.href='". base_url('admin/stok-barang') ."';</script>";
	}

	public function pembeli()
	{
		// print_r($this->M_Barang->cekNamaBarang('mk3'));die;
		$data = [
			'pembeli' => $this->M_Pembeli->getAllPembeli(),
			'judul_halaman'	=> 'Riwayat Pembelian',
		]; 

		$this->load->view('admin/riwayat-pembelian', $data);
	}
}
