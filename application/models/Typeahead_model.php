<?php

class Typeahead_model extends CI_Model {
    
	function __construct() {
        parent::__construct();
    }

	function search_contoh($q) {
		$this->db->select("
			contoh.id_contoh,
			contoh.kode_contoh,
			contoh.nama_contoh,
			contoh.nama_contoh as value
			");
		$this->db->like('contoh.nama_contoh', $q);
		$this->db->or_like('contoh.kode_contoh', $q);
		$this->db->limit('10');
		$result = $this->db->get('contoh');
		return $result->result_array();
	}
	
} 