<?php
    $path = base_url();
?>
<!-- <script src="<?php echo $path; ?>assets/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo $path; ?>assets/plugins/datatable/dataTables.bootstrap.js"></script> 
<link href="<?php echo $path; ?>assets/plugins/datatable/dataTables.bootstrap.css" rel="stylesheet" /> -->

<script src="<?php echo $path; ?>assets/plugins/datatable2/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $path; ?>assets/plugins/datatable2/js/bootstrap.datatable.js"></script> 
<link href="<?php echo $path; ?>assets/plugins/datatable2/css/bootstrap.datatable.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo $path; ?>assets/plugins/datetime/lang/bootstrap-datetimepicker.id.js"></script>

<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script>
<script>
$(document).ready(function() {	
		var d = new Date(),
				stDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + (d.getDate()-5),
				enDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + (d.getDate());
		
		
		
		$('#datetimepicker').datetimepicker({
			 format: "dd-mm-yyyy",
			 startDate: stDate,
			 endDate: enDate,
			 todayBtn: false,
			 showMeridian: false,
			 language: "id",
			 startView: "month",
			 minView: "month"
		})
		.on('changeDate', function(ev){
			var tabel_detail = $('#tbpresensi');
			tabel_detail.children('tbody').empty().append('<tr><td colspan="7" class="text-center"><h3><i class="fa fa-sun-o fa-spin"></i> Loading..</h3></td></tr>');
			
			var param = ev.date.getFullYear() + "-" + (ev.date.getMonth()+1) + "-" + (ev.date.getDate());
			/*
			var xx = $('#tbpresensi').dataTable({
		      "processing": true,
					"serverSide": true,
					"destroy": true,
					"ajax": {
		            "url": "ngintip_absen",
		            "type": "POST",
		            "dataType": "jsonp",
		            "data": {
		            		"tgl":param
		            }
		       },
		      //"sPaginationType": "full_numbers",
		      //"scrollX": true,
		      //"scrollXInner": "200%",
		      //"scrollCollapse": true,
		      "aoColumns": [
		        { "data": "Nama","title": "Pegawai"},
		        { "data": "UnitKerja","title": "Unit kerja"},
		        { "data": "jam_masuk","title": "Jam masuk"},
		        { "data": "lokasi_fp_masuk","title": "Lokasi FP masuk"},
		        { "data": "jam_keluar","title": "Jam keluar"},
		        { "data": "lokasi_fp_keluar","title": "Lokasi FP keluar"},               
		      ],
		      //"order": [[ 1, "asc" ]],
		      "language": {
		          "lengthMenu": "Menampilkan  _MENU_  data per halaman",
		          "zeroRecords": "Tidak ada data",
		          "info": "Halaman _PAGE_ dari total  _PAGES_  halaman <br> Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
		          "infoEmpty": "Tidak ada data",
		          "infoFiltered": "",
		          "search": "Pencarian : "
		      }
		  });
		  */
			      
			$.ajax({
				url: 'ngintip_absen',
        type: 'POST',
        dataType: "json",
        data: {
            tgl: param,
        },
        success: function(cb){
			console.log(param);
			console.log(cb);
			
			if(!cb.status){
				$.notific8(cb.message,{ sticky:false,horizontalEdge:"top",theme:"danger",heading:"<i class='fa fa-exclamation-triangle'></i> Konfirmasi"});
				tabel_detail.children('tbody').empty().append('<tr><td colspan="7" class="text-center"><h3>Silahkan klik salah satu tanggal diatas</h3></td></tr>');

			}else{
				if(cb.result2.length > 0){
					tabel_detail.children('tbody').empty();
					$.each(cb.result2,function(i,item){
						if (item.nama == null){varnama = '-';}else{varnama = item.nama;};
						tabel_detail.children('tbody').last().append(
						'<tr>'+
						'<td style="text-align: center">'+(i+1)+'</td>'+
						'<td>'+item.nama+'</td>'+
						'<td>'+item.unitkerja+'</td>'+
						'<td style="text-align: center">'+item.jammasuk+'</td>'+
						'<td>'+item.lokasimasuk+'</td>'+
						'<td style="text-align: center">'+item.jampulang+'</td>'+
						'<td>'+item.lokasipulang+'</td>'+
						'</tr>'
						);
					});	
					
				}else{
					//tabel_detail.dataTable().fnDestroy();
					tabel_detail.children('tbody').empty().append('<tr><td colspan="7" class="text-center"><h3>Belum ada data perekaman presensi</h3></td></tr>');
					
				}
				
			}
        }
      });
        
		});
		
});//end script
</script>