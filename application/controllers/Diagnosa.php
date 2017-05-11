<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosa extends CI_Controller {
  function __construct()
   {
    parent::__construct();
    $this->load->model('Crud_model');
    $this->load->model('Diagnosa_model');
   }
	public function index()
	{
    $where             = array(
      'diagnosa.status !=' => 99
    );
    $a                 = $this->Diagnosa_model->json_semua_diagnosa($where);
    $data['per_page']  = 15;
    $data['total']     = ceil($a / 15);
		$data['main_view']     = 'diagnosa/home';
		$this->load->view('sistem_pakar', $data);
	}

  public function simpan_diagnosa()
   {
		$this->form_validation->set_rules('kode_diagnosa', 'kode_diagnosa', 'required');
		$this->form_validation->set_rules('nama_diagnosa', 'nama_diagnosa', 'required');
		$id_diagnosa  = trim($this->input->post('id_diagnosa'));
		$kode_diagnosa  = trim($this->input->post('kode_diagnosa'));
		$nama_diagnosa  = trim($this->input->post('nama_diagnosa'));
		$keterangan     = trim($this->input->post('keterangan'));
		$created_time  = date('Y-m-d H:i:s');
		
    $table_name = 'diagnosa';
    $where      = array(
      'diagnosa.kode_diagnosa' => $kode_diagnosa,
      'diagnosa.nama_diagnosa' => $nama_diagnosa
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
			
				'id_diagnosa' => $id_diagnosa,
				'kode_diagnosa' => $kode_diagnosa,
				'nama_diagnosa' => $nama_diagnosa,
				'keterangan' => $keterangan,
				'created_time' => $created_time,
				'status' => 1
								
				);
        $table_name = 'diagnosa';
        $id         = $this->Diagnosa_model->simpan_diagnosa($data_input, $table_name);
        echo $id;
      }
      else{
        echo 'doble';
      }
     }
   }
   
  public function update_data_diagnosa()
   {
    $this->form_validation->set_rules('id_diagnosa', 'id_diagnosa', 'required');
		$this->form_validation->set_rules('nama_diagnosa', 'nama_diagnosa', 'required');
		$id_diagnosa    = trim($this->input->post('id_diagnosa'));
		$kode_diagnosa  = trim($this->input->post('kode_diagnosa'));
		$nama_diagnosa  = trim($this->input->post('nama_diagnosa'));
		$keterangan     = trim($this->input->post('keterangan'));
		$updated_time         = date('Y-m-d H:i:s');
		if ($this->form_validation->run() == FALSE)
     {
      echo '[]';
     }
    else
     {
      $data_update = array(
			
				'kode_diagnosa' => $kode_diagnosa,
				'nama_diagnosa' => $nama_diagnosa,
				'keterangan' => $keterangan,
				'updated_by' => $updated_by,
				'updated_time' => $updated_time
								
				);
      $table_name  = 'diagnosa';
      $where       = array(
        'diagnosa.id_diagnosa' => $id_diagnosa      
			);
      $this->diagnosa_model->Update_data_diagnosa($data_update, $where, $table_name);
      echo '[{"save":"ok"}]';
     }
   }
   
  public function diagnosa_get_by_id()
   {
    $table_name = 'diagnosa';
    $id         = $_GET['id'];
    $fields     = "
				diagnosa.id_diagnosa,
				diagnosa.kode_diagnosa,
				diagnosa.nama_diagnosa,
				diagnosa.keterangan,
				diagnosa.created_by,
				diagnosa.created_time,
				diagnosa.updated_by,
				diagnosa.updated_time,
				diagnosa.deleted_by,
				diagnosa.deleted_time,
				diagnosa.status,
        ";
    $where      = array(
      'diagnosa.id_diagnosa' => $id
    );
    $order_by   = 'diagnosa.id_diagnosa';
    echo json_encode($this->Diagnosa_model->get_by_id($table_name, $where, $fields, $order_by));
   }
   
  public function hapus_diagnosa()
   {
    $table_name = 'diagnosa';
    $id         = $_GET['id'];
    $where      = array(
      'diagnosa.id_diagnosa' => $id
    );
    $t          = $this->Diagnosa_model->json_semua_diagnosa($where, $table_name);
    if ($t == 0)
     {
      echo ' {"errors":"Yes"} ';
     }
    else
     {
      $data_update = array(
        'diagnosa.status' => 99
      );
      $where       = array(
        'diagnosa.id_diagnosa' => $id
      );
      $this->Diagnosa_model->update_data_diagnosa($data_update, $where, $table_name);
      echo ' {"errors":"No"} ';
     }
   }

	public function search_diagnosa()
		{
		$key_word = trim($this->input->post('key_word'));
    $halaman    = $this->input->post('halaman');
    $limit      = 15;
    $start      = ($halaman - 1) * $limit;
    $fields     = "
				diagnosa.id_diagnosa,
				diagnosa.kode_diagnosa,
				diagnosa.nama_diagnosa,
				diagnosa.keterangan,
				diagnosa.created_by,
				diagnosa.created_time,
				diagnosa.updated_by,
				diagnosa.updated_time,
				diagnosa.deleted_by,
				diagnosa.deleted_time,
				diagnosa.status
				";
    $where      = array(
      'diagnosa.status !=' => 99
    );
    $order_by   = 'diagnosa.id_diagnosa';
    echo json_encode($this->Diagnosa_model->search_diagnosa($fields, $where, $limit, $start, $key_word, $order_by));
		}
    
	public function count_all_search_diagnosa()
		{
			$table_name = 'diagnosa';
			$key_word = $_GET['key_word'];
			$field = 'nama_diagnosa';
			$where = array(
					''.$table_name.'.status' => 1
				);
			$a = $this->diagnosa_model->count_all_search_diagnosa($where, $key_word, $table_name, $field);
			$limit = 20;
			echo ceil($a/$limit); 
		}
    
  public function json_all_diagnosa()
   {
    $where      = array(
      'diagnosa.status !=' => 99
    );
    $a          = $this->Diagnosa_model->json_semua_diagnosa($where);
    $halaman    = $this->input->get('halaman');
    $limit      = 10;
    $start      = ($halaman - 1) * $limit;
    $fields     = "
				
				diagnosa.id_diagnosa,
				diagnosa.kode_diagnosa,
				diagnosa.nama_diagnosa,
				diagnosa.keterangan,
				diagnosa.created_by,
				diagnosa.created_time,
				diagnosa.updated_by,
				diagnosa.updated_time,
				diagnosa.deleted_by,
				diagnosa.deleted_time,
				diagnosa.status
								
				";
    $where      = array(
      'diagnosa.status !=' => 99
    );
    $order_by   = 'diagnosa.id_diagnosa';
    echo json_encode($this->Diagnosa_model->json_all_diagnosa($where, $limit, $start, $fields, $order_by));
   }
  
}
