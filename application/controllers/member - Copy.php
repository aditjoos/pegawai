<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class member extends CI_Controller{
	function __construct(){
	    parent::__construct();
			$this->load->model('mmember');
			$this->load->library('xfungsi');
			$this->xfungsi->cek_session();
			date_default_timezone_set("Asia/Jakarta");
	}

	function index(){

		$time = date("Y_m");
		$table = "pp14_".$time;
		$id = $this->session->userdata('id_user');
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$info['biodata']	= $this->get_biodata();
		$info['rekap']		= $this->get_rekap_presensi();
		$info['rekappp14']	= $this->mmember->tunkinpp14($table,$id);
		$info['report1']	= $this->mmember->akum_kurang_jam($table,$id);
		$info['report2']	= $this->mmember->nilai_pengurang_tunkin($table,$id);
		$info['report3']	= $this->mmember->point_potong_tunkin($table,$id);
		$info['report4']	= $this->mmember->total_potongan($table,$id);
		$info['report5']	= $this->mmember->point_tunkin($table,$id);
		$data['main_page'] 	= $this->load->view('member/dashboard',$info,true);
		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/dashboard_js','',true);

		//$page['view_page'] 	= $this->load->view('template/body',$data,true);	
		//$this->load->view('template/view_page',$page);	

		$this->load->view('template/body',$data);
	}

	function profil(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$data['main_page'] 	= $this->load->view('member/profile2','',true);

		$data['modal'] 			= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 			= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/profile2_js','',true);

		$this->load->view('template/body',$data);		
	}

	function log_out(){
		$this->session->sess_destroy();
		redirect('/');
	}

	function akun_pegawai(){

		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		//$info['biodata']		= $this->get_biodata();
		//$info['rekap']			= $this->get_rekap_presensi();
		$data['main_page'] 	= $this->load->view('member/akun','',true);

		$data['modal'] 			= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 			= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/akun_js','',true);

		//$page['view_page'] 	= $this->load->view('template/body',$data,true);	
		//$this->load->view('template/view_page',$page);	

		$this->load->view('template/body',$data);
	}

	function transparansi(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);
		$data['main_page'] 	= $this->load->view('member/ngintip','',true);
		$data['modal'] 			= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 			= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/ngintip_js','',true);
		$this->load->view('template/body',$data);
	}

	function under_construction(){

		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$data['main_page'] 	= $this->load->view('404/under_const','',true);

		$data['modal'] 			= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 			= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('404/under_const_js','',true);

		$this->load->view('template/body',$data);
	}

	function get_biodata(){
		$id = $this->session->userdata('id_user');
		$data = array(
			'id'		=> $id
		);

		$cb = array();
		$result = $this->mmember->get_biodata($data)->result();
		foreach($result as $key => $val){
			$cb = $val;
		}
		return json_encode($cb);

	}

	function get_rekap_presensi(){
		$id = $this->session->userdata('id_user');
		$bulan = $this->input->get_post('bulan',true);
		$tahun = $this->input->get_post('tahun',true);

		date_default_timezone_set('Asia/Jakarta');

		if(isset($bulan,$tahun)){
			$set 			= $tahun.'-'.$bulan;
			$date 		= new DateTime($set.'-01 12:00:00');
			$periode 	= $date->format('m').$date->format('Y');	
		}else{
			$periode = date('m').date('Y');
		}

		//echo $periode;

		$data = array(
			'id'			=> $id,
			'periode'	=> $periode,
		);

		if($this->mmember->is_table_exist('presensi_sum_'.$periode)){
			$cb = array();
			$result = $this->mmember->get_rekap($data)->result();
			foreach($result as $key => $val){
				$cb = $val;
			}
			return json_encode($cb);
		}else{
			return json_encode(array('message' => 'data tidak tersedia'));
		};

		/*
		if($this->mmember->is_table_exist($data)){
			echo 1;
		}else{
			echo 0;
		};
		*/

	}

	function keysToLower($obj){
	    $type = (int) is_object($obj) - (int) is_array($obj);
	    if ($type === 0) return $obj;
	    reset($obj);
	    while (($key = key($obj)) !== null)
	    {
	        $element = keysToLower(current($obj));
	        switch ($type)
	        {
	        case 1:
	            if (!is_int($key) && $key !== ($keyLowercase = strtolower($key)))
	            {
	                unset($obj->{$key});
	                $key = $keyLowercase;
	            }
	            $obj->{$key} = $element;
	            break;
	        case -1:
	            if (!is_int($key) && $key !== ($keyLowercase = strtolower($key)))
	            {
	                unset($obj[$key]);
	                $key = $keyLowercase;
	            }
	            $obj[$key] = $element;
	            break;
	        }
	        next($obj);
	    }
	    return $obj;
	}
	function ajax_rekap_presensi(){
		$id 			= $this->session->userdata('id_user');
		$periode 		= $this->input->get_post('periode',true);
		$periode_tukin 	= substr($periode, 2,4).'_'.substr($periode, 0,2);	
		$periode_tukin2	= 'pp14_'.substr($periode, 2,4).'_'.substr($periode, 0,2);	

		$data = array(
			'id'		=> $id,
			'periode'	=> $periode,
			'tukin'		=> $periode_tukin,
			'pp14'		=> $periode_tukin2,
		);

		if($this->mmember->is_table_exist('presensi_sum_'.$periode)){

			$cb_tmp = array();
			$cb1 = array();
			$cb2 = array();
			$cb3 = array();
			$cb4 = array();
			$cb5 = array();

			$res1 = $this->mmember->get_rekap($data)->result();
			$res2 = $this->mmember->get_presensi($data)->result();
			$res3 = $this->mmember->detail_presensi($data);

			//$res4 = $this->mmember->get_tukin($data)->result();

			if($this->mmember->is_table_exist($periode_tukin.'_tunkin')){
				$res4 = $this->mmember->get_tukin($data)->result();
				foreach($res4 as $key => $val){
					$cb4[strtolower($key)] = $val;
				}
			}

			foreach($res1 as $key => $val){
				$cb_tmp = $val;
			}

			foreach($cb_tmp as $key => $val){
				$cb1[strtolower($key)] = $val;
			}

			if($this->mmember->is_table_exist($periode_tukin2)){
				$res9 = $this->mmember->tunkinpp14($periode_tukin2,$id)->result();
				foreach($res9 as $key => $val){
					$cb5[strtolower($key)] = $val;
				}
				$res01 = $this->mmember->akum_kurang_jam($periode_tukin2,$id)->result();
				foreach($res01 as $key => $val){
					$cb6[strtolower($key)] = $val;
				}
				$res02 = $this->mmember->nilai_pengurang_tunkin($periode_tukin2,$id)->result();
				foreach($res02 as $key => $val){
					$cb7[strtolower($key)] = $val;
				}
				$res03 = $this->mmember->point_potong_tunkin($periode_tukin2,$id)->result();
				foreach($res03 as $key => $val){
					$cb8[strtolower($key)] = $val;
				}
				$res04 = $this->mmember->total_potongan($periode_tukin2,$id)->result();
				foreach($res04 as $key => $val){
					$cb9[strtolower($key)] = $val;
				}
				$res05 = $this->mmember->point_tunkin($periode_tukin2,$id)->result();
				foreach($res05 as $key => $val){
					$cb10[strtolower($key)] = $val;
				}
			}

			$i=0;
			foreach($res2 as $key => $val){
				$cb2[$key] = $val;

				$i++;
				if($val->jammasuk1!='00:00:00' && strtolower($val->jenis)=='m'){
					$cb3[] = array(
							'id'		=> $i,
							'title'		=> 'Masuk',
							'start'		=> $val->tgl.' '.$val->jammasuk1,
							'allDay'	=> false,
							'color'		=> "#44aed8",
							'jenis'		=> 'mm', //masuk masuk
						);
				}

				if($val->jamkeluar1!='00:00:00' && strtolower($val->jenis)=='m'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> 'Keluar',
							'start'		=> $val->tgl.' '.$val->jamkeluar1,
							'allDay'	=> false,
							'color'		=> "#f2b136",
							'jenis'		=> 'mk', //masuk keluar
						);
				}

				if(strtolower($val->jenis)=='l'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> 'Libur',
							'start'		=> $val->tgl,
							'allDay'	=> true,
							'color'		=> "#e75f47",
							'jenis'		=> 'lb',
						);
				}

				if(strtolower($val->jenis)=='dl'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> 'Dinas Luar',
							'start'		=> $val->tgl,
							'allDay'	=> true,
							'color'		=> "#8c6954",
							'jenis'		=> 'dl',
						);
				}

				if(strtolower($val->jenis)=='c'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> 'Cuti',
							'start'		=> $val->tgl,
							'allDay'	=> true,
							'color'		=> "#91c056",
							'jenis'		=> 'ct',
						);
				}

				if(strtolower($val->jenis)=='i'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> 'Ijin',
							'start'		=> $val->tgl,
							'allDay'	=> true,
							'color'		=> "#3fb497",
							'jenis'		=> 'ij',
						);
				}

				if(strtolower($val->jenis)=='s'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> 'Sakit',
							'start'		=> $val->tgl,
							'allDay'	=> true,
							'color'		=> "#f2e394",
							'jenis'		=> 'sk',
						);
				}

				if(strtolower($val->jenis)=='-'){
					$cb3[] = array(
							'id'		=> $i,
							'title'		=> 'Tanpa Ketrngn.',
							'start'		=> $val->tgl,
							'allDay'	=> true,
							'color'		=> "#3a434a",
							'jenis'		=> 'tk',
						);
				}
			}

			$hasil = array(
				'rekap'			=> $cb1,
				'presensi' 		=> $cb2,
				'kalender'		=> $cb3,
				'detail'		=> $res3,
				// 'tukin'			=> $cb4,
				'pp14'			=> $cb5,
				'result1'		=> $cb6,
				'result2'		=> $cb7,
				'result3'		=> $cb8,
				'result4'		=> $cb9,
				'result5'		=> $cb10
			);

			/*
			$hasil = array(
				'rekap'			=> $res1,
				'presensi' 	=> $res2,
				//'kalender'	=> $cb3,
				'detail'		=> $res3,
				'tukin'			=> $cb4,
			);
			*/ 
			echo json_encode($hasil);

			//echo $data;
		}
		else{
			echo json_encode(array('message' => 'data tidak tersedia'));
		};

	}

	function kalender(){
		$id = $this->session->userdata('id_user');
		//$periode = date('mY',$this->input->get_post('periode',true));
		$periode = $this->input->get_post('periode',true);

		$data = array(
			'id'			=> $id,
			'periode'	=> $periode,
		);

		if($this->mmember->is_table_exist($data)){
			$cb3 = array();
			$res2 = $this->mmember->get_presensi($data)->result();

			$i=0;
			foreach($res2 as $key => $val){
				$i++;
				if($val->JamMasuk1!='00:00:00' && strtolower($val->Jenis)=='m'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> 'Masuk',
							'start'		=> $val->Tgl.' '.$val->JamMasuk1,
							'allDay'	=> false,
							'color'		=> "#428bca",
						);
				}

				if($val->JamKeluar1!='00:00:00' && strtolower($val->Jenis)=='m'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> 'Keluar',
							'start'		=> $val->Tgl.' '.$val->JamKeluar1,
							'allDay'	=> false,
							'color'		=> "#f37864",
						);
				}

				if(strtolower($val->Jenis)!='l' && strtolower($val->Jenis)!='m' && strtolower($val->Jenis)!='-'){
					$cb3[] = array(
							'id'			=> $i,
							'title'		=> $val->Ket,
							'start'		=> $val->Tgl,
							'allDay'	=> true,
							'color'		=> "#405C63",
						);
				}

			}

			echo json_encode($cb3);
		}else{
			//echo json_encode(array('message' => 'data tidak tersedia'));
			echo json_encode($data);
		};

		//echo json_encode($data);
	}

	function cek_auth(){
		$id				= $this->session->userdata('id_user');
		$old_pwd	= $this->input->get_post('old-pwd',true);
		$new_pwd	= $this->input->get_post('new-pwd',true);

		$data = array(
			'id'			=> $id,
			'old_pwd'	=> $old_pwd,
			'new_pwd'	=> $new_pwd
		);

		$res = $this->mmember->cek_auth($data);
		$cb = array();
		if($res->num_rows() > 0){
			$this->mmember->update_akun($data);
			$cb["status"]=1;
			$cb["message"]="Pengaturan telah disimpan.";
		}else{
			$cb["status"]=0;
			$cb["message"]="Password lama anda salah !";
		}

		echo json_encode($cb);
	}

	function ngintip_absen(){
		$tgl 	= $this->input->get_post('tgl',true);

		$start 	= new DateTime();
		$start->modify('-6 day');
		//$start->modify('-6 year');

		$end 		= new DateTime();
		//$end->modify('+6 year');

		try {
			$d = new DateTime($tgl);
		} catch (exception $e) {
			$d = new DateTime();
		}

		$stt = $this->cek_ijin_h5($d,$start,$end);

		if($stt==0){
			$data = array(
				'periode'	=> date_format($d,'mY'),
				'tgl'		=> date_format($d,'Y-m-d'),
				'start'		=> date_format($start,'Y-m-d'),
				'end'		=> date_format($end,'Y-m-d'),
				'req'		=> 'absen',
				'idku' 		=> $this->session->userdata('id_user')
			);
			/*
			$res = $this->mmember->ngintip_absen($data)->result();
			$cb = array(
				'status'=> 1,
				'message'	=> 'OK.',
				'data'	=> $res,
				'param'	=> $data
			);
			*/
			
			$cek1 = $this->mmember->selectall();
			foreach($cek1->result_array() as $az){
				$tampil_web = $az['tampil_web'];
			}
			
			$callback = array();
			if($this->mmember->is_table_exist('tmp_presensi_'.$data['periode'])){
				
				if($tampil_web == "INDIVIDU"){
					$res1 = $this->mmember->get_masuk_keluar($data);
				}
				
			
			$i=-1;
			foreach($res1->result() as $key1 => $val1){
				$i++;
				//$x = $val1->row();
				$callback[$i]['id'] 		= $val1->idcard;
				$callback[$i]['nama'] 		= $val1->nama;
				$callback[$i]['unit_kerja'] = $val1->namaunit;

				$data['idcard'] = $val1->idcard;

				$data['req'] = 'masuk';				
				$res2 = $this->mmember->get_masuk_keluar($data);
				if($res2->num_rows() > 0){
					$y = $res2->row();
					if($y->stt=='masuk'){
						$callback[$i]['jam_masuk'] 				= $y->jam;
						$callback[$i]['id_fp_masuk'] 			= $y->kode_mesin;
						$callback[$i]['lokasi_fp_masuk'] 	= $y->lokasi;	
					}else{
						$callback[$i]['jam_masuk'] 				= '-';
						$callback[$i]['id_fp_masuk'] 			= '-';
						$callback[$i]['lokasi_fp_masuk'] 	= '-';
					}					
				} else {
					$callback[$i]['jam_masuk'] 				= '-';
					$callback[$i]['id_fp_masuk'] 			= '-';
					$callback[$i]['lokasi_fp_masuk'] 	= '-';
				}

				$data['req'] = 'keluar';
				$res3 = $this->mmember->get_masuk_keluar($data);	
				if($res3->num_rows() > 0){
					$z = $res3->row();
					if($z->stt=='keluar'){
						$callback[$i]['jam_keluar'] 				= $z->jam;
						$callback[$i]['id_fp_keluar'] 			= $z->kode_mesin;
						$callback[$i]['lokasi_fp_keluar'] 	= $z->lokasi;	
					}else{
						$callback[$i]['jam_keluar'] 				= '-';
						$callback[$i]['id_fp_keluar'] 			= '-';
						$callback[$i]['lokasi_fp_keluar'] 	= '-';
					}					
				} else {
					$callback[$i]['jam_keluar'] 				= '-';
					$callback[$i]['id_fp_keluar'] 			= '-';
					$callback[$i]['lokasi_fp_keluar'] 	= '-';
				}
			}

				$cb = array(
					'status'	=> 1,
					'message'	=> 'OK.',
					'data'		=> $callback,
					'param'		=> $data
				);

			}else{
				$cb = array(
					'status'	=> 0,
					'message'	=> 'Tanggal pengecekan melewati range yang sudah ditetapkan.',
					'data'		=> $callback,
					'param'		=> $data
				);
			}

		}else{
			$x = $d;
			$d = new DateTime();
			$data = array(
				'periode'	=> date_format($d,'mY'),
				'tgl'			=> date_format($d,'Y-m-d'),
				'start'		=> date_format($start,'Y-m-d'),
				'end'			=> date_format($end,'Y-m-d'),
				'x'				=> date_format($x,'Y-m-d'),
				'req'			=> 'absen'
			);
			$callback = array();

			if($this->mmember->is_table_exist('tmp_presensi_'.$data['periode'])){

			$res1 = $this->mmember->get_masuk_keluar($data);
			$i=-1;
			foreach($res1->result() as $key1 => $val1){
				$i++;
				//$x = $val1->row();
				$callback[$i]['id'] 				= $val1->idcard;
				$callback[$i]['nama'] 			= $val1->nama;
				$callback[$i]['unit_kerja'] = $val1->namaunit;

				$data['idcard'] = $val1->idcard;

				$data['req'] = 'masuk';				
				$res2 = $this->mmember->get_masuk_keluar($data);
				if($res2->num_rows() > 0){
					$y = $res2->row();
					if($y->stt=='masuk'){
						$callback[$i]['jam_masuk'] 				= $y->jam;
						$callback[$i]['id_fp_masuk'] 			= $y->kode_mesin;
						$callback[$i]['lokasi_fp_masuk'] 	= $y->lokasi;	
					}else{
						$callback[$i]['jam_masuk'] 				= '-';
						$callback[$i]['id_fp_masuk'] 			= '-';
						$callback[$i]['lokasi_fp_masuk'] 	= '-';
					}					
				} else {
					$callback[$i]['jam_masuk'] 				= '-';
					$callback[$i]['id_fp_masuk'] 			= '-';
					$callback[$i]['lokasi_fp_masuk'] 	= '-';
				}

				$data['req'] = 'keluar';
				$res3 = $this->mmember->get_masuk_keluar($data);	
				if($res3->num_rows() > 0){
					$z = $res3->row();
					if($z->stt=='keluar'){
						$callback[$i]['jam_keluar'] 				= $z->jam;
						$callback[$i]['id_fp_keluar'] 			= $z->kode_mesin;
						$callback[$i]['lokasi_fp_keluar'] 	= $z->lokasi;	
					}else{
						$callback[$i]['jam_keluar'] 				= '-';
						$callback[$i]['id_fp_keluar'] 			= '-';
						$callback[$i]['lokasi_fp_keluar'] 	= '-';
					}					
				} else {
					$callback[$i]['jam_keluar'] 				= '-';
					$callback[$i]['id_fp_keluar'] 			= '-';
					$callback[$i]['lokasi_fp_keluar'] 	= '-';
				}
			}

			}
			$cb = array(
				'status'	=> 0,
				'message'	=> 'Tanggal pengecekan melewati range yang sudah ditetapkan.',
				'data'		=> $callback,
				'param'		=> $data
			);
		}

		echo json_encode($cb);
	}

	function cek_ijin_h5($day,$start,$end){
		if($day >= $start && $day <= $end){
			return 0; //OK
		}else{
			if($day < $start){
				return 1; //lewat h-5
			}else{
				return 2; //lewat h+1
			}
		}
	}	

	function biodata(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$info['biodata']		= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/biodata',$info,true);

		$data['modal'] 			= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 			= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/biodata_js','',true);

		$this->load->view('template/body',$data);
	}

	function biodata2(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$info['biodata']		= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/biodata2',$info,true);

		$data['modal'] 			= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 			= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/biodata_js','',true);

		$this->load->view('template/body',$data);
	}

	function get_biodata2(){
		$id		= $this->session->userdata('id_user');
		$data = array(
			'id'			=> $id,
		);

		$cb1 = array();
		$cb2 = array();
		$result = $this->mmember->get_biodata2($data)->result();
		foreach($result as $key => $val){
			$cb1 = $val;
		}

		foreach($cb1 as $key2 => $val2){
			$cb2[strtolower($key2)] = $val2;
		}
		return json_encode($cb2);

	}

	function pivot(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		//$info['pivot']			= $this->get_pivot();
		$data['main_page'] 	= $this->load->view('member/pivot','',true);

		$data['modal'] 			= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 			= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/pivot_js','',true);

		$this->load->view('template/body',$data);
	}

	function get_pivot(){
		$result = $this->mmember->get_pivot()->result();
		echo json_encode($result);
	}

}//end class

?>