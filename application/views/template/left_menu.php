<?php
    $path = base_url();
		$lvl = $this->session->userdata('user_level');
?>
<!--
//////////////////////////////////////////////////////////////
//////////     LEFT NAV MENU     //////////
///////////////////////////////////////////////////////////
-->
<nav id="menu"  data-search="close">
		<ul>
				<!-- <li class="label-lg mm-label">Main Layout</li> -->
				<li><a href="<?php echo $path; ?>Member"><i class="icon  fa fa-bar-chart-o"></i> Dashboard</a></li>
				<!--
				<li><a href="<?php echo $path; ?>Member/profil"><i class="icon  fa fa-user"></i> Biodata</a></li>
				-->
				
				<!--
				<li><span><i class="icon  fa fa-money"></i> Tunjangan Kinerja</span>
						<ul>
								<li><a href="ui.html"> Point tunjangan</a></li>
								<li><a href="ui_button.html"> Rekap bulanan</a></li>
								<li><a href="ui_icon.html"> Format Dirjen GTK</a></li>
								<li><a href="ui_slide.html"> Rekap jejak presensi</a></li>
								<li><a href="ui_modal.html"> Detail pemotongan tunjangan</a></li>
						</ul>
				</li>
				<li><a href="#"><i class="icon  fa fa-envelope-o"></i> Surat tugas</a></li>
				<li><span><i class="icon  fa fa-folder-o"></i> Data</span>
						<ul>
								<li><a href="menu.html"> Dinas luar </a></li>
								<li><a href="menuOpen.html"> Ijin / Sakit / Cuti</a></li>
								<li><a href="menuVertical.html"> Lupa fingerprint</a></li>
						</ul>
				</li>
				-->
				<!-- <li><a href="<?php echo $path; ?>Member/under_construction"><i class="icon  fa fa-user"></i> Biodata </a></li>
				<li><a href="<?php echo $path; ?>Member/under_construction"><i class="icon  fa fa-thumbs-o-up"></i> Presensi</a></li>
				<li><a href="<?php echo $path; ?>Member/under_construction"><i class="icon  fa fa-star-half-empty"></i> Tunjangan Kinerja</a></li>
				<li><a href="<?php echo $path; ?>Member/under_construction"><i class="icon  fa fa-envelope-o"></i> Surat tugas</a></li>
				<li><a href="<?php echo $path; ?>Member/under_construction"><i class="icon  fa fa-folder-o"></i> Data</a></li> -->
				<li><a href="<?php echo $path; ?>Member/transparansi"><i class="icon  fa fa-eye"></i> Presensi harian</a></li>
				<li><span><i class="icon  fa fa-user"></i> <?php echo strtolower($lvl); ?> Profil pegawai</span>
						<ul>
							<li><a href="<?php echo $path; ?>Member/biodata2"><i class="icon  fa fa-user"></i> Biodata </a></li>
						</ul>
				</li>
				<?php 
					if(strtolower($lvl)=='operator'){
						?>
							<li><span><i class="icon fa fa-sitemap"></i> MENU OPERATOR</span>
								<ul>
									<li><a href="#"><i class="icon fa fa-eye"></i> Presensi unit kerja</a></li>
								</ul>
							</li>
						<?php
					}
					if(strtolower($lvl)=='admin'){
						?>
							<li><span><i class="icon fa fa-sitemap"></i> MENU ADMINISTRATOR</span>
								<ul>
									<li><a href="<?php echo $path; ?>member/pivot"><i class="icon fa fa-eye"></i> Pivot profil pegawai</a></li>
									<li><span><i class="icon  fa fa-eye"></i> Ajuan Data Pegawai</span>
										<ul>
											<li><a href="<?php echo $path; ?>member/riw_edu_add"><i class="icon fa fa-eye"></i> Data Pendidikan</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Riwayat Diklat Fungsional</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Riwayat Diklat Teknis</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Riwayat Diklat Penjenjangan</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Riwayat Kepangkatan</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Riwayat Jabatan Struktural</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Riwayat Jabatan Fungsional</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Riwayat Pekerjaan</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Data Keluarga (Suami/Istri)</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Data Keluarga (Anak)</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Data Keluarga (Keluarga)</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Data DP3</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Data Seminar</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Data Tanda Jasa</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Data Anggota Organisasi</a></li>
											<li><a href="<?php echo $path; ?>member"><i class="icon fa fa-eye"></i> Data Hukuman</a></li>
										</ul>
									</li>
								</ul>
							</li>
						<?php
					} 
				?>

		</ul>
</nav>
<!-- //nav left menu-->