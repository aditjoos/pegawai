<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller{
	function __construct(){
	    parent::__construct();
			$this->load->model('Mauth');
			
	}
	
	function index(){
		$data['toko']=$this->Mauth->toko();
		$this->load->view('front/login',$data);		
	}
	
	function auth(){
		$usr = $this->input->get_post('username',true);
		$pwd = $this->input->get_post('password',true);
		
		$data = array(
			'user_name'		=> $usr,
			'user_pass'		=> $pwd
		);
		
		$result = $this->Mauth->get_akses($data);
		$cb = array();
		
		$path = "assets/tmp/foto";
		
		if($result->num_rows() > 0){
			foreach ($result->result() as $row) {
				$session = array(
					'id_user'			=> $row->niplog,
					'nama'				=> $row->nama_lengkap,
					'user_level'	=> $row->lvl,
					//'user_email'	=> $row->email,
					'dept'				=> $row->id_unitkerja,
					'stt_login'		=> TRUE,
					'foto'				=> 'data:image/jpeg;base64,'.base64_encode($row->foto)
				);	
				//$file = fopen($path."/".$row->id_user,"w");
				//fwrite($file, 'data:image/jpeg;base64,'.base64_encode($row->Foto));
   			//fclose($file);
			}
			$this->session->set_userdata($session);
			
			$cb["status"]=1;
			$cb["message"]="Username dan password OK.";
		}else{
			$cb["status"]=0;
			$cb["message"]="Username dan password tidak valid.";
		}
		echo json_encode($cb);
		
	}
	
}

?>