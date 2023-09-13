<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_Admin');
		$this->load->library('session');
	}

	public function index()
	{
		
		if ($this->session->login) {
			echo "<script>alert('Anda Telah Masuk !'); history.back()</script>";
		}

		$data = [
			'judul_halaman'	=> 'Login',
		];
		$this->load->view('login', $data);
	}

	public function login()
	{
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));

		$cekLogin = $this->M_Admin->cekData($username, $password);
		if ($cekLogin['status'] == 1) {
			$this->session->set_userdata(['nama'=>$cekLogin['nama'], 'login' => true]);
			echo "<script>alert('Selamat Datang ^_^'); window.location.href='". base_url() ."admin';</script>";
		}else{
			echo "<script>alert('Username / Password Salah !'); window.location.href='". base_url() ."auth';</script>";
		}
	}

	public function logout()
	{
		$session = ['nama','login'];
		$this->session->unset_userdata($session);
		echo "<script>alert('Anda Telah Keluar !'); window.location.href='". base_url() ."/auth';</script>";
	}
}
