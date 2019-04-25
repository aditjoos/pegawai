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

	// ---------------------------------------------------------------------------------------------------------------- dendra

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
			'id_ajuan_status' => '1', // pengajuan pegawai
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

	            $arr = array('nama_berkas' => $nm_file, );
				$this->Mmember->update($folder,$arr,'no',$last_rec);

	            echo json_decode($result);
	        }
        }
	}

	function list_pendidikan(){
		$card = $this->session->userdata('id_user');

		$tbl = "data_pendidikan";
		$arr = array('nip' => $card, );
		// $q = $this->Mmember->select_all_order('data_pendidikan',$arr,'no','DESC');
		$q = $this->Mmember->riwayat_ajuan($tbl,$card);
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			$tbl = '';
			foreach ($rsl as $key) {
				$no = $key->no;
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
					$info_ajuan = "<span class='label label-info'>$deskripsi</span>";
				}else if($id_ajuan == "2"){
					$info_ajuan = "<span class='label label-primary'>$deskripsi</span>";
				}else if($id_ajuan == "3"){
					$info_ajuan = "<span class='label label-success'>$deskripsi</span>";
				}else if($id_ajuan == "4"){
					$info_ajuan = "<span class='label label-warning'>$deskripsi</span>";
				}else if($id_ajuan == "5"){
					$info_ajuan = "<span class='label label-danger'>$deskripsi</span>";
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
								<button class='btn btn-success'><i class='fa fa-file'></i></button>
								<button class='btn btn-warning'><i class='fa fa-pencil'></i></button>
								<button class='btn btn-danger'><i class='fa fa-trash-o'></i></button>
							</td>
						</tr>";
			}
		}else{
			$tbl = "<tr><td colspan='9' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
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
		$arr = array('nip' => $card, );
		$q = $this->Mmember->riwayat_ajuan($tbl,$card);
		$tot = $q->num_rows();
		$rsl = $q->result();

		if($tot>'0'){
			$tbl = '';
			foreach ($rsl as $key) {
				$no = $key->no;
				$nip = $key->nip;
				$nama_diklat = $key->nama_diklat;
				$tmp_belajar = $key->tmp_belajar;
				$lokasi = $key->lokasi;
				$tgl_mulai = $key->tgl_mulai;
				$tgl_selesai = $key->tgl_selesai;
				$jml_jam = $key->jml_jam;
				$penyelenggara = $key->penyelenggara;
				$file = $key->file;
				$id_ajuan = $key->id_ajuan_status;
				$deskripsi = $key->deskripsi;

				if($id_ajuan == "1"){
					$info_ajuan = "<span class='label label-info'>$deskripsi</span>";
				}else if($id_ajuan == "2"){
					$info_ajuan = "<span class='label label-primary'>$deskripsi</span>";
				}else if($id_ajuan == "3"){
					$info_ajuan = "<span class='label label-success'>$deskripsi</span>";
				}else if($id_ajuan == "4"){
					$info_ajuan = "<span class='label label-warning'>$deskripsi</span>";
				}else if($id_ajuan == "5"){
					$info_ajuan = "<span class='label label-danger'>$deskripsi</span>";
				}else{
					$info_ajuan = "-";

				$tbl = "
						<tr>
							<td>$nama_diklat</td>
							<td>
								$tmp_belajar<br>
								$lokasi
							</td>
							<td>
								Tanggal Mulai: $tgl_mulai<br>
								Tanggal Selesai: $tgl_selesai
							</td>
							<td>$jml_jam</td>
							<td>$penyelenggara</td>
							<td style='text-align:center'>$info_ajuan</td>
							<td>
								<button class='btn btn-success'><i class='fa fa-file'></i></button>
								<button class='btn btn-warning'><i class='fa fa-pencil'></i></button>
								<button class='btn btn-danger'><i class='fa fa-trash-o'></i></button>
							</td>

						</tr>
						";
				}
			}
		}else{
			$tbl = "<tr><td colspan='9' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
		}

		$data = array('tbl' => $tbl, );
		echo json_encode($data);

	}

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

	function riw_dik_jenjang_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/riw_dik_jenjang_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_dik_jenjang_add_js','',true);

		$this->load->view('template/body',$data);
	}

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

	function riw_pekerjaan_add(){
		$data['head_page'] 	= $this->load->view('template/head','',true);
		$data['top_menu'] 	= $this->load->view('template/top_menu','',true);

		// $info['biodata']	= $this->get_biodata2();
		$data['main_page'] 	= $this->load->view('member/riw_pekerjaan_add','',true);

		$data['modal'] 		= $this->load->view('template/modal','',true);
		$data['left_menu'] 	= $this->load->view('template/left_menu','',true);
		$data['foot'] 		= $this->load->view('template/foot','',true);
		$data['custom_js'] 	= $this->load->view('member/riw_pekerjaan_add_js','',true);

		$this->load->view('template/body',$data);
	}

	// ---------------------------------------------------------------------------------------------------------------- dendra

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

	//===========================[ /\      adit      /\ ]=====(end)=====================


}//end class

?>