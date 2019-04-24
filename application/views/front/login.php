<?php
	$path = base_url();
?>
<html lang="en">
<head>
<title>Sistem Kepegawaian</title>
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $path; ?>assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $path; ?>assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $path; ?>assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo $path; ?>assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo $path; ?>assets/ico/favicon.ico">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="<?php echo $path; ?>assets/css/bootstrap/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $path; ?>assets/css/bootstrap/bootstrap-themes.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $path; ?>assets/css/style.css" />

</head>
<body class="full-lg">
<div id="wrapper">

<div id="loading-top">
		<div id="canvas_loading"></div>
		<span>Otentifikasi user, mohon menunggu...</span>
</div>

<div id="main">
		<div class="container">
				<div class="row">
						<div class="col-lg-12">
							<?php
								foreach($toko->result_array() as $a){
									// $nama = $a["NamaSekolah"];
									$nama = $a["namasekolah"];
									$tahun = $a["tahun_aktif"];
								}
							?>
								<div class="account-wall">
										<section class="align-lg-center">
										<div class="site-logo"></div>
										<h1 class="login-title">
											<span><?php echo $nama; ?></span></h1><h4> Sistem Informasi Kepegawaian</h4>
										</section>
										<form id="form-signin" class="form-signin">
												<section>
														<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-user"></i></div>
																<input  type="text" class="form-control" name="username" placeholder="Username">
														</div>
														<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-key"></i></div>
																<input type="password" class="form-control"  name="password" placeholder="Password">
														</div>
														<button class="btn btn-lg btn-theme-inverse btn-block" type="submit" id="sign-in">Login</button>
												</section>
										</form>
										<a href="" class="footer-link">&copy; <?php echo $tahun,' ',$nama; ?></a>
								</div>	
								<!-- //account-wall-->
								
						</div>
						<!-- //col-sm-6 col-md-4 col-md-offset-4-->
				</div>
				<!-- //row-->
		</div>
		<!-- //container-->
		
</div>
<!-- //main-->

		
</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		
<!-- Jquery Library -->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>assets/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<!-- 
<script type="text/javascript" src="<?php echo $path; ?>assets/js/modernizr/modernizr.js"></script>
-->
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/mmenu/jquery.mmenu.js"></script>

<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/form/form.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/datetime/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/chart/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/pluginsForBS/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/miscellaneous/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/caplet.custom.js"></script>
<script type="text/javascript">
$(function() {
		   //Login animation to center 
			function toCenter(){
					var mainH=$("#main").outerHeight();
					var accountH=$(".account-wall").outerHeight();
					var marginT=(mainH-accountH)/2;
						   if(marginT>30){
							   $(".account-wall").css("margin-top",marginT-15);
							}else{
								$(".account-wall").css("margin-top",30);
							}
				}
				toCenter();
				var toResize;
				$(window).resize(function(e) {
					clearTimeout(toResize);
					toResize = setTimeout(toCenter(), 500);
				});
				
			  
			//Set note alert
			setTimeout(function () { 
				$.notific8('Silahkan login menggunakan akun anda untuk melihat data anda. jika anda tidak tahu, silahkan menghubungi bagian <strong>kepegawaian</strong>.',
						{ 
							sticky:false, 
							horizontalEdge:"top", 
							theme:"inverse" ,
							heading:"Selamat Datang"
						}
				)}, 1000);
	
			
			$("#form-signin").submit(function(event){
					event.preventDefault();
					var main=$("#main");
					//scroll to top
					main.animate({
						scrollTop: 0
					}, 500);
					main.addClass("slideDown");		
					
					// send username and password to php check login
					$.ajax({
						url: "home/auth", 
						data: $(this).serialize(), 
						type: "POST", 
						dataType: 'json',
						success: function (e) {
								setTimeout(function () { main.removeClass("slideDown") }, !e.status ? 500:3000);
								 if (!e.status) { 
									 $.notific8('Username atau Password tidak sesuai.',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Gagal !! "});
									return false;
								 }
								 setTimeout(function () { $("#loading-top span").text("Otentifikasi user berhasil...") }, 500);
								 setTimeout(function () { $("#loading-top span").text("Memuat halaman akun anda...")  }, 1500);
								 setTimeout( "window.location.href='Member'", 2100 );
						}
					});	
			
			});
	});
</script>
</body>
</html>