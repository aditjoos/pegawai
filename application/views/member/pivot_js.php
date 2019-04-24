<?php
    $path = base_url();
?>

<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $path; ?>assets/plugins/pivottable/pivot.css" />
<!-- <link type="text/css" rel="stylesheet" href="<?php echo $path; ?>assets/plugins/pivottable/c3.min.css" /> -->
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/pivottable/pivot.js"></script>
<!-- <script type="text/javascript" src="<?php echo $path; ?>assets/plugins/pivottable/d3.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/pivottable/c3.min.js"></script> -->
<script type="text/javascript">
    $(function(){
        var msg = '<div class="alert alert-danger alert-bold-border square fade in alert-dismissable text-center">'+
							    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
							    '<p><i class="fa fa-spin fa-sun-o"></i><strong> Sedang memuat data. Mohon menunggu...</strong></p>'+
							    '</div>';
				$('#msg-load').empty().append(msg);
				
        var derivers = $.pivotUtilities.derivers;
        var renderers = $.extend($.pivotUtilities.renderers, $.pivotUtilities.c3_renderers);
				$.getJSON('get_pivot',{})
				.done(function(mps){
					$("#pivot").pivotUI(mps, {
              renderers: renderers,
              cols: ["status_pegawai"], 
              rows: ["unit_kerja"],
              rendererName: "Table"
          });
          $('#msg-load').empty();
				});
				/*
        $.getJSON("get_pivot", function(mps) {
            $("#pivot").pivotUI(mps, {
                renderers: renderers,
                cols: ["status_pegawai"], 
                rows: ["unit_kerja"],
                rendererName: "Table"
            });
        });
        */
        
     });
</script>