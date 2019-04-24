<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mauth extends CI_Model {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function get_auth($data){
		return $this->db->query('
		select a.id_user,a.`password` as pwd,a.nama_lengkap,a.email,a.`level`,
		a.id_unitkerja,b.* 
		from user1 a 
		inner join guru b on b.IDCard = a.id_user 
		where a.id_user = "'.$data['user_name'].'" 
		and a.`password` = md5("'.$data['user_pass'].'")');
		
	}
	
	function toko(){
		return $this->db->query("SELECT * FROM profile");
	}
	function get_akses($data){
		return $this->db->query('
		select a.niplog,a.passlog as pwd,b.Nama as nama_lengkap,a.akseslog as `lvl`,
		b.IDUnitKerja as id_unitkerja,b.* 
		from akses a 
		inner join guru b on b.IDCard = a.niplog 
		where a.niplog = "'.$data['user_name'].'" 
		and a.passlog = encode("'.$data['user_pass'].'","SIF-Tech")');
		
	}

}

?>