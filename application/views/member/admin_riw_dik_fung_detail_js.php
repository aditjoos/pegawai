<?php
    $path = base_url();
?>

<!-- <!-- <script type="text/javascript" src="<?php echo $path; ?>assets/js/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/jquery.ui.min.js"></script> -->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
	$(document).ready(function(){
		// show_keterangan();
	})

	function show_keterangan(){
		$("#option-1").click(function(){
			$("#field_keterangan").hide();
		});
		$("#option-2").click(function(){
			$("#field_keterangan").hide();
		});
		$("#option-3").click(function(){
			$("#field_keterangan").hide();
		});
		$("#option-4").click(function(){
			$("#field_keterangan").show();
		});
		$("#option-5").click(function(){
			$("#field_keterangan").show();
		});
		$("#option-6").click(function(){
			$("#field_keterangan").hide();
		});
		$("#option-7").click(function(){
			$("#field_keterangan").hide();
		});
	}
	
</script>