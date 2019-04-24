<?php
	$path = base_url();	
?>
<section class="panel corner-flip">
	<header class="panel-heading no-borders bg-lightseagreen">
			<div class="mail-title">
				<h3>Pengaturan Akun Pegawai</h3>
				<section>
					<div class="mail-thumbnail"><img alt="" src="<?php echo $this->session->userdata('foto'); ?>" class="circle"></div>
					<span><strong><?php echo $this->session->userdata('nama'); ?></strong></span>
				</section>
			</div>
	</header>		
	<div class="panel-tools fully color bg-lightseagreen-darken" align="right"></div>
	<div class="panel-body">
		<div class="row">	
			<div class="col-md-2 align-lg-center">
					<img alt="" src="<?php echo $this->session->userdata('foto'); ?>" style="max-width:120px; border:5px #edece5 solid; margin:25px 0;">
			</div>	
			<div class="col-md-10">
					<br>
					<h3><strong>Akun</strong> Pegawai</h3>
					<hr>
					<form name="akun">
							<div class="form-group">
									<label class="control-label">Nama</label>
									<input type="text" class="form-control" value="<?php echo $this->session->userdata('nama'); ?>" readonly>
							</div>
							<div class="form-group">
									<label class="control-label">User ID</label>
									<input type="text" class="form-control" value="<?php echo $this->session->userdata('id_user'); ?>" readonly>
							</div>
							<div class="form-group row">
									<div class="col-md-6">
										<label class="control-label">Password lama</label>
										<input type="password" class="form-control" name="old-pwd">
									</div>
							</div>
							<div class="form-group row">
									<div class="col-md-6">
										<label class="control-label">Password baru</label>
										<input type="password" class="form-control" name="new-pwd">
									</div>
									<div class="col-md-6">
										<label class="control-label">Ketik ulang password baru</label>
										<input type="password" class="form-control" name="retype-pwd">
									</div>
							</div>
							
							<hr>
							<div class="form-group">
									<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
					</form>
			</div>							
		</div>
	</div>
	<div class="flip"></div>
</section>