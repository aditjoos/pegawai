<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mmember extends CI_Model {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('Datatables');
	}
	
	function get_biodata($data){
		return $this->db->query('select * from guru '
		.' where ID = "'.$data['id'].'" ');
		
	}
	
	function is_table_exist($str){
		$cek = $this->db->query('show tables like "'.$str.'"');
		if($cek->num_rows() > 0){
			$cek2 = $this->db->query('select count(*) as jmh from '.$str);
			if($cek2->num_rows() > 0 && $cek2->row()->jmh > 0){
				return true;
			}else{
				return false;
			}			
		}else{
			return false;
		}
	}
	
	function get_rekap($data){
		$sql = 'select a.*,
		(select count(*) from presensi_'.$data['periode'].' where idcard = "'.$data['id'].'" and jenis = "-") as tk 
		from presensi_sum_'.$data['periode']
		.' as a where a.idcard = "'.$data['id'].'" ';
		
		$sql = strtolower($sql);
		
		return $this->db->query($sql);
	}
	
	function get_presensi($data){
		$sql = 'SELECT GROUP_CONCAT(LOWER(COLUMN_NAME)) as nama 
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_NAME = "presensi_'.$data['periode'].'"';
		
		$hsl = $this->db->query($sql);
		$field = $hsl->row()->nama;
		
		$sql = 'select '.$field.' from presensi_'.$data['periode']
		.' where idcard = "'.$data['id'].'" order by tgl asc';
		
		$sql = strtolower($sql);
		
		return $this->db->query($sql);
	}
	
	function get_tukin($data){
		return $this->db->query('select * from '.$data['tukin'].'_tunkin'
		.' where idcard = "'.$data['id'].'" order by tgl asc');
	}
	
	function detail_presensi($data){
		$this->datatables
			->select('tgl,jammasuk1,jamkeluar1,total,ket',false)
			->from('presensi_'.$data['periode'])
			->where('idcard',$data['id']);
	
			return $this->datatables->generate();
		
	}

	function cek_auth($data){
		return $this->db->query('select * from user1 '
		.' where id_user = "'.$data['id'].'"  
		and `password` = md5("'.$data['old_pwd'].'")');
	}
	
	function cek_akses($data){
		return $this->db->query('select * from akses '
		.' where niplog = "'.$data['id'].'"  
		and passlog = encode("'.$data['old_pwd'].'","SIF-Tech")');
	}

	function update_akun($data){
		$this->db->query('update user1 '
		.' set `password` = md5("'.$data['new_pwd'].'") 
		where id_user = "'.$data['id'].'"');
	}

	function update_akses($data){
		$this->db->query('update akses '
		.' set passlog = encode("'.$data['new_pwd'].'","SIF-Tech") 
		where niplog = "'.$data['id'].'"');
	}
	
	function ngintip_absen($data){
		$sql = "select k.tgl,l.idcard,l.nama,l.unitkerja,
					k.masuk as jam_masuk,k.datang as id_fp_masuk,k.lokasi as lokasi_fp_masuk,
					k.keluar as jam_keluar,k.pulang as id_fp_keluar,n.lokasi as lokasi_fp_keluar 
					from (
					select x.*,y.kode_mesin as datang,b.lokasi,z.kode_mesin as pulang 
					from (
					select a.idcard,min(a.jam) as masuk,max(a.jam) as keluar,a.tgl 
					from tmp_presensi_".$data['periode']." a 
					where a.tgl = '".$data['tgl']."' and a.idcard = '".$data['id']."'
					group by a.idcard 
					) as x 
					inner join (select * from tmp_presensi_".$data['periode'].") as y on y.tgl = x.tgl and y.idcard = x.idcard and y.jam = x.masuk 
					inner join (select * from tmp_presensi_".$data['periode'].") as z on z.tgl = x.tgl and z.idcard = x.idcard and z.jam = x.keluar 
					inner join mesin b on b.kode_mesin = y.kode_mesin 
					group by x.idcard 
					) as k 
					inner join guru l on l.idcard = k.idcard 
					inner join unitkerja m on m.id = l.idunitkerja 
					inner join mesin n on n.kode_mesin = k.pulang 
					order by k.masuk asc";
		
		$sql = strtolower($sql);
					
		return $this->db->query($sql);
	}
	
	function ngintip_absen_v2($data){
			$this->datatables
			->select("k.tgl,l.idcard,l.nama,l.unitkerja,
					k.masuk as jam_masuk,k.datang as id_fp_masuk,k.lokasi as lokasi_fp_masuk,
					k.keluar as jam_keluar,k.pulang as id_fp_keluar,n.lokasi as lokasi_fp_keluar",false)
			->from("(
					select x.*,y.kode_mesin as datang,b.lokasi,z.kode_mesin as pulang 
					from (
					select a.idcard,min(a.jam) as masuk,max(a.jam) as keluar,a.tgl 
					from tmp_presensi_".$data['periode']." a 
					where a.tgl = '".$data['tgl']."' 
					group by a.idcard 
					) as x 
					inner join (select * from tmp_presensi_".$data['periode'].") as y on y.tgl = x.tgl and y.idcard = x.idcard and y.jam = x.masuk 
					inner join (select * from tmp_presensi_".$data['periode'].") as z on z.tgl = x.tgl and z.idcard = x.idcard and z.jam = x.keluar 
					inner join mesin b on b.kode_mesin = y.kode_mesin 
					group by x.idcard 
					) as k")
			->join('guru as l', 'l.idcard = k.idcard', 'inner')
			->join('unitkerja as m', 'm.id = l.idunitkerja', 'inner')
			->join('mesin as n', 'n.kode_mesin = k.pulang', 'inner');
	
			return $this->datatables->generate();
	}

	function get_masuk_keluar($data){
		if($data['req']=='masuk'){
			$sql = "select a.idcard,a.tgl,a.jam,
							b.jammasuk,b.jamkeluar,b.istirahat,cast(concat(a.tgl,' ',a.jam) as DATETIME) as waktu_full,
							WEEKDAY(cast(concat(a.tgl,' ',a.jam) as DATETIME))+1 as xhari,
							a.kode_mesin,c.lokasi,
							if(a.jam < b.istirahat,'masuk',
							if(a.jam >= b.istirahat,'keluar',null)) as stt 
							from tmp_presensi_".$data['periode']." a 
							inner join guru x on x.idcard = a.idcard 
							inner join presensi_jamkerja b on b.hari = WEEKDAY(cast(concat(a.tgl,' ',a.Jam) as DATETIME))+1 and b.shift = x.jamkerja 
							inner join mesin c on c.kode_mesin = a.kode_mesin 
							where a.tgl = '".$data['tgl']."'  
							and a.idcard = '".$data['idcard']."'  
							order by waktu_full asc limit 1";
							
		}
		elseif($data['req']=='keluar'){
			$sql = "select a.idcard,a.tgl,a.jam,
							b.jammasuk,b.jamkeluar,b.istirahat,cast(concat(a.tgl,' ',a.jam) as DATETIME) as waktu_full,
							WEEKDAY(cast(concat(a.tgl,' ',a.Jam) as DATETIME))+1 as xhari,
							a.kode_mesin,c.lokasi,
							if(a.jam < b.istirahat,'masuk',
							if(a.jam >= b.istirahat,'keluar',null)) as stt 
							from tmp_presensi_".$data['periode']." a 
							inner join guru x on x.idcard = a.idcard 
							inner join presensi_jamkerja b on b.hari = WEEKDAY(cast(concat(a.tgl,' ',a.jam) as DATETIME))+1 and b.shift = x.jamkerja  
							inner join mesin c on c.kode_mesin = a.kode_mesin 
							where a.tgl = '".$data['tgl']."'  
							and a.idcard = '".$data['idcard']."'  
							order by waktu_full desc limit 1";
		}
		elseif($data['req']=='absen'){
			$sql = "select a.tgl,b.*,c.NamaUnit 
							from tmp_presensi_".$data['periode']." a 
							inner join guru b on b.idcard = a.idcard 
							inner join unitkerja c on c.id = b.idunitkerja 
							where a.tgl = '".$data['tgl']."' and a.idcard = '".$data['idku']."'
							group by a.idcard 
							order by a.jam asc";
		}
		
		$sql = strtolower($sql);
		
		return $this->db->query($sql);
	}

	function get_masuk_keluar2($data){
		if($data['req']=='masuk'){
			$sql = "select a.idcard,a.tgl,a.jam,
							b.jammasuk,b.jamkeluar,b.istirahat,cast(concat(a.tgl,' ',a.jam) as DATETIME) as waktu_full,
							WEEKDAY(cast(concat(a.tgl,' ',a.jam) as DATETIME))+1 as xhari,
							a.kode_mesin,c.lokasi,
							if(a.jam < b.istirahat,'masuk',
							if(a.jam >= b.istirahat,'keluar',null)) as stt 
							from tmp_presensi_".$data['periode']." a 
							inner join guru x on x.idcard = a.idcard 
							inner join presensi_jamkerja b on b.hari = WEEKDAY(cast(concat(a.tgl,' ',a.Jam) as DATETIME))+1 and b.shift = x.jamkerja 
							inner join mesin c on c.kode_mesin = a.kode_mesin 
							where a.tgl = '".$data['tgl']."'
							GROUP BY a.jam							
							order by waktu_full asc";
		}
		elseif($data['req']=='keluar'){
			$sql = "select a.idcard,a.tgl,a.jam,
							b.jammasuk,b.jamkeluar,b.istirahat,cast(concat(a.tgl,' ',a.jam) as DATETIME) as waktu_full,
							WEEKDAY(cast(concat(a.tgl,' ',a.Jam) as DATETIME))+1 as xhari,
							a.kode_mesin,c.lokasi,
							if(a.jam < b.istirahat,'masuk',
							if(a.jam >= b.istirahat,'keluar',null)) as stt 
							from tmp_presensi_".$data['periode']." a 
							inner join guru x on x.idcard = a.idcard 
							inner join presensi_jamkerja b on b.hari = WEEKDAY(cast(concat(a.tgl,' ',a.jam) as DATETIME))+1 and b.shift = x.jamkerja  
							inner join mesin c on c.kode_mesin = a.kode_mesin 
							where a.tgl = '".$data['tgl']."'  
							GROUP BY a.jam 
							order by waktu_full desc";
		}
		elseif($data['req']=='absen'){
			$sql = "select a.tgl,b.*,c.NamaUnit 
							from tmp_presensi_".$data['periode']." a 
							inner join guru b on b.idcard = a.idcard 
							inner join unitkerja c on c.id = b.idunitkerja 
							where a.tgl = '".$data['tgl']."' 
							group by a.idcard 
							order by a.jam asc";
		}
		
		$sql = strtolower($sql);
		
		return $this->db->query($sql);
	}
	
	function get_biodata2($data){
		$cmd = 'SELECT ID, NIP, IDCard, Nama, jabatan, Gelar_depan, Gelar_belakang, TempatLahir, 
						TanggalLahir, JenisKelamin, Agama, Status, Gol_Darah, Telepon, NoHP, Alamat, 
						KodePos, Kab_Kota, Propinsi, Pendidikan, Kode_MP, Deskripsi_MP, Aktif, 
						StatusPeg, IDUnitKerja, UnitKerja, TipePegawai, Gol_ruang, Pangkat, jamkerja, TotalJam, 
						TMT_sekolah, inisial_guru, level, nuptk, grade_tunkin, 
						idUnitKerja,UnitKerja,concat(idUnitKerja, " - ", UnitKerja) as myUK, 
						trim(CONCAT(gelar_depan," ", nama,if(gelar_belakang <> "",", ", ""), gelar_belakang)) as namagelar 
						FROM guru 
						WHERE IDCard = "'.$data['id'].'"
						ORDER BY IDUnitKerja, nip';
		$cmd = strtolower($cmd);
		
		return $this->db->query($cmd);
	}

	function get_pivot(){
		$cmd = 'select IDCard as id,NIP as nip, TempatLahir as tempat_lahir, TanggalLahir as tanggal_lahir,
						JenisKelamin as jenis_kelamin, Agama as agama, `Status` as `status`, Gol_Darah as gol_darah,
						Kab_Kota as kab_kota, Propinsi as propinsi, Aktif as aktif, TipePegawai as tipe_pegawai,
						Pendidikan as pendidikan, DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,tanggallahir)),"%y") AS usia_thn,
						StatusPeg as status_pegawai, UnitKerja as unit_kerja 
						from guru';
		return $this->db->query($cmd);
	}
	
	function tunkinpp14($in1, $in2){
		$sql = "SELECT idcard,jenis, tgl,dtg_rule, dtg_real, dtg_late, dtg_late_angka,
				if(dtg_status=0,'', if(dtg_status = 1,'Bisa Ganti Jam', 'TIDAK Bisa Ganti Jam')) as dtg_status,
				t1, t2, t3, t4, t5, t6, round(potong_masuk,2) as potong_msk,
				plg_rule, plg_real, plg_early, plg_early_angka,
				if(plg_status = 0,'', 'PSW') as plg_status, psw1, psw2, psw3, psw4, psw5,
				round(potong_plg,2) as potong_pulang, suket, round(potong_tot,2) as potong_total, total_terlambat,
				IF (
					DAYOFWEEK(tgl) = 1,
					'Minggu',

				IF (
					DAYOFWEEK(tgl) = 2,
					'Senin',

				IF (
					DAYOFWEEK(tgl) = 3,
					'Selasa',

				IF (
					DAYOFWEEK(tgl) = 4,
					'Rabu',

				IF (
					DAYOFWEEK(tgl) = 5,
					'Kamis',

				IF (DAYOFWEEK(tgl) = 6, 'Jum`at', 'Sabtu')
				))))) AS dino
				FROM $in1 WHERE idcard = '$in2' ORDER BY tgl";
				
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}
	
	function akum_kurang_jam($in1,$in2){
		$sql = "select SEC_TO_TIME( SUM(time_to_sec(total_terlambat))) as akumjam from $in1 where idcard = '$in2'";
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}
	
	function nilai_pengurang_tunkin($in1,$in2){
		$sql = "SELECT (SUM(TIME_TO_SEC(`total_terlambat`)) div (3600 * 7.5))*3 as pengurang FROM $in1 where idcard = '$in2'";
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}
	
	function point_potong_tunkin($in1,$in2){
		$sql = "select round(sum(potong_tot),2) as pointcut from $in1 where idcard = '$in2'";
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}
	
	function total_potongan($in1,$in2){
		$sql = "select round(sum(potong_tot),2) + ((SUM(TIME_TO_SEC(`total_terlambat`)) div (3600 * 7.5))*3) as sumcut from $in1 where idcard = '$in2'";
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}
	
	function point_tunkin($in1,$in2){
		$sql = "select 100 - (round(sum(potong_tot),2) + ((SUM(TIME_TO_SEC(`total_terlambat`))) div (3600 * 7.5))*3) as point_tunkin from $in1 where idcard = '$in2'";
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}
	
	function selectall(){
		$sql = "select * from profile";
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}
	
	function show_all_data_absen($data){
		$sql = "select 
					x.idcard, z.nama, z.unitkerja, x.tgl, if(x.jam < z.istirahat,x.jam,'-') as JamMasuk, if(x.jam < z.istirahat, x.lokasi,'-') as LokasiMasuk, 
					if(y.jam > z.istirahat,y.jam,'-') as JamPulang, if(y.jam > z.istirahat,y.lokasi,'-') as LokasiPulang 
				from (
				SELECT t1.*, t3.lokasi FROM tmp_presensi_".$data['periode']." as t1
				JOIN (SELECT idcard, MIN(jam) jam1 FROM tmp_presensi_".$data['periode']." where tgl = '".$data['tgl']."' GROUP BY idcard) as  t2
				ON t1.idcard = t2.idcard and t1.jam = t2.jam1
				join mesin t3 
				on t1.kode_mesin = t3.kode_mesin
				GROUP BY t1.idcard ORDER BY t1.idcard,t1.tgl) x 

				join(
				SELECT t1.*, t3.lokasi FROM tmp_presensi_".$data['periode']." as t1
				JOIN (SELECT idcard, MAX(jam) jam1 FROM tmp_presensi_".$data['periode']." where tgl = '".$data['tgl']."' GROUP BY idcard) as  t2
				ON t1.idcard = t2.idcard and t1.jam = t2.jam1
				join mesin t3 
				on t1.kode_mesin = t3.kode_mesin
				GROUP BY t1.idcard ORDER BY t1.idcard,t1.tgl) y 
				on y.idcard = x.idcard
				
				join (select a.idcard, a.nama, a.unitkerja, a.jamkerja, b.istirahat from guru a
				join presensi_jamkerja b
				on a.jamkerja = b.shift GROUP BY a.idcard) z on x.idcard = z.idcard
				ORDER BY JamMasuk desc";
				
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}
	
	function show_personal_data_absen($data){
		$sql = "select 
					x.idcard, z.nama, z.unitkerja, x.tgl, if(x.jam < z.istirahat,x.jam,'-') as JamMasuk, if(x.jam < z.istirahat, x.lokasi,'-') as LokasiMasuk, 
					if(y.jam > z.istirahat,y.jam,'-') as JamPulang, if(y.jam > z.istirahat,y.lokasi,'-') as LokasiPulang 
				from (
				SELECT t1.*, t3.lokasi FROM tmp_presensi_".$data['periode']." as t1
				JOIN (SELECT idcard, MIN(jam) jam1 FROM tmp_presensi_".$data['periode']." where tgl = '".$data['tgl']."' GROUP BY idcard) as  t2
				ON t1.idcard = t2.idcard and t1.jam = t2.jam1
				join mesin t3 
				on t1.kode_mesin = t3.kode_mesin
				GROUP BY t1.idcard ORDER BY t1.idcard,t1.tgl) x 

				join(
				SELECT t1.*, t3.lokasi FROM tmp_presensi_".$data['periode']." as t1
				JOIN (SELECT idcard, MAX(jam) jam1 FROM tmp_presensi_".$data['periode']." where tgl = '".$data['tgl']."' GROUP BY idcard) as  t2
				ON t1.idcard = t2.idcard and t1.jam = t2.jam1
				join mesin t3 
				on t1.kode_mesin = t3.kode_mesin
				GROUP BY t1.idcard ORDER BY t1.idcard,t1.tgl) y 
				on y.idcard = x.idcard
				
				join (select a.idcard, a.nama, a.unitkerja, a.jamkerja, b.istirahat from guru a
				join presensi_jamkerja b
				on a.jamkerja = b.shift GROUP BY a.idcard) z on x.idcard = z.idcard
				where z.idcard = '".$data['idku']."' ORDER BY JamMasuk desc";
				
		$sql = strtolower($sql);
		return $this->db->query($sql);
	}

	// ---------------------------------------------------------------------------------------------------------------- dendra
	
	function select_all($tbl,$with,$sort){
		$this->db->order_by($with, $sort);
		$q = $this->db->get($tbl);  
		return $q;
	}

	function select_all_order($tbl,$arr,$with,$sort){
		$this->db->order_by($with, $sort);
		$this->db->where($arr);
		$query = $this->db->get($tbl);  
		return $query;
	}

	function update($tbl,$arr,$id_0,$id_1){
		$this->db->where($id_0, $id_1);
		$this->db->update($tbl, $arr);
	}

	function insert($tbl,$arr){
		$this->db->insert($tbl, $arr);
	}

	function delete($tbl,$arr){
		$this->db->delete($tbl, $arr); 
	}

	function last_data($tbl,$field,$record,$order){
		$q = "
			SELECT
				*
			FROM
				$tbl
			WHERE
				$field = $record;
			ORDER BY $order DESC
			LIMIT 1
			";

		$sql = strtolower($q);
		return $this->db->query($sql);

	}
	
	function last_data1($tbl,$record){
		$q = "
			SELECT
				MAX(NO) as nomor
			FROM
				$tbl
			WHERE
				idcard = '$record';
			";

		$sql = strtolower($q);
		return $this->db->query($sql);

	}

	function riwayat_ajuan($tbl,$idcard){
		$q = "
			SELECT
				*
			FROM
				$tbl a
			INNER JOIN ajuan b ON a.idcard = b.idcard
			INNER JOIN ref_ajuanstatus c ON b.id_ajuanstatus = c.id_statusajuan
			WHERE
				a.idcard = '$idcard' AND a.`no` = b.no_jenis_ajuan
			";

		$sql = strtolower($q);
		return $this->db->query($sql);
	}


	//===========================[ \/      adit      \/ ]=====(start)===================


	function riw_edu_add_process($data){
		$sql1 = "INSERT INTO `sas_tkplb`.`data_pendidikan` (
					`idcard`, 
					`nip`, 
					`tingkat_pend`, 
					`nama_sekolah`, 
					`jurusan`, 
					`thn_masuk`, 
					`thn_lulus`, 
					`tmp_belajar`, 
					`lokasi`, 
					`no_ijazah`
				) VALUES (
					'".$data['id_user']."', 
					(SELECT nip FROM `sas_tkplb`.`guru` WHERE idcard = '".$data['id_user']."'), 
					'".$data['tingkat_pend']."',
					'".$data['nama_sekolah']."',
					'".$data['jurusan']."',
					".$data['thn_masuk'].",
					CURDATE(), 
					'".$data['tmp_belajar']."',
					'".$data['lokasi']."',
					'".$data['nomor_ijazah']."'
				);"
		;
		$sql2 = "INSERT INTO `sas_tkplb`.`ajuan` (
					`jenis_ajuan`,
					`no_jenis_ajuan`,
					`tgl_ajuan`,
					`id_ajuanstatus`,
					`idcard`,
					`update_by`,
					`tgl_update`,
					`komentar`,
				) VALUES (
					1,
					(
						SELECT 
							no 
						FROM 
							sas_tkplb.data_pendidikan 
						WHERE 
							idcard = '".$data['id_user']."' AND 
							thn_lulus = (
								SELECT 
									MAX(thn_lulus) 
								FROM 
									sas_tkplb.data_pendidikan 
								WHERE idcard = '".$data['id_user']."'
							)
					),
					CURDATE(),
					6,
					'".$data['id_user']."',
					'',
					CURDATE(),
					''
				);"
		;
		
		$this->db->query($sql1+$sql2);
	}

	function list_ajuan_dik_fung(){
		$q = 	"SELECT
					a.idcard,
					a.no_jenis_ajuan,
					b.gelar_depan,
					b.nama,
					b.gelar_belakang,
					a.nama_ajuan,
					a.tgl_ajuan,
					a.jenis_ajuan,
					a.deskripsi
				FROM
					v_ajuan AS a
				INNER JOIN 
					guru AS b 
				ON 
					a.idcard = b.id ORDER BY tgl_ajuan DESC;";

		$sql = strtolower($q);
		return $this->db->query($sql);
	}

	function get_riw_dik_fung_detail($id_record){
		$q = 	"SELECT * FROM data_dikfungsi WHERE no = ".$id_record;

		$sql = strtolower($q);
		return $this->db->query($sql);
	}

	function get_riw_dik_teknis_detail($id_record){
		$q = 	"SELECT * FROM data_dikteknis WHERE no = ".$id_record;

		$sql = strtolower($q);
		return $this->db->query($sql);
	}

	function get_riw_dik_jenjang_detail($id_record){
		$q = 	"SELECT * FROM data_dikjenjang WHERE no = ".$id_record;

		$sql = strtolower($q);
		return $this->db->query($sql);
	}

	function get_riw_edu_detail($id_record){
		$q = 	"SELECT * FROM data_pendidikan WHERE no = ".$id_record;

		$sql = strtolower($q);
		return $this->db->query($sql);
	}

	function list_status_ajuan(){
		$q = "SELECT id_statusajuan as id, deskripsi FROM ref_ajuanstatus";

		$sql = strtolower($q);
		return $this->db->query($sql)->result();
	}

	function update_ajuan($data){
		$q1 = "UPDATE 
					ajuan 
				SET 
					id_ajuanstatus = '".$data['id_ajuanstatus']."', 
					update_by = '".$data['update_by']."', 
					tgl_update = CURDATE() 
				WHERE jenis_ajuan = '".$data['jenis_ajuan']."' AND no_jenis_ajuan = ".$data['no_jenis_ajuan'].";";
		
		$q2 = "";
		$jenis_ajuan = $data['jenis_ajuan'];
		$jenis_diklat = $data['jenis_diklat'];
		$table = "";
		if($jenis_ajuan == "1" || $jenis_ajuan == "2" || $jenis_ajuan == "3" || $jenis_ajuan == "4" || $jenis_ajuan == "13" ){
			if($jenis_ajuan == "1"){
				$jenis_diklat = "PENGEMBANGAN";
				$table = "data_pendidikan";
			}elseif($jenis_ajuan == "2"){
				$table = "data_dikfungsi";
			}elseif($jenis_ajuan == "3"){
				$table = "data_dikteknis";
			}elseif($jenis_ajuan == "4"){
				$table = "data_dikjenjang";
			}elseif($jenis_ajuan == "13"){
				$table = "data_seminar";
			}
			$q2 = "UPDATE 
						$table
					SET 
						jenis_diklat = '$jenis_diklat'
					WHERE `no` = '".$data['no_jenis_ajuan']."';";
			$this->db->query($q2);
			// echo "<script>console.log($table)</script>";
		}

		// $sql = strtolower($q1.$q2);
		$this->db->query($q1);
	}

	//===========================[ /\      adit      /\ ]=====(end)=====================

	// -----------------------------------------------------------------------------------------------------------------------

}

?>