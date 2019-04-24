<?php
    $path = base_url();
?>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
	$(document).ready(function(){
		list_pendidikan();
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
</script>