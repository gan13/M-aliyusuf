<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {
	public function index()
	{
		$data['main_view']     = 'sekolah/coba';
		$this->load->view('Sekolah', $data);
	}

}
