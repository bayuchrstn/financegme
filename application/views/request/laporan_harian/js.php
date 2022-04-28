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

	function open_search_modal()
	{
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/pre_customer', 'location_id_search', '');
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/author', 'author_search', '');
		$('#modal_marketing_progress_search').modal('show');
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
		<?php
			$modul_code = $modul['code'];
		?>
		var current_shift = '<?php echo $this->$modul_code->current_shift(); ?>';
		set_option('<?php echo base_url(); ?>select_option/request/laporan_harian/shift', 'shift_insert', current_shift);
		set_option('<?php echo base_url(); ?>select_option/request/laporan_harian/jenis_laporan_harian', 'jenis_laporan_insert', '');
		set_option('<?php echo base_url(); ?>select_option/yesno', 'solve_insert', '');
		set_option('<?php echo base_url(); ?>select_option/yesno', 'sla_insert', '');
		location_picker('customer', '', 'location_insert', 'location_id_insert');
		$('#modal_request_insert').modal('show');
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
