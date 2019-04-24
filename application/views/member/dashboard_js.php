<?php
    $path = base_url();
?>

<script src="<?php echo $path; ?>assets/plugins/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo $path; ?>assets/plugins/fullcalendar/fullcalendar.js"></script>
<script src="<?php echo $path; ?>assets/plugins/fullcalendar/lang/id.js"></script>
<link href="<?php echo $path; ?>assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" />

<!-- Library Themes Customize-->
<!-- <script type="text/javascript" src="<?php echo $path; ?>assets/js/private/profile.js"></script> -->
<script type="text/javascript" src="<?php echo $path; ?>assets/js/caplet.custom.js"></script>
<script>
$(document).ready(function() {	
		
		function format_number( number, decimals, dec_point, thousands_sep ){
		    if(isNaN(number)){
		    	s = '0';
		    	return s;	
		    }else{	    	
		    	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
			    var n = !isFinite(+number) ? 0 : +number,
			        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			        s = '',
			        toFixedFix = function (n, prec) {
			            var k = Math.pow(10, prec);
			            return '' + Math.round(n * k) / k;
			        };
			    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
			    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
			    if (s[0].length > 3) {
			        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			    }
			    if ((s[1] || '').length > prec) {
			        s[1] = s[1] || '';
			        s[1] += new Array(prec - s[1].length + 1).join('0');
			    }
			    // Add this number to the element as text.
		    	return s.join(dec);	
		    }
		    
		};
		
		function set_number(number){
			if(isNaN(number)){
		    	s = 0;
		    	return s;	
		    }else{
		    	return number;
		    }
		}
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev',
				center: 'title',
				right: 'next'
			},
			editable: false,
			droppable: false,
			theme: false,
			timeFormat: 'HH:mm:ss',
			events: function(start, end, timezone, callback) {
				var moment = $('#calendar').fullCalendar('getDate');
				var curDate = moment.format('MMYYYY');
				var msg = '<div class="alert alert-info alert-bold-border square fade in alert-dismissable text-center">' +
					'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
					'<p><i class="fa fa-spin fa-sun-o"></i><strong> Sedang memuat data. Mohon menunggu...</strong></p>' +
					'</div>';

				$('#jmh_masuk').empty().append('<p><i class="fa fa-spinner fa-spin"></i> Loading..</p>');
				$('#jmh_dl').empty().append('<p><i class="fa fa-spinner fa-spin"></i> Loading..</p>');
				$('#jmh_sakit').empty().append('<p><i class="fa fa-spinner fa-spin"></i> Loading..</p>');
				$('#jmh_ijin').empty().append('<p><i class="fa fa-spinner fa-spin"></i> Loading..</p>');
				$('#jmh_cuti').empty().append('<p><i class="fa fa-spinner fa-spin"></i> Loading..</p>');
				$('#tot_jam').empty().append('<p><i class="fa fa-spinner fa-spin"></i> Loading..</p>');
				$('#msg-load').empty().append(msg);

				$.ajax({
					url: 'member/ajax_rekap_presensi',
					type: 'POST',
					dataType: "json",
					data: {
						periode: curDate,
					},
					success: function(cb) {
						console.log(cb);

						if (!cb.message) {

							$('#jmh_masuk').empty().append(cb.rekap.masuk);
							$('#jmh_dl').empty().append(cb.rekap.tugas);
							$('#jmh_sakit').empty().append(cb.rekap.sakit);
							$('#jmh_ijin').empty().append(cb.rekap.ijin);
							$('#jmh_cuti').empty().append(cb.rekap.cuti);
							$('#jmh_tk').empty().append(cb.rekap.tk);
							$('#tot_jam').empty().append(cb.rekap.totaljam);

							var events = [],
								poin_sakit = 0,
								jmh_sakit = parseInt(set_number(cb.rekap.sakit));

							if (jmh_sakit < 3) {
								poin_sakit = 0;
							} else if (jmh_sakit >= 3 && jmh_sakit <= 14) {
								poin_sakit = 25;
							} else if (jmh_sakit >= 15) {
								poin_sakit = 50;
							}

							$.each(cb.kalender, function(i, item) {
								if (item.jenis == 'lb') {
									events.push({
										id: item.id,
										title: '\n' + item.title,
										start: item.start,
										allDay: item.allDay,
										color: item.color
									});
									$('.fc-day[data-date="' + item.start + '"]').css('background', item.color);
								} else if (item.jenis == 'dl') {
									events.push({
										id: item.id,
										title: '\n' + item.title,
										start: item.start,
										allDay: item.allDay,
										color: item.color
									});
									$('.fc-day[data-date="' + item.start + '"]').css('background', item.color);
								} else if (item.jenis == 'tk') {
									events.push({
										id: item.id,
										title: '\n' + item.title,
										start: item.start,
										allDay: item.allDay,
										color: item.color
									});
									$('.fc-day[data-date="' + item.start + '"]').css('background', item.color);
								} else if (item.jenis == 'ct') {
									events.push({
										id: item.id,
										title: '\n' + item.title,
										start: item.start,
										allDay: item.allDay,
										color: item.color
									});
									$('.fc-day[data-date="' + item.start + '"]').css('background', item.color);
								} else if (item.jenis == 'ij') {
									events.push({
										id: item.id,
										title: '\n' + item.title,
										start: item.start,
										allDay: item.allDay,
										color: item.color
									});
									$('.fc-day[data-date="' + item.start + '"]').css('background', item.color);
								} else {
									events.push({
										id: item.id,
										title: '\n' + item.title,
										start: item.start,
										allDay: item.allDay,
										color: item.color
									});
								}

							});
							callback(events);

							var tabel_detail = $('#tabel-detail'),
								tot = 0;
							tabel_detail.children('tbody').empty();
							tabel_detail.children('tfoot').empty();

							$.each(cb.presensi, function(i, item) {
								if (item.jenis == 'M') {
									tabel_detail.children('tbody').last().append(
										'<tr>' +
										'<td style="text-align: center">' + (i + 1) + '</td>' +
										'<td style="text-align: center">' + item.tgl + '</td>' +
										'<td style="text-align: center">' + item.jammasuk1 + '</td>' +
										'<td style="text-align: center">' + item.jamkeluar1 + '</td>' +
										'<td style="text-align: right">' + item.total + '</td>' +
										'<td style="text-align: center">' + item.ket.toUpperCase() + '</td>' +
										'</tr>'
									);
									tot = tot + parseFloat(item.total);
								} else {
									tabel_detail.children('tbody').last().append(
										'<tr>' +
										'<td style="text-align: center">' + (i + 1) + '</td>' +
										'<td style="text-align: center">' + item.tgl + '</td>' +
										'<td style="text-align: center">-</td>' +
										'<td style="text-align: center">-</td>' +
										'<td style="text-align: right">0</td>' +
										'<td style="text-align: center">' + item.ket.toUpperCase() + '</td>' +
										'</tr>'
									);
								}

							});

							$('#msg-load').empty();

							tabel_detail.children('tfoot').empty().append(
								'<tr>' +
								'<td colspan="4" style="text-align: right">Total jam </td>' +
								'<td style="text-align: right">' + tot + '</td>' +
								'<td style="text-align: center"></td>' +
								'</tr>'
							);
							tabel_detail.children('tfoot').css({
								'background-color': '#f9f8f5',
								'color': '#898989'
							});
							
							//var aa = cb.tukin;
							if (cb.pp14.length > 0) {
								//console.log(cb);
								// alert('test');
								var tabel_tukin = $('#tabel-tukin'),
									tot_poin = 0,
									tot_telat = 0,
									tot_plg = 0;
								tot_final = 0;
								tabel_tukin.children('tbody').empty();
								tabel_tukin.children('tfoot').empty();

								$.each(cb.pp14, function(i, item) {
									if (item.dtg_real == null){vardtg_real = '-';}else{vardtg_real = item.dtg_real;};
									if (item.dtg_late == null){vardtg_late = '-';}else{vardtg_late = item.dtg_late;};
									if (item.dtg_late_angka == null){vardtg_late_angka = '-';}else{vardtg_late_angka = item.dtg_late_angka;};
									if (item.t1 == '0'){vart1 = '-';}else{vart1 = '<i class="fa fa-check"></i>';};
									if (item.t2 == '0'){vart2 = '-';}else{vart2 = '<i class="fa fa-check"></i>';};
									if (item.t3 == '0'){vart3 = '-';}else{vart3 = '<i class="fa fa-check"></i>';};
									if (item.t4 == '0'){vart4 = '-';}else{vart4 = '<i class="fa fa-check"></i>';};
									if (item.t5 == '0'){vart5 = '-';}else{vart5 = '<i class="fa fa-check"></i>';};
									if (item.t6 == '0'){vart6 = '-';}else{vart6 = '<i class="fa fa-check"></i>';};
									if (item.potong_msk == null){vardpotongmasuk = '-';}else{vardpotongmasuk = item.potong_msk;};
									if (item.plg_real == null){varplg_real = '-';}else{varplg_real = item.plg_real;};
									if (item.plg_status == ''){varplg_status = '-';}else{varplg_status = item.plg_status;};
									if (item.plg_early == null){varplg_early = '-';}else{varplg_early = item.plg_early;};
									if (item.plg_early_angka == null){varplg_early_angka = '-';}else{varplg_early_angka = item.plg_early_angka;};
									if (item.psw1 == '0'){varpsw1 = '-';}else{varpsw1 = '<i class="fa fa-check"></i>';};
									if (item.psw2 == '0'){varpsw2 = '-';}else{varpsw2 = '<i class="fa fa-check"></i>';};
									if (item.psw3 == '0'){varpsw3 = '-';}else{varpsw3 = '<i class="fa fa-check"></i>';};
									if (item.psw4 == '0'){varpsw4 = '-';}else{varpsw4 = '<i class="fa fa-check"></i>';};
									if (item.psw5 == '0'){varpsw5 = '-';}else{varpsw5 = '<i class="fa fa-check"></i>';};
									if (item.potong_pulang == null){vardpotongpulang = '-';}else{vardpotongpulang = item.potong_pulang;};
									if (item.suket == ""){varsuket = '-';}else{varsuket = item.suket;};
									if (item.potong_total == null){vardpotongtotal = '-';}else{vardpotongtotal = item.potong_total;};
									if (item.total_terlambat == null){vardtotalterlambat = '-';}else{vardtotalterlambat = item.total_terlambat;};
									
									if (item.jenis == 'M') {
										tabel_tukin.children('tbody').last().append(
											'<tr>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + (i + 1) + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;text-transform: uppercase;">' + item.dino + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;" nowrap>' + item.tgl + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;" nowrap>' + item.jenis + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + item.dtg_rule + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vardtg_real + '</td>' +
											'<td style="background-color: #CED4FC;" nowrap>' + item.dtg_status + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vardtg_late + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vardtg_late_angka + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vart1 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vart2 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vart3 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vart4 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vart5 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vart6 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vardpotongmasuk + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + item.plg_rule + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varplg_real + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;text-transform: uppercase;">' + varplg_status + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varplg_early + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varplg_early_angka + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varpsw1 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varpsw2 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varpsw3 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varpsw4 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varpsw5 + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vardpotongpulang + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + varsuket + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vardpotongtotal + '</td>' +
											'<td style="text-align: center;background-color: #CED4FC;">' + vardtotalterlambat + '</td>' +
											'</tr>'
										);
										tot_poin = tot_poin + parseFloat(item.point_cut);
										tot_telat = tot_telat + parseFloat(item.dtg_cut);
										tot_plg = tot_plg + parseFloat(item.plg_cut);
										//tot_plg		= tot_plg+parseFloat(item.final_cut);
										tot_final = tot_final + parseFloat(item.final_cut);
									} else if (item.jenis == '-') {
										tabel_tukin.children('tbody').last().append(
											'<tr>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + (i + 1) + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;text-transform: uppercase;">' + item.dino + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;" nowrap>' + item.tgl + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;" nowrap>' + item.jenis + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + item.dtg_rule + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vardtg_real + '</td>' +
											'<td style="background-color: #FEA8A8;" nowrap>' + item.dtg_status + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vardtg_late + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vardtg_late_angka + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vart1 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vart2 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vart3 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vart4 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vart5 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vart6 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vardpotongmasuk + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + item.plg_rule + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varplg_real + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;text-transform: uppercase;">' + varplg_status + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varplg_early + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varplg_early_angka + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varpsw1 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varpsw2 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varpsw3 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varpsw4 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varpsw5 + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vardpotongpulang + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + varsuket + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vardpotongtotal + '</td>' +
											'<td style="text-align: center;background-color: #FEA8A8;">' + vardtotalterlambat + '</td>' +
											'</tr>'
										);
									} else {
										tabel_tukin.children('tbody').last().append(
											'<tr>' +
											'<td style="text-align: center">' + (i + 1) + '</td>' +
											'<td style="text-align: center;text-transform: uppercase;">' + item.dino + '</td>' +
											'<td style="text-align: center">' + item.tgl + '</td>' +
											'<td style="text-align: center" nowrap>' + item.jenis + '</td>' +
											'<td style="text-align: center" nowrap>' + item.dtg_rule + '</td>' +
											'<td style="text-align: center" nowrap>'+ vardtg_real +'</td>' +
											'<td style="text-align: center" nowrap>' + item.dtg_status + '</td>' +
											'<td style="text-align: center" nowrap>'+ vardtg_late +'</td>' +
											'<td style="text-align: center;">'+ vardtg_late_angka +'</td>' +
											'<td style="text-align: center" nowrap>' + vart1 + '</td>' +
											'<td style="text-align: center" nowrap>' + vart2 + '</td>' +
											'<td style="text-align: center" nowrap>' + vart3 + '</td>' +
											'<td style="text-align: center" nowrap>' + vart4 + '</td>' +
											'<td style="text-align: center" nowrap>' + vart5 + '</td>' +
											'<td style="text-align: center" nowrap>' + vart6 + '</td>' +
											'<td style="text-align: center" nowrap>' + vardpotongmasuk + '</td>' +
											'<td style="text-align: center" nowrap>' + item.plg_rule + '</td>' +
											'<td style="text-align: center" nowrap>' + varplg_real + '</td>' +
											'<td style="text-align: center;text-transform: uppercase;" nowrap>' + varplg_status + '</td>' +
											'<td style="text-align: center;" nowrap>' + varplg_early + '</td>' +
											'<td style="text-align: center;" nowrap>' + varplg_early_angka + '</td>' +
											'<td style="text-align: center;" nowrap>' + varpsw1 + '</td>' +
											'<td style="text-align: center;" nowrap>' + varpsw2 + '</td>' +
											'<td style="text-align: center;" nowrap>' + varpsw3 + '</td>' +
											'<td style="text-align: center;" nowrap>' + varpsw4 + '</td>' +
											'<td style="text-align: center;" nowrap>' + varpsw5 + '</td>' +
											'<td style="text-align: center;" nowrap>' + vardpotongpulang + '</td>' +
											'<td style="text-align: center;" nowrap>' + varsuket + '</td>' +
											'<td style="text-align: center;" nowrap>' + vardpotongtotal + '</td>' +
											'<td style="text-align: center;" nowrap>' + vardtotalterlambat + '</td>' +
											'</tr>'
										);
									}

								});

								tabel_tukin.children('tfoot').empty().append(
									/* '<tr>' +
									'<td colspan="30">' +
									'<p><strong>Catatan : </strong></p>' +
									'<p><strong>Total Kinerja = (100 - Jam Kinerja Kurang) - Poin Sakit</strong></p>' +
									'<p><strong>Jika Sakit &lt; 3 maka Point Sakit = 0</strong></p>' +
									'<p><strong>Jika Sakit &gt; = 3 dan Sakit &lt; = 14 maka Point Sakit = 25</strong></p>' +
									'<p><strong>Jika Sakit &gt; = 15 maka Point Sakit = 50</strong></p>' +
									'</td>' +
									'</tr>' */
								);
								tabel_tukin.children('tfoot').css({
									'background-color': '#f9f8f5',
									'color': '#898989'
								});

							} else if (cb.pp14.length = 0) {
								var tabel_tukin = $('#tabel-tukin');
								
								tabel_tukin.children('tbody').empty();
								tabel_tukin.children('tfoot').empty();

								tabel_tukin.children('tbody').last().append(
									'<tr>' +
									'<td colspan="30" style="text-align: center"><h3>Rekapan belum tersedia</h3></td>' +
									'</tr>'
								);
								tabel_tukin.children('tfoot').empty().append(
									/* '<tr>' +
									'<td style="text-align: right">-</td>' +
									'<td style="text-align: right">-</td>' +
									'<td style="text-align: right">-</td>' +
									'</tr>' +
									'<tr>' +
									'<td colspan="29">' +
									'<p><strong>Catatan : </strong></p>' +
									'<p><strong>Total Kinerja = (100 - Jam Kinerja Kurang) - Poin Sakit</strong></p>' +
									'<p><strong>Jika Sakit &lt; 3 maka Point Sakit = 0</strong></p>' +
									'<p><strong>Jika Sakit &gt; = 3 dan Sakit &lt; = 14 maka Point Sakit = 25</strong></p>' +
									'<p><strong>Jika Sakit &gt; = 15 maka Point Sakit = 50</strong></p>' +
									'</td>' +
									'</tr>' */
								);
								tabel_tukin.children('tfoot').css({
									'background-color': '#f9f8f5',
									'color': '#898989'
								});

							}
							
							if (cb.result1.length > 0) {
								var akum1 = $("#akum1");
								akum1.empty();
								$.each(cb.result1, function(i, item) {
									if(!item.akumjam){
										akum1.append('<strong>(A)</strong> Akumulasi Kurang Jam Kerja: <strong>00:00:00</strong>');
									}else{
										akum1.append('<strong>(A)</strong> Akumulasi Kurang Jam Kerja: <strong>'+ item.akumjam +'</strong>');
									}
								});
							}
							
							if (cb.result2.length > 0) {
								var akum2 = $("#akum2");
								akum2.empty();
								$.each(cb.result2, function(i, item) {
									if(!item.pengurang){
										akum2.append('<strong>(B)</strong> Nilai Pengurang Tunkin: <strong>0</strong>');
									}else{
										akum2.append('<strong>(B)</strong> Nilai Pengurang Tunkin: <strong>'+ item.pengurang +'</strong>');
									}
								});
							}
							
							if (cb.result3.length > 0) {
								var akum3 = $("#akum3");
								akum3.empty();
								$.each(cb.result3, function(i, item) {
									if(!item.pointcut){
										akum3.append('<strong>(C)</strong> Point Potongan Kinerja (presensi): <strong>0</strong>');
									}else{	
										akum3.append('<strong>(C)</strong> Point Potongan Kinerja (presensi): <strong>'+ item.pointcut +'</strong>');
									}
								});
							}
							
							if (cb.result4.length > 0) {
								var akum4 = $("#akum4");
								akum4.empty();
								$.each(cb.result4, function(i, item) {
									if(!item.sumcut){
										akum4.append('<i class="fa fa-warning pull-right"></i><strong>(D)</strong> Total Potongan [B + C]: <strong>0</strong>');
									}else{	
										akum4.append('<i class="fa fa-warning pull-right"></i><strong>(D)</strong> Total Potongan [B + C]: <strong>'+ item.sumcut +'</strong>');
									}
								});
							}
							
							if (cb.result5.length > 0) {
								var akum5 = $("#akum5");
								akum5.empty();
								$.each(cb.result5, function(i, item) {
									if(!item.point_tunkin){
										akum5.append('<i class="fa fa-check-square pull-right"></i><strong>(E)</strong> Point Tunjangan Kerja [100 - D] : <strong>100</strong>');
									}else{	
										akum5.append('<i class="fa fa-check-square pull-right"></i><strong>(E)</strong> Point Tunjangan Kerja [100 - D] : <strong>'+ item.point_tunkin +'</strong>');
									}
								});
							}
						} else {
							$('#jmh_masuk').empty().append('Rekapan belum tersedia');
							$('#jmh_dl').empty().append('Rekapan belum tersedia');
							$('#jmh_sakit').empty().append('Rekapan belum tersedia');
							$('#jmh_ijin').empty().append('Rekapan belum tersedia');
							$('#jmh_cuti').empty().append('Rekapan belum tersedia');
							$('#jmh_tk').empty().append('Rekapan belum tersedia');
							$('#tot_jam').empty().append('Rekapan belum tersedia');

							$('#msg-load').empty();
						}

					},
					error: function() {
						alert('Terjadi kesalahan dalam membaca data!');
					}
				});
			}
		});
			
});//end script
</script>