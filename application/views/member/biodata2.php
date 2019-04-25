<?php
	$path = base_url();
	if(isset($biodata)){
		//var_dump(json_decode($biodata));
		$data = json_decode($biodata);
	}

?>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading bg-inverse">
                    <h3><strong>Biodata</strong> Pegawai </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info">
                                <strong>Informasi!</strong>
                                <br /> Apabila ada ketidaksesuaian data pegawai, mohon segera konfirmasi ke bagian kepegawaian.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabbable">
                                <ul class="nav nav-tabs" data-provide="tabdrop">
                                    <li class="active"><a href="#home" data-toggle="tab">Data Dasar</a></li>
                                    <li><a href="#pendidikan" data-toggle="tab">Riwayat Pendidikan</a></li>
                                    <li><a href="#dik_fungsi" data-toggle="tab">Riwayat Diklat Fungsional</a></li>
                                    <li><a href="#dik_teknis" data-toggle="tab">Riwayat Diklat Teknis</a></li>
                                    <li><a href="#dik_jenjang" data-toggle="tab">Riwayat Diklat Penjenjangan</a></li>
                                    <li><a href="#pangkat" data-toggle="tab">Riwayat Kepangkatan</a></li>
                                    <li><a href="#jab_struktural" data-toggle="tab">Riwayat Jabatan Struktural</a></li>
                                    <li><a href="#jab_fungsional" data-toggle="tab">Riwayat Jabatan Fungsional</a></li>
                                    <li><a href="#pekerjaan" data-toggle="tab">Riwayat Pekerjaan</a></li>
                                    <li><a href="#kel_suamiistri" data-toggle="tab">Data Keluarga (Suami/Istri)</a></li>
                                    <li><a href="#kel_anak" data-toggle="tab">Data Keluarga (Anak)</a></li>
                                    <li><a href="#kel_keluarga" data-toggle="tab">Data Keluarga (Keluarga)</a></li>
                                    <li><a href="#dp3" data-toggle="tab">Data DP3</a></li>
                                    <li><a href="#seminar" data-toggle="tab">Data Seminar</a></li>
                                    <li><a href="#tanda_jasa" data-toggle="tab">Data Tanda Jasa</a></li>
                                    <li><a href="#anggota_organisasi" data-toggle="tab">Data Anggota Organisasi</a></li>
                                    <li><a href="#hukuman" data-toggle="tab">Data Hukuman</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active row" id="home">
                                        <div class="col-lg-9">
                                            <div class="table-responsive ">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2" class="bg-theme-inverse"><strong>A. BIODATA</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Nama lengkap</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->nama;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Gelar depan</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->gelar_depan;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Gelar belakang</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->gelar_belakang;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Tempat lahir</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->tempatlahir;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Tanggal lahir</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->tanggallahir;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Jenis kelamin</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->jeniskelamin;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Status keluarga</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->status;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Agama</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->agama;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Golongan darah</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->gol_darah;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Pendidikan terakhir</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->pendidikan;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Alamat</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->alamat;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Kab./Kota</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->kab_kota;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Kode pos</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->kodepos;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">No. telp.</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->telepon;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">No. hp.</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->nohp;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="bg-theme-inverse"><strong>B. KEPEGAWAIAN</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Unit kerja</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->idunitkerja.' - '.$data->unitkerja;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Status kepegawaian</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->statuspeg;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">TMT. CPNS.</td>
                                                            <td>-</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Jabatan</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->jabatan;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Tipe pegawai</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->tipepegawai;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Golongan ruang</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->gol_ruang;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Pangkat</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->pangkat;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 150px">Grade tunjangan kinerja</td>
                                                            <td>
                                                                <?php if(isset($data)){echo $data->grade_tunkin;}else{echo '-';} ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody align="center">
                                                        <tr>
                                                            <td class="bg-theme-inverse"><strong>PAS FOTO</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td><img alt="" src="<?php echo $this->session->userdata('foto'); ?>" style="height: auto; max-width: 200px"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="pendidikan">
                                        <div class="col-lg-12">
                                            <div>
                                                <span style="margin-bottom: 10px;font-size: 26px;"><strong>Riwayat</strong> Pendidikan </span>
                                                <a class="btn btn-primary pull-right" href="<?php echo $path;?>Member/riw_edu_add"><i class="fa fa-plus"></i> Tambah Ajuan</a>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td>Sekolah / Universitas</td>
                                                            <td>Waktu</td>
                                                            <td>Lokasi</td>
                                                            <td>Nomor Ijasah</td>
                                                            <td>Status</td>
                                                            <td>Aksi</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="ls_pendidikan"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="dik_fungsi">
                                    	<div class="col-lg-12">
                                            <div>
                                                <span style="margin-bottom: 10px;font-size: 26px;"><strong>Riwayat</strong> Diklat Fungsional </span>
                                                <a class="btn btn-primary pull-right" href="<?php echo base_url();?>Member/riw_dik_fungsi_add"><i class="fa fa-plus"></i> Tambah Ajuan</a>
                                            </div>
                                            <div class="table-responsive ">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td rowspan="2">Nama Diklat</td>
                                                            <td colspan="2">Lokasi</td>
                                                            <td colspan="3">Waktu</td>
                                                            <td rowspan="2">Penyelenggara</td>
                                                            <td rowspan="2">Status</td>
                                                            <td rowspan="2">Aksi</td>
                                                        </tr>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td>Tempat</td>
                                                            <td>Kota</td>
                                                            <td>Mulai</td>
                                                            <td>Selesai</td>
                                                            <td>Total Jam</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="ls_dik_fungsi"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="dik_teknis">
                                        <div class="col-lg-12">
                                            <div>
                                                <span style="margin-bottom: 10px;font-size: 26px;"><strong>Riwayat</strong> Diklat Teknis </span>
                                                <a class="btn btn-primary pull-right" href="<?php echo base_url();?>Member/riw_dik_teknis_add"><i class="fa fa-plus"></i> Tambah Ajuan</a>
                                            </div>
                                            <div class="table-responsive ">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td rowspan="2">Nama Diklat</td>
                                                            <td colspan="2">Lokasi</td>
                                                            <td colspan="3">Waktu Diklat</td>
                                                            <td rowspan="2">Penyelenggara</td>
                                                            <td rowspan="2">Status</td>
                                                            <td rowspan="2">Berkas</td>
                                                        </tr>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td>Tempat</td>
                                                            <td>Kota</td>
                                                            <td>Mulai</td>
                                                            <td>Selesai</td>
                                                            <td>Total Jam</td>
                                                        </tr>
                                                       
                                                    </thead>
                                                    <tbody id="ls_dik_teknis"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="dik_jenjang">
                                        <div class="col-lg-12">
                                            <div>
                                                <span style="margin-bottom: 10px;font-size: 26px;"><strong>Riwayat</strong> Diklat Penjenjangan </span>
                                                <a class="btn btn-primary pull-right" href="<?php echo base_url();?>Member/riw_dik_jenjang_add"><i class="fa fa-plus"></i> Tambah Ajuan</a>
                                            </div>
                                            <div class="table-responsive ">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td rowspan="2">Jenis Diklat</td>
                                                            <td rowspan="2">Angkatan</td>
                                                            <td rowspan="2">Penyelenggara</td>
                                                            <td rowspan="2">Lokasi</td>
                                                            <td colspan="3">Waktu</td>
                                                            <td rowspan="2">Predikat</td>
                                                            <td rowspan="2">Status</td>
                                                            <td rowspan="2">Berkas</td>
                                                        </tr>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td>Tgl Mulai</td>
                                                            <td>Tgl Selesai</td>
                                                            <td>Total Jam</td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="pangkat">
                                        <div class="col-lg-12">
                                            <div>
                                                <span style="margin-bottom: 10px;font-size: 26px;"><strong>Riwayat</strong> Kepangkatan</span>
                                                <a class="btn btn-primary pull-right" href="<?php echo base_url();?>Member/riw_pangkat_add"><i class="fa fa-plus"></i> Tambah Ajuan</a>
                                            </div>
                                            <div class="table-responsive ">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td colspan="2">Golongan</td>
                                                            <td colspan="3">Pejabat</td>
                                                            <td rowspan="2">Status</td>
                                                            <td rowspan="2">Berkas</td>
                                                        </tr>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td>Jenis</td>
                                                            <td>TMT</td>
                                                            <td>Penandatangan</td>
                                                            <td>Nomor SK</td>
                                                            <td>Tanggal SK</td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="jab_struktural">
                                        <div class="col-lg-12">
                                            <div>
                                                <span style="margin-bottom: 10px;font-size: 26px;"><strong>Riwayat</strong> Jabatan Struktural</span>
                                                <a class="btn btn-primary pull-right" href="<?php echo base_url();?>Member/riw_jab_struktur_add"><i class="fa fa-plus"></i> Tambah Ajuan</a>
                                            </div>
                                            <div class="table-responsive ">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td rowspan="2">Eselon</td>
                                                            <td colspan="3">Jabatan</td>
                                                            <td colspan="3">SK</td>
                                                            <td rowspan="2">Status</td>
                                                            <td rowspan="2">Berkas</td>
                                                        </tr>
                                                        <tr style="text-align: center;" class="bg-theme-inverse">
                                                            <td>Nama</td>
                                                            <td>Unit Kerja</td>
                                                            <td>TMT</td>
                                                            <td>Nomor</td>
                                                            <td>Tanggal</td>
                                                            <td>Pejabat Penandatangan</td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="jab_fungsional">
                                        <div class="col-lg-12">
                                            <div>
                                                <span style="margin-bottom: 10px;font-size: 26px;"><strong>Riwayat</strong> Jabatan Fungsional</span>
                                                <a class="btn btn-primary pull-right" href="<?php echo base_url();?>Member/riw_jab_fungsi_add"><i class="fa fa-plus"></i> Tambah Ajuan</a>
                                            </div>
                                            <div class="table-responsive ">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Nama Jabatan</td>
                                                            <td>TMT Jabatan</td>
                                                            <td>Nomor SK</td>
                                                            <td>Tanggal SK</td>
                                                            <td>Pejabat Penandatangan</td>
                                                            <td>Status</td>
                                                            <td>Berkas</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="pekerjaan">
                                        <div class="col-lg-12">
                                            <div>
                                                <span style="margin-bottom: 10px;font-size: 26px;"><strong>Riwayat</strong> Pekerjaan</span>
                                                <a class="btn btn-primary pull-right" href="<?php echo base_url();?>Member/riw_pekerjaan_add"><i class="fa fa-plus"></i> Tambah Ajuan</a>
                                            </div>
                                            <div class="table-responsive ">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Nama Jabatan</td>
                                                            <td>TMT Jabatan</td>
                                                            <td>Tahun Mulai</td>
                                                            <td>Tahun Selesai</td>
                                                            <td>Nomor SK</td>
                                                            <td>Tanggal SK</td>
                                                            <td>NIP Baru</td>
                                                            <td>NIP Lama</td>
                                                            <td>Pejabat</td>
                                                            <td>Status</td>
                                                            <td>Berkas</td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade row" id="kel_suamiistri">
                                    </div>

                                    <div class="tab-pane fade row" id="kel_anak">
                                    </div>
                                    <div class="tab-pane fade row" id="kel_keluarga">
                                    </div>
                                    <div class="tab-pane fade row" id="dp3">
                                    </div>
                                    <div class="tab-pane fade row" id="seminar">
                                    </div>
                                    <div class="tab-pane fade row" id="tanda_jasa">
                                    </div>
                                    <div class="tab-pane fade row" id="anggota_organisasi">
                                    </div>
                                    <div class="tab-pane fade row" id="hukuman">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </section>

        </div>
    </div>
