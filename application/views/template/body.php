<html lang="en">
	<!-- HEAD -->
	<?php 
		if(isset($head_page)){ echo $head_page; }
	?>
	<body class="leftMenu nav-collapse">
		<div id="wrapper">
			<!-- TOP MENU -->
			<?php 
				if(isset($top_menu)){ echo $top_menu; }
			?>
			<div id="main">
				<!-- MAIN PAGE-->
				<?php 
					if(isset($main_page)){ echo $main_page; }
				?>
				
				
			</div>
			
			<!-- MODAL -->
			<?php 
				if(isset($modal)){ echo $modal; }
			?>
			
			<!-- LEFT NAV MENU -->
			<?php 
				if(isset($left_menu)){ echo $left_menu; }
			?>
		</div>
	
		<!-- JS PATH FOOTER -->
		<?php 
			if(isset($foot)){ echo $foot; }
			if(isset($custom_js)){ echo $custom_js; }
		?>
	</body>
</html>