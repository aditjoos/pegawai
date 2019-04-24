<?php
    $path = base_url();
?>
<!--
/////////////////////////////////////////////////////////////////////////
//////////     HEADER  CONTENT     ///////////////
//////////////////////////////////////////////////////////////////////
-->
<div id="header">

		<div class="logo-area clearfix">
				<a href="#" class="logo"></a>
		</div>
		<!-- //logo-area-->
		
		<div class="tools-bar">
				<ul class="nav navbar-nav nav-main-xs">
						<li><a href="#" class="icon-toolsbar nav-mini"><i class="fa fa-bars"></i>&nbsp;</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right tooltip-area">
						<li><a href="#" class="nav-collapse avatar-header">
										<img alt="" src="<?php echo $this->session->userdata('foto'); ?>" style="max-height: 40px; width: auto">
								</a>
						</li>
						<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
									<em><strong>Hi</strong>, <?php echo $this->session->userdata('nama'); ?> </em> <i class="dropdown-icon fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu pull-right icon-right arrow">
										<li><a href="<?php echo $path; ?>Member/akun_pegawai"><i class="fa fa-user"></i> Akun pegawai</a></li>
										<li class="divider"></li>
										<li><a href="<?php echo $path; ?>Member/log_out"><i class="fa fa-sign-out"></i> Logout </a></li>
								</ul>
								<!-- //dropdown-menu-->
						</li>
						<li class="visible-lg">
							<a href="#" class="h-seperate fullscreen" data-toggle="tooltip" title="Full Screen" data-container="body"  data-placement="left">
								<i class="fa fa-expand"></i>&nbsp;
							</a>
						</li>
				</ul>
		</div>
		<!-- //tools-bar-->
		
</div>
<!-- //header-->