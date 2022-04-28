<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	tinymce.init({
		selector: '.wysiwyg',
		statusbar:  false,
		menubar:    false,
		rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ],
		setup: function(editor) {
			editor.on('change', function(e) {
				var isi = this.getContent();
				$('.fake_tinymce').val(isi);
			});
		}
	});

	function row_table_detail(key='', value='') {
		var ret = '<tr>';
		ret += '<td valign="top" width="200">'+key+'</td>';
		ret += '<td valign="top" width="10">:</td>';
		ret += '<td valign="top">'+value+'</td>';
		ret += '</tr>';
		return ret;
	}

	function open_search_modal()
	{
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/pre_customer', 'location_id_search', '');
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/author', 'author_search', '');
		$('#modal_marketing_progress_search').modal('show');
	}

	function insert(task_id) {
		var action = '<?php echo base_url(); ?>trial_report/show/'+task_id+'/json';
		block_this('js_table_request');
		$.ajax({
			type: 'GET',
			url : action,
			success: function(res){
				var response = $.parseJSON(res);

				$('#trial_report_insert').attr('action','<?=base_url();?>ajax_request/trial_questions/serialize/insert');

				var telephone_home = response.detail.customer.data.telephone_home != '' ? response.detail.customer.data.telephone_home : '-';
				var telephone_mobile = response.detail.customer.data.telephone_mobile != '' ? response.detail.customer.data.telephone_mobile : '-';
				var telephone_work = response.detail.customer.data.telephone_work != '' ? response.detail.customer.data.telephone_work : '-';
				var append = '';
				append += '<table class="table_data_info"><tbody>';
				append += row_table_detail('Nama',response.detail.customer.data.customer_name);
				append += row_table_detail('Alamat',response.detail.customer.data.customer_address);
				append += row_table_detail('Contact',response.detail.customer.data.contact_person);
				append += row_table_detail('Telepon',telephone_home+'/'+telephone_mobile+'/'+telephone_work);
				append += row_table_detail('Mulai Trial',response.detail.task_marketing_request.data.date_request_start);
				append += row_table_detail('Selesai Trial',response.detail.task_marketing_request.data.date_request_end);
				append += '</tbody></table>';
				$('#show_trial_report_div').empty().append(append);

				$.ajax({
					type: 'GET',
					url : '<?=base_url()?>ajax_request/trial_questions',
					success: function(r){
						var result = $.parseJSON(r);
						var append = '<br>';
						append += '<table class="table table-bordered">';
						append += '<thead class="bg-slate">';
						append += '<tr><th>Pertanyaan</th><th>Ya/Tidak</th><th>Uraian</th></tr>';
						append += '</thead>';
						append += '<tbody>';
						for (var i = 0; i<result.length; i++) {
							append += '<tr>';
							append += '<td width="250">'+result[i].note+'</td>';
							append += '<td width="50" class="text-center"><input type="hidden" name="trial_question[]" value="1"><input type="checkbox" name="jawaban_'+i+'"></td>';
							append += '<td><textarea name="trial_answer[]" class="form-control"></textarea></td>';
							append += '</tr>';
						}
						append += '<tr>';
						append += '<td colspan="3"><b>Note : </b><textarea name="note" class="form-control"></textarea></td>';
						append += '</tr>';


						append += '</tbody>';
						append += '</table>';
						append += '<input type="hidden" name="task_id" value="'+response.detail.id+'">';
						$('#show_trial_report_div').append(append);
					}
				});

				// console.log(response);
				$('#modal_insert_trial_report').modal('show');
			}
		});
		unblock_this('js_table_request');	
	}

	function show(task_id) {
		var action = '<?php echo base_url(); ?>trial_report/show/'+task_id+'/json';
		// block_this('js_table_request');
		$.ajax({
			type: 'GET',
			url : action,
			success: function(res){
				var response = $.parseJSON(res);

				var telephone_home = response.detail.customer.data.telephone_home != '' ? response.detail.customer.data.telephone_home : '-';
				var telephone_mobile = response.detail.customer.data.telephone_mobile != '' ? response.detail.customer.data.telephone_mobile : '-';
				var telephone_work = response.detail.customer.data.telephone_work != '' ? response.detail.customer.data.telephone_work : '-';
				var append = '';
				append += '<table class="table_data_info"><tbody>';
				append += row_table_detail('Nama',response.detail.customer.data.customer_name);
				append += row_table_detail('Alamat',response.detail.customer.data.customer_address);
				append += row_table_detail('Contact',response.detail.customer.data.contact_person);
				append += row_table_detail('Telepon',telephone_home+'/'+telephone_mobile+'/'+telephone_work);
				append += row_table_detail('Mulai Trial',response.detail.task_marketing_request.data.date_request_start);
				append += row_table_detail('Selesai Trial',response.detail.task_marketing_request.data.date_request_end);
				append += row_table_detail('Dibuat Oleh',response.detail.trial.data.report_name+' pada '+response.detail.trial.data.report_date);
				append += '</tbody></table>';

				$('#detail_trial_report_div').empty().append(append);

				$.ajax({
					type: 'POST',
					url : '<?=base_url()?>/ajax_request/trial_questions/unserialize',
					data : {checklist : response.detail.trial.data.checklist},
					success: function(r){
						var result = $.parseJSON(r);
						var append = '<br>';
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
						$('#detail_trial_report_div').append(append);
					}
				});

				// console.log(response);
				$('#modal_view_trial_report').modal('show');
			}
		});
		// unblock_this('js_table_request');	
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
                $("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);

				location_picker(response.location, response.location_id, 'location_update', 'location_id_update');
				$("#form_<?php echo $modul['code']?>_update #date_start_update").val(response.date_start);
				$("#form_<?php echo $modul['code']?>_update #date_due_update").val(response.date_due);

				//ext
				set_option('<?php echo base_url(); ?>select_option/request/laporan_harian/shift', 'shift_update', response.task_ext.shift);
				set_option('<?php echo base_url(); ?>select_option/request/laporan_harian/jenis_laporan_harian', 'jenis_laporan_update', response.task_ext.jenis_laporan);
				$("#form_<?php echo $modul['code']?>_update #pelapor_update").val(response.task_ext.pelapor);
				$("#form_<?php echo $modul['code']?>_update #jenis_laporan_update").val(response.task_ext.jenis_laporan);
				$("#form_<?php echo $modul['code']?>_update #laporan_update").val(response.task_ext.laporan);
				$("#form_<?php echo $modul['code']?>_update #analisa_update").val(response.task_ext.analisa);
				$("#form_<?php echo $modul['code']?>_update #tindakan_update").val(response.task_ext.tindakan);
				set_option('<?php echo base_url(); ?>select_option/yesno', 'solve_update', response.task_ext.solve);
				set_option('<?php echo base_url(); ?>select_option/yesno', 'sla_update', response.task_ext.sla);
				// form customize

                $('#modal_request_update').modal('show');
                unblock_this('js_table_marketing_progress');
            }
        });
        return false;
    }

    function input()
    {
        return false;
    }

	function location_picker(location, location_id, flocation, flocation_id)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>location_picker/index/'+location+'/'+location_id,
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



</script>
