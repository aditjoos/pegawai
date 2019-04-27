<?php
    $path = base_url();
?>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
	$(document).ready(function(){
		list_pendidikan();
		list_dik_fungsi();
		list_dik_teknis();
		list_dik_jenjang();
	})

	function list_pendidikan(){
		$.ajax({
	        url      : "list_pendidikan",
	        type     : 'POST',
	        dataType : 'json',
	        success  : function(data){
	            console.log(data);
	            var tbl = data.tbl;
	            $("#ls_pendidikan").html(tbl);
	        }
	    })
	}

	function list_dik_fungsi(){
		$.ajax({
	        url      : "list_dik_fungsi",
	        type     : 'POST',
	        dataType : 'json',
	        success  : function(data){
	            console.log(data);
	            var tbl = data.tbl;
	            $("#ls_dik_fungsi").html(tbl);
	        }
	    })
	}

	function list_dik_teknis(){
		$.ajax({
	        url      : "list_dik_teknis",
	        type     : 'POST',
	        dataType : 'json',
	        success  : function(data){
	            console.log(data);
	            var tbl = data.tbl;
	            $("#ls_dik_teknis").html(tbl);
	        }
	    })
	}

	function list_dik_jenjang(){
		$.ajax({
	        url      : "list_dik_jenjang",
	        type     : 'POST',
	        dataType : 'json',
	        success  : function(data){
	            console.log(data);
	            var tbl = data.tbl;
	            $("#ls_dik_jenjang").html(tbl);
	        }
	    })
	}
	
</script>