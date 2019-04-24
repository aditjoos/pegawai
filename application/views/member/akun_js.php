<?php
    $path = base_url();
?>

<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
$(document).ready(function() {	
	$('form[name=akun]').on('submit',function(f){
		f.preventDefault();
		var a = $('input[name=old-pwd]').val(),
				b = $('input[name=new-pwd]').val(),
				c = $('input[name=retype-pwd]').val();
		if(!a){
			setTimeout(function () { 
				$.notific8('Semua isian harus diisi !',
					{ 
						sticky:false, 
						horizontalEdge:"top", 
						theme:"danger" ,
						heading:"<i class='fa fa-exclamation-triangle'></i> Konfirmasi",
					}
			)}, 100);
			
			return false;
		}
		
		if(b!=c){
			setTimeout(function () { 
				$.notific8('Isian password baru tidak sama dengan isian ketik ulang password baru !',
						{ 
							sticky:false, 
							horizontalEdge:"top", 
							theme:"danger" ,
							heading:"<i class='fa fa-exclamation-triangle'></i> Konfirmasi",
						}
				)}, 100);
		}else{
			$('button[type=submit]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Simpan');
			
			$.ajax({
				url: "cek_auth", 
				data: $(this).serialize(), 
				type: "POST", 
				dataType: 'json',
				success: function (e) {
					 if (!e.status) { 
						$.notific8(e.message,{ sticky:false,horizontalEdge:"top",theme:"danger",heading:"<i class='fa fa-exclamation-triangle'></i> Konfirmasi"});
						//return false;
					 }else{
						$.notific8('Pengaturan baru telah disimpan.',
							{ 
								sticky:false, 
								horizontalEdge:"top", 
								theme:"success" ,
								heading:"<i class='fa fa-check'></i> Informasi",
							});	
					 }
					 $('button[type=submit]').removeProp('disabled').html('Simpan');
				}
			});	
		}
	});
	
});//end script
</script>