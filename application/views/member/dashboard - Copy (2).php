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
									<div class="alert alert-success">
										<strong>A</strong> - Akumulasi Kurang Jam Kerja:
										<?php 
											foreach($report1->result_array() as $a){
												echo ' <strong>',$a['akumjam'],'</strong>';
											}; 
										?>
									</div>
								</div>
								<div class ="col-lg-4">
									<div class="alert alert-success">
										<strong>B</strong> - Nilai Pengurang Tunkin:
										<?php 
											foreach($report2->result_array() as $b){
												echo ' <strong>',$b['pengurang'],'</strong>';
											}; 
										?>
									</div>
								</div>
								<div class ="col-lg-4">
									<div class="alert alert-success">
										<strong>C</strong> - Point Potongan Kinerja (presensi):
										<?php 
											foreach($report3->result_array() as $c){
												echo ' <strong>',$c['pointcut'],'</strong>';
											}; 
										?>
									</div>
								</div>
								<div class ="col-lg-6">
									<div class="alert alert-danger">
										<i class="fa fa-warning pull-right"></i>
										<strong>D</strong> - Total Potongan [B + C]:
										<?php 
											foreach($report4->result_array() as $d){
												echo ' <strong>',$d['sumcut'],'</strong>';
											}; 
										?>
									</div>
								</div>
								<div class ="col-lg-6">
									<div class="alert alert-info">
										<i class="fa fa-check-square pull-right"></i>
										<strong>E</strong> - Point Tunjangan Kerja [100 - D] :
										<?php 
											foreach($report5->result_array() as $e){
												echo ' <strong>',$e['point_tunkin'],'</strong>';
											}; 
										?>
									</div>
								</div>
									<div class="table-responsive" style="width: 100%; overflow-x:scroll;">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<th rowspan = '3'>No.</th>
													<th rowspan = '3'>Hari</th>
													<th rowspan = '3'>Tanggal</th>
													<th rowspan = '3'>Jenis</th>
													<th colspan = '12'>Datang</th>
													<th colspan = '11'>Pulang</th>
													<th colspan = '2' rowspan='2'>Akumulasi</th>
												</tr>
												<tr>
													<th colspan = '2'>Rekaman Datang</th>
													<th colspan = '3'>Status Kehadiran</th>
													<th colspan = '7'>Point Keterlambatan (%)</th>
													<th colspan = '2'>Rekaman Pulang</th>
													<th colspan = '3'>Status Pulang</th>
													<th colspan = '6'>Point PSW (%)</th>
												</tr>
												<tr>
													<th>Aturan</th>
													<th>Finger</th>
													<th>Terlambat</th>
													<th>Akumulasi</th>
													<th>Angka</th>
													<th>0</th>
													<th>0,5</th>
													<th>1</th>
													<th>1,5</th>
													<th>2</th>
													<th>3</th>
													<th>Jumlah</th>
													
													<th>Aturan</th>
													<th>Finger</th>
													<th>Terlambat</th>
													<th>Akumulasi</th>
													<th>Angka</th>
													<th>0,5</th>
													<th>1</th>
													<th>1,5</th>
													<th>2</th>
													<th>3</th>
													<th>Jumlah</th>
													<th nowrap>Potong Point</th>
													<th nowrap>Jam Kerja Kurang</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												$no = 1;
												foreach($rekappp14->result_array() as $a){
													$id_a = $a["idcard"];
													$dino_a = $a["dino"];
													$jenis_a = $a["jenis"];
													$tgl_a = $a["tgl"];
													$dtg_rule_a = $a["dtg_rule"];
													$dtg_real_a = $a["dtg_real"];
													$dtg_late_a = $a["dtg_late"];
													$dtg_late_angka_a = $a["dtg_late_angka"];
													$dtg_status_a = $a["dtg_status"];
													$t1_a = $a["t1"];
													$t2_a = $a["t2"];
													$t3_a = $a["t3"];
													$t4_a = $a["t4"];
													$t5_a = $a["t5"];
													$t6_a = $a["t6"];
													$cut_in = $a["potong_msk"];
													$plg_rule_a = $a["plg_rule"];
													$plg_real_a = $a["plg_real"];
													$plg_early_a = $a["plg_early"];
													$plg_early_angka_a = $a["plg_early_angka"];
													$plg_status_a = $a["plg_status"];
													$psw1_a = $a["psw1"];
													$psw2_a = $a["psw2"];
													$psw3_a = $a["psw3"];
													$psw4_a = $a["psw4"];
													$psw5_a = $a["psw5"];
													$potong_plg_a = $a["potong_plg"];
													$potong_tot_a = $a["potong_total"];
													$total_terlambat_a = $a["total_terlambat"];
													
													
													if($rekappp14->result_array() == ''){
														echo "<tr>														
																<td colspan='8' style='text-align: center'>Rekapan belum tersedia</td>
															</tr>";
													}else{
											?>
													<tr>
														<td style="text-align: center"><?php echo $no;?></td>
														<td style="text-align: center"><?php echo $dino_a;?></td>
														<td nowrap><?php echo $tgl_a;?></td>
														<td style="text-align: center"><?php echo $jenis_a;?></td>
														<td style="text-align: center"><?php echo $dtg_rule_a;?></td>
														<td style="text-align: center"><?php echo $dtg_real_a;?></td>
														<td nowrap><?php echo $dtg_status_a;?></td>
														<td style="text-align: center"><?php echo $dtg_late_a;?></td>														
														<td style="text-align: center"><?php echo $dtg_late_angka_a;?></td>
														<td style="text-align: center"><?php if ($t1_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($t2_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($t3_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($t4_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($t5_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($t6_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php echo $cut_in;?></td>
														<td style="text-align: center"><?php echo $plg_rule_a;?></td>
														<td style="text-align: center"><?php echo $plg_real_a;?></td>
														<td style="text-align: center"><?php echo $plg_early_a;?></td>
														<td style="text-align: center"><?php echo $plg_early_angka_a;?></td>
														<td style="text-align: center"><?php echo $plg_status_a;?></td>
														<td style="text-align: center"><?php if ($psw1_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($psw2_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($psw3_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($psw4_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php if ($psw5_a == '0'){echo "-";}else{echo "<i class='fa fa-check'></i>";}?></td>
														<td style="text-align: center"><?php echo $potong_plg_a;?></td>
														<td style="text-align: center"><?php echo $potong_tot_a;?></td>
														<td style="text-align: center"><?php echo $total_terlambat_a;?></td>
													</tr>
											<?php
													}												
												$no++;
												}
												
											?>
												
											</tbody>
											<tfoot style="background-color: #f9f8f5; color: #898989">
												<tr>														
													<td style="text-align: right" colspan="29">&nbsp;</td>
												</tr>
												<tr>														
													<td colspan="29">
														<p><strong>Catatan : </strong></p>
														<p><strong>Total Kinerja = (100 - Jam Kinerja Kurang) - Poin Sakit</strong></p>
														<p><strong>Jika Sakit &lt; 3 maka Point Sakit = 0</strong></p>
														<p><strong>Jika Sakit &gt; = 3 dan Sakit &lt; = 14 maka Point Sakit = 25</strong></p>
														<p><strong>Jika Sakit &gt; = 15 maka Point Sakit = 50</strong></p>
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

