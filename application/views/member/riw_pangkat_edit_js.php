<?php
    $path = base_url();
?>

<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
$(document).ready(function() {	
	opt_golruang();
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

		var gol = $("#gol").val();
		var tmt_gol = $("#tmt_gol").val();
		var pejab_sk = $("#pejab_sk").val();
		var no_sk = $("#no_sk").val();
		var tgl_sk = $("#tgl_sk").val();
		var ket = $("#ket").val();

		if(!gol){
			$.notific8('Lengkapi isian Golongan / Ruang',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!tmt_gol){
			$.notific8('Lengkapi isian TMT Golongan',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!pejab_sk){
			$.notific8('Lengkapi isian Pejabat Penandatangan SK',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!no_sk){
			$.notific8('Lengkapi isian Nomor SK',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!tgl_sk){
			$.notific8('Lengkapi isian Tanggal SK',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!ket){
			$.notific8('Lengkapi isian Keterangan',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else if(!file){
			$.notific8('Tidak terdapat berkas foto pendukung',{ life:5000,horizontalEdge:"top", theme:"danger" ,heading:" Simpan Gagal !! "});
		}else{
			$("#btn_submit").attr("disabled", true);
			$("#btn_submit").html("<i class='fa fa-sun-o fa-spin'></i> Proses");
			$.ajax({
                url: 'do_upload_pangkat',
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

function opt_golruang(){
	$.ajax({
        url      : "opt_golruang",
        type     : 'POST',
        dataType : 'json',
        success  : function(data){
            console.log(data);
            var opt = data.opt;
            $("#gol").html(opt);
        }
    })
}



</script>