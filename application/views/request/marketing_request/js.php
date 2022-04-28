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

	function show_this(x)
	{
		console.log(x);
		$("#modal_detail_mrk_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		$('#modal_detail_mrk').modal('show');
	}

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
				if(response.task_ext !== null){
					$("#form_<?php echo $modul['code']?>_update #date_request_start_update").val(response.task_ext.date_request_start);
				}
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
				location_picker(response.location, response.location_id, 'location_update', 'location_id_update');
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
		location_picker('customer', 'x', 'location_insert', 'location_id_insert');
		$('.cos').val('');
		tinyMCE.get('body_insert').setContent('');
        // set_option('<?php echo base_url(); ?>select_option/request/<?php echo $req_code; ?>/customer', 'location_id_insert', '');
		set_option('<?php echo base_url(); ?>select_option/kosong', 'category_id_insert', '');
		$('#modal_request_insert').modal('show');
        return false;
    }

	function location_picker(location, location_id, flocation, flocation_id)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>location_picker/index/'+location+'/'+location_id+'/marketing_request',
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
			location_picker(location, 'x', 'location_insert', 'location_id_insert');
		});
	}

	if( $('#location_update').length ){
		$('#location_update').change(function(){
			var location = $(this).val();
			location_picker(location, 'x', 'location_update', 'location_id_update');
		});
	}



</script>
