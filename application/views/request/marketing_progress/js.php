<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');

	function show_this(x)
	{
		// console.log(x);
		// $("#show_detail_mp_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		var action = "<?php echo base_url(); ?>/xhr/task_report/get_task_detail/"+x;
		$.ajax({
			url : action,
			type: 'GET',
			success: function(response) {
				var append = '<table class="table_data_info">';
				append += row_table_detail('Nama Marketing', response.data_location.data_marketing.name);
				append += row_table_detail('Tanggal', response.date_created);
				append += response.task_child.length > 0 ? row_table_detail('Tanggal request', response.task_child.task_marketing_request["0"].date_request_start) : '';
				append += row_table_detail(response.data_location.status=='pre_customer' ? 'Pre Customer' : 'Customer', response.data_location.customer_name);
				append += row_table_detail('Progress', response.detail_category.name);
				append += row_table_detail('Judul', response.subject);
				append += row_table_detail('Keterangan', response.body);
				append += '</table>';

				// laporan
				if (response.laporan && response.laporan.hasOwnProperty('id')) {
					append += '<div class="row"><div class="col-lg-12" style="border-top:1px solid #000;">';
					append += '<b>Laporan</b><br>Dibuat oleh :'+response.laporan.author.name+' pada '+response.laporan.date_created;
					append += response.laporan.body;
					append += '</div></div>';

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
									} else if(response.laporan.task_report_survey_link[i].jenis=='wr') {
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
									} else {

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
										} else if (response.laporan.task_report_install_link[i].jenis=='wr') {
											// wireless data
											append += row_table_detail('Jenis Link', 'Wireless');
											append += row_table_detail('BTS', response.laporan.task_report_install_link[i].wireless_bts);
											append += row_table_detail('Jarak BTS', response.laporan.task_report_install_link[i].wireless_jarak);
											append += row_table_detail('Antenna', response.laporan.task_report_install_link[i].wireless_antena);
											append += row_table_detail('Wireless Radio', response.laporan.task_report_install_link[i].wireless_radio);
											append += row_table_detail('Sinyal Strength', response.laporan.task_report_install_link[i].wireless_signal_strenght);
											append += row_table_detail('Kualitas Sinyal', response.laporan.task_report_install_link[i].wireless_kualitas_signal);
											append += row_table_detail('Jenis Kabel', response.laporan.task_report_install_link[i].wireless_jenis_kabel);
											append += row_table_detail('Jarak Kabel', response.laporan.task_report_install_link[i].wireless_jarak_kabel);
										} else {
											append += '';
										}
										append +='</table>';
										append += '</div></div></div>';
									}
								}

								//barang out
								if (response.laporan.list_barang_out.length>0) {
									append += '<div class="panel panel-info"> <div class="panel-heading" role="tab" id="headingBarangOut" style="padding: 5px 20px;"><h6 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseBarangOut" aria-expanded="true" aria-controls="collapseBarangOut">';
									append += '<span class="icon-arrow-right5"></span> ';
									append += 'Daftar Barang Keluar';
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

							break;
					}

				}

				$("#show_detail_mp_div").empty().append(append);

				//is trial
				if (response.category=='mp_trial') {
					$.ajax({
						type: 'GET',
						url : '<?php echo base_url(); ?>trial_report/show/'+response.id+'/json',
						success: function(res){
							var response = $.parseJSON(res);
							var append = '';

							append += '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
							append += '<div class="panel panel-info"> <div class="panel-heading" role="tab" id="heading'+i+'" style="padding: 5px 20px;"><h6 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+i+'" aria-expanded="true" aria-controls="collapse'+i+'">';
							append += '<span class="icon-arrow-right5"></span> ';
							append += ' Detail Trial';
							append += '</a></h6></div>';
							append += '<div id="collapse'+i+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+i+'"><div class="panel-body">';

							var telephone_home = response.detail.customer.data.telephone_home != '' ? response.detail.customer.data.telephone_home : '-';
							var telephone_mobile = response.detail.customer.data.telephone_mobile != '' ? response.detail.customer.data.telephone_mobile : '-';
							var telephone_work = response.detail.customer.data.telephone_work != '' ? response.detail.customer.data.telephone_work : '-';
							append += '<table class="table_data_info"><tbody>';
							append += row_table_detail('Nama',response.detail.customer.data.customer_name);
							append += row_table_detail('Alamat',response.detail.customer.data.customer_address);
							append += row_table_detail('Contact',response.detail.customer.data.contact_person);
							append += row_table_detail('Telepon',telephone_home+'/'+telephone_mobile+'/'+telephone_work);
							append += row_table_detail('Mulai Trial',response.detail.task_marketing_request.data.date_request_start);
							append += row_table_detail('Selesai Trial',response.detail.task_marketing_request.data.date_request_end);
							append += '</tbody></table><!--aaa-->';
							append += '<div id="detail_trial_report"></div></div></div></div></div>';

							$('#show_detail_mp_div').append(append);

							if (response.detail.trial.data.status=='done') {
								$.ajax({
									type: 'POST',
									url : '<?=base_url()?>/ajax_request/trial_questions/unserialize',
									data : {checklist : response.detail.trial.data.checklist},
									success: function(r){
										var result = $.parseJSON(r);
										var append = '<br>';
										append += 'Dibuat Oleh : '+response.detail.trial.data.report_name+' pada '+response.detail.trial.data.report_date;
										append += '<table class="table table-bordered">';
										append += '<thead class="bg-slate">';
										append += '<tr><th>Pertanyaan</th><th>Ya/Tidak</th><th>Uraian</th></tr>';
										append += '</thead>';
										append += '<tbody>';
										for (var i = 0; i<result.length; i++) {
											append += '<tr>';
											append += '<td width="250">'+result[i].pertanyaan+'</td>';
											append += '<td width="50" class="text-center">'+result[i].jawaban+'</td>';
											append += '<td>'+result[i].uraian+'</td>';
											append += '</tr>';
										}

										append += '<tr>';
										append += '<td colspan="3"><b>Keterangan : </b><br>'+response.detail.trial.data.note+'</td>';
										append += '</tr>';

										append += '</tbody>';
										append += '</table>';
										$('#detail_trial_report').empty().append(append);
									}
								});

							// console.log(response);
							}
						}
					});
				}

			}
		});
		$.ajax({
			type: 'GET',
			url : '<?=base_url();?>ajax/get_task_comment/'+x,
			success: function(res){
				var response = $.parseJSON(res);
				$('#show_komentar_div').empty();
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
				$('#show_komentar_div').append(append_tag);
			}
		});
		$('.collapse').on('show.bs.collapse', function () {
			// alert('ok');
		});
		$('#modal_detail_mp').modal('show');
	}
	function row_table_detail(key='', value='') {
		var ret = '<tr>';
		ret += '<td valign="top" width="200">'+key+'</td>';
		ret += '<td valign="top" width="10">:</td>';
		ret += '<td valign="top">'+value+'</td>';
		ret += '</tr>';
		return ret;
	}

	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>

	function asearch()
	{
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/pre_customer', 'location_id_search', '');
		set_option('<?php echo base_url(); ?>select_option/request/marketing_progress/marketing', 'author_search', '');
		$('#modal_asearch').modal('show');
		return false;
	}

    function update_marketing_progress(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        block_this('js_table_marketing_progress');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);

				// form customize
                $("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);
				// form customize

                $('#modal_request_update').modal('show');
                unblock_this('js_table_marketing_progress');
            }
        });
        return false;
    }

    function input()
    {
		$('.cos').val('');
		tinyMCE.get('body_insert').setContent('');
        set_option('<?php echo base_url(); ?>select_option/request/<?php echo $req_code; ?>/customer', 'location_id_insert', '');
		set_option('<?php echo base_url(); ?>select_option/kosong', 'category_id_insert', '');
		$('#modal_request_insert').modal('show');
        return false;
    }

	//ketika pelanggan dipilih maka akan mempengaruhi select option jenis marketing progress
	$('#location_id_insert').change(function(){
		var customer_id = $(this).val();
		// console.log(customer_id);
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_category/'+customer_id, 'category_id_insert', '');
	});

	//ketika jenis marketing progress dipilih maka akan mempengaruhi bentuk form tambahan untuk marketing progress
	//misalnya marketing progress jenis survey maka ti tampilkan form tanggal request
	//dan lain lain dikondisikan disini
	$('#category_id_insert').change(function(){
		var mp_level = $(this).val();
		var customer_id = $('#location_id_insert').val();

		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>xhr/marketing_progress/form_ext/'+mp_level+'/'+customer_id+'/insert',
            success: function(res) {
				$('#form_ext_insert').html(res);
            }
        });

		if (mp_level === 'mp_instalasi') {
			getTaskBy({
				category: 'survey',
				locationId: customer_id,
				taskCategory: 'task_report',
			}, (tasks) => {
				getTaskDetail(tasks[0].id, (d) => {
					if (d.task_boq.length !== 0) {
						var tableElement = $('#boq_marketing_progress_insert');
						var tableBodyElement = tableElement.children('tbody');

						tableElement.before(`<input type="hidden" name="boq_mode" value="update" />`);
						tableBodyElement.empty();

						d.task_boq.map((boq) => {
							var namaBarang = boq.mode === 'barang' ? `${boq.brand_name} / ${boq.category_name} / ${boq.item_name}` : boq.item_name_custom;

							tableBodyElement.append(`
								<tr>
									<td>${namaBarang}</td>
									<td align="center">${boq.qty}</td>
									<td>${boq.note}</td>
									<td align="center"><input type="checkbox" name="boq[${boq.id}][approve_mrk]" value="1" /></td>
								</tr>
								`);
							});
					}
				});
			});
		}
	});

	function getTaskBy(data, cb) {
		var url = '<?php echo base_url(); ?>task/get'; // json

		$.ajax({ type: 'POST', url, data, success: function(res) {
			cb(res);
		}});
	}

	function getTaskDetail(id, cb) {
		var url = '<?php echo base_url(); ?>xhr/task_report/get_task_detail/' + id; // json

		$.ajax({ type: 'GET', url, success: function(res) {
			cb(res);
		}});
	}

	function addAttachmentInput() {
		var index = Number($('.attachment-control_input').last().children('.attachment-index').val()) + 1;

		$('#attachment-add_input').before(`
			<div class="attachment-control_input" style="margin-bottom: 5px;">
				<input class="attachment-index" type="hidden" name="attachment_index[]" value="${index}" />
				<label class="btn btn-primary btn-xs" style="cursor: pointer;">
					<div class="attachment-label">Pilih file</div>
					<input class="attachment-input" type="file" name="attachment_${index}" onchange="setAttachmentName(this)" style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; position: absolute; z-index: -1;" />
				</label>
			</div>
		`);
	}

	function setAttachmentName(e) {
		var fileName = e.files[0].name;
		var check = check_file(e);
		
		if(check==''){
			$(e).parent().children('.attachment-label').text(fileName);
			$('input[name=attachment_fake]').val(fileName);
		} else {
			alert(check);
		}
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
					$('#modal_detail_mp').modal('hide');
					$('#modal_add_comment').modal('hide');
					show_this(task_id);
					$('#show_komentar').tab('show');
				} else {
					alert(response.status);
				}
			}
		});
		return false;
	});

</script>
