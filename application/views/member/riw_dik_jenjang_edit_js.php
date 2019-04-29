<?php
    $path = base_url();
?>

<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
$(document).ready(function() {	
	opt_edu();
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

		var file = $("#file_image").val();
		var jns_diklat = $("#jns_diklat").val();
		var angkatan = $("#angkatan").val();
		var created = $("#created").val();
		var tgl_mulai = $("#tgl_mulai").val();
		var tgl_selesai = $("#tgl_selesai").val();
		var predikat = $("#predikat").val();
		var lokasi = $("#lokasi").val();
		var jml_jam = $("#jml_jam").val();

		if(!angkatan){
			$.notific8('Lengkapi isian Angkatan',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!created){
			$.notific8('Lengkapi isian Penyelenggara',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!tgl_mulai){
			$.notific8('Lengkapi isian Tanggal Mulai',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!tgl_selesai){
			$.notific8('Lengkapi isian Tanggal Selsai',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!predikat){
			$.notific8('Lengkapi isian Predikat',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!lokasi){
			$.notific8('Lengkapi isian Lokasi',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!jml_jam){
			$.notific8('Lengkapi isian Jumlah Jam',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!file){
			line = $("#line").val();
			id_rec = $("#id_rec").val();

			$("#btn_submit").attr("disabled", true);
			$("#btn_submit").html("<i class='fa fa-sun-o fa-spin'></i> Update");

			$.ajax({
		        url      : line+"Member/update_dik_fungsi",
		        type     : 'POST',
		        dataType : 'json',
		        data 	 : {'nama':nama,'belajar':belajar,'lokasi':lokasi,'tgl_mulai':tgl_mulai,'tgl_selesai':tgl_selesai,
							'jml_jam':jml_jam,'created':created,'id_rec':id_rec},
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
			line = $("#line").val();
			id_rec = $("#id_rec").val();

			$("#btn_submit").attr("disabled", true);
			$("#btn_submit").html("<i class='fa fa-sun-o fa-spin'></i> Update");

			$.ajax({
                url: line+'Member/do_upload_dik_jenjang',
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
					$.notific8('Data telah diperbarui.',{ life:5000,horizontalEdge:"top", theme:"success" ,heading:" Update Sukses !! "});
		            setTimeout(function(){ 
						window.history.back();
					}, 2000);
                }
            });
		}

	})



});//end script

function opt_edu(){
	$.ajax({
        url      : "opt_edu",
        type     : 'POST',
        dataType : 'json',
        success  : function(data){
            console.log(data);
            var opt = data.opt;
            $("#edu").html(opt);
        }
    })
}

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