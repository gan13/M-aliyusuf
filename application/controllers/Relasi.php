<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relasi extends CI_Controller {
  function __construct()
   {
    parent::__construct();
    $this->load->model('Crud_model');
    $this->load->model('Relasi_model');
   }
	public function index()
	{
    $where             = array(
      'relasi.status !=' => 99
    );
    $a                 = $this->Relasi_model->json_semua_relasi($where);
    $data['per_page']  = 20;
    $data['total']     = ceil($a / 20);
		$data['main_view']     = 'relasi/home';
		$this->load->view('sistem_pakar', $data);
	}

  public function json_all_relasi()
   {
    $id_diagnosa         = trim($this->input->post('id_diagnosa'));
    $halaman    = $this->input->get('halaman');
    $limit      = 200;
    $start      = ($halaman - 1) * $limit;
    $fields     = "
				
				relasi.id_relasi,
				relasi.id_gejala,
				relasi.id_diagnosa,
				relasi.created_by,
				relasi.created_time,
				relasi.updated_by,
				relasi.updated_time,
				relasi.deleted_by,
				relasi.deleted_time,
				relasi.keterangan,
				relasi.status,
        (SELECT gejala.nama_gejala FROM gejala WHERE gejala.id_gejala=relasi.id_gejala) as nama_gejala
								
				";
    $where      = array(
      'relasi.status !=' => 99,
      'relasi.id_diagnosa' => $id_diagnosa
    );
    $order_by   = 'relasi.id_relasi';
    echo json_encode($this->Relasi_model->json_all_relasi($where, $limit, $start, $fields, $order_by));
   }
  public function simpan_relasi()
   {
		$this->form_validation->set_rules('id_gejala', 'id_gejala', 'required');
		$id_relasi         = trim($this->input->post('id_relasi'));
		$id_diagnosa         = trim($this->input->post('id_diagnosa'));
		$id_gejala        = trim($this->input->post('id_gejala'));
		$created_by         = $this->session->userdata('id_users');
		$created_time         = date('Y-m-d H:i:s');
		$keterangan         = trim($this->input->post('keterangan'));
		
    $table_name = 'relasi';
    $where      = array(
      'relasi.id_relasi' => $id_relasi,
      'relasi.id_diagnosa' => $id_diagnosa,
      'relasi.id_gejala' => $id_gejala
    );
    $a          = $this->Crud_model->semua_data($where, $table_name);
    
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      if($a == 0){
        $data_input = array(
			
				'id_relasi' => $id_relasi,
				'id_diagnosa' => $id_diagnosa,
				'id_gejala' => $id_gejala,
				'created_time' => $created_time,
				'keterangan' => $keterangan,
				'status' => 1
								
				);
        $table_name = 'relasi';
        $id         = $this->Relasi_model->simpan_relasi($data_input, $table_name);
        echo $id;
      }
      else{
        echo 'doble';
      }
     }
   }
   
  public function update_data_relasi()
   {
    $this->form_validation->set_rules('id_relasi', 'id_relasi', 'required');
		$id_relasi         = trim($this->input->post('id_relasi'));
		$id_gejala         = trim($this->input->post('id_gejala'));
		$updated_by         = $this->session->userdata('id_users');
		$updated_time         = date('Y-m-d H:i:s');
		$keterangan         = trim($this->input->post('keterangan'));
		if ($this->form_validation->run() == FALSE)
     {
      echo '[]';
     }
    else
     {
      $data_update = array(
			
				'id_gejala' => $id_gejala,
				'updated_by' => $updated_by,
				'updated_time' => $updated_time,
				'keterangan' => $keterangan
								
				);
      $table_name  = 'relasi';
      $where       = array(
        'relasi.id_relasi' => $id_relasi      
			);
      $this->Relasi_model->update_data_relasi($data_update, $where, $table_name);
      echo '[{"save":"ok"}]';
     }
   }
   
  public function il_simpan_relasi()
   {
		$this->form_validation->set_rules('id_relasi', 'id_relasi', 'required');
		$id_relasi         = trim($this->input->post('id_relasi'));
		$id_gejala         = trim($this->input->post('id_gejala'));
		$updated_by         = $this->session->userdata('id_users');
		$updated_time         = date('Y-m-d H:i:s');
		$keterangan         = trim($this->input->post('keterangan'));
				
		if ($this->form_validation->run() == FALSE)
     {
      echo 'Error';
     }
    else
     {
      $data_update = array(
        
				'id_gejala' => $id_gejala,
				'updated_by' => $updated_by,
				'updated_time' => $updated_time,
				'keterangan' => $keterangan
								
				);
      $table_name  = 'relasi';
      $where       = array(
        'relasi.id_relasi' => $id_relasi      );
      $this->Relasi_model->update_data_relasi($data_update, $where, $table_name);
      echo 'Success';
     }
   }
  public function relasi_get_by_id()
   {
    $table_name = 'relasi';
    $id         = $_GET['id'];
    $fields     = "
				relasi.id_relasi,
				relasi.id_gejala,
				relasi.created_by,
				relasi.created_time,
				relasi.updated_by,
				relasi.updated_time,
				relasi.deleted_by,
				relasi.deleted_time,
				relasi.temp,
				relasi.keterangan,
				relasi.status,
        ";
    $where      = array(
      'relasi.id_relasi' => $id
    );
    $order_by   = 'relasi.id_relasi';
    echo json_encode($this->Relasi_model->get_by_id($table_name, $where, $fields, $order_by));
   }
   
  public function hapus_relasi()
   {
    $table_name = 'relasi';
    $id         = $_GET['id'];
    $where      = array(
      'relasi.id_relasi' => $id
    );
    $t          = $this->Relasi_model->json_semua_relasi($where, $table_name);
    if ($t == 0)
     {
      echo ' {"errors":"Yes"} ';
     }
    else
     {
      $data_update = array(
        'relasi.status' => 99
      );
      $where       = array(
        'relasi.id_relasi' => $id
      );
      $this->Relasi_model->update_data_relasi($data_update, $where, $table_name);
      echo ' {"errors":"No"} ';
     }
   }
  public function cari_relasi()
   {
    $table_name = 'relasi';
    $key_word   = $_GET['key_word'];
    $where      = array(
      'relasi.status !=' => 99
    );
    $field      = 'relasi.id_gejala';
    $a          = $this->Relasi_model->count_all_search_relasi($where, $key_word, $table_name, $field);
    if (empty($key_word))
     {
      echo '[]';
      exit;
     }
    else if ($a == 0)
     {
      echo '[{"jumlah":"0"}]';
      exit;
     }
    $fields     = "
				relasi.id_relasi,
				relasi.id_gejala,
				relasi.created_by,
				relasi.created_time,
				relasi.updated_by,
				relasi.updated_time,
				relasi.deleted_by,
				relasi.deleted_time,
				relasi.temp,
				relasi.keterangan,
				relasi.status,
			";
    $where      = array(
      'relasi.status !=' => 99
    );
    $field_like = 'relasi.id_gejala';
    $limit      = $_GET['limit'];
    $start      = (($_GET['start']) * $limit);
    $order_by   = ''.$field_like.'';
    echo json_encode($this->Relasi_model->search($table_name, $fields, $where, $limit, $start, $field_like, $key_word, $order_by));
   }
   
  public function count_all_cari_relasi()
   {
    $table_name = 'relasi';
    $key_word   = $_GET['key_word'];
    if (empty($key_word))
     {
      echo '[]';
      exit;
     }
    $where = array(
      'relasi.status !=' => 99
    );
    $field = 'relasi.id_gejala';
    $a     = $this->Relasi_model->count_all_search_relasi($where, $key_word, $table_name, $field);
    $limit = $_GET['limit'];
    echo '[{"relasi":"' . ceil($a / $limit) .'", "jumlah":"'.$a .'"}]';
   }
   public function search_relasi()
		{
		$key_word = trim($this->input->post('key_word'));
    $halaman    = $this->input->post('halaman');
    $limit      = 20;
    $start      = ($halaman - 1) * $limit;
    $fields     = "
				relasi.id_relasi,
				relasi.id_gejala,
				relasi.created_by,
				relasi.created_time,
				relasi.updated_by,
				relasi.updated_time,
				relasi.deleted_by,
				relasi.deleted_time,
				relasi.temp,
				relasi.keterangan,
				relasi.status
				";
    $where      = array(
      'relasi.status !=' => 99
    );
    $order_by   = 'relasi.id_relasi';
    echo json_encode($this->Relasi_model->search_relasi($fields, $where, $limit, $start, $key_word, $order_by));
		}
    
	public function count_all_search_relasi()
		{
			$table_name = 'relasi';
			$key_word = $_GET['key_word'];
			$field = 'id_gejala';
			$where = array(
					''.$table_name.'.status' => 1
				);
			$a = $this->Relasi_model->count_all_search_relasi($where, $key_word, $table_name, $field);
			$limit = 20;
			echo ceil($a/$limit); 
		}
}
