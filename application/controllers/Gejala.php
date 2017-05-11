<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gejala extends CI_Controller {
  function __construct()
   {
    parent::__construct();
    $this->load->model('Crud_model');
    $this->load->model('Gejala_model');
   }
	public function index()
	{
    $where             = array(
      'gejala.status !=' => 99
    );
    $a                 = $this->Gejala_model->json_semua_gejala($where);
    $data['per_page']  = 15;
    $data['total']     = ceil($a / 15);
		$data['main_view']     = 'gejala/home';
		$this->load->view('sistem_pakar', $data);
	}

  public function simpan_gejala()
   {
		$this->form_validation->set_rules('kode_gejala', 'kode_gejala', 'required');
		$this->form_validation->set_rules('nama_gejala', 'nama_gejala', 'required');
		$id_gejala  = trim($this->input->post('id_gejala'));
		$kode_gejala  = trim($this->input->post('kode_gejala'));
		$nama_gejala  = trim($this->input->post('nama_gejala'));
		$bobot     = trim($this->input->post('bobot'));
		$created_time  = date('Y-m-d H:i:s');
		
    $table_name = 'gejala';
    $where      = array(
      'gejala.kode_gejala' => $kode_gejala,
      'gejala.nama_gejala' => $nama_gejala
    );
    $a= $this->Crud_model->semua_data($where, $table_name);
    
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      if($a == 0){
        $data_input = array(
			
				'id_gejala' => $id_gejala,
				'kode_gejala' => $kode_gejala,
				'nama_gejala' => $nama_gejala,
				'bobot' => $bobot,
				'created_time' => $created_time,
				'status' => 1
								
				);
        $table_name = 'gejala';
        $id         = $this->Gejala_model->simpan_gejala($data_input, $table_name);
        echo $id;
      }
      else{
        echo 'doble';
      }
     }
   }
   
  public function update_data_gejala()
   {
    $this->form_validation->set_rules('id_gejala', 'id_gejala', 'required');
		$this->form_validation->set_rules('nama_gejala', 'nama_gejala', 'required');
		$id_gejala    = trim($this->input->post('id_gejala'));
		$kode_gejala  = trim($this->input->post('kode_gejala'));
		$nama_gejala  = trim($this->input->post('nama_gejala'));
		$bobot     = trim($this->input->post('bobot'));
		$updated_time         = date('Y-m-d H:i:s');
		if ($this->form_validation->run() == FALSE)
     {
      echo '[]';
     }
    else
     {
      $data_update = array(
			
				'kode_gejala' => $kode_gejala,
				'nama_gejala' => $nama_gejala,
				'bobot' => $bobot,
				'updated_by' => $updated_by,
				'updated_time' => $updated_time
								
				);
      $table_name  = 'gejala';
      $where       = array(
        'gejala.id_gejala' => $id_gejala      
			);
      $this->gejala_model->Update_data_gejala($data_update, $where, $table_name);
      echo '[{"save":"ok"}]';
     }
   }
   
  public function gejala_get_by_id()
   {
    $table_name = 'gejala';
    $id         = $_GET['id'];
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
				gejala.status,
        ";
    $where      = array(
      'gejala.id_gejala' => $id
    );
    $order_by   = 'gejala.id_gejala';
    echo json_encode($this->Gejala_model->get_by_id($table_name, $where, $fields, $order_by));
   }
   
  public function hapus_gejala()
   {
    $table_name = 'gejala';
    $id         = $_GET['id'];
    $where      = array(
      'gejala.id_gejala' => $id
    );
    $t          = $this->Gejala_model->json_semua_gejala($where, $table_name);
    if ($t == 0)
     {
      echo ' {"errors":"Yes"} ';
     }
    else
     {
      $data_update = array(
        'gejala.status' => 99
      );
      $where       = array(
        'gejala.id_gejala' => $id
      );
      $this->Gejala_model->update_data_gejala($data_update, $where, $table_name);
      echo ' {"errors":"No"} ';
     }
   }

	public function search_gejala()
		{
		$key_word = trim($this->input->post('key_word'));
    $halaman    = $this->input->post('halaman');
    $limit      = 15;
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
    echo json_encode($this->Gejala_model->search_gejala($fields, $where, $limit, $start, $key_word, $order_by));
		}
    
	public function count_all_search_gejala()
		{
			$table_name = 'gejala';
			$key_word = $_GET['key_word'];
			$field = 'nama_gejala';
			$where = array(
					''.$table_name.'.status' => 1
				);
			$a = $this->gejala_model->count_all_search_gejala($where, $key_word, $table_name, $field);
			$limit = 20;
			echo ceil($a/$limit); 
		}
    
  public function json_all_gejala()
   {
    $where      = array(
      'gejala.status !=' => 99
    );
    $a          = $this->Gejala_model->json_semua_gejala($where);
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
    echo json_encode($this->Gejala_model->json_all_gejala($where, $limit, $start, $fields, $order_by));
   }
  
}
