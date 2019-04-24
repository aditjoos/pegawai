<?php
	$path = base_url();
	if(isset($biodata)){
		//var_dump(json_decode($biodata));
		$data = json_decode($biodata);
	}
	
	if(isset($rekap)){
		//var_dump(json_decode($rekap));
		$data_rekap = json_decode($rekap);
	}
	
?>
<section class="panel corner-flip">
	<header class="panel-heading no-borders bg-lightseagreen">
			<div class="mail-title">
				<h3>Rekap Presensi Pegawai</h3>
				<section>
					<span><strong><?php echo $this->session->userdata('nama'); ?></strong></span>
				</section>
			</div>
	</header>		
	<div class="panel-tools fully color bg-lightseagreen-darken" align="right"></div>
	<div class="panel-body">	
			<div class="alert alert-info alert-block">
				<strong>Penting !</strong> 
				<br />
				<ol class="rectangle-list">
					<li><a href="#" style="background-color: transparent; color: #31708F">Rekap data presensi dilakukan selambat-lambatnya <strong>PADA TANGGAL 3 SETIAP BULAN</strong></a></li>
					<li><a href="#" style="background-color: transparent; color: #31708F">Apabila ada ketidaksesuaian data, mohon segera konfirmasi ke bagian kepegawaian <strong>SEBELUM TANGGAL 7 SETIAP BULAN</strong></a></li>
					<li><a href="#" style="background-color: transparent; color: #31708F"><strong>Batas pengajuan tukin adalah tanggal 7 setiap bulannya</strong>, pengajuan komplain melebihi tanggal tersebut <strong>tidak akan dilayani</strong></a></li>
				</ol>
				
			</div>
			<div class="btn-toolbar" role="toolbar">
					<div class="btn-group">
							<a href="#tab1" class="btn btn-theme-inverse" data-toggle="tab"><i class="fa fa-calendar"></i> Rekap presensi</a>					
					</div>
					<div class="btn-group">
							<a href="#tab2" class="btn btn-theme-inverse" data-toggle="tab"><i class="fa fa-th-list"></i> Detail presensi</a>					
					</div>
					<div class="btn-group">
							<a href="#tab3" class="btn btn-theme-inverse" data-toggle="tab"><i class="fa fa-bar-chart-o"></i> Perhitungan tunjangan kinerja</a>						
					</div>
			</div>
			<hr>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<div class="row">
						<div class="col-lg-12" id="msg-load">
							
						</div>
					</div>
					<div class="row">				
							<div class="col-lg-8" >
									<div id="calendar"></div>
							</div>		
							<div class="col-lg-4" >
								<h3><strong>Keterangan</strong></h3>
								<hr>
									<table class="table table-hover table-bordered">
										<tbody align="left">
												<tr>
														<td style="background-color: #F7F6F1"><strong>NIP</strong></td>
														<td><?php 
																	if(isset($data)){
																		echo $data->nip;	
																	}else{
																		echo '-'; 
																	}
																?>
														</td>
												</tr>
												<tr>
														<td style="background-color: #F7F6F1"><strong>Nama</strong></td>
														<td><?php 
																	if(isset($data)){
																		echo $data->nama;	
																	}else{
																		echo '-'; 
																	}
																?>
														</td>
												</tr>
												<tr>
														<td style="background-color: #F7F6F1"><strong>Jumlah masuk</strong></td>
														<td id="jmh_masuk"></td>
												</tr>
												<tr>
														<td style="background-color: #F7F6F1"><strong>Dinas luar</strong></td>
														<td id="jmh_dl"></td>
												</tr>
												<tr>
														<td style="background-color: #F7F6F1"><strong>Sakit</strong></td>
														<td id="jmh_sakit"></td>
												</tr>
												<tr>
														<td style="background-color: #F7F6F1"><strong>Ijin</strong></td>
														<td id="jmh_ijin"></td>
												</tr>
												<tr>
														<td style="background-color: #F7F6F1"><strong>Cuti</strong></td>
														<td id="jmh_cuti"></td>
												</tr>
												<tr>
														<td style="background-color: #F7F6F1"><strong>Tanpa keterangan</strong></td>
														<td id="jmh_tk"></td>
												</tr>
												<tr>
														<td style="background-color: #F7F6F1"><strong>Total jam</strong></td>
														<td id="tot_jam"></td>
												</tr>
										</tbody>
								</table>
							</div>					
					</div>
				</div>
				
				<div class="tab-pane" id="tab2">
					<div class="row">				
							<div class="col-lg-12" >
									<div class="table-responsive">
										<table class="table table-bordered table-striped" id="tabel-detail">
											<thead>
												<tr>
													<th>No.</th>
													<th>Tanggal</th>
													<th>Jam masuk</th>
													<th>Jam keluar</th>
													<th>Total jam</th>
													<th>Keterangan</th>
												</tr>
											</thead>
											<tbody>
												<tr>														
													<td colspan="6" style="text-align: center">Rekapan belum tersedia</td>
												</tr>
											</tbody>
											<tfoot style="background-color: #f9f8f5; color: #898989">
												<tr>														
													<td colspan="4" style="text-align: right">Total jam </td>
													<td style="text-align: right">-</td>
													<td style="text-align: center"></td>
												</tr>
											</tfoot>
										</table>
									</div>
							</div>							
					</div>
				</div>
				
				<div class="tab-pane" id="tab3">
					<div class="row">				
							<div class="col-lg-12" >
								<div class ="col-lg-4">
									<div class="alert alert-success" id="akum1">
										<strong>(A)</strong> - Akumulasi Kurang Jam Kerja:
									</div>
								</div>
								<div class ="col-lg-4">
									<div class="alert alert-success" id="akum2">
										<strong>(B)</strong> - Nilai Pengurang Tunkin:
									</div>
								</div>
								<div class ="col-lg-4">
									<div class="alert alert-success" id="akum3">
										<strong>(C)</strong> - Point Potongan Kinerja (presensi):
									</div>
								</div>
								<div class ="col-lg-6">
									<div class="alert alert-danger" id="akum4">
										<i class="fa fa-warning pull-right"></i>
										<strong>(D)</strong> - Total Potongan [B + C]:
									</div>
								</div>
								<div class ="col-lg-6">
									<div class="alert alert-info" id="akum5">
										<i class="fa fa-check-square pull-right"></i>
										<strong>(E)</strong> - Point Tunjangan Kerja [100 - D] :
									</div>
								</div>
									<div class="table-responsive" style="width: 100%; overflow-x:scroll;">
										<table class="table table-bordered table-striped" id="tabel-tukin">
											<thead>
												<tr>
													<th rowspan = '3'>No.</th>
													<th rowspan = '3'>Hari</th>
													<th rowspan = '3'>Tanggal</th>
													<th rowspan = '3'>Jenis</th>
													<th colspan = '12' class="success">Datang</th>
													<th colspan = '11' class="warning">Pulang</th>
													<th colspan = '3' rowspan='2'>Akumulasi</th>
												</tr>
												<tr>
													<th colspan = '2' class="success">Rekaman Datang</th>
													<th colspan = '3' class="success">Status Kehadiran</th>
													<th colspan = '7' class="success">Point Keterlambatan (%)</th>
													<th colspan = '2' class="warning">Rekaman Pulang</th>
													<th colspan = '3' class="warning">Status Pulang</th>
													<th colspan = '6' class="warning">Point PSW (%)</th>
												</tr>
												<tr>
													<th class="success">Aturan</th>
													<th class="success">Finger</th>
													<th class="success">Terlambat</th>
													<th class="success">Akumulasi</th>
													<th class="success">Angka</th>
													<th class="success">0</th>
													<th class="success">0,5</th>
													<th class="success">1</th>
													<th class="success">1,5</th>
													<th class="success">2</th>
													<th class="success">3</th>
													<th class="success">Jumlah</th>
													
													<th class="warning">Aturan</th>
													<th class="warning">Finger</th>
													<th class="warning">PSW</th>
													<th class="warning">Akumulasi</th>
													<th class="warning">Angka</th>
													<th class="warning">0,5</th>
													<th class="warning">1</th>
													<th class="warning">1,5</th>
													<th class="warning">2</th>
													<th class="warning">3</th>
													<th class="warning">Jumlah</th>
													<th>Ada Suket</th>
													<th nowrap>Potong Point</th>
													<th nowrap>Jam Kerja Kurang</th>
												</tr>
											</thead>
											<tbody>
													<tr>
														<td colspan='29' style='text-align:center'><h3>Rekapan Belum Tersedia</h3></td>
													</tr>												
											</tbody>
											<tfoot style="background-color: #f9f8f5; color: #898989">
												<tr>														
													<td style="text-align: right" colspan="29">&nbsp;</td>
												</tr>
												<tr>														
													<td colspan="30">
													<!--
														<p><strong>Catatan : </strong></p>
														<p><strong>Total Kinerja = (100 - Jam Kinerja Kurang) - Poin Sakit</strong></p>
														<p><strong>Jika Sakit &lt; 3 maka Point Sakit = 0</strong></p>
														<p><strong>Jika Sakit &gt; = 3 dan Sakit &lt; = 14 maka Point Sakit = 25</strong></p>
														<p><strong>Jika Sakit &gt; = 15 maka Point Sakit = 50</strong></p>
													-->
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
							</div>							
					</div>
				</div>
				
			</div>
	</div>
	<div class="flip"></div>
</section>

