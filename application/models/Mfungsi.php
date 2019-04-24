<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mfungsi extends CI_Model {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function cek_jadwal($data){
		return $this->db->query('
			select a.k_instansi,a.jenis,a.ins_nickName as nama_instansi,
			c.id as id_kategori,c.kategori,
			b.tgl_mulai,b.tgl_selesai,b.jns_proses,b.stt_allow 
			from ref_instansi a 
			inner join jadwal_detail b on b.k_instansi = a.k_instansi 
			inner join jadwal c on c.id = b.id_kategori 
			where a.k_instansi = 1
		');
	}
	
}

?>