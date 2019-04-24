<?php
	$path = base_url();
	if(isset($biodata)){
		//var_dump(json_decode($biodata));
		$data = json_decode($biodata);
	}
	
?>


<div class="row">
	<div class="col-md-2 align-lg-center">
		<div style="margin: 100px 0 0 15px; border: 3px #0AA699 solid;
		width: 150px; 
		height: 150px; 
		border-radius: 75px; 
		-webkit-border-radius: 
		75px; -moz-border-radius: 75px; 
		background: url(<?php echo $this->session->userdata('foto'); ?>) no-repeat;
		">;
			<!-- <img alt="" src="<?php //echo $this->session->userdata('foto'); ?>"> -->
		</div>
	</div>
	<div class="col-md-10">
			<br>
			<h3><strong>Data</strong> Pribadi</h3>
			<hr>
			
			<form>
					<div class="form-group">
							<label class="control-label">Nama</label>
							<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->Nama;}else{echo '-';} ?>">
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Gelar depan</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->Gelar_depan;}else{echo '-';} ?>">
							</div>
							<div class="col-md-6">
								<label class="control-label">Gelar belakang</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->Gelar_belakang;}else{echo '-';} ?>">
							</div>
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Tanggal lahir</label>
								<div class="input-group date form_datetime" data-picker-position="bottom-left" data-date-format="dd MM yyyy - HH:ii p">
									<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->TanggalLahir;}else{echo '-';} ?>">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><i class="fa fa-times"></i>&nbsp;</button>
										<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i>&nbsp;</button>
									</span>
								</div>
							</div>
							<div class="col-md-6">
								<label class="control-label">Tempat lahir</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->TempatLahir;}else{echo '-';} ?>">
							</div>
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Jenis kelamin</label>
								<select  class="selectpicker form-control">
									<option value="pria" <?php if(isset($data)){if($data->JenisKelamin=="PRIA"){echo "Selected";}} ?>>Pria</option>
									<option value="wanita" <?php if(isset($data)){if($data->JenisKelamin=="WANITA"){echo "Selected";}} ?>>Wanita</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="control-label">Status keluarga</label>
								<select  class="selectpicker form-control">
									<option value="nikah" <?php if(isset($data)){if($data->Status=="MENIKAH"){echo "Selected";}} ?>>Menikah</option>
									<option value="belum menikah" <?php if(isset($data)){if($data->Status=="BELUM MENIKAH"){echo "Selected";}} ?>>Belum menikah</option>
									<option value="duda" <?php if(isset($data)){if($data->Status=="DUDA"){echo "Selected";}} ?>>Duda</option>
									<option value="janda" <?php if(isset($data)){if($data->Status=="JANDA"){echo "Selected";}} ?>>Janda</option>
								</select>
							</div>
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Agama</label>
								<select  class="selectpicker form-control">
									<option value="islam" <?php if(isset($data)){if($data->Agama=="ISLAM"){echo "Selected";}} ?>>Islam</option>
									<option value="protestan" <?php if(isset($data)){if($data->Agama=="KRISTEN"){echo "Selected";}} ?>>Kristen Katolik</option>
									<option value="katolik" <?php if(isset($data)){if($data->Agama=="KATOLIK"){echo "Selected";}} ?>>Kristen Protestan</option>
									<option value="hindu" <?php if(isset($data)){if($data->Agama=="HINDU"){echo "Selected";}} ?>>Hindu</option>
									<option value="budha" <?php if(isset($data)){if($data->Agama=="BUDHA"){echo "Selected";}} ?>>Budha</option>
									<option value="konghuchu" <?php if(isset($data)){if($data->Agama=="KONGHUCHU"){echo "Selected";}} ?>>Konghuchu</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="control-label">Golongan darah</label>
								<select  class="selectpicker form-control">
									<option value="a" <?php if(isset($data)){if($data->Gol_Darah=="A"){echo "Selected";}} ?>>A</option>
									<option value="b" <?php if(isset($data)){if($data->Gol_Darah=="B"){echo "Selected";}} ?>>B</option>
									<option value="ab" <?php if(isset($data)){if($data->Gol_Darah=="AB"){echo "Selected";}} ?>>AB</option>
									<option value="o" <?php if(isset($data)){if($data->Gol_Darah=="O"){echo "Selected";}} ?>>O</option>
								</select>
							</div>
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Pendidikan</label>
								<select  class="selectpicker form-control">
									<option value="sd" <?php if(isset($data)){if($data->Pendidikan=="SD"){echo "Selected";}} ?>>SD sederajat</option>
									<option value="smp" <?php if(isset($data)){if($data->Pendidikan=="SMP"){echo "Selected";}} ?>>SMP sederajat</option>
									<option value="sma" <?php if(isset($data)){if($data->Pendidikan=="SMA" || $data->Pendidikan=="SMK"){echo "Selected";}} ?>>SMA/SMK sederajat</option>
									<option value="d1" <?php if(isset($data)){if($data->Pendidikan=="D1"){echo "Selected";}} ?>>D1</option>
									<option value="d2" <?php if(isset($data)){if($data->Pendidikan=="D2"){echo "Selected";}} ?>>D2</option>
									<option value="d3" <?php if(isset($data)){if($data->Pendidikan=="D3"){echo "Selected";}} ?>>D3</option>
									<option value="d4" <?php if(isset($data)){if($data->Pendidikan=="D4"){echo "Selected";}} ?>>D4</option>
									<option value="s1" <?php if(isset($data)){if($data->Pendidikan=="S1"){echo "Selected";}} ?>>S1</option>
									<option value="s2" <?php if(isset($data)){if($data->Pendidikan=="S2"){echo "Selected";}} ?>>S2</option>
									<option value="s3" <?php if(isset($data)){if($data->Pendidikan=="S3"){echo "Selected";}} ?>>S3</option>
								</select>
							</div>
							<!-- <div class="col-md-6">
								<label class="control-label">Nama sekolah</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->TempatLahir;}else{echo '-';} ?>">
							</div> -->
					</div>
					<!-- <div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Tanggal lulus</label>
								<div class="input-group date form_datetime" data-picker-position="bottom-left" data-date-format="dd MM yyyy - HH:ii p">
									<input type="text" class="form-control">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><i class="fa fa-times"></i>&nbsp;</button>
										<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i>&nbsp;</button>
									</span>
								</div>
							</div>
							<div class="col-md-6">
								<label class="control-label">Jurusan / Pendidikan</label>
								<input type="text" class="form-control"  placeholder="Your last name">
							</div>
					</div> -->
					<div class="form-group">
							<label class="control-label">Alamat</label>
							<textarea class="form-control"><?php if(isset($data)){echo $data->Alamat;}else{echo '-';} ?></textarea>
					</div>
					<div class="form-group row">
							<div class="col-md-3">
								<label class="control-label">Kab./Kota</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->Kab_Kota;}else{echo '-';} ?>">
							</div>
							<div class="col-md-3">
								<label class="control-label">Kode pos</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->KodePos;}else{echo '-';} ?>">
							</div>
							<div class="col-md-3">
								<label class="control-label">No. telp.</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->Telepon;}else{echo '-';} ?>">
							</div>
							<div class="col-md-3">
								<label class="control-label">No. hp.</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->NoHP;}else{echo '-';} ?>">
							</div>
					</div>
					
					<br>
					<h3><strong>Kepegawaian</strong></h3>
					<hr>
					<div class="form-group row">
							<div class="col-md-2">
								<label class="control-label">Unit kerja</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->idUnitKerja;}else{echo '-';} ?>">
							</div>
							<div class="col-md-10">
								<label class="control-label">&nbsp;</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->UnitKerja;}else{echo '-';} ?>">
							</div>
					</div>
					<!-- <div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">NIP. baru</label>
								<input type="text" class="form-control"  placeholder="Your last name">
							</div>
							<div class="col-md-6">
								<label class="control-label">NIP. lama</label>
								<input type="text" class="form-control"  placeholder="Your last name">
							</div>
					</div> -->
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Status kepegawain</label>
								<select  class="selectpicker form-control">
									<option value="1" <?php if(isset($data)){if($data->StatusPeg=="PNS DPK"){echo "Selected";}} ?>>PNS DPK</option>
									<option value="2" <?php if(isset($data)){if($data->StatusPeg=="PNS INSTANSI"){echo "Selected";}} ?>>PNS Instansi</option>
									<option value="3" <?php if(isset($data)){if($data->StatusPeg=="PNS"){echo "Selected";}} ?>>PNS</option>
									<option value="4" <?php if(isset($data)){if($data->StatusPeg!="PNS" && $data->StatusPeg!="PNS DPK" && $data->StatusPeg!="PNS INSTANSI"){echo "Selected";}} ?>>NON PNS</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="control-label">TMT. CPNS.</label>
								<div class="input-group date form_datetime" data-picker-position="bottom-left" data-date-format="dd MM yyyy - HH:ii p">
									<input type="text" class="form-control">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><i class="fa fa-times"></i>&nbsp;</button>
										<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i>&nbsp;</button>
									</span>
								</div>
							</div>
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Jabatan</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->jabatan;}else{echo '-';} ?>">
							</div>
							<div class="col-md-6">
								<label class="control-label">Tipe pegawai</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->TipePegawai;}else{echo '-';} ?>">
							</div>																		
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Golongan/Ruang</label>
								<select  class="selectpicker form-control">
									<option value="1" <?php if(isset($data)){if($data->Gol_ruang=="I/a"){echo "Selected";}} ?>>I/a</option>
									<option value="2" <?php if(isset($data)){if($data->Gol_ruang=="I/b"){echo "Selected";}} ?>>I/b</option>
									<option value="3" <?php if(isset($data)){if($data->Gol_ruang=="I/c"){echo "Selected";}} ?>>I/c</option>
									<option value="4" <?php if(isset($data)){if($data->Gol_ruang=="I/d"){echo "Selected";}} ?>>I/d</option>
									<option value="4" <?php if(isset($data)){if($data->Gol_ruang=="I/e"){echo "Selected";}} ?>>I/e</option>
									<option value="1" <?php if(isset($data)){if($data->Gol_ruang=="II/a"){echo "Selected";}} ?>>II/a</option>
									<option value="2" <?php if(isset($data)){if($data->Gol_ruang=="II/b"){echo "Selected";}} ?>>II/b</option>
									<option value="3" <?php if(isset($data)){if($data->Gol_ruang=="II/c"){echo "Selected";}} ?>>II/c</option>
									<option value="4" <?php if(isset($data)){if($data->Gol_ruang=="II/d"){echo "Selected";}} ?>>II/d</option>
									<option value="4" <?php if(isset($data)){if($data->Gol_ruang=="II/e"){echo "Selected";}} ?>>II/e</option>
									<option value="1" <?php if(isset($data)){if($data->Gol_ruang=="III/a"){echo "Selected";}} ?>>III/a</option>
									<option value="2" <?php if(isset($data)){if($data->Gol_ruang=="III/b"){echo "Selected";}} ?>>III/b</option>
									<option value="3" <?php if(isset($data)){if($data->Gol_ruang=="III/c"){echo "Selected";}} ?>>III/c</option>
									<option value="4" <?php if(isset($data)){if($data->Gol_ruang=="III/d"){echo "Selected";}} ?>>III/d</option>
									<option value="4" <?php if(isset($data)){if($data->Gol_ruang=="IIII/e"){echo "Selected";}} ?>>III/e</option>
									<option value="1" <?php if(isset($data)){if($data->Gol_ruang=="VI/a"){echo "Selected";}} ?>>VI/a</option>
									<option value="2" <?php if(isset($data)){if($data->Gol_ruang=="VI/b"){echo "Selected";}} ?>>VI/b</option>
									<option value="3" <?php if(isset($data)){if($data->Gol_ruang=="VI/c"){echo "Selected";}} ?>>VI/c</option>
									<option value="4" <?php if(isset($data)){if($data->Gol_ruang=="VI/d"){echo "Selected";}} ?>>VI/d</option>
									<option value="4" <?php if(isset($data)){if($data->Gol_ruang=="VI/e"){echo "Selected";}} ?>>VI/e</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="control-label">Pangkat</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->Pangkat;}else{echo '-';} ?>">
							</div>																		
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Shift kerja</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->jamkerja;}else{echo '-';} ?>">
							</div>
							<div class="col-md-6">
								<label class="control-label">Grade tunjangan kinerja</label>
								<input type="text" class="form-control" value="<?php if(isset($data)){echo $data->grade_tunkin;}else{echo '-';} ?>">
							</div>
					</div>
					<div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Kedudukan</label>
								<select  class="selectpicker form-control">
									<option value="aktif" <?php if(isset($data)){if($data->Aktif=="AKTIF"){echo "Selected";}} ?>>AKTIF</option>
									<option value="non aktif" <?php if(isset($data)){if($data->Aktif=="NON AKTIF"){echo "Selected";}} ?>>NON AKTIF</option>
									<option value="keluar" <?php if(isset($data)){if($data->Aktif=="KELUAR"){echo "Selected";}} ?>>KELUAR</option>
								</select>
							</div>
							<!-- <div class="col-md-6">
								<label class="control-label">No. NPWP.</label>
								<input type="text" class="form-control"  placeholder="Your last name">
							</div> -->
					</div>
					<!-- <div class="form-group row">
							<div class="col-md-6">
								<label class="control-label">Taspen.</label>
								<select  class="selectpicker form-control">
									<option value="1">Sudah</option>
									<option value="2">Belum</option>
								</select>
							</div>																		
					</div>
					
					<hr>
					<div class="form-group">
							<button type="button" class="btn btn-theme"> Refresh</button>
					</div> -->
			</form>
	</div>
</div>
