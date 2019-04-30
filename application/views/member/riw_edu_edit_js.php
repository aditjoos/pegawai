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
		var edu = $("#edu").val();
		var sekolah = $("#sekolah").val();
		var prodi = $("#prodi").val();
		var tahun = $("#tahun").val();
		var tanggal = $("#tanggal").val();
		var belajar = $("#belajar").val();
		var lokasi = $("#lokasi").val();
		var ijasah = $("#ijasah").val();

		if(!edu){
			$.notific8('Lengkapi isian Tingkat Pendidikan',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!sekolah){
			$.notific8('Lengkapi isian Nama Sekolah / Universitas',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!prodi){
			$.notific8('Lengkapi isian Jurusan / Program Studi',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!tahun){
			$.notific8('Lengkapi isian tahun masuk',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!tanggal){
			$.notific8('Lengkapi isian tanggal lulus',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!lokasi){
			$.notific8('Lengkapi isian lokasi',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!ijasah){
			$.notific8('Lengkapi isian nomor ijasah',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!file){
			line = $("#line").val();
			id_rec = $("#id_rec").val();

			$("#btn_submit").attr("disabled", true);
			$("#btn_submit").html("<i class='fa fa-sun-o fa-spin'></i> Update");

			$.ajax({
		        url      : line+"Member/update_pendidikan",
		        type     : 'POST',
		        dataType : 'json',
		        data 	 : {"edu":edu,"sekolah":sekolah,"prodi":prodi,"tahun":tahun,"tanggal":tanggal,"belajar":belajar,"lokasi":lokasi,"ijasah":ijasah,'id_rec':id_rec},
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
			$("#btn_submit").html("<i class='fa fa-sun-o fa-spin'></i> Update");
			$.ajax({
                url: 'do_upload_pendidikan',
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

function opt_edu(){
	ln = $("#line").val();
	$.ajax({
        url      : ln+"Member/opt_edu",
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