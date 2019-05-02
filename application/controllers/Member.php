<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Member extends CI_Controller{
	function __construct(){
	    parent::__construct();
			$this->load->model('Mmember');
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
		if($this->Mmember->is_table_exist($table)){
			$info['rekappp14']	= $this->Mmember->tunkinpp14($table,$id);
			$info['report1']	= $this->Mmember->akum_kurang_jam($table,$id);
			$info['report2']	= $this->Mmember->nilai_pengurang_tunkin($table,$id);
			$info['report3']	= $this->Mmember->point_potong_tunkin($table,$id);
			$info['report4']	= $this->Mmember->total_potongan($table,$id);
			$info['report5']	= $this->Mmember->point_tunkin($table,$id);
		};
		
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
		$result = $this->Mmember->get_biodata($data)->result();
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

		if($this->Mmember->is_table_exist('presensi_sum_'.$periode)){
			$cb = array();
			$result = $this->Mmember->get_rekap($data)->result();
			foreach($result as $key => $val){
				$cb = $val;
			}
			return json_encode($cb);
		}else{
			return json_encode(array('message' => 'data tidak tersedia'));
		};

		/*
		if($this->Mmember->is_table_exist($data)){
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

		if($this->Mmember->is_table_exist('presensi_sum_'.$periode)){

			$cb_tmp = array();
			$cb1 = array();
			$cb2 = array();
			$cb3 = array();
			$cb4 = array();
			$cb5 = array();

			$res1 = $this->Mmember->get_rekap($data)->result();
			$res2 = $this->Mmember->get_presensi($data)->result();
			$res3 = $this->Mmember->detail_presensi($data);

			//$res4 = $this->Mmember->get_tukin($data)->result();

			if($this->Mmember->is_table_exist($periode_tukin.'_tunkin')){
				$res4 = $this->Mmember->get_tukin($data)->result();
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

			if($this->Mmember->is_table_exist($periode_tukin2)){
				$res9 = $this->Mmember->tunkinpp14($periode_tukin2,$id)->result();
				foreach($res9 as $key => $val){
					$cb5[strtolower($key)] = $val;
				}
				$res01 = $this->Mmember->akum_kurang_jam($periode_tukin2,$id)->result();
				foreach($res01 as $key => $val){
					$cb6[strtolower($key)] = $val;
				}
				$res02 = $this->Mmember->nilai_pengurang_tunkin($periode_tukin2,$id)->result();
				foreach($res02 as $key => $val){
					$cb7[strtolower($key)] = $val;
				}
				$res03 = $this->Mmember->point_potong_tunkin($periode_tukin2,$id)->result();
				foreach($res03 as $key => $val){
					$cb8[strtolower($key)] = $val;
				}
				$res04 = $this->Mmember->total_potongan($periode_tukin2,$id)->result();
				foreach($res04 as $key => $val){
					$cb9[strtolower($key)] = $val;
				}
				$res05 = $this->Mmember->point_tunkin($periode_tukin2,$id)->result();
				foreach($res05 as $key => $val){
					$cb10[strtolower($key)] = $val;
				}
			}else{
				echo json_encode(array('message' => 'data tidak tersedia'));
			};

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

		if($this->Mmember->is_table_exist($data)){
			$cb3 = array();
			$res2 = $this->Mmember->get_presensi($data)->result();

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
		$id			= $this->session->userdata('id_user');
		$old_pwd	= $this->input->get_post('old-pwd',true);
		$new_pwd	= $this->input->get_post('new-pwd',true);

		$data = array(
			'id'		=> $id,
			'old_pwd'	=> $old_pwd,
			'new_pwd'	=> $new_pwd
		);

		$res = $this->Mmember->cek_akses($data);
		$cb = array();
		if($res->num_rows() > 0){
			$this->Mmember->update_akses($data);
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
			
			$cek1 = $this->Mmember->selectall();
			foreach($cek1->result_array() as $az){
				$tampil_web = $az['tampil_web'];
			}
			
			// $info1 = array();
			$callback = array();
			if($this->Mmember->is_table_exist('tmp_presensi_'.$data['periode'])){
				
				if($tampil_web == "INDIVIDU"){
					$res1 = $this->Mmember->show_personal_data_absen($data)->result();
				}else{
					$res1 = $this->Mmember->show_all_data_absen($data)->result();
				};
				
				foreach($res1 as $key => $val){
						$info1[strtolower($key)] = $val;
					}
					
				$cb = array(
					'status'	=> 1,
					'message'	=> 'OK.',
					'result2'	=> $info1
				);

			}else{
				$cb = array(
					'status'	=> 0,
					'message'	=> 'Tanggal pengecekan melewati range yang sudah ditetapkan.',
					'data'		=> $callback,
					'param'		=> $data
				);
			}

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
		$data['id']		= $this->session->userdata('id_user');

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
		$result = $this->Mmember->get_biodata2($data)->result();
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
		$result = $this->Mmember->get_pivot()->result();
		echo json_encode($result);
	}

	//================================================================================================================== deny

	function riw_edu_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/riw_edu_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_edu_add_js','',true);

		$this->load->view('template/body',$data);
	}

	function opt_edu(){
		$rsl = $this->Mmember->select_all('ref_pendidikan','id','ASC')->result();

		
		$opt = "<option value=''>-</option>";
		foreach ($rsl as $key) {
			$id = $key->id;
			$nm = $key->jenjang;

			$opt .="<option value='$nm'>$nm</option>";
		}

		$data = array('opt' => $opt, );
		echo json_encode($data);
	}

	function opt_golruang(){
		$rsl = $this->Mmember->select_all('ref_golruang','id','ASC')->result();

		
		$opt = "<option value=''>-</option>";
		foreach ($rsl as $key) {
			$id = $key->id;
			$nm = $key->golongan;

			$opt .="<option value='$nm'>$nm</option>";
		}

		$data = array('opt' => $opt, );
		echo json_encode($data);
	}

	function do_upload_pendidikan(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_pendidikan";

		$edu = $_POST['edu'];
		$sekolah = $_POST["sekolah"];
		$prodi = $_POST["prodi"];
		$tahun = $_POST["tahun"];
		$tgl = $_POST["tanggal"];
		$belajar = $_POST["belajar"];
		$lokasi = $_POST["lokasi"];
		$ijasah = $_POST["ijasah"];

		$tanggal = date("Y-m-d", strtotime($tgl));

		$arr = array(
			'idcard' => $id,
			'nip' => $id,
			'tingkat_pend' => $edu,
			'nama_sekolah' => $sekolah,
			'jurusan' => $prodi,
			'thn_masuk' => $tahun,
			'thn_lulus' => $tanggal,
			'tmp_belajar' => $belajar,
			'lokasi' => $lokasi,
			'no_ijazah' => $ijasah,
		);

		$this->Mmember->insert($folder,$arr); 

		if (!is_dir('assets/uploads/' . $folder)){
	        mkdir('./assets/uploads/' . $folder, 0777, true);
	    }

		$sql = $this->Mmember->last_data1($folder,$id)->row();
		$last_rec = $sql->nomor;

		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'jenis_ajuan' => '1', 
			'no_jenis_ajuan' => $last_rec, 
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$this->Mmember->insert('ajuan',$arr1); 

	    $nm_file = $id.'_'.$last_rec;
        $config = array(
        	'upload_path' => './assets/uploads/' . $folder, 
        	'allowed_types' =>'jpg|jpeg|png|pdf', 
        	'file_name' => $nm_file, 
        );

        $this->load->library('upload',$config);
        if(is_uploaded_file($_FILES['file_image']['tmp_name'])){
	        if($this->upload->do_upload("file_image")){
	            $data = array('upload_data' => $this->upload->data());
	 			
	            //Resize and Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/uploads/'.$folder.'/'.$nm_file; 
	            $config['create_thumb']= TRUE;
	            $config['maintain_ratio'] = TRUE;
	            $config['quality']= '60%';
	            $config['width']= 600;
	            $config['max_width']= 1200;
	            $config['height']= 450;
	            $config['max_height']= 1200;
	            $config['max_size']= 3000;
	            $config['new_image']= './assets/uploads/'.$folder.'/'.$nm_file; 
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();

				$foto2	= $_FILES['file_image']['name'];
	            $pisah2 = explode('.',$foto2);
	            $ext2 	= $pisah2[1];
	            $filefix2 = $nm_file.'.'.$ext2;

	            $arr = array('nama_berkas' => $filefix2,);
				$this->Mmember->update($folder,$arr,'no',$last_rec);

	            echo json_decode($result);
	        }
        }
	}
	
	function list_pendidikan(){
		$card = $this->session->userdata('id_user');

		$tbl = "data_pendidikan";
		$arr = array('idcard' => $card, );
		$no = "1";
		$q = $this->Mmember->riwayat_ajuan($tbl,$no,$card);
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			$tbl = '';
			foreach ($rsl as $key) {
				$no = $key->no;
				$nox = $this->encrypt->encode($no);
				$nox = str_replace(array('+', '/', '='), array('-', '_', '~'), $nox);

				$tingkat_pend = $key->tingkat_pend;
				$nama_sekolah = $key->nama_sekolah;
				$jurusan = $key->jurusan;
				$thn_masuk = $key->thn_masuk;
				$thn_lulus = $key->thn_lulus;
				$tmp_belajar = $key->tmp_belajar;
				$lokasi = $key->lokasi;
				$no_ijazah = $key->no_ijazah;
				$file = $key->nama_berkas;
				$id_ajuan = $key->id_ajuanstatus;
				$deskripsi = $key->deskripsi;

				$tanggal = date("d-m-Y", strtotime($thn_lulus));

				if($id_ajuan == "1"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success' onclick='buka_berkas($no,1);'><i class='fa fa-picture-o'></i></button>
								<a class='btn btn-warning' href='riw_edu_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,1);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "2"){
					$info_ajuan = "<span class='label label-primary col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,1);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "3"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,1);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "4"){
					$info_ajuan = "<span class='label label-warning col-md-12'>$deskripsi</span>";
					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_edu_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,1);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "5"){
					$info_ajuan = "<span class='label label-danger col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_edu_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,1);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "6"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,1);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "7"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,1);'><i class='fa fa-picture-o'></i></button>";
				}else{
					$info_ajuan = "-";
				}

				$tbl  .= "<tr>
							<td><span style='color:black;'>$tingkat_pend</span> - <b>$nama_sekolah</b><br>jurusan: $jurusan</td>
							<td>Tahun Masuk: <span style='color:green;'>$thn_masuk</span><br>Tanggal Lulus: <span style='color:orange'>$tanggal</span></td>
							<td style='text-align:center;'>$lokasi</td>
							<td>$no_ijazah</td>
							<td style='text-align:center'>$info_ajuan</td>
							<td>
								$btn_aksi
							</td>
						</tr>";
			}
		}else{
			$tbl = "<tr><td colspan='9' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
		echo json_encode($data);

	}

	function riw_edu_edit(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$idx 	= $this->uri->segment(3);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id		= $this->encrypt->decode($idx);
		
		$tbl  	= "data_pendidikan";
		$info['tbl'] = $tbl;
		$info['id_rec'] = $idx;

		$q 		= $this->Mmember->riwayat_ajuan_detail($tbl,$id,'1')->row();
		if(isset($q)){
			$info['nm_sekolah'] = $q->nama_sekolah;
			$info['jurusan'] = $q->jurusan;
			$info['thn_masuk'] = $q->thn_masuk;
			$info['thn_lulus'] = $q->thn_lulus;
			$info['tmp_belajar'] = $q->tmp_belajar;
			$info['lokasi'] = $q->lokasi;
			$info['no_ijazah'] = $q->no_ijazah;
			$info['nama_berkas'] = $q->nama_berkas;
		}
		
		$data['main_page'] 	= $this->load->view('member/riw_edu_edit',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_edu_edit_js','',true);

		$this->load->view('template/body',$data);
	}

	function update_pendidikan(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_pendidikan";

		$edu = $this->input->post('edu',true);
		$sekolah = $this->input->post('sekolah',true);
		$prodi = $this->input->post('prodi',true);
		$tahun = $this->input->post('tahun',true);
		$tanggal = $this->input->post('tanggal',true);
		$belajar = $this->input->post('belajar',true);
		$lokasi = $this->input->post('lokasi',true);
		$ijasah = $this->input->post('ijasah',true);

		$idx = $this->input->post('id_rec',true);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id_rec	= $this->encrypt->decode($idx);

		$tanggalx = date("Y-m-d", strtotime($tanggal));

		$arr = array(
			'idcard' => $id,
			'nip' => $id,
			'tingkat_pend' => $edu,
			'nama_sekolah' => $sekolah,
			'jurusan' => $prodi,
			'thn_masuk' => $tahun,
			'thn_lulus' => $tanggalx,
			'tmp_belajar' => $belajar,
			'lokasi' => $lokasi,
			'no_ijazah' => $ijasah,
		);

		$this->Mmember->update($folder,$arr,'no',$id_rec);
		
		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
		);
		$arrx = array('no_jenis_ajuan' => $id_rec,'jenis_ajuan' => '2', );
		$this->Mmember->update2('ajuan',$arr1,$arrx);
		// $this->Mmember->update('ajuan',$arr1,'no_jenis_ajuan',$id_rec);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}

	function do_upload_dik_fungsi(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_dikfungsi";

		$nama = $_POST['nama'];
		$belajar = $_POST['belajar'];
		$lokasi = $_POST['lokasi'];
		$tgl_mulai = $_POST['tgl_mulai'];
		$tgl_selesai = $_POST['tgl_selesai'];
		$jml_jam = $_POST['jml_jam'];
		$created = $_POST['created'];

		$start = date("Y-m-d", strtotime($tgl_mulai));
		$finish = date("Y-m-d", strtotime($tgl_selesai));

		$arr = array(
			'idcard' => $id,
			'nama_diklat' => $nama,
			'tmp_belajar' => $belajar,
			'lokasi' => $lokasi,
			'tgl_mulai' => $start,
			'tgl_selesai' => $finish,
			'jml_jam' => $jml_jam,
			'penyelenggara' => $created,
		);

		$this->Mmember->insert($folder,$arr); 

		if (!is_dir('assets/uploads/' . $folder)){
	        mkdir('./assets/uploads/' . $folder, 0777, true);
	    }

		$sql = $this->Mmember->last_data1($folder,$id)->row();
		$last_rec = $sql->nomor;

		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'jenis_ajuan' => '2', 
			'no_jenis_ajuan' => $last_rec, 
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$this->Mmember->insert('ajuan',$arr1); 

	    $nm_file = $id.'_'.$last_rec;
        $config = array(
        	'upload_path' => './assets/uploads/' . $folder, 
        	'allowed_types' =>'jpg|jpeg|png|pdf', 
        	'file_name' => $nm_file, 
        );
        
        $this->load->library('upload',$config);
        if(is_uploaded_file($_FILES['file_image']['tmp_name'])){
	        if($this->upload->do_upload("file_image")){
	            $data = array('upload_data' => $this->upload->data());
	 			
	            //Resize and Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/uploads/'.$folder.'/'.$nm_file; 
	            $config['create_thumb']= TRUE;
	            $config['maintain_ratio'] = TRUE;
	            $config['quality']= '60%';
	            $config['width']= 600;
	            $config['max_width']= 1200;
	            $config['height']= 450;
	            $config['max_height']= 1200;
	            $config['max_size']= 3000;
	            $config['new_image']= './assets/uploads/'.$folder.'/'.$nm_file; 
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();
	            
	            $foto2	= $_FILES['file_image']['name'];
	            $pisah2 = explode('.',$foto2);
	            $ext2 	= $pisah2[1];
	            $filefix2 = $nm_file.'.'.$ext2;

	            $arr = array('nama_berkas' => $filefix2,);
				$this->Mmember->update($folder,$arr,'no',$last_rec);

	            echo json_decode($result);
	        }
        }
	}

	function do_upload_dik_update(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_dikfungsi";

		$nama = $_POST['nama'];
		$belajar = $_POST['belajar'];
		$lokasi = $_POST['lokasi'];
		$tgl_mulai = $_POST['tgl_mulai'];
		$tgl_selesai = $_POST['tgl_selesai'];
		$jml_jam = $_POST['jml_jam'];
		$created = $_POST['created'];
		$idx = $_POST['id_rec'];
		$id_rec	= $this->encryption->decrypt($idx);

		$start = date("Y-m-d", strtotime($tgl_mulai));
		$finish = date("Y-m-d", strtotime($tgl_selesai));

		$arr = array(
			'idcard' => $id,
			'nama_diklat' => $nama,
			'tmp_belajar' => $belajar,
			'lokasi' => $lokasi,
			'tgl_mulai' => $start,
			'tgl_selesai' => $finish,
			'jml_jam' => $jml_jam,
			'penyelenggara' => $created,
		);

		$this->Mmember->update($folder,$arr,'no',$id_rec);

		if (!is_dir('assets/uploads/' . $folder)){
	        mkdir('./assets/uploads/' . $folder, 0777, true);
	    }

		$sql = $this->Mmember->last_data1($folder,$id)->row();
		$last_rec = $sql->nomor;

		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);

		$arrx = array('no_jenis_ajuan' => $id_rec,'jenis_ajuan' => '2', );
		$this->Mmember->update2('ajuan',$arr1,$arrx);
		// $this->Mmember->update('ajuan',$arr1,'no_jenis_ajuan',$id_rec);

	    $nm_file = $id.'_'.$last_rec;
        $config = array(
        	'upload_path' => './assets/uploads/' . $folder, 
        	'allowed_types' =>'jpg|jpeg|png|pdf', 
        	'file_name' => $nm_file, 
        );
        
        $this->load->library('upload',$config);
        if(is_uploaded_file($_FILES['file_image']['tmp_name'])){
	        if($this->upload->do_upload("file_image")){
	            $data = array('upload_data' => $this->upload->data());
	 			
	            //Resize and Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/uploads/'.$folder.'/'.$nm_file; 
	            $config['create_thumb']= TRUE;
	            $config['maintain_ratio'] = TRUE;
	            $config['quality']= '60%';
	            $config['width']= 600;
	            $config['max_width']= 1200;
	            $config['height']= 450;
	            $config['max_height']= 1200;
	            $config['max_size']= 3000;
	            $config['new_image']= './assets/uploads/'.$folder.'/'.$nm_file; 
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();
	            
	            $foto2	= $_FILES['file_image']['name'];
	            $pisah2 = explode('.',$foto2);
	            $ext2 	= $pisah2[1];
	            $filefix2 = $nm_file.'.'.$ext2;

	            $arr = array('nama_berkas' => $filefix2,);
				$this->Mmember->update($folder,$arr,'no',$id_rec);

	            echo json_decode($result);
	        }
        }
	}

	function update_dik_fungsi(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_dikfungsi";

		$jns_diklat = $this->input->post("jns_diklat",true);
		$angkatan = $this->input->post("angkatan",true);
		$created = $this->input->post("created",true);
		$tgl_mulai = $this->input->post("tgl_mulai",true);
		$tgl_selesai = $this->input->post("tgl_selesai",true);
		$predikat = $this->input->post("predikat",true);
		$lokasi = $this->input->post("lokasi",true);
		$jml_jam = $this->input->post("jml_jam",true);

		$idx = $this->input->post('id_rec',true);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id_rec	= $this->encrypt->decode($idx);

		$start = date("Y-m-d", strtotime($tgl_mulai));
		$finish = date("Y-m-d", strtotime($tgl_selesai));

		$arr = array(
			'idcard' => $id,
			'nama_diklat' => $nama,
			'tmp_belajar' => $belajar,
			'lokasi' => $lokasi,
			'tgl_mulai' => $start,
			'tgl_selesai' => $finish,
			'jml_jam' => $jml_jam,
			'penyelenggara' => $created,
		);

		$this->Mmember->update($folder,$arr,'no',$id_rec);
		
		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$arrx = array('no_jenis_ajuan' => $id_rec,'jenis_ajuan' => '4', );
		$this->Mmember->update2('ajuan',$arr1,$arrx);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}



	function riw_dik_fungsi_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/riw_dik_fungsi_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_dik_fungsi_add_js','',true);

		$this->load->view('template/body',$data);
	}

	function list_dik_fungsi(){
		$card = $this->session->userdata('id_user');

		$tbl = "data_dikfungsi"; 
		$arr = array('idcard' => $card, );
		$no = "2";
		$q = $this->Mmember->riwayat_ajuan($tbl,$no,$card);
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			$tbl = '';
			foreach ($rsl as $key) {
				$no = $key->no; 
				$nox = $this->encrypt->encode($no);
				$nox = str_replace(array('+', '/', '='), array('-', '_', '~'), $nox);


				$idcard = $key->idcard;
				$nip = $key->nip;
				$nama_diklat = $key->nama_diklat;
				$tmp_belajar = $key->tmp_belajar;
				$lokasi = $key->lokasi;
				$tgl_mulaix = $key->tgl_mulai; 
				$tgl_mulai = date("d-m-Y", strtotime($tgl_mulaix));
				$tgl_selesaix = $key->tgl_selesai;
				$tgl_selesai = date("d-m-Y", strtotime($tgl_selesaix));
				$jml_jam = $key->jml_jam;
				$penyelenggara = $key->penyelenggara;
				$file = $key->nama_berkas;
				$id_ajuan = $key->id_ajuanstatus;
				$deskripsi = $key->deskripsi;

				if($id_ajuan == "1"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success' onclick='buka_berkas($no,2);'><i class='fa fa-picture-o'></i></button>
								<a class='btn btn-warning' href='riw_dik_fungsi_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,2);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "2"){
					$info_ajuan = "<span class='label label-primary col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,2);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "3"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,2);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "4"){
					$info_ajuan = "<span class='label label-warning col-md-12'>$deskripsi</span>";
					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_dik_fungsi_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,2);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "5"){
					$info_ajuan = "<span class='label label-danger col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_dik_fungsi_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,2);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "6"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,2);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "7"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,2);'><i class='fa fa-picture-o'></i></button>";
				}else{
					$info_ajuan = "-";
				}

				$tbl .= "
						<tr>
							<td>
								<span style='color:blue;'>$nama_diklat</span><br>
								Penyelenggara: $penyelenggara
							</td>
							<td>
								$lokasi
							</td>
							<td>
								Mulai: <span style='color:green;'>$tgl_mulai</span><br>
								Selesai: <span style='color:red;'>$tgl_selesai</span>
							</td>
							<td style='text-align:center;'>$jml_jam</td>
							<td style='text-align:center'>$info_ajuan</td>
							<td>
								$btn_aksi
							</td>

						</tr>
						";
			}
		}else{
			$tbl = "<tr><td colspan='9' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
		echo json_encode($data);

	}
	 
	function open_berkas(){
		$id = $this->input->post("id",true);
		$tbl = $this->input->post("tbl",true);

		$arr = array('id_jenisajuan' => $tbl, );
		$q = $this->Mmember->select_all_order('ref_jenisajuan',$arr,'id_jenisajuan','ASC')->row();
		$tblx = $q->tabel_ref;

		$arr1 = array('no' => $id, );
		$q1 = $this->Mmember->select_all_order($tblx,$arr1,'no','ASC')->row();

		$berkas = $q1->nama_berkas;

		$data = array('info' => $berkas,'tabel' => $tblx, );
		echo json_encode($data);
	}


	function riw_dik_fungsi_edit(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$idx 	= $this->uri->segment(3);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id		= $this->encrypt->decode($idx);
		
		$tbl  	= "data_dikfungsi";
		$info['tbl'] = $tbl;
		$info['id_rec'] = $idx;

		$q 		= $this->Mmember->riwayat_ajuan_detail($tbl,$id,'2')->row();
		if(isset($q)){
			$info['nm_diklat'] = $q->nama_diklat;
			$info['lokasi'] = $q->lokasi;
			$info['tgl_mulai'] = $q->tgl_mulai;
			$info['tgl_selesai'] = $q->tgl_selesai;
			$info['jml_jam'] = $q->jml_jam;
			$info['penyelenggara'] = $q->penyelenggara;
			$info['nama_berkas'] = $q->nama_berkas;
		}


		$data['main_page'] 	= $this->load->view('member/riw_dik_fungsi_edit',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_dik_fungsi_edit_js','',true);

		$this->load->view('template/body',$data);
	}

	function hapus_data_dikfungsi(){
		$id = $this->input->post("id",true);

		$tbl = "data_dikfungsi";
		$arr = array('no' => $id,);
		$this->Mmember->delete($tbl,$arr);

		$tbl = "ajuan";
		$arr = array('no_jenis_ajuan' => $id,);
		$this->Mmember->delete($tbl,$arr);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}

	function hapus_data_pendidikan(){
		$id = $this->input->post("id",true);

		$tbl = "data_pendidikan";
		$arr = array('no' => $id,);
		$this->Mmember->delete($tbl,$arr);

		$tbl = "ajuan";
		$arr = array('no_jenis_ajuan' => $id,);
		$this->Mmember->delete($tbl,$arr);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}

	/*function konten_dik_fungsi_js(){
		$card 	= $this->session->userdata('id_user');
		$tbl  	= "data_dikfungsi";
		$q = $this->Mmember->riwayat_ajuan_detail($tbl,$id)->row();
		$data = array('info' => "hallo deny", );
		echo json_encode($data);
	}

	function konten_dik_fungsi(){
		$tbl  		= "data_dikfungsi";
		$card 		= $this->session->userdata('id_user');
		$idx 		= $this->uri->slash_segment('3');
		$id			= $this->encryption->decrypt($idx);
		$q 			= $this->Mmember->riwayat_ajuan_detail($tbl,$id)->row();

		if(isset($q)){
			$data = array(
				$nm_diklat => $q->nama_diklat,
				$lokasi => $q->lokasi,
				$tgl_mulai => $q->tgl_mulai,
				$tgl_selesai => $q->tgl_selesai,
				$jml_jam => $q->jml_jam,
				$penyelenggara => $q->penyelenggara,
				$nama_berkas => $q->nama_berkas,
			);
		}
		
		$data = array('id_rec' => $idx, );

		echo json_encode($data);

	}*/

	function riw_dik_teknis_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/riw_dik_teknis_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_dik_teknis_add_js','',true);

		$this->load->view('template/body',$data);
	}

	function list_dik_teknis(){
		$card = $this->session->userdata('id_user');

		$tbl = "data_dikteknis";
		$arr = array('idcard' => $card, );
		$no = "3";
		$q = $this->Mmember->riwayat_ajuan($tbl,$no,$card);
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			$tbl = '';
			foreach ($rsl as $key) {
				$no = $key->no; 
				$nox = $this->encrypt->encode($no);
				$nox = str_replace(array('+', '/', '='), array('-', '_', '~'), $nox);

				$idcard = $key->idcard;
				$nip = $key->nip;
				$nama_diklat = $key->nama_diklat;
				$tmp_belajar = $key->tmp_belajar;
				$lokasi = $key->lokasi;
				$tgl_mulaix = $key->tgl_mulai;
				$tgl_mulai = date("d-m-Y", strtotime($tgl_mulaix));
				$tgl_selesaix = $key->tgl_selesai;
				$tgl_selesai = date("d-m-Y", strtotime($tgl_selesaix));
				$jml_jam = $key->jml_jam;
				$penyelenggara = $key->penyelenggara;
				$file = $key->nama_berkas;
				$id_ajuan = $key->id_ajuanstatus;
				$deskripsi = $key->deskripsi;

				if($id_ajuan == "1"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success' onclick='buka_berkas($no,3);'><i class='fa fa-picture-o'></i></button>
								<a class='btn btn-warning' href='riw_dik_teknis_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,3);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "2"){
					$info_ajuan = "<span class='label label-primary col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,3);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "3"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,3);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "4"){
					$info_ajuan = "<span class='label label-warning col-md-12'>$deskripsi</span>";
					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_dik_teknis_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,3);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "5"){
					$info_ajuan = "<span class='label label-danger col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_dik_teknis_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,3);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "6"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,3);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "7"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,3);'><i class='fa fa-picture-o'></i></button>";
				}else{
					$info_ajuan = "-";
				}

				$tbl .= "
						<tr>
							<td>
								<span style='color:blue;'>$nama_diklat</span><br>
								Penyelenggara: $penyelenggara
							</td>
							<td>
								$lokasi
							</td>
							<td>
								Mulai: <span style='color:green;'>$tgl_mulai</span><br>
								Selesai: <span style='color:red;'>$tgl_selesai</span>
							</td>
							<td style='text-align:center;'>$jml_jam</td>
							<td style='text-align:center'>$info_ajuan</td>
							<td>
								$btn_aksi
							</td>

						</tr>
						";
			}
		}else{
			$tbl = "<tr><td colspan='9' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
		echo json_encode($data);

	}

	function do_upload_dik_teknis(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_dikteknis";

		$nama = $_POST['nama'];
		$belajar = $_POST['belajar'];
		$lokasi = $_POST['lokasi'];
		$tgl_mulai = $_POST['tgl_mulai'];
		$tgl_selesai = $_POST['tgl_selesai'];
		$jml_jam = $_POST['jml_jam'];
		$created = $_POST['created'];

		$start = date("Y-m-d", strtotime($tgl_mulai));
		$finish = date("Y-m-d", strtotime($tgl_selesai));

		$arr = array(
			'idcard' => $id,
			'nama_diklat' => $nama,
			'tmp_belajar' => $belajar,
			'lokasi' => $lokasi,
			'tgl_mulai' => $start,
			'tgl_selesai' => $finish,
			'jml_jam' => $jml_jam,
			'penyelenggara' => $created,
		);

		$this->Mmember->insert($folder,$arr); 

		if (!is_dir('assets/uploads/' . $folder)){
	        mkdir('./assets/uploads/' . $folder, 0777, true);
	    }

		$sql = $this->Mmember->last_data1($folder,$id)->row();
		$last_rec = $sql->nomor;

		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'jenis_ajuan' => '3', 
			'no_jenis_ajuan' => $last_rec, 
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$this->Mmember->insert('ajuan',$arr1); 

	    $nm_file = $id.'_'.$last_rec;
        $config = array(
        	'upload_path' => './assets/uploads/' . $folder, 
        	'allowed_types' =>'jpg|jpeg|png|pdf', 
        	'file_name' => $nm_file, 
        );

        $this->load->library('upload',$config);
        if(is_uploaded_file($_FILES['file_image']['tmp_name'])){
	        if($this->upload->do_upload("file_image")){
	            $data = array('upload_data' => $this->upload->data());
	 			
	            //Resize and Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/uploads/'.$folder.'/'.$nm_file; 
	            $config['create_thumb']= TRUE;
	            $config['maintain_ratio'] = TRUE;
	            $config['quality']= '60%';
	            $config['width']= 600;
	            $config['max_width']= 1200;
	            $config['height']= 450;
	            $config['max_height']= 1200;
	            $config['max_size']= 3000;
	            $config['new_image']= './assets/uploads/'.$folder.'/'.$nm_file; 
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();

	            $foto2	= $_FILES['file_image']['name'];
	            $pisah2 = explode('.',$foto2);
	            $ext2 	= $pisah2[1];
	            $filefix2 = $nm_file.'.'.$ext2;

	            $arr = array('nama_berkas' => $filefix2, );
				$this->Mmember->update($folder,$arr,'no',$last_rec);

	            echo json_decode($result);
	        }
        }
	}

	function riw_dik_teknis_edit(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$idx 	= $this->uri->segment(3);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id		= $this->encrypt->decode($idx);
		
		$tbl  	= "data_dikteknis";
		$info['tbl'] = $tbl;
		$info['id_rec'] = $idx;

		$q 		= $this->Mmember->riwayat_ajuan_detail($tbl,$id,'3')->row();
		if(isset($q)){
			$info['nm_diklat'] = $q->nama_diklat;
			$info['lokasi'] = $q->lokasi;
			$info['tgl_mulai'] = $q->tgl_mulai;
			$info['tgl_selesai'] = $q->tgl_selesai;
			$info['jml_jam'] = $q->jml_jam;
			$info['penyelenggara'] = $q->penyelenggara;
			$info['nama_berkas'] = $q->nama_berkas;
		}


		$data['main_page'] 	= $this->load->view('member/riw_dik_teknis_edit',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_dik_teknis_edit_js','',true);

		$this->load->view('template/body',$data);
	}

	function update_dik_teknis(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_dikteknis";

		$nama = $this->input->post('nama',true);
		$belajar = $this->input->post('belajar',true);
		$lokasi = $this->input->post('lokasi',true);
		$tgl_mulai = $this->input->post('tgl_mulai',true);
		$tgl_selesai = $this->input->post('tgl_selesai',true);
		$jml_jam = $this->input->post('jml_jam',true);
		$created = $this->input->post('created',true);
		$idx = $this->input->post('id_rec',true);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id_rec	= $this->encrypt->decode($idx);

		$start = date("Y-m-d", strtotime($tgl_mulai));
		$finish = date("Y-m-d", strtotime($tgl_selesai));

		$arr = array(
			'idcard' => $id,
			'nama_diklat' => $nama,
			'tmp_belajar' => $belajar,
			'lokasi' => $lokasi,
			'tgl_mulai' => $start,
			'tgl_selesai' => $finish,
			'jml_jam' => $jml_jam,
			'penyelenggara' => $created,
		);
		$this->Mmember->update($folder,$arr,'no',$id_rec);
		
		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$arrx = array('no_jenis_ajuan' => $id_rec,'jenis_ajuan' => '3', );
		$this->Mmember->update2('ajuan',$arr1,$arrx);
		// $this->Mmember->update('ajuan',$arr1,'no_jenis_ajuan',$id_rec);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}

	function riw_dik_jenjang_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$data['main_page'] 	= $this->load->view('member/riw_dik_jenjang_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_dik_jenjang_add_js','',true);

		$this->load->view('template/body',$data);
	}

	function do_upload_dik_jenjang(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_dikjenjang";

		$jns_diklat = $_POST["jns_diklat"];
		$angkatan = $_POST["angkatan"];
		$created = $_POST["created"];
		$tgl_mulai = $_POST["tgl_mulai"];
		$tgl_selesai = $_POST["tgl_selesai"];
		$predikat = $_POST["predikat"];
		$lokasi = $_POST["lokasi"];
		$jml_jam = $_POST["jml_jam"];

		$start = date("Y-m-d", strtotime($tgl_mulai));
		$finish = date("Y-m-d", strtotime($tgl_selesai));

		$arr = array(
			'idcard' => $id,
			'jns_diklat' => $jns_diklat,
			'angkatan' => $angkatan,
			'penyelenggara' => $created,
			'tgl_mulai' => $start,
			'tgl_selesai' => $finish,
			'predikat' => $predikat,
			'lokasi' => $lokasi,
			'jml_jam' => $jml_jam,

		);

		$this->Mmember->insert($folder,$arr); 

		if (!is_dir('assets/uploads/' . $folder)){
	        mkdir('./assets/uploads/' . $folder, 0777, true);
	    }

		$sql = $this->Mmember->last_data1($folder,$id)->row();
		$last_rec = $sql->nomor;

		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'jenis_ajuan' => '4', 
			'no_jenis_ajuan' => $last_rec, 
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$this->Mmember->insert('ajuan',$arr1); 

	    $nm_file = $id.'_'.$last_rec;
        $config = array(
        	'upload_path' => './assets/uploads/' . $folder, 
        	'allowed_types' =>'jpg|jpeg|png|pdf', 
        	'file_name' => $nm_file, 
        );

        $this->load->library('upload',$config);
        if(is_uploaded_file($_FILES['file_image']['tmp_name'])){
	        if($this->upload->do_upload("file_image")){
	            $data = array('upload_data' => $this->upload->data());
	 			
	            //Resize and Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/uploads/'.$folder.'/'.$nm_file; 
	            $config['create_thumb']= TRUE;
	            $config['maintain_ratio'] = TRUE;
	            $config['quality']= '60%';
	            $config['width']= 600;
	            $config['max_width']= 1200;
	            $config['height']= 450;
	            $config['max_height']= 1200;
	            $config['max_size']= 3000;
	            $config['new_image']= './assets/uploads/'.$folder.'/'.$nm_file; 
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();

	            $foto2	= $_FILES['file_image']['name'];
	            $pisah2 = explode('.',$foto2);
	            $ext2 	= $pisah2[1];
	            $filefix2 = $nm_file.'.'.$ext2;

	            $arr = array('nama_berkas' => $filefix2,);
				$this->Mmember->update($folder,$arr,'no',$last_rec);

	            echo json_decode($result);
	        }
        }
	}

	function list_dik_jenjang(){
		$card = $this->session->userdata('id_user');

		$tbl = "data_dikjenjang";
		$no = "4";
		$arr = array('idcard' => $card, );
		$q = $this->Mmember->riwayat_ajuan($tbl,$no,$card);
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			$tbl = '';
			foreach ($rsl as $key) {
				$no = $key->no; 
				$nox = $this->encrypt->encode($no);
				$nox = str_replace(array('+', '/', '='), array('-', '_', '~'), $nox);

				$idcard = $key->idcard;
				$nip = $key->nip;
				$jns_diklat = $key->jns_diklat;
				$angkatan = $key->angkatan;
				$created = $key->penyelenggara;
				$tgl_mulaix = $key->tgl_mulai;
				$tgl_mulai = date("d-m-Y", strtotime($tgl_mulaix));
				$tgl_selesaix = $key->tgl_selesai;
				$tgl_selesai = date("d-m-Y", strtotime($tgl_selesaix));
				$predikat = $key->predikat;
				$lokasi = $key->lokasi;
				$jml_jam = $key->jml_jam;

				$file = $key->nama_berkas;
				$id_ajuan = $key->id_ajuanstatus;
				$deskripsi = $key->deskripsi;

				if($id_ajuan == "1"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success' onclick='buka_berkas($no,4);'><i class='fa fa-picture-o'></i></button>
								<a class='btn btn-warning' href='riw_dik_jenjang_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,4);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "2"){
					$info_ajuan = "<span class='label label-primary col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,4);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "3"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,4);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "4"){
					$info_ajuan = "<span class='label label-warning col-md-12'>$deskripsi</span>";
					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_dik_jenjang_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,4);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "5"){
					$info_ajuan = "<span class='label label-danger col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_dik_jenjang_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,4);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "6"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,4);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "7"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,4);'><i class='fa fa-picture-o'></i></button>";
				}else{
					$info_ajuan = "-";
				}

				$tbl .= "
						<tr>
							<td>
								$jns_diklat<br>
								Angkatan: $angkatan
							</td>
							<td>$created</td>
							<td>$lokasi</td>
							<td>
								Mulai: <span style='color:green;'>$tgl_mulai</span><br>
								Selesai: <span style='color:red;'>$tgl_selesai</span>
							</td>
							<td style='text-align:center;'>$jml_jam</td>
							<td style='text-align:center;'>$predikat</td>
							<td style='text-align:center'>$info_ajuan</td>
							<td>
								$btn_aksi
							</td>

						</tr>
						";
			}
		}else{
			$tbl = "<tr><td colspan='10' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
		echo json_encode($data);

	}

	function riw_dik_jenjang_edit(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$idx 	= $this->uri->segment(3);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id		= $this->encrypt->decode($idx);
		
		$tbl  	= "data_dikjenjang";
		$info['tbl'] = $tbl;
		$info['id_rec'] = $idx;

		$q 		= $this->Mmember->riwayat_ajuan_detail($tbl,$id,'4')->row();
		if(isset($q)){

			$info['jns_diklat'] = $q->jns_diklat;
			$info['angkatan'] = $q->angkatan;
			$info['penyelenggara'] = $q->penyelenggara;
			$info['tgl_mulai'] = $q->tgl_mulai;
			$info['tgl_selesai'] = $q->tgl_selesai;
			$info['predikat'] = $q->predikat;
			$info['lokasi'] = $q->lokasi;
			$info['jml_jam'] = $q->jml_jam;
			$info['nama_berkas'] = $q->nama_berkas;
		}


		$data['main_page'] 	= $this->load->view('member/riw_dik_jenjang_edit',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_dik_jenjang_edit_js','',true);

		$this->load->view('template/body',$data);
	}

	function update_dik_jenjang(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_dikjenjang";

		$jns_diklat = $this->input->post('jns_diklat',true);
		$angkatan = $this->input->post('angkatan',true);
		$created = $this->input->post('created',true);
		$tgl_mulai = $this->input->post('tgl_mulai',true);
		$tgl_selesai = $this->input->post('tgl_selesai',true);
		$predikat = $this->input->post('predikat',true);
		$lokasi = $this->input->post('lokasi',true);
		$jml_jam = $this->input->post('jml_jam',true);

		$idx = $this->input->post('id_rec',true);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id_rec	= $this->encrypt->decode($idx);

		$start = date("Y-m-d", strtotime($tgl_mulai));
		$finish = date("Y-m-d", strtotime($tgl_selesai));

		$arr = array(
			'idcard' => $id,
			"jns_diklat" => $jns_diklat,
			"angkatan" => $angkatan,
			"penyelenggara" => $created,
			"tgl_mulai" => $start,
			"tgl_selesai" => $finish,
			"predikat" => $predikat,
			"lokasi" => $lokasi,
			"jml_jam" => $jml_jam,
		);

		$this->Mmember->update($folder,$arr,'no',$id_rec);
		
		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$arrx = array('no_jenis_ajuan' => $id_rec,'jenis_ajuan' => '4', );
		$this->Mmember->update2('ajuan',$arr1,$arrx);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}

	// pangkat ************************************************************************
	function riw_pangkat_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/riw_pangkat_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_pangkat_add_js','',true);

		$this->load->view('template/body',$data);
	}

	function do_upload_pangkat(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_pangkat";

		$gol = $_POST["gol"];
		$tmt_gol = $_POST["tmt_gol"];
		$pejab_sk = $_POST["pejab_sk"];
		$no_sk = $_POST["no_sk"];
		$tgl_sk = $_POST["tgl_sk"];
		$ket = $_POST["ket"];

		$tanggal_tmt = date("Y-m-d", strtotime($tmt_gol));
		$tanggal_sk = date("Y-m-d", strtotime($tgl_sk));

		$arr = array(
			'idcard' => $id,
			'nip' => $id,

			"golongan" => $gol,
			"tmt_golongan" => $tanggal_tmt,
			"pejabat_sk" => $pejab_sk,
			"no_sk" => $no_sk,
			"tgl_sk" => $tanggal_sk,
			"ket" => $ket,

		);

		$this->Mmember->insert($folder,$arr); 

		if (!is_dir('assets/uploads/' . $folder)){
	        mkdir('./assets/uploads/' . $folder, 0777, true);
	    }

		$sql = $this->Mmember->last_data1($folder,$id)->row();
		$last_rec = $sql->nomor;

		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'jenis_ajuan' => '5', 
			'no_jenis_ajuan' => $last_rec, 
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$this->Mmember->insert('ajuan',$arr1); 

	    $nm_file = $id.'_'.$last_rec;
        $config = array(
        	'upload_path' => './assets/uploads/' . $folder, 
        	'allowed_types' =>'jpg|jpeg|png|pdf', 
        	'file_name' => $nm_file, 
        );

        $this->load->library('upload',$config);
        if(is_uploaded_file($_FILES['file_image']['tmp_name'])){
	        if($this->upload->do_upload("file_image")){
	            $data = array('upload_data' => $this->upload->data());
	 			
	            //Resize and Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/uploads/'.$folder.'/'.$nm_file; 
	            $config['create_thumb']= TRUE;
	            $config['maintain_ratio'] = TRUE;
	            $config['quality']= '60%';
	            $config['width']= 600;
	            $config['max_width']= 1200;
	            $config['height']= 450;
	            $config['max_height']= 1200;
	            $config['max_size']= 3000;
	            $config['new_image']= './assets/uploads/'.$folder.'/'.$nm_file; 
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();

				$foto2	= $_FILES['file_image']['name'];
	            $pisah2 = explode('.',$foto2);
	            $ext2 	= $pisah2[1];
	            $filefix2 = $nm_file.'.'.$ext2;

	            $arr = array('nama_berkas' => $filefix2,);
				$this->Mmember->update($folder,$arr,'no',$last_rec);

	            echo json_decode($result);
	        }
        }	
	}

	function list_pangkat(){
		$card = $this->session->userdata('id_user');

		$tbl = "data_pangkat";
		$no = "5";
		$arr = array('idcard' => $card, );
		$q = $this->Mmember->riwayat_ajuan($tbl,$no,$card);
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			$tbl = '';
			foreach ($rsl as $key) {
				$no = $key->no; 
				$nox = $this->encrypt->encode($no);
				$nox = str_replace(array('+', '/', '='), array('-', '_', '~'), $nox);

				$idcard = $key->idcard;
				$nip = $key->nip;
				$gol = $key->golongan;
				$tanggal_tmt = date("d-m-Y",strtotime($key->tmt_golongan));
				$pejab_sk = $key->pejabat_sk;
				$no_sk = $key->no_sk;
				$tanggal_sk = date("d-m-Y",strtotime($key->tgl_sk));
				$ket = $key->ket;

				$file = $key->nama_berkas;
				$id_ajuan = $key->id_ajuanstatus;
				$deskripsi = $key->deskripsi;

				if($id_ajuan == "1"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success' onclick='buka_berkas($no,5);'><i class='fa fa-picture-o'></i></button>
								<a class='btn btn-warning' href='riw_pangkat_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,5);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "2"){
					$info_ajuan = "<span class='label label-primary col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,5);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "3"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,5);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "4"){
					$info_ajuan = "<span class='label label-warning col-md-12'>$deskripsi</span>";
					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_pangkat_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,5);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "5"){
					$info_ajuan = "<span class='label label-danger col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_pangkat_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,5);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "6"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,5);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "7"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,5);'><i class='fa fa-picture-o'></i></button>";
				}else{
					$info_ajuan = "-";
				}

				$tbl .= "
						<tr>
							<td>
								$gol
							</td>
							<td>$tanggal_tmt</td>
							<td>$pejab_sk</td>
							<td style='text-align:center;'>$no_sk</td>
							<td style='text-align:center;'>$tanggal_sk</td>
							<td style='text-align:center'>$ket</td>
							<td style='text-align:center'>$info_ajuan</td>
							<td>
								$btn_aksi
							</td>

						</tr>
						";
			}
		}else{
			$tbl = "<tr><td colspan='10' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
		echo json_encode($data);

	}

	function riw_pangkat_edit(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$idx 	= $this->uri->segment(3);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id		= $this->encrypt->decode($idx);
		
		$tbl  	= "data_pangkat";
		$info['tbl'] = $tbl;
		$info['id_rec'] = $idx;

		$q 		= $this->Mmember->riwayat_ajuan_detail($tbl,$id,'5')->row();
		if(isset($q)){

			$info['gol'] = $q->golongan;
			$info['tanggal_tmt'] = date("d-m-Y",strtotime($q->tmt_golongan));
			$info['pejab_sk'] = $q->pejabat_sk;
			$info['no_sk'] = $q->no_sk;
			$info['tanggal_sk'] = date("d-m-Y",strtotime($q->tgl_sk));
			$info['ket'] = $q->ket;

		}


		$data['main_page'] 	= $this->load->view('member/riw_pangkat_edit',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_pekerjaan_edit_js','',true);

		$this->load->view('template/body',$data);
	}

	function hapus_data_pangkat(){
		$id = $this->input->post("id",true);

		$tbl = "data_pangkat";
		$arr = array('no' => $id,);
		$this->Mmember->delete($tbl,$arr);

		$tbl = "ajuan";
		$arr = array('no_jenis_ajuan' => $id,);
		$this->Mmember->delete($tbl,$arr);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}

	// pangkat ************************************************************************

	// Jabatan Struktural ************************************************************************

	function riw_jab_struktur_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/riw_jab_struktur_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_jab_struktur_add_js','',true);

		$this->load->view('template/body',$data);
	}
	// Jabatan Struktural ************************************************************************

	// Jabatan Fungsional************************************************************************
	function riw_jab_fungsi_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/riw_jab_fungsi_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_jab_fungsi_add_js','',true);

		$this->load->view('template/body',$data);
	}
	// Jabatan Fungsional************************************************************************

	// pekerjaan************************************************************************
	function riw_pekerjaan_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$data['main_page'] 	= $this->load->view('member/riw_pekerjaan_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_pekerjaan_add_js','',true);

		$this->load->view('template/body',$data);
	}

	function do_upload_pekerjaan(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_pekerjaan";

		$jabatan = $_POST["jabatan"];
		$tmt_jabatan = $_POST["tmt_jabatan"];
		$thn_mulai = $_POST["thn_mulai"];
		$thn_selesai = $_POST["thn_selesai"];
		$no_sk = $_POST["no_sk"];
		$tgl_sk = $_POST["tgl_sk"];
		$nip_pejab_baru = $_POST["nip_pejab_baru"];
		$nip_pejab_lama = $_POST["nip_pejab_lama"];
		$nm_pejab = $_POST["nm_pejab"];

		$tanggal_tmt = date("Y-m-d", strtotime($tmt_jabatan));
		$tanggal_sk = date("Y-m-d", strtotime($tgl_sk));

		$arr = array(
			'idcard' => $id,
			'nip' => $id,
			"nm_jabatan" => $jabatan,
			"tmt_jabatan" => $tanggal_tmt,
			"thn_mulai" => $thn_mulai,
			"thn_selesai" => $thn_selesai,
			"no_sk" => $no_sk,
			"tgl_sk" => $tanggal_sk,
			"nip_pejbaru" => $nip_pejab_baru,
			"nip_pejlama" => $nip_pejab_lama,
			"pejabat_sk" => $nm_pejab,
		);

		$this->Mmember->insert($folder,$arr); 

		if (!is_dir('assets/uploads/' . $folder)){
	        mkdir('./assets/uploads/' . $folder, 0777, true);
	    }

		$sql = $this->Mmember->last_data1($folder,$id)->row();
		$last_rec = $sql->nomor;

		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'jenis_ajuan' => '8', 
			'no_jenis_ajuan' => $last_rec, 
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$this->Mmember->insert('ajuan',$arr1); 

	    $nm_file = $id.'_'.$last_rec;
        $config = array(
        	'upload_path' => './assets/uploads/' . $folder, 
        	'allowed_types' =>'jpg|jpeg|png|pdf', 
        	'file_name' => $nm_file, 
        );

        $this->load->library('upload',$config);
        if(is_uploaded_file($_FILES['file_image']['tmp_name'])){
	        if($this->upload->do_upload("file_image")){
	            $data = array('upload_data' => $this->upload->data());
	 			
	            //Resize and Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/uploads/'.$folder.'/'.$nm_file; 
	            $config['create_thumb']= TRUE;
	            $config['maintain_ratio'] = TRUE;
	            $config['quality']= '60%';
	            $config['width']= 600;
	            $config['max_width']= 1200;
	            $config['height']= 450;
	            $config['max_height']= 1200;
	            $config['max_size']= 3000;
	            $config['new_image']= './assets/uploads/'.$folder.'/'.$nm_file; 
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();

				$foto2	= $_FILES['file_image']['name'];
	            $pisah2 = explode('.',$foto2);
	            $ext2 	= $pisah2[1];
	            $filefix2 = $nm_file.'.'.$ext2;

	            $arr = array('nama_berkas' => $filefix2,);
				$this->Mmember->update($folder,$arr,'no',$last_rec);

	            echo json_decode($result);
	        }
        }	
	}

	function list_pekerjaan(){
		$card = $this->session->userdata('id_user');

		$tbl = "data_pekerjaan";
		$no = "8";
		$arr = array('idcard' => $card, );
		$q = $this->Mmember->riwayat_ajuan($tbl,$no,$card);
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			$tbl = '';
			foreach ($rsl as $key) {
				$no = $key->no; 
				$nox = $this->encrypt->encode($no);
				$nox = str_replace(array('+', '/', '='), array('-', '_', '~'), $nox);

				$idcard = $key->idcard;
				$nip = $key->nip;
				$nm_jabatan = $key->nm_jabatan;
				$tmt_jabatan = $key->tmt_jabatan;
				$thn_mulai = $key->thn_mulai;
				$thn_selesai = $key->thn_selesai;
				$no_sk = $key->no_sk;
				$tgl_sk = $key->tgl_sk;
				$nip_pejbaru = $key->nip_pejbaru;
				$nip_pejlama = $key->nip_pejlama;
				$pejabat_sk = $key->pejabat_sk;

				$file = $key->nama_berkas;
				$id_ajuan = $key->id_ajuanstatus;
				$deskripsi = $key->deskripsi;

				if($id_ajuan == "1"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success' onclick='buka_berkas($no,8);'><i class='fa fa-picture-o'></i></button>
								<a class='btn btn-warning' href='riw_pekerjaan_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,8);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "2"){
					$info_ajuan = "<span class='label label-primary col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,8);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "3"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";

					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,8);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "4"){
					$info_ajuan = "<span class='label label-warning col-md-12'>$deskripsi</span>";
					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_pekerjaan_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,8);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "5"){
					$info_ajuan = "<span class='label label-danger col-md-12'>$deskripsi</span>";

					$btn_aksi = "
								<button class='btn btn-success'><i class='fa fa-comment'></i></button>
								<a class='btn btn-warning' href='riw_pekerjaan_edit/$nox'><i class='fa fa-pencil'></i></a>
								<button class='btn btn-danger' onclick='confirm_hapus($no,8);'><i class='fa fa-trash-o'></i></button>
								";
				}else if($id_ajuan == "6"){
					$info_ajuan = "<span class='label label-info col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,8);'><i class='fa fa-picture-o'></i></button>";
				}else if($id_ajuan == "7"){
					$info_ajuan = "<span class='label label-success col-md-12'>$deskripsi</span>";
					$btn_aksi = "<button class='btn btn-success' onclick='buka_berkas($no,8);'><i class='fa fa-picture-o'></i></button>";
				}else{
					$info_ajuan = "-";
				}

				$tbl .= "
						<tr>
							<td>
								$nm_jabatan<br>
								TMT: $tmt_jabatan
							</td>
							<td>
								Mulai: <span style='color:green;'>$thn_mulai</span><br>
								Selesai: <span style='color:red;'>$thn_selesai</span>
							</td>
							<td>
								No SK: <span>$no_sk</span><br>
								Tgl SK: <span>$tgl_sk</span>
							</td>
							<td>
								Baru: <span>$nip_pejbaru</span><br>
								Lama: <span>$nip_pejlama</span>
							</td>
							<td>
								$pejabat_sk
							</td>
							<td>
								$info_ajuan
							</td>
							<td>
								$btn_aksi
							</td>

						</tr>
						";
			}
		}else{
			$tbl = "<tr><td colspan='10' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
		echo json_encode($data);

	}

	function riw_pekerjaan_edit(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$idx 	= $this->uri->segment(3);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id		= $this->encrypt->decode($idx);
		
		$tbl  	= "data_pekerjaan";
		$info['tbl'] = $tbl;
		$info['id_rec'] = $idx;

		$q 		= $this->Mmember->riwayat_ajuan_detail($tbl,$id,'8')->row();
		if(isset($q)){
			$info['nm_jabatan'] = $q->nm_jabatan;
			$info['tmt_jabatan'] = $q->tmt_jabatan;
			$info['thn_mulai'] = $q->thn_mulai;
			$info['thn_selesai'] = $q->thn_selesai;
			$info['no_sk'] = $q->no_sk;
			$info['tgl_sk'] = $q->tgl_sk;
			$info['nip_pejbaru'] = $q->nip_pejbaru;
			$info['nip_pejlama'] = $q->nip_pejlama;
			$info['pejabat_sk'] = $q->pejabat_sk;
			$info['nama_berkas'] = $q->nama_berkas;

		}


		$data['main_page'] 	= $this->load->view('member/riw_pekerjaan_edit',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_pekerjaan_edit_js','',true);

		$this->load->view('template/body',$data);
	}

	function update_pekerjaan(){
		$id		= $this->session->userdata('id_user');
		$folder = "data_pekerjaan";

		$jabatan = $_POST["jabatan"];
		$tmt_jabatan = $_POST["tmt_jabatan"];
		$thn_mulai = $_POST["thn_mulai"];
		$thn_selesai = $_POST["thn_selesai"];
		$no_sk = $_POST["no_sk"];
		$tgl_sk = $_POST["tgl_sk"];
		$nip_pejab_baru = $_POST["nip_pejab_baru"];
		$nip_pejab_lama = $_POST["nip_pejab_lama"];
		$nm_pejab = $_POST["nm_pejab"];

		$tanggal_tmt = date("Y-m-d", strtotime($tmt_jabatan));
		$tanggal_sk = date("Y-m-d", strtotime($tgl_sk));

		$idx = $this->input->post('id_rec',true);
		$idx 	= str_replace(array('-', '_', '~'), array('+', '/', '='), $idx);
		$id_rec	= $this->encrypt->decode($idx);

		$arr = array(
			'idcard' => $id,
			'nip' => $id,
			"nm_jabatan" => $jabatan,
			"tmt_jabatan" => $tanggal_tmt,
			"thn_mulai" => $thn_mulai,
			"thn_selesai" => $thn_selesai,
			"no_sk" => $no_sk,
			"tgl_sk" => $tanggal_sk,
			"nip_pejbaru" => $nip_pejab_baru,
			"nip_pejlama" => $nip_pejab_lama,
			"pejabat_sk" => $nm_pejab,
		);

		$this->Mmember->update($folder,$arr,'no',$id_rec);
		
		$tgl = date("Y-m-d h:i:s");

		$arr1 = array(
			'tgl_ajuan' => $tgl, 
			'id_ajuanstatus' => '1', // pengajuan pegawai
			'idcard' => $id,
		);
		$arrx = array('no_jenis_ajuan' => $id_rec,'jenis_ajuan' => '8', );
		$this->Mmember->update2('ajuan',$arr1,$arrx);
		// $this->Mmember->update('ajuan',$arr1,'no_jenis_ajuan',$id_rec);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}

	function hapus_data_pekerjaan(){
		$id = $this->input->post("id",true);

		$tbl = "data_pendidikan";
		$arr = array('no' => $id,);
		$this->Mmember->delete($tbl,$arr);

		$tbl = "ajuan";
		$arr = array('no_jenis_ajuan' => $id,);
		$this->Mmember->delete($tbl,$arr);

		$data = array('info' => 'sukses', );
		echo json_encode($data);
	}

	// pekerjaan************************************************************************


	//================================================================================================================== deny

	//=============================[ /\ Function Lama  /\ ]==============================
	//                               |                 | 
	//============================[ \/      adit      \/ ]=====(start)===================

	function riw_edu_add_function(){
		$data = array(
			'id_user'			=> $this->session->userdata('id_user'),
			'tingkat_pend' 		=> $this->input->get_post('edu',true),
			'nama_sekolah' 		=> $this->input->get_post('sekolah',true),
			'jurusan' 			=> $this->input->get_post('prodi',true),
			'thn_masuk' 		=> $this->input->get_post('tahun',true),
			'thn_lulus' 		=> $this->input->get_post('tanggal',true),
			'tmp_belajar' 		=> $this->input->get_post('belajar',true),
			'lokasi' 			=> $this->input->get_post('lokasi',true),
			'nomor_ijazah' 		=> $this->input->get_post('ijazah',true)
		);
		
		$this->mmember->riw_edu_add_process($data);
		redirect('/Member/riw_edu_add');
	}

	function admin_ajuan_pegawai(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/admin_ajuan_pegawai','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/admin_ajuan_pegawai_js','',true);

		$this->load->view('template/body',$data);
	}

	function list_ajuan_riw_dik_fung(){
		// $arr = array('nip' => $card, );
		$tbl = '';
		// $info_ajuan = "-";
		$q = $this->Mmember->list_ajuan_dik_fung();
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			foreach ($rsl as $key) {
				$idcard = $key->idcard;
				$no_jenis_ajuan = $key->no_jenis_ajuan;
				$gelar_depan = $key->gelar_depan;
				$nama = $key->nama;
				$gelar_belakang = $key->gelar_belakang;
				$nama_ajuan = $key->nama_ajuan;
				// $tgl_ajuan = $key->tgl_ajuan;
				$tgl_ajuan = date("d-m-Y", strtotime($key->tgl_ajuan));
				$id_ajuan = $key->jenis_ajuan;
				$deskripsi = $key->deskripsi;
				$id_ajuanstatus = $key->id_ajuanstatus;

				$controller = '';
				if($id_ajuan == "1"){
					$controller = "admin_riw_edu_detail";
				}else if($id_ajuan == "2"){
					$controller = "admin_riw_dik_fung_detail";
				}else if($id_ajuan == "3"){
					$controller = "admin_riw_dik_teknis_detail";
				}else if($id_ajuan == "4"){
					$controller = "admin_riw_dik_jenjang_detail";
				}else if($id_ajuan == "5"){
					$controller = "no_controller";
				}else{
					$controller = "no_controller";
				}
				
				$info_ajuan = "-";
				if($id_ajuanstatus == "1"){
					$info_ajuan = "<span class='label label-info'>$deskripsi</span>";
				}else if($id_ajuanstatus == "2"){
					$info_ajuan = "<span class='label label-primary'>$deskripsi</span>";
				}else if($id_ajuanstatus == "3"){
					$info_ajuan = "<span class='label label-success'>$deskripsi</span>";
				}else if($id_ajuanstatus == "4"){
					$info_ajuan = "<span class='label label-warning'>$deskripsi</span>";
				}else if($id_ajuanstatus == "5"){
					$info_ajuan = "<span class='label label-danger'>$deskripsi</span>";
				}else if($id_ajuanstatus == "6"){
					$info_ajuan = "<span class='label label-info'>$deskripsi</span>";
				}else if($id_ajuanstatus == "7"){
					$info_ajuan = "<span class='label label-success'>$deskripsi</span>";
				}else{
					$info_ajuan = "-";
				}

				$tbl  .= "<tr>
							<td><span style='color:black;'>$idcard</span></td>
							<td>$gelar_depan $nama $gelar_belakang</td>
							<td>$nama_ajuan</td>
							<td>$tgl_ajuan</td>
							<td style='text-align:center'>$info_ajuan</td>
							<td>
								<a href='".base_url()."member/$controller/$no_jenis_ajuan/$id_ajuan' class='btn btn-success'>
									<i class='fa fa-eye'></i> 
									Lihat
								</a>
							</td>
						</tr>";
			}
		}else{
			$tbl = "<tr><td colspan='6' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
		echo json_encode($data);

	}

	function update_ajuan(){
		$data = array(
			'jenis_ajuan' 		=> $this->uri->segment(3),
			'no_jenis_ajuan' 	=> $this->uri->segment(4),
			'id_ajuanstatus' 	=> $this->input->get_post('status_ajuan',true),
			'jenis_diklat' 		=> $this->input->get_post('jenis_diklat',true),
			'update_by'			=> $this->session->userdata('id_user')
		);

		// echo $data['no_jenis_ajuan'];
		
		$this->Mmember->update_ajuan($data);
		redirect('/member/admin_ajuan_pegawai');
	}

	function admin_riw_dik_fung_detail($id_record){
		// $data['id']		= $idcard;
		// $id = $id_record;
		// $data = array(
		// 	'id'		=> $id
		// );

		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$info['detail']		= $this->get_riw_dik_fung_detail($id_record);
		$info['select_option']		= $this->Mmember->list_status_ajuan();
		$data['main_page'] 	= $this->load->view('member/admin_riw_dik_fung_detail',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/admin_riw_dik_fung_detail_js','',true);

		$this->load->view('template/body',$data);
	}

	function get_riw_dik_fung_detail($id_record){

		$cb1 = array();
		$cb2 = array();
		$result = $this->Mmember->get_riw_dik_fung_detail($id_record)->result();
		foreach($result as $key => $val){
			$cb1 = $val;
		}

		foreach($cb1 as $key2 => $val2){
			$cb2[strtolower($key2)] = $val2;
		}
		return json_encode($cb2);

	}

	function admin_riw_dik_teknis_detail($id_record){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$info['detail']		= $this->get_riw_dik_teknis_detail($id_record);
		$info['select_option']		= $this->Mmember->list_status_ajuan();
		$data['main_page'] 	= $this->load->view('member/admin_riw_dik_teknis_detail',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/admin_riw_dik_teknis_detail_js','',true);

		$this->load->view('template/body',$data);
	}

	function get_riw_dik_teknis_detail($id_record){
		$cb1 = array();
		$cb2 = array();
		$result = $this->Mmember->get_riw_dik_teknis_detail($id_record)->result();
		foreach($result as $key => $val){
			$cb1 = $val;
		}

		foreach($cb1 as $key2 => $val2){
			$cb2[strtolower($key2)] = $val2;
		}
		return json_encode($cb2);

	}

	function admin_riw_dik_jenjang_detail($id_record){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$info['detail']		= $this->get_riw_dik_jenjang_detail($id_record);
		$info['select_option']		= $this->Mmember->list_status_ajuan();
		$data['main_page'] 	= $this->load->view('member/admin_riw_dik_jenjang_detail',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/admin_riw_dik_jenjang_detail_js','',true);

		$this->load->view('template/body',$data);
	}

	function get_riw_dik_jenjang_detail($id_record){
		$cb1 = array();
		$cb2 = array();
		$result = $this->Mmember->get_riw_dik_jenjang_detail($id_record)->result();
		foreach($result as $key => $val){
			$cb1 = $val;
		}

		foreach($cb1 as $key2 => $val2){
			$cb2[strtolower($key2)] = $val2;
		}
		return json_encode($cb2);

	}

	function admin_riw_edu_detail($id_record){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		$info['detail']		= $this->get_riw_edu_detail($id_record);
		$info['select_option']		= $this->Mmember->list_status_ajuan();
		$data['main_page'] 	= $this->load->view('member/admin_riw_edu_detail',$info,true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/admin_riw_edu_detail_js','',true);

		$this->load->view('template/body',$data);
	}

	function get_riw_edu_detail($id_record){
		$cb1 = array();
		$cb2 = array();
		$result = $this->Mmember->get_riw_edu_detail($id_record)->result();
		foreach($result as $key => $val){
			$cb1 = $val;
		}

		foreach($cb1 as $key2 => $val2){
			$cb2[strtolower($key2)] = $val2;
		}
		return json_encode($cb2);

	}

	//===========================[ /\      adit      /\ ]=====(end)=====================


}//end class

?>