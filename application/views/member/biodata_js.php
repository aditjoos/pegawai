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
		list_pekerjaan();
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

	function list_pekerjaan(){
		$.ajax({
	        url      : "list_pekerjaan",
	        type     : 'POST',
	        dataType : 'json',
	        success  : function(data){
	            console.log(data);
	            var tbl = data.tbl;
	            $("#ls_pekerjaan").html(tbl);
	        }
	    })
	}

	function edit_dik_fungsi(id){
		window.location.href = 'riw_dik_fungsi_add',{'id':id};
	}
	
	function confirm_hapus(id,tb){
		if(tb == '1'){var tbl = "data_pendidikan";}
		else if(tb == '2'){var tbl = "data_dikfungsi";}
		else if(tb == '3'){var tbl = "data_dikteknis";}
		else if(tb == '4'){var tbl = "data_dikjenjang";}
		else if(tb == '5'){var tbl = "data_pangkat";}
		else if(tb == '8'){var tbl = "data_pekerjaan";}

		$("#md-hapus").modal("show");
		$("#hapus").attr("onclick","hapus_"+tbl+"("+id+");");

	}

	function hapus_data_dikfungsi(id){
		line = $("#line").val();
		$.ajax({
	        url      : line+"Member/hapus_data_dikfungsi",
	        type     : 'POST',
	        dataType : 'json',
	        data 	 : {'id':id},
	        success  : function(data){
	            console.log(data);
	            var info = data.info;
				location.reload(true);
				$.notific8('Data terpilih berhasil di hapus',{ life:5000,horizontalEdge:"top", theme:"success" ,heading:" Hapus Sukses !! "});

	        }
	    })
	}

	function hapus_data_pendidikan(id){
		line = $("#line").val();
		$.ajax({
	        url      : line+"Member/hapus_data_pendidikan",
	        type     : 'POST',
	        dataType : 'json',
	        data 	 : {'id':id},
	        success  : function(data){
	            console.log(data);
	            var info = data.info;
				location.reload(true);
				$.notific8('Data terpilih berhasil di hapus',{ life:5000,horizontalEdge:"top", theme:"success" ,heading:" Hapus Sukses !! "});

	        }
	    })
	}

	function hapus_data_pekerjaan(id){
		line = $("#line").val();
		$.ajax({
	        url      : line+"Member/hapus_data_pekerjaan",
	        type     : 'POST',
	        dataType : 'json',
	        data 	 : {'id':id},
	        success  : function(data){
	            console.log(data);
	            var info = data.info;
				location.reload(true);
				$.notific8('Data terpilih berhasil di hapus',{ life:5000,horizontalEdge:"top", theme:"success" ,heading:" Hapus Sukses !! "});

	        }
	    })
	}


	function buka_berkas(id,tbl){
		line = $("#line").val();

		$.ajax({
	        url      : line+"Member/open_berkas",
	        type     : 'POST',
	        dataType : 'json',
	        data 	 : {'id':id,'tbl':tbl},
	        success  : function(data){
	            console.log(data);
	            var info = data.info;
	            var tbl = data.tabel;
	            
	            if(!info){
					$("#ktn").html("<embed frameborder='0' scrolling='yes' width='100%' height='100%' src='"+line+"assets/img/noimage.jpg' >");
	            }else{
					$("#ktn").html("<embed frameborder='0' scrolling='yes' width='100%' height='100%' src='"+line+"assets/uploads/"+tbl+"/"+info+"'>");
	            }

				
	        }
	    })

		$("#md-foto").modal("show");
	}

</script>