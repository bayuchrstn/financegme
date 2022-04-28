<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>

	function row_table_detail(key='', value='') {
		var ret = '<tr>';
		ret += '<td valign="top" width="200">'+key+'</td>';
		ret += '<td valign="top" width="10">:</td>';
		ret += '<td valign="top">'+value+'</td>';
		ret += '</tr>';
		return ret;
	}

	function show_this(x)
	{
		$("#show_detail_pekerjaan_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		$.ajax({
			// url : '<?php echo base_url().$modul['url']; ?>/show/'+x+'/json',
			url : "<?php echo base_url(); ?>/xhr/task_report/get_task_detail/"+x,
			type: 'GET',
			success: function(response){
				// var response = $.parseJSON(res);
				var append_tag = '';
				if (response.laporan && response.laporan.hasOwnProperty('id')) {
					append_tag += '<table class="table_data_info"><tbody>';
					append_tag += row_table_detail('Dibuat oleh', response.laporan.author.name);
					append_tag += row_table_detail('Tanggal', response.laporan.date_created);
					append_tag += row_table_detail('Status', response.laporan.status);

					var report_link = (response.laporan.task_report[0].owncloud.indexOf('http://') >=0 || response.laporan.task_report[0].owncloud.indexOf('https://')>=0) ? response.laporan.task_report[0].owncloud : 'http://'+response.laporan.task_report[0].owncloud;
					append_tag += row_table_detail('Link', response.laporan.task_report[0].owncloud!='' ? '<a href="'+report_link+'" target="_blank">Click Here</a>' : '-');
					
					append_tag += '<tr><td colspan="3">'+response.laporan.body+'</td></tr>';
					append_tag += '</tbody></table>';

					var append = '';

					switch (response.laporan.category){
							case 'survey':
								if (response.laporan.task_report_survey_link.length > 0) {
									append += '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
									for (var i = 0; i < response.laporan.task_report_survey_link.length; i++) {
										append += '<div class="panel panel-info"> <div class="panel-heading" role="tab" id="heading'+i+'" style="padding: 5px 20px;"><h6 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+i+'" aria-expanded="true" aria-controls="collapse'+i+'">';
										append += '<span class="icon-arrow-right5"></span> ';
										append += response.laporan.task_report_survey_link[i].ps+' link';
										append += '</a></h6></div>';
										append += '<div id="collapse'+i+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+i+'"><div class="panel-body">';
										append +='<table class="table_data_info">';
										if (response.laporan.task_report_survey_link[i].jenis=='fo') {
											//fiber data
											append += row_table_detail('FO Distribusi', response.laporan.task_report_survey_link[i].fo_distribusi);
											append += row_table_detail('Jarak ODP', response.laporan.task_report_survey_link[i].fo_jarak_odp_server);
											append += row_table_detail('Start Point', response.laporan.task_report_survey_link[i].fo_start_point);
											append += row_table_detail('End Point', response.laporan.task_report_survey_link[i].fo_end_point);
											append += row_table_detail('Jenis Kabel', response.laporan.task_report_survey_link[i].fo_jenis_kabel);
											append += row_table_detail('Status Kabel', response.laporan.task_report_survey_link[i].fo_status_kabel);
											append += row_table_detail('Tiang 7M', response.laporan.task_report_survey_link[i].fo_tiang_7);
											append += row_table_detail('Tiang 9M', response.laporan.task_report_survey_link[i].fo_tiang_9);
											append += row_table_detail('Tambahan', response.laporan.task_report_survey_link[i].fo_accessories);
										} else {
											//wireless data
											append += row_table_detail('BTS', response.laporan.task_report_survey_link[i].wireless_bts);
											append += row_table_detail('Jarak BTS', response.laporan.task_report_survey_link[i].wireless_bts_jarak);
											append += row_table_detail('BTS Alternatif', response.laporan.task_report_survey_link[i].wireless_bts_alternative);
											append += row_table_detail('Jarak BTS Alternatif', response.laporan.task_report_survey_link[i].wireless_bts_jarak_alternative);
											append += row_table_detail('Jenis Tower', response.laporan.task_report_survey_link[i].wireless_jenis_tower);
											append += row_table_detail('Tinggi', response.laporan.task_report_survey_link[i].wireless_tinggi_tower);
											append += row_table_detail('Jenis Kabel', response.laporan.task_report_survey_link[i].wireless_kabel);
											append += row_table_detail('Jenis Access Point', response.laporan.task_report_survey_link[i].wireless_access_point);
											append += row_table_detail('Kebutuhan Tangga', response.laporan.task_report_survey_link[i].wireless_tangga);
										}
										append += row_table_detail('Catatan', response.laporan.task_report_survey_link[i].note);
										append +='</table>';
										append += '</div></div></div>';
									}
									append += '</div>';
								}
								break;

							case 'pre_survey':
								if (response.laporan.task_report_presurvey.length > 0) {
									append +='<table class="table_data_info">';
									append += row_table_detail('Coverage', response.laporan.task_report_presurvey[0].status_coverage);
									append += row_table_detail('Koordinat', response.laporan.task_report_presurvey[0].koordinat);
									append += row_table_detail('Jarak ODP', response.laporan.task_report_presurvey[0].jarak_opd_pelanggan);
									append += row_table_detail('Jenis Tower', response.laporan.task_report_presurvey[0].jenis_tower);
									append += row_table_detail('Tinggi Tower', response.laporan.task_report_presurvey[0].tinggi_tower);
									append += row_table_detail('Estimasi Waktu', response.laporan.task_report_presurvey[0].estimasi_waktu_pengerjaan);
									append += row_table_detail('Estimasi Biaya', response.laporan.task_report_presurvey[0].estimasi_biaya);
									append += row_table_detail('Vendor', response.laporan.task_report_presurvey[0].nama_vendor);
									append += row_table_detail('Catatan', response.laporan.task_report_presurvey[0].note);
									append +='</table>';
								}
								break;

							case 'installasi':
							case 'installasi_new':
								if (response.laporan.task_report_install_link.length > 0) {
									append += '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
									for (var i = 0; i < response.laporan.task_report_install_link.length; i++) {
										if (response.laporan.task_report_install_link[i].jenis=='fo' || response.laporan.task_report_install_link[i].jenis=='wr') {
											append += '<div class="panel panel-info"> <div class="panel-heading" role="tab" id="heading'+i+'" style="padding: 5px 20px;"><h6 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+i+'" aria-expanded="true" aria-controls="collapse'+i+'">';
											append += '<span class="icon-arrow-right5"></span> ';
											append += response.laporan.task_report_install_link[i].ps+' link';
											append += '</a></h6></div>';
											append += '<div id="collapse'+i+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+i+'"><div class="panel-body">';
											append +='<table class="table_data_info">';
											if (response.laporan.task_report_install_link[i].jenis=='fo') {
												//fiber data
												append += row_table_detail('Jenis Link', 'Fiber');
												append += row_table_detail('ODP', response.laporan.task_report_install_link[i].fo_odp);
												append += row_table_detail('Jenis Kabel', response.laporan.task_report_install_link[i].fo_jenis_kabel);
												append += row_table_detail('Jarak Kabel', response.laporan.task_report_install_link[i].fo_jarak_kabel);
												append += row_table_detail('Type ONT/ONU', response.laporan.task_report_install_link[i].fo_ont_onu);
												append += row_table_detail('Serial Number ONT/ONU', response.laporan.task_report_install_link[i].fo_serial_number_ont_onu);
												append += row_table_detail('Mac Address ONT/ONU', response.laporan.task_report_install_link[i].fo_mac_address_fo_ont_onu);
												append += row_table_detail('Power Optic ODP', response.laporan.task_report_install_link[i].fo_power_optic_odp);
												append += row_table_detail('Power Optic Roset', response.laporan.task_report_install_link[i].fo_power_optic_roset);
												append += row_table_detail('IP PTP Privat', response.laporan.task_report_install_link[i].fo_ip_ptv_privat);
											} else {
												// wireless data
												append += row_table_detail('Jenis Link', 'Wireless');
												append += row_table_detail('BTS', response.laporan.task_report_install_link[i].wireless_bts);
												append += row_table_detail('BTS', response.laporan.task_report_install_link[i].wireless_bts);
												append += row_table_detail('Jarak BTS', response.laporan.task_report_install_link[i].wireless_jarak);
												append += row_table_detail('Antenna', response.laporan.task_report_install_link[i].wireless_antena);
												append += row_table_detail('Wireless Radio', response.laporan.task_report_install_link[i].wireless_radio);
												append += row_table_detail('Sinyal Strength', response.laporan.task_report_install_link[i].wireless_signal_strenght);
												append += row_table_detail('Kualitas Sinyal', response.laporan.task_report_install_link[i].wireless_kualitas_signal);
												append += row_table_detail('Jenis Kabel', response.laporan.task_report_install_link[i].wireless_jenis_kabel);
												append += row_table_detail('Jarak Kabel', response.laporan.task_report_install_link[i].wireless_jarak_kabel);
											}
											append +='</table>';
											append += '</div></div></div>';
										}
									}

									//barang out
									if (response.laporan.list_barang_out.length>0) {
										append += '<div class="panel panel-info"> <div class="panel-heading" role="tab" id="headingBarangOut" style="padding: 5px 20px;"><h6 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseBarangOut" aria-expanded="true" aria-controls="collapseBarangOut">';
										append += '<span class="icon-arrow-right5"></span> ';
										append += 'Daftar Barang Dipasang';
										append += '</a></h6></div>';
										append += '<div id="collapseBarangOut" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingBarangOut"><div class="panel-body">';
										append +='<table class="table table-bordered">';
										append += '<thead class="bg-slate">';
										append += '<tr><th>Nama Barang</th><th>Kode</th><th>Status</th></tr>';
										append += '</thead>';
										append += '<tbody>';
										$.each(response.laporan.list_barang_out, function(i, item){
											append += '<tr>';
											append += '<td>'+item.category_name+'</td>';
											append += '<td>'+item.nomor_barang+'</td>';
											append += '<td>'+item.owner_status+'</td>';
											append += '</tr>'
										});
										append += '</tbody>';
										append +='</table>';
										append += '</div></div></div>';
									}

									append += '</div>';
								}
								break;
							default:
								append_tag += '';
								break;
						}
						append_tag += append;

				} else {
					append_tag += 'Belum ada laporan pekerjaan';
				}
				$("#show_laporan_hasil_pekerjaan_div").empty().append(append_tag);
			}
		});
		$.ajax({
			type: 'GET',
			url : '<?=base_url();?>ajax/get_task_comment/'+x,
			success: function(res){
				var response = $.parseJSON(res);
				$('#show_laporan_komentar_div').empty();
				append_tag = '';
				if (response.data.length > 0) {
					const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
					for (var i = 0; i < response.data.length; i++) {
						var tanggal = new Date(response.data[i].date_post*1000);
						var tanggal_array = {
							'tahun' : tanggal.getFullYear(),
							'bulan' : ('0'+(tanggal.getMonth()+1)).slice(-2),
							'tanggal' : ('0'+tanggal.getDate()).slice(-2),
							'jam' : ('0'+tanggal.getHours()).slice(-2),
							'menit' : ('0'+tanggal.getMinutes()).slice(-2),
							'detik' : ('0'+tanggal.getSeconds()).slice(-2)
						};
						var tanggal_post = tanggal_array.tanggal+' '+monthNames[tanggal_array.bulan-1]+' '+tanggal_array.tahun+' '+tanggal_array.jam+':'+tanggal_array.menit;
						// var tanggal_post = '';

						append_tag += '<div class="row"><div class="col-md-12"><div class="media-body">'+response.data[i].content+'<div class="media-annotation">'+response.data[i].author_name+' pada '+tanggal_post+'</div></div></div></div>';
					}
					append_tag += '<br>';
				}
				append_tag += '<a class="btn btn-primary" onclick="addComment('+x+');"><i class="icon-comments"></i> Komentar</a>';
				$('#show_laporan_komentar_div').append(append_tag);
			}
		});
		$('#modal_tab_detail_pekerjaan').modal('show');
	}


    function input()
    {
		set_option('<?php echo base_url(); ?>select_option/assign_to', 'assign_to_insert', 'user');
		set_option('<?php echo base_url(); ?>select_option/request/task_teknis/assigned_user', 'user_assigned_insert', '');
		set_option('<?php echo base_url(); ?>select_option/request/task_teknis/jenis_pekerjaan_teknis', 'category_id_insert', '');
		location_picker('customer', '', 'location_insert', 'location_id_insert');
		$('.cos').val('');
		$('#attachment_ul_insert').html('');
		$('#body_fake_insert').val('');
		tinyMCE.get('body_insert').setContent('');
		$('#modal_request_insert').modal('show');
        return false;
    }

	function update(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        block_this('js_table_marketing_progress');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

				// form customize
				var arr = [];
				$.each(response.user_assigned, function( index, value ) {
                    // console.log(value);
					arr.push(value);
                    // $('#chk_'+value).prop('checked', true);
                });

				set_option('<?php echo base_url(); ?>select_option/request/task_teknis/assigned_user', 'user_assigned_update', arr);
				location_picker(response.location, response.location_id, 'location_update', 'location_id_update');
				set_option('<?php echo base_url(); ?>select_option/request/task_teknis/jenis_pekerjaan_teknis', 'category_id_update', response.category);
                $("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
                $("#form_<?php echo $modul['code']?>_update #date_start_update").val(response.date_start);
                $("#form_<?php echo $modul['code']?>_update #date_due_update").val(response.date_due);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);
				show_attachment('<?php echo base_url(); ?>attachment/index/'+response.id, 'current_attachment_div_<?php echo $modul['code']; ?>');
				$('#attachment_ul_update').html('');
				// form customize

                $('#modal_request_update').modal('show');
                unblock_this('js_table_marketing_progress');
            }
        });
        return false;
    }

    function hapus(id) {
    	var modul = 'delete_task_teknis';
    	var post_url = '<?php echo base_url();?>ajax_request/lock_task/'+modul;
		$("#data_info_delete").load("<?php echo base_url().$modul['url']; ?>/show/"+id+"/echo");

		$.ajax({
			type : 'GET',
			url  : '<?php echo base_url();?>pekerjaan_teknis/update/'+id, 
			success: function(res){
				var response = $.parseJSON(res);
				$('#delete_id').val(response.id);
				$('#form_product_delete').attr('action',post_url);
				$('#modal_product_delete').modal('show');
			}
		});
		
		console.log(id);
	}

	function location_picker(location, location_id, flocation, flocation_id)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>location_picker/all/'+location+'/'+location_id,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#'+flocation).html(response.location).val(location).chosen().trigger('chosen:updated');
				$('#'+flocation_id).html(response.location_id).val(location_id).chosen().trigger('chosen:updated');
			}
		});
	}

	if( $('#location_insert').length ){
		$('#location_insert').change(function(){
			var location = $(this).val();
			location_picker(location, '', 'location_insert', 'location_id_insert');
		});
	}

	if( $('#location_update').length ){
		$('#location_update').change(function(){
			var location = $(this).val();
			location_picker(location, '', 'location_update', 'location_id_update');
		});
	}

	function addComment(x) {
		$('#comment_task_id').val(x);
		$('#modal_add_comment').modal('show');
	}

	$('#form_add_comment').on('submit', function(){
		var task_id = $("input#comment_task_id").val();
		$.ajax({
			type: 'POST',
			url : $(this).attr('action'),
			data: $(this).serialize(),
			success: function(res){
				var response = $.parseJSON(res);
				if (response.status=='success') {
					$('#modal_tab_detail_pekerjaan').modal('hide');
					$('#modal_add_comment').modal('hide');
					show_this(task_id);
					$('#show_laporan_komentar').tab('show');
				} else {
					alert(response.status);
				}
			}
		});
		return false;
	});

</script>
