<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_Barang');
	}

	public function index()
	{
		$data = [
			'data_minuman' => $this->M_Barang->getBarang('MM'),
			'data_makanan' => $this->M_Barang->getBarang('MK'),
			'judul_halaman'	=> 'Halaman Utama',
		];
		$this->load->view('index', $data);
	}

	public function bayar()
	{
		$pecahan = $this->input->post('uang_pecahan');
		$kodeBarang = $this->input->post('kode');
		$uang = $this->input->post('uang');

		$this->db->from("barang");
		$this->db->where('kode_barang', $kodeBarang);
		$barang = $this->db->get()->row();

		if (empty($barang)) {
			return false;
		}

		if ($barang->stok < 1) {
			return false;
		}

		$statusBeli =	 $this->M_Barang->cekHargaBarang($uang, $kodeBarang);
		if ($statusBeli == false) {
			return false;
		}

		$kembalian = ($uang != $pecahan) ? $uang - $pecahan : 0;
		$data = [
			'kode_barang' => htmlspecialchars(strtoupper($kodeBarang)),
			'uang_masuk' => htmlspecialchars($uang),
			'kembalian' => htmlspecialchars($kembalian),
			'tanggal_pembelian' => date("Y-m-d H:i:s"),
		];

		$this->load->model('M_Pembeli');
		$response = $this->M_Pembeli->simpanData($data);
		if ($response == true) {
			$this->M_Barang->updateStok($data['kode_barang']);
			$uangKembalian = $data['kembalian'] != 0 ? ' | Uang Kembalian anda sebesar : ' . $data['kembalian'] : '';

			$res = [
				'kembalian' => $uangKembalian,
				'pesan' => 'Transaksi Berhasil !',
			];
			echo json_encode($res);
		} else {
			return false;
		}
		return false;
	}
}
