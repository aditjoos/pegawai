<?php
    $path = base_url();
?>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
	$(document).ready(function(){
		list_ajuan();
	})

	function list_ajuan(){
		$.ajax({
	        url      : "list_ajuan_riw_dik_fung",
	        type     : 'POST',
	        dataType : 'json',
	        success  : function(data){
	            console.log(data);
	            var tbl = data.tbl;
	            $("#ls_ajuan_dik_fung").html(tbl);
	        }
	    })
	}
	
</script>