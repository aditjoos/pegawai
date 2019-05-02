<?php
    $path = base_url();
?>

<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
$(document).ready(function() {	
	
	$(".tanggal").datepicker({
		format: "dd-mm-yyyy",
	    autoclose: true
	});

	$(".tahun").datepicker({
		format: "yyyy",
	    viewMode: "years", 
	    minViewMode: "years",
	   	autoclose: true
	});

	$("#file_image").change(function() {
	    filePreview(this);
	});

	$("#upload_form").submit(function(e) {
		e.preventDefault();

		var jabatan = $("#jabatan").val();
		var tmt_jabatan = $("#tmt_jabatan").val();
		var thn_mulai = $("#thn_mulai").val();
		var thn_selesai = $("#thn_selesai").val();
		var no_sk = $("#no_sk").val();
		var tgl_sk = $("#tgl_sk").val();
		var nip_pejab_baru = $("#nip_pejab_baru").val();
		var nip_pejab_lama = $("#nip_pejab_lama").val();
		var nm_pejab = $("#nm_pejab").val();
		var file = $("#file_image").val();

		if(!jabatan){
			$.notific8('Lengkapi isian Nama jabatan',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!tmt_jabatan){
			$.notific8('Lengkapi isian tmt jabatan',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!thn_mulai){
			$.notific8('Lengkapi isian tahun mulai',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!thn_selesai){
			$.notific8('Lengkapi isian tahun selesai',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!no_sk){
			$.notific8('Lengkapi isian nomor sk',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!tgl_sk){
			$.notific8('Lengkapi isian tanggal sk',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!nip_pejab_baru){
			$.notific8('Lengkapi isian nip pejabat baru',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!nip_pejab_lama){
			$.notific8('Lengkapi isian nip pejabat lama',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!nm_pejab){
			$.notific8('Lengkapi isian nama pejabat',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!file){
			line = $("#line").val();
			id_rec = $("#id_rec").val();

			$("#btn_submit").attr("disabled", true);
			$("#btn_submit").html("<i class='fa fa-sun-o fa-spin'></i> Update");

			$.ajax({
		        url      : line+"Member/update_pekerjaan",
		        type     : 'POST',
		        dataType : 'json',
		        data 	 : {"jabatan":jabatan,"tmt_jabatan":tmt_jabatan,"thn_mulai":thn_mulai,"thn_selesai":thn_selesai,"no_sk":no_sk,
		        			"tgl_sk":tgl_sk,"nip_pejab_baru":nip_pejab_baru,"nip_pejab_lama":nip_pejab_lama,"nm_pejab":nm_pejab,'id_rec':id_rec},
		        success  : function(data){
		            console.log(data);
		            var info = data.info;

					$.notific8('Data telah diperbarui.',{ life:5000,horizontalEdge:"top", theme:"success" ,heading:" Update Sukses !! "});
		            setTimeout(function(){ 
						window.history.back();
					}, 2000);
		            
		        }
		    })
		}else{
			$("#btn_submit").attr("disabled", true);
			$("#btn_submit").html("<i class='fa fa-sun-o fa-spin'></i> Proses");
			$.ajax({
                url: 'do_upload_pekerjaan',
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
					$.notific8('silahkan menunggu informasi dari tim Kepegawaian',{ life:5000,horizontalEdge:"top", theme:"success" ,heading:" Simpan Berhasil !! "});

					setTimeout(function(){ 
						window.location.href = "biodata2";
					}, 2000);
                }
            });
		}

	})



});//end script

function filePreview(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $("#upload_form + img").remove();
            $("#blah").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}





</script>