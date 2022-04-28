<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>

	function open_item_modal(prefix)
	{
		// alert('ok');
		$('#barang_div').removeClass('hidden');
		$('#custom_div').addClass('hidden');
		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/item_selector', 'item_selector_insert', 'barang');
		// set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/supplier', 'supplier_insert', '');
		$('#prefix_fcart').val(prefix);
		$('#modal_boq').modal('show');
		return false;
	}

	function show_this(x)
	{
		console.log(x);
		$("#detail_detail_ticket_div").load("<?php echo base_url(); ?>ticket/show/"+x+"/echo");
		getajax('<?php echo base_url(); ?>xhr/ticket/view_update/timeline/'+x, 'detail_timeline_ticket_div');
		$('#modal_ticket').modal('show');
	}

	function balas(id) {
		var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
		$.ajax({
			url : action,
			type: 'GET',
			success: function(res){
				var response = $.parseJSON(res);
				var append = '';
				// append += response.author_name+' menulis: '+response.body;
				getajax('<?php echo base_url(); ?>xhr/ticket/view_update/reply/'+response.id, 'modal_balas_ticket_div');
				// $('#modal_balas_ticket_div').prepend(append);
			}
		});
		$('#modal_balas_ticket').modal('show');
	}


	//main input
    function input()
    {
		set_option('<?php echo base_url(); ?>select_option/request/ticket_helpdesk/ticket_status', 'status_create', 'open');
		set_option('<?php echo base_url(); ?>select_option/request/ticket/ticket_type', 'ticket_type_create', 'default');
		set_option('<?php echo base_url(); ?>select_option/request/ticket/ticket_priority', 'ticket_priority_create', 'medium');

		$('.cos').val('');
		$('#attachment_ul_insert').html('');
		$('#body_fake_insert').val('');
		tinyMCE.get('body_insert').setContent('');

		location_picker('customer', '', 'location_create', 'location_id_create');

		// $('#modal_request_insert').modal('show');
		$('#modal_ticket_insert').modal('show');

        return false;
    }

	//main update
	function update(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
				$('.cos').val('');

				set_option('<?php echo base_url(); ?>select_option/request/ticket_helpdesk/ticket_status', 'status_view_ticket', response.status);
				set_option('<?php echo base_url(); ?>select_option/request/ticket/ticket_type', 'ticket_type_view_ticket', response.category);
				set_option('<?php echo base_url(); ?>select_option/request/ticket/ticket_priority', 'ticket_priority_view_ticket', response.task_ext.priority);

				//--------------------------------
				// alert(response.id);
				$('#subject_ticket_view_ticket').val(response.subject);
				$('#id_view_ticket').val(response.id);
				// $('#id_ticket_reply').val(response.id);
				$('#id_ticket_update').val(response.id);
				tinyMCE.get('body_ticket_view_ticket').setContent(response.body);
				$('#body_ticket_fake_view_ticket').val(response.body);

				$('#modal_ticket_update_form').attr('action', '<?php echo base_url(); ?>xhr/');
				show_attachment('<?php echo base_url(); ?>attachment/index/'+response.id, 'ticket_attachment_div');

				getajax('<?php echo base_url(); ?>xhr/ticket/view_update/timeline/'+response.id, 'timeline_ticket_div');
				getajax('<?php echo base_url(); ?>xhr/ticket/view_update/reply/'+response.id, 'reply_ticket_div');
				getajax('<?php echo base_url(); ?>ticket/show/'+response.id+'/echo', 'detail_ticket_div');
				//----------------------------------

				$('#attachment_ul_insert').html('');
				$('#body_fake_insert').val('');
				tinyMCE.get('body_insert').setContent('');

                $('#modal_ticket_update').modal('show');
            }
        });
        return false;
    }

	function up_selected(up)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>ajax/up_selected/'+up,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#up_select_subject').val(response.subject);
				$('#up_select_update').val(response.id);
			}
		});
		return false;
	}

	// edit ticket ext single
	$('#status_view_ticket').change(function(){
		var nt = $(this).val();
		var id_ticket = $('#id_view_ticket').val();
		$.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>xhr/ticket/update_part/status',
			data: {status:nt, id_ticket:id_ticket},
            success: function(res) {
                var response = jQuery.parseJSON(res);
				create_alert('ticket_view_msg', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
            }
        });
	});

	$('#ticket_type_view_ticket').change(function(){
		var nt = $(this).val();
		var id_ticket = $('#id_view_ticket').val();
		$.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>xhr/ticket/update_part/category',
			data: {category:nt, id_ticket:id_ticket},
            success: function(res) {
                var response = jQuery.parseJSON(res);
				create_alert('ticket_view_msg', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
            }
        });
	});

	$('#ticket_priority_view_ticket').change(function(){
		var nt = $(this).val();
		var id_ticket = $('#id_view_ticket').val();
		$.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>xhr/ticket/update_part/priority',
			data: {priority:nt, id_ticket:id_ticket},
            success: function(res) {
                var response = jQuery.parseJSON(res);
				create_alert('ticket_view_msg', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
            }
        });
	});
	// edit ticket ext single

	// location picker-------------------------------------------------------------------
	function location_picker(location, location_id, flocation, flocation_id)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>location_picker/general/'+location+'/'+location_id,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#'+flocation).html(response.location).val(location).chosen().trigger('chosen:updated');
				$('#'+flocation_id).html(response.location_id).val(location_id).chosen().trigger('chosen:updated');
			}
		});
	}

	if( $('#location_create').length ){
		$('#location_create').change(function(){
			var location = $(this).val();
			location_picker(location, '', 'location_create', 'location_id_create');
		});
	}

	if( $('#location_id_create').length ){
		$('#location_id_create').change(function(){
			var id = $(this).val();
			var action = '<?php echo base_url(); ?>customer/customer_by_id/'+id;
			$.ajax({
				url : action,
				type: 'GET',
				success: function(res){
					var response = $.parseJSON(res);
					$('#email_create').val(response.email);
				}
			});
		});
	}

	if( $('#location_update').length ){
		$('#location_update').change(function(){
			var location = $(this).val();
			location_picker(location, '', 'location_update', 'location_id_update');
		});
	}
	// location picker-------------------------------------------------------------------

	$(document).ready(function(){
		$('#up_select_insert').change(function(){
			var ref = $('#up_select_insert').val();
			$.ajax({
	            type:'GET',
	            url: '<?php echo base_url(); ?>xhr/boq/get_survey_ref/'+ref,
	            success: function(res) {
	                var response = jQuery.parseJSON(res);
					// console.log(response);
					// console.log(response.location_id);
					// alert(response.location_id);
					$('#location_insert').val(response.location);
					$('#location_id_insert').val(response.location_id);
					// $('#boq_item_from_ts').html(response.item_from_ts);
					getajax('<?php echo base_url(); ?>ajax_request/show_boq/'+response.id, 'boq_item_from_ts');
	            }
	        });
	        return false;
		});

		$('#item_selector_insert').change(function(){
			var mode = $(this).val();
			if(mode=='barang'){
				$('#barang_div').removeClass('hidden');
				$('#custom_div').addClass('hidden');
			} else {
				$('#barang_div').addClass('hidden');
				$('#custom_div').removeClass('hidden');
			}
			return false;
		});
	});


</script>
