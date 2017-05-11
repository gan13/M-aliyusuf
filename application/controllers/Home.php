<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$data['main_view']     = 'sekolah/beranda';
		$this->load->view('Sekolah', $data);
	}

}
