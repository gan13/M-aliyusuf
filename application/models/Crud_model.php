<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
	function opsi($where, $table_name, $fields, $order_by){
		$this->db->select("$fields");
		$this->db->where($where);
		$this->db->order_by($order_by);
		return $this->db->get($table_name);
	}

	public function json($where, $limit, $start, $table_name, $fields, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }

	public function json_join($where, $limit, $start, $table_name, $fields, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		if($table_name == 'operator'){
			$this->db->join('users', 'users.user_id=operator.user_id');
			}
		if($table_name == 'anggota_perpus'){
			$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
			}	
		if($table_name == 'buku'){
			$this->db->join('penerbit_buku', 'penerbit_buku.id_penerbit_buku=buku.id_penerbit_buku');
			$this->db->join('pengarang_buku', 'pengarang_buku.id_pengarang_buku=buku.id_pengarang_buku');
			$this->db->join('rak_buku', 'rak_buku.id_rak_buku=buku.id_rak_buku');
			}
		if($table_name == 'inventaris_buku'){
			$this->db->join('buku', 'buku.id_buku=inventaris_buku.id_buku');
			$this->db->join('distributor_buku', 'distributor_buku.id_distributor_buku=inventaris_buku.id_distributor_buku');
			}	
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function get_by_id($table_name, $where, $fields, $order_by) {
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function seperti($table_name, $where, $fields, $order_by, $like_data) {
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->like($like_data);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function get_by_id_join($table_name, $where, $fields, $order_by) {
		$this->db->select("$fields");
    $this->db->where($where);
		if($table_name == 'operator'){
			$this->db->join('users', 'users.user_id=operator.user_id');
			}
		if($table_name == 'anggota_perpus'){
			$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
			}	
		if($table_name == 'buku'){
			$this->db->join('penerbit_buku', 'penerbit_buku.id_penerbit_buku=buku.id_penerbit_buku');
			$this->db->join('pengarang_buku', 'pengarang_buku.id_pengarang_buku=buku.id_pengarang_buku');
			$this->db->join('rak_buku', 'rak_buku.id_rak_buku=buku.id_rak_buku');
			}
		if($table_name == 'inventaris_buku'){
			$this->db->join('buku', 'buku.id_buku=inventaris_buku.id_buku');
			$this->db->join('distributor_buku', 'distributor_buku.id_distributor_buku=inventaris_buku.id_distributor_buku');
			}
		if($table_name == 'lokal_rekam_medis'){
			$this->db->join('pasien', 'pasien.id_pasien=lokal_rekam_medis.id_pasien');
			}
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
  function save_data($data_input, $table_name)
	{
		$this->db->insert( $table_name, $data_input );
		return $this->db->insert_id();
	}
		
  function update_data($data_update, $where, $table_name)
	{
		$this->db->where($where);
		$this->db->update($table_name, $data_update);
	}
	
	function semua_data($where, $table_name) {	
		$this->db->from($table_name);
		$this->db->where($where);
		return $this->db->count_all_results(); 
	}	
	
	function like_data($where, $table_name, $like_data) {	
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->like($like_data);
		return $this->db->count_all_results(); 
	}	
	
	function count_search($where, $key_word, $table_name, $field) {	
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->like($field, $key_word);
		return $this->db->count_all_results(); 
	}
		
	public function search($table_name, $fields, $where, $limit, $start, $field_like, $key_word, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		$this->db->like($field_like, $key_word);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }	
		
	public function search_join($table_name, $fields, $where, $limit, $start, $field_like, $key_word, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		if($table_name == 'operator'){
			$this->db->join('users', 'users.user_id=operator.user_id');
			}
		if($table_name == 'anggota_perpus'){
			$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
			}	
		if($table_name == 'buku'){
			$this->db->join('penerbit_buku', 'penerbit_buku.id_penerbit_buku=buku.id_penerbit_buku');
			$this->db->join('pengarang_buku', 'pengarang_buku.id_pengarang_buku=buku.id_pengarang_buku');
			$this->db->join('rak_buku', 'rak_buku.id_rak_buku=buku.id_rak_buku');
			}
		if($table_name == 'inventaris_buku'){
			$this->db->join('buku', 'buku.id_buku=inventaris_buku.id_buku');
			$this->db->join('distributor_buku', 'distributor_buku.id_distributor_buku=inventaris_buku.id_distributor_buku');
			}
		$this->db->like($field_like, $key_word);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }

	public function json_buku_kategori_buku($where) {
		$this->db->select("
		kategori_buku.kategori_buku_nama,
		buku_kategori_buku.id_buku_kategori_buku
		");
    $this->db->where($where);
		$this->db->join('kategori_buku', 'kategori_buku.id_kategori_buku=buku_kategori_buku.id_kategori_buku');
		$this->db->order_by('kategori_buku.kategori_buku_nama');
		$result = $this->db->get('buku_kategori_buku');
		return $result->result_array();
    }

	public function json_laborat_perbagian($where, $table_name, $fields) {
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->join('comments', 'comments.id = blogs.id');
		
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
	public function show_json_latihan($table_name)
{
$result = $this->db->get($table_name);
return $result->result_array();
}
}