<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak_model extends CI_Model
{
		
	function cetak_single_table($table, $fields, $where, $order_by){
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->order_by($order_by);
		return $this->db->get($table);
	}
		
	function contoh($where, $id_puskesmas_pendaftar){
		$this->db->select("
		pus_pendaftaran.tanggal_pendaftaran,
		pus_pendaftaran.nomor_pendaftaran,
		pasien.nama_penduduk,
		(SELECT lokal_rekam_medis.no_rekam_medis FROM lokal_rekam_medis WHERE 
		lokal_rekam_medis.id_pasien=pus_pendaftaran.id_pasien and lokal_rekam_medis.id_puskesmas='".$id_puskesmas_pendaftar."') as no_rekam_medis,
		pegawai.nama_pegawai,
		(SELECT bagian_puskesmas.nama_bagian_puskesmas FROM bagian_puskesmas, pus_pelayanan WHERE 
		bagian_puskesmas.id_bagian_puskesmas=pus_pelayanan.id_bagian_puskesmas 
		and pus_pelayanan.id_pus_pendaftaran=pus_pendaftaran.id_pus_pendaftaran
		and pus_pelayanan.rujukan_dari_bagian='0'
		) as nama_bagian_puskesmas
		
		");
    $this->db->where($where);
		$this->db->join('pasien', 'pasien.id_pasien=pus_pendaftaran.id_pasien');
		$this->db->join('users', 'users.user_id=pus_pendaftaran.created_by');
		$this->db->join('pegawai', 'pegawai.nip_pegawai=users.user_name');
		
		//$this->db->join('lokal_rekam_medis', 'lokal_rekam_medis.id_puskesmas=pus_pendaftaran.id_puskesmas');
		$this->db->order_by('pus_pendaftaran.tanggal_pendaftaran');
		return $this->db->get('pus_pendaftaran');
	}
	
}