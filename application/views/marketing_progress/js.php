<script type="text/javascript">
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

    function update_marketing_progress(id)
    {
        var action = '<?php echo base_url(); ?>marketing_progress/update/'+id;
        block_this('js_table_marketing_progress');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

				// form customize
                $("#form_marketing_progress_update").attr('action', response.action);
                $("#form_marketing_progress_update #subject_update").val(response.subject);
                $("#form_marketing_progress_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_marketing_progress_update #id_update").val(response.id);
				// form customize

                $('#modal_marketing_progress_update').modal('show');
                unblock_this('js_table_marketing_progress');
            }
        });
        return false;
    }

    function delete_marketing_progress(id)
    {
        var action = '<?php echo base_url(); ?>marketing_progress/delete/'+id;
        block_this('panel_marketing_progress');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);


                $("#form_marketing_progress_delete").attr('action', response.action);
                $("#form_marketing_progress_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_marketing_progress_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('panel_marketing_progress');
            }
        });
        return false;
    }

    function insert_marketing_progress()
    {
		tinyMCE.get('body_insert').setContent('');
        set_option('<?php echo base_url(); ?>select_option/my_pre_customer', 'location_id_insert', '');
        set_option('<?php echo base_url(); ?>select_option/kosong', 'category_id_insert', '');
        $('#modal_marketing_progress_insert').modal('show');
        return false;
    }

	$('#location_id_insert').change(function(){
		var customer_id = $(this).val();
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_category/'+customer_id, 'category_id_insert', '');
	});

	function reset_form_insert()
	{
		$('.cos').val('');
		$('#location_id_insert').val('0').chosen().trigger('chosen:updated');
		$('#category_insert').html('').chosen().trigger('chosen:updated');
		tinyMCE.get('body_insert').setContent('');
		$('#info-attachment').html('');
	}



    $(document).ready(function() {
		$('#location_id_insert').change(function(){
			var location_id = $(this).val();
			$.ajax({
	            type:'GET',
	            url: '<?php echo base_url(); ?>marketing_progress/get_category/'+location_id,
	            success: function(res) {
	                // var response = jQuery.parseJSON(res);
					$('#category_insert').html(res).chosen().trigger('chosen:updated');
	            }
	        });
	        return false;
		});
    });


</script>
