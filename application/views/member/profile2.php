<?php
	$path = base_url();
?>

<div id="overview">
		<div class="row">
				<div class="col-sm-12">
						<section class="profile-cover">
								<div class="profile-avatar">
										<div>
											<img alt="" src="<?php echo $path; ?>assets/img/avatar5.png" class="circle">
											<span><?php echo $this->session->userdata('nama'); ?></span>
										</div>
								</div>
						</section>
				</div>
				<!-- //content > row > col-sm-12 -->
		</div>
		<!-- //row-->
</div>

<div class="tabbable">
		<ul id="profile-tab" class="nav nav-tabs" data-provide="tabdrop">
				<!-- <li><a href="#" id="prevtab" data-change="prev"><i class="fa fa-chevron-left"></i></a></li>
				<li><a href="#" id="nexttab" class="change" data-change="next"><i class="fa fa-chevron-right"></i></a></li> -->
				<li class="active"><a href="#tab1" data-toggle="tab">Biodata</a></li>
				<li><a href="#tab2" data-toggle="tab">Riwayat Pendidikan</a></li>
				<li><a href="#tab3" data-toggle="tab">Riwayat Diklat</a></li>
				<li><a href="#tab4" data-toggle="tab">Riwayat Kepangkatan</a></li>
				<li><a href="#tab5" data-toggle="tab">Riwayat Jabatan</a></li>
				<li><a href="#tab6" data-toggle="tab">Riwayat Pekerjaan</a></li>
				<li><a href="#tab7" data-toggle="tab">Keluarga</a></li>
				<li><a href="#tab8" data-toggle="tab">Data DP3</a></li>
				<li><a href="#tab9" data-toggle="tab">Data Seminar</a></li>
				<li><a href="#tab10" data-toggle="tab">Data Tanda Jasa</a></li>
				<li><a href="#tab11" data-toggle="tab">Data Anggota Organisasi</a></li>
				<li><a href="#tab12" data-toggle="tab">Data Hukuman</a></li>
		</ul>
		<div class="tab-content row">						
			<div class="tab-pane fade in active col-lg-12" id="tab1">
				<div class="row">
					<div class="col-md-2 align-lg-center">
							<img alt="" src="<?php echo $path; ?>assets/img/avatar.png" class="circle" style="max-width:120px; border:5px #edece5 solid; margin:25px 0;">
							<div class="progress progress-shine progress-sm tooltip-in">
									<div class="progress-bar bg-warning" aria-valuetransitiongoal="69"></div>
							</div>
							<label class="progress-label">Account Complete</label>
					</div>
					<div class="col-md-10">
							<br>
							<h3><strong>Data</strong> Pribadi</h3>
							<hr>
							<form>
									<div class="form-group">
											<label class="control-label">Nama</label>
											<input type="text" class="form-control"  parsley-trigger="keyup"  parsley-rangelength="[8,15]"  parsley-required="true" parsley-trigger="keyup" placeholder="8-15 Characters">
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Gelar depan</label>
												<input type="text" class="form-control" id="fullname" parsley-required="true" placeholder="Your full name">
											</div>
											<div class="col-md-6">
												<label class="control-label">Gelar belakang</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Tanggal lahir</label>
												<div class="input-group date form_datetime" data-picker-position="bottom-left" data-date-format="dd MM yyyy - HH:ii p">
													<input type="text" class="form-control">
													<span class="input-group-btn">
														<button class="btn btn-default" type="button"><i class="fa fa-times"></i>&nbsp;</button>
														<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i>&nbsp;</button>
													</span>
												</div>
											</div>
											<div class="col-md-6">
												<label class="control-label">Tempat lahir</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Jenis kelamin</label>
												<select  class="selectpicker form-control">
													<option value="pria">Pria</option>
													<option value="wanita">Wanita</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="control-label">Status keluarga</label>
												<select  class="selectpicker form-control">
													<option value="nikah">Menikah</option>
													<option value="belum menikah">Belum menikah</option>
													<option value="duda">Duda</option>
													<option value="janda">Janda</option>
												</select>
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Agama</label>
												<select  class="selectpicker form-control">
													<option value="islam">Islam</option>
													<option value="protestan">Kristen Katolik</option>
													<option value="katolik">Kristen Protestan</option>
													<option value="hindu">Hindu</option>
													<option value="budha">Budha</option>
													<option value="konghuchu">Konghuchu</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="control-label">Golongan darah</label>
												<select  class="selectpicker form-control">
													<option value="a">A</option>
													<option value="b">B</option>
													<option value="ab">AB</option>
													<option value="o">O</option>
												</select>
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Pendidikan</label>
												<select  class="selectpicker form-control">
													<option value="sd">SD sederajat</option>
													<option value="smp">SMP sederajat</option>
													<option value="sma">SMA/SMK sederajat</option>
													<option value="d1">D1</option>
													<option value="d2">D2</option>
													<option value="d3">D3</option>
													<option value="d4">D4</option>
													<option value="s1">S1</option>
													<option value="s2">S2</option>
													<option value="s3">S3</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="control-label">Nama sekolah</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									<div class="form-group row">
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
									</div>
									<div class="form-group">
											<label class="control-label">Alamat</label>
											<textarea class="form-control"  parsley-trigger="keyup" rows="3" placeholder="Enter  your address"></textarea>
									</div>
									<div class="form-group row">
											<div class="col-md-4">
												<label class="control-label">Kab./Kota</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
											<div class="col-md-4">
												<label class="control-label">Kode pos</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
											<div class="col-md-4">
												<label class="control-label">No. telp.</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									
									<br>
									<h3><strong>Kepegawaian</strong></h3>
									<hr>
									<div class="form-group row">
											<div class="col-md-2">
												<label class="control-label">Unit eseleon</label>
												<select  class="selectpicker form-control">
													<option value="1">I</option>
													<option value="2">II</option>
													<option value="3">III</option>
													<option value="4">IV</option>
												</select>
											</div>
											<div class="col-md-10">
												<label class="control-label">&nbsp;</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">NIP. baru</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
											<div class="col-md-6">
												<label class="control-label">NIP. lama</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Status kepegawain</label>
												<select  class="selectpicker form-control">
													<option value="1">PNS DPK</option>
													<option value="2">PNS Instansi</option>
													<option value="3">PNS</option>
													<option value="4">NON PNS</option>
												</select>
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Instansi asal</label>
												<input type="text" class="form-control"  placeholder="Your last name">
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
											<div class="col-md-12">
												<label class="control-label">Unit kerja</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Golongan</label>
												<select  class="selectpicker form-control">
													<option value="1">I/a</option>
													<option value="2">I/b</option>
													<option value="3">I/c</option>
													<option value="4">I/d</option>
													<option value="4">I/e</option>
													<option value="1">II/a</option>
													<option value="2">II/b</option>
													<option value="3">II/c</option>
													<option value="4">II/d</option>
													<option value="4">II/e</option>
													<option value="1">III/a</option>
													<option value="2">III/b</option>
													<option value="3">III/c</option>
													<option value="4">III/d</option>
													<option value="4">III/e</option>
													<option value="1">VI/a</option>
													<option value="2">VI/b</option>
													<option value="3">VI/c</option>
													<option value="4">VI/d</option>
													<option value="4">VI/e</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="control-label">TMT. golongan</label>
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
											<div class="col-md-12">
												<label class="control-label">Nama jabatan</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">No. karpeg.</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
											<div class="col-md-6">
												<label class="control-label">No. NPWP.</label>
												<input type="text" class="form-control"  placeholder="Your last name">
											</div>
									</div>
									<div class="form-group row">
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
									</div>
							</form>
					</div>
				</div>
					
			</div>
			<!-- /#tab1-->

			<div class="tab-pane fade col-lg-12" id="tab2">
					<div class="row">
						<div class="col-md-12">
							<br>
							<h3><strong>Riwayat</strong> Pendidikan Formal</h3>
							<hr>
							<div class="form-group">
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
											<thead>
												<tr>
														<th>Jenjang</th>
														<th>Nama</th>
														<th>Jurusan</th>
														<th>Masuk</th>
														<th>Lulus</th>
														<th>Instansi</th>
														<th>Lokasi</th>
														<th>No. ijazah</th>
												</tr>
											</thead>
											<tbody align="center">
												<tr class="odd">
														<td class="center">S1</td>
														<td>Hendri</td>
														<td class="center">Informatika</td>
														<td>1999</td>
														<td>2002</td>
														<td>Sekolah Tinggi Ilmu Komputer</td>
														<td>Jl. Dinoyo no. 48 Langdungsari Malang</td>
														<td>1234567890.abcdefg</td>
												</tr>
											</tbody>
									</table>
							</div>
							
						</div>
					</div>
			</div>
			<!-- /#tab2-->
									
			<div class="tab-pane fade col-lg-12" id="tab3">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Riwayat</strong> Diklat Fungsional</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Nama diklat</th>
													<th>Tempat</th>
													<th>Kota</th>
													<th>Mulai</th>
													<th>Selesai</th>
													<th>Total jam</th>
													<th>Penyelenggara</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>Sekolah Tinggi Ilmu Komputer</td>
													<td>Jl. Dinoyo no. 48 Langdungsari Malang</td>
													<td>1234567890.abcdefg</td>
											</tr>
										</tbody>
								</table>
						</div>
						
						<br>
						<h3><strong>Riwayat</strong> Diklat Teknis</h3>
						<hr>
						<div class="form-group">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
									<thead>
										<tr>
												<th>NIP</th>
												<th>Nama diklat</th>
												<th>Tempat</th>
												<th>Kota</th>
												<th>Mulai</th>
												<th>Selesai</th>
												<th>Total jam</th>
												<th>Penyelenggara</th>
										</tr>
									</thead>
									<tbody align="center">
										<tr class="odd">
												<td class="center">S1</td>
												<td>Hendri</td>
												<td class="center">Informatika</td>
												<td>1999</td>
												<td>2002</td>
												<td>Sekolah Tinggi Ilmu Komputer</td>
												<td>Jl. Dinoyo no. 48 Langdungsari Malang</td>
												<td>1234567890.abcdefg</td>
										</tr>
									</tbody>
							</table>
						</div>
						
						<br>
						<h3><strong>Riwayat</strong> Diklat Penjenjangan / Struktural</h3>
						<hr>
						<div class="form-group">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Jenis diklat</th>
													<th>Angkatan</th>
													<th>Penyelenggara</th>
													<th>Lokasi</th>
													<th>Tgl. mulai</th>
													<th>Tgl. selesai</th>
													<th>Total jam</th>
													<th>Predikat</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>Sekolah Tinggi Ilmu Komputer</td>
													<td>Jl. Dinoyo no. 48 Langdungsari Malang</td>
													<td>1234567890.abcdefg</td>
													<td>Lulus</td>
											</tr>
										</tbody>
								</table>
						</div>
						
					</div>
				</div>

			</div>
			<!-- /#tab3-->

			<div class="tab-pane fade col-lg-12" id="tab4">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Riwayat</strong> Kepangkatan</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>Jenis</th>
													<th>TMT</th>
													<th>Penandatangan</th>
													<th>No. SK.</th>
													<th>Tgl. SK.</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /#tab4-->
			
			<div class="tab-pane fade col-lg-12" id="tab5">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Riwayat</strong> Jabatan Struktural</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Eselon</th>
													<th>Nama</th>
													<th>Unit kerja</th>
													<th>TMT</th>
													<th>No.</th>
													<th>Tgl.</th>
													<th>Pejabat penandatangan</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>Sekolah Tinggi Ilmu Komputer</td>
													<td>Jl. Dinoyo no. 48 Langdungsari Malang</td>
													<td>1234567890.abcdefg</td>
											</tr>
										</tbody>
								</table>
						</div>
						
						<br>
						<h3><strong>Riwayat</strong> Jabatan Fungsional</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Nama</th>
													<th>TMT</th>
													<th>No.</th>
													<th>Tgl.</th>
													<th>Pejabat penandatangan</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td>2002</td>
													<td>Sekolah Tinggi Ilmu Komputer</td>
													<td>Jl. Dinoyo no. 48 Langdungsari Malang</td>
													<td>1234567890.abcdefg</td>
											</tr>
										</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /#tab5-->
			
			<div class="tab-pane fade col-lg-12" id="tab6">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Riwayat</strong> Pekerjaan / Jabatan</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Nama jabatan</th>
													<th>TMT jabatan</th>
													<th>Tahun mulai</th>
													<th>Tahun selesai</th>
													<th>No. SK.</th>
													<th>Tgl. SK.</th>
													<th>NIP baru pejabat penandatangan</th>
													<th>NIP lama pejabat penandatangan</th>
													<th>Pejabat</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /#tab6-->
			
			<div class="tab-pane fade col-lg-12" id="tab7">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Data</strong> Istri / Suami</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Nama pasangan</th>
													<th>No. karis</th>
													<th>Tgl. lahir</th>
													<th>Tgl. nikah</th>
													<th>Pendidikan</th>
													<th>Pekerjaan</th>
													<th>Status pasangan</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
						
						<br>
						<h3><strong>Data</strong> Anak</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Nama</th>
													<th>Jenis kelamin</th>
													<th>Tempat lahir</th>
													<th>Tgl. lahir</th>
													<th>Status</th>
													<th>Pendidikan</th>
													<th>Pekerjaan</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
						
						<br>
						<h3><strong>Data</strong> Keluarga</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Keluarga</th>
													<th>Nama</th>
													<th>Hubungan</th>
													<th>Pekerjaan</th>
													<th>Tgl. lahir</th>
													<th>Jenis kelamin</th>
													<th>Kondisi</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
						
					</div>
				</div>
			</div>
			<!-- /#tab7-->

			<div class="tab-pane fade col-lg-12" id="tab8">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Data</strong> DP3</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP.</th>
													<th>Tahun</th>
													<th>NIP baru pejabat penilai</th>
													<th>NIP lama pejabat penilai</th>
													<th>Nama pejabat penilai</th>
													<th>Jabatan pejabat penilai</th>
													<th>Unit kerja pejabat penilai</th>
													<th>NIP baru atasan pejabat penilai</th>
													<th>NIP lama atasan pejabat penilai</th>
													<th>Nama atasan pejabat penilai</th>
													<th>Unit kerja pejabat penilai</th>
													<th>Nilai kesetiaan</th>
													<th>Nilai kerjasama</th>
													<th>Nilai prestasi kerja</th>
													<th>Nilai prakarsa</th>
													<th>Nilai tanggung jawab</th>
													<th>Nilai kepemimpinan</th>
													<th>Nilai ketaatan</th>
													<th>Nilai kejujuran</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /#tab8-->
			
			<div class="tab-pane fade col-lg-12" id="tab9">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Data</strong> Seminar / Lokakarya / Simposium</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP.</th>
													<th>Nama kegiatan</th>
													<th>Lokasi kegiatan</th>
													<th>Tempat kegiatan.</th>
													<th>Penyelenggara kegiatan</th>
													<th>Tahun kegiatan</th>
													<th>Keudukan kegiatan</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /#tab9-->
			
			<div class="tab-pane fade col-lg-12" id="tab10">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Data</strong> Tanda Jasa / Penghargaan</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP.</th>
													<th>Nama tanda jasa</th>
													<th>Tgl. tanda jasa</th>
													<th>No. tanda jasa</th>
													<th>Negara / Instansi pemberi</th>
													<th>Jabatan tanda jasa</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /#tab10-->
			
			<div class="tab-pane fade col-lg-12" id="tab11">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Data</strong> Keanggotaan Organisasi</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Tahun</th>
													<th>Nama organisasi</th>
													<th>Kedudukan di-organisasi</th>
													<th>Tgl. mulai</th>
													<th>Tgl. selesai</th>
													<th>No. SK.</th>
													<th>SK. jabatan pembuat</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /#tab11-->
			
			<div class="tab-pane fade col-lg-12" id="tab12">
				<div class="row">
					<div class="col-md-12">
						<br>
						<h3><strong>Data</strong> Hukuman Disiplin</h3>
						<hr>
						<div class="form-group">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-rwy-pendidikan">
										<thead>
											<tr>
													<th>NIP</th>
													<th>Hukuman</th>
													<th>No. SK.</th>
													<th>Tgl. SK.</th>
													<th>TMT. SK.</th>
													<th>Pejabat pembuat SK.</th>
											</tr>
										</thead>
										<tbody align="center">
											<tr class="odd">
													<td class="center">S1</td>
													<td>Hendri</td>
													<td class="center">Informatika</td>
													<td>1999</td>
													<td>2002</td>
													<td>2002</td>
											</tr>
										</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /#tab12-->
			
		</div>
		<!-- //tab-content -->
</div>