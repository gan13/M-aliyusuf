<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller {
  function __construct()
   {
    parent::__construct();
    $this->load->model('Crud_model');
    $this->load->model('Konsultasi_model');
   }
   
	public function index()
	{
		$data['main_view']     = 'konsultasi/home';
		$this->load->view('sistem_pakar', $data);
	}

  public function json_all_gejala()
   {
    $where      = array(
      'gejala.status !=' => 99
    );
    $a          = $this->Konsultasi_model->json_semua_gejala($where);
    $halaman    = $this->input->get('halaman');
    $limit      = 10;
    $start      = ($halaman - 1) * $limit;
    $fields     = "
				
				gejala.id_gejala,
				gejala.kode_gejala,
				gejala.nama_gejala,
				gejala.bobot,
				gejala.created_by,
				gejala.created_time,
				gejala.updated_by,
				gejala.updated_time,
				gejala.deleted_by,
				gejala.deleted_time,
				gejala.status
								
				";
    $where      = array(
      'gejala.status !=' => 99
    );
    $order_by   = 'gejala.id_gejala';
    echo json_encode($this->Konsultasi_model->json_all_gejala($where, $limit, $start, $fields, $order_by));
   }
  
}
