<?php
class Latihan_model extends CI_Model {
	function __construct() {
	parent::__construct();
}

public function tampil_data($table_name, $order_by) {
$this->db->order_by($order_by);
return $this->db->get($table_name);
}

public function tampil_data_by_id($table_name, $where) {
$this->db->where($where);
return $this->db->get($table_name);
}

function input_data($table_name, $data_input) {
$this->db->insert($table_name, $data_input);
return $this->db->insert_id();
}

function data_update($table_name, $data_update, $where) {
$this->db->update($table_name, $data_update, $where);
}

function data_hapus($table_name, $where)
{
$this->db->delete($table_name, $where);
}

public function show_json_latihan($table_name)
{
$result = $this->db->get($table_name);
return $result->result_array();
}
}