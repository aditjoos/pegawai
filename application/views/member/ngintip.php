<?php
	$path = base_url();	
?>
<section class="panel">
	<header class="panel-heading no-borders bg-lightseagreen">
			<div class="title">
				<h3>Presensi Harian Pegawai</h3>
				<section>
					&nbsp;
				</section>
			</div>
	</header>		
	<div class="panel-tools fully color bg-lightseagreen-darken" align="right"></div>
	<div class="panel-body">	
		<div class="alert alert-info">
				<strong>Informasi!</strong> 
				<br />
				Anda hanya diijinkan melihat data presensi harian seluruh pegawai hanya sampai dengan <strong>H-5 dari tanggal server</strong>.
		</div>
		<hr />
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-danger panel-square panel-no-border text-center">
						<div id="datetimepicker"></div>	
				</div>				
			</div>
			<div class="col-md-9">
				<div class="panel panel-danger panel-square panel-no-border">

				</div>				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover table-bordered" id="tbpresensi">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Unit kerja</th>
							<th>Jam masuk</th>
							<th>Lokasi presensi masuk</th>
							<th>Jam keluar</th>
							<th>Lokasi presensi keluar</th>
						</tr>
					</thead>
					<tbody align="left">
						<tr><td colspan="7" class="text-center"><h3>Silahkan klik salah satu tanggal diatas</h3></td></tr>
					</tbody>
			</table>
			</div>
		</div>
		
	</div>
</section>