<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konsultasi_model extends CI_Model
{
	public function json_all_gejala($where, $limit, $start, $fields, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get('gejala');
		return $result->result_array();
    }
    
	function json_semua_gejala($where) {	
		$this->db->from('gejala');
		$this->db->where($where);
		return $this->db->count_all_results(); 
	}	
	
}