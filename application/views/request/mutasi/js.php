<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>


	function show_this(x)
	{
		console.log(x);
		$("#modal_show_this_div").load("<?php echo base_url(); ?>boq/show/"+x+"/echo");
		$('#modal_show_this').modal('show');
	}

	$('#customer_id_insert').change(function(){
		sync_customer_info($(this).val(), 'insert');
	});

	function sync_customer_info(c, prefix)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>xhr/customer_care/customer_info/'+c,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				console.log(response);
				// $('#layanan').val(response.gpro);
				$('#address_'+prefix).val(response.customer_address);
				$('#email_'+prefix).val(response.email);
				$('#contact_person_'+prefix).val(response.contact_person);
				$('#telephone_home_'+prefix).val(response.telephone_home);
				$('#telephone_mobile_'+prefix).val(response.telephone_mobile);
				$('#telephone_work_'+prefix).val(response.telephone_work);
				$('#cis_sid_'+prefix).val(response.customer_id+' - '+response.service_id);
				// $('#email').val(response.email);
			}
		});
		return false;
	}


	//main input
    function input()
    {
		$('#form_<?php echo $modul['code']; ?>_insert').attr('action', '<?php echo base_url() ?>request/insert');
		set_option('<?php echo base_url(); ?>select_option/request/mutasi/customer', 'location_id_insert', '');
		set_option('<?php echo base_url(); ?>select_option/request/mutasi/type_mutasi', 'category_insert', '');
		// set_option('<?php echo base_url(); ?>select_option/request/customer_call/feedback', 'scale_insert', '');
		// set_option('<?php echo base_url(); ?>select_option/request/customer_call/status', 'status_insert', 'open');
		$('.cos').val('');

		// $('#respon_fake_insert').val('');
		// $('#note_fake_insert').val('');
		// tinyMCE.get('respon_insert').setContent('');
		// tinyMCE.get('note_insert').setContent('');

		$('#modal_request_insert').modal('show');
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

				sync_customer_info(response.location_id, 'update');
				set_option('<?php echo base_url(); ?>select_option/request/customer_call/customer', 'customer_id_update', response.location_id);
				set_option('<?php echo base_url(); ?>select_option/request/customer_call/category', 'category_update', response.category);
				set_option('<?php echo base_url(); ?>select_option/request/customer_call/feedback', 'scale_update', response.task_ext.scale);
				set_option('<?php echo base_url(); ?>select_option/request/customer_call/status', 'status_update', response.status);

				$("#form_<?php echo $modul['code']?>_update").attr('action', response.params_ext.form_action);
				tinyMCE.get('respon_update').setContent(response.task_ext.respon);
				tinyMCE.get('note_update').setContent(response.task_ext.note);
				$("#form_<?php echo $modul['code']?>_update #note_fake_update").val(response.task_ext.note);
				$("#form_<?php echo $modul['code']?>_update #respon_fake_update").val(response.task_ext.respon);

				$("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);


				// $('#location_update').val(response.location);
                // $('#location_id_update').val(response.location_id);

                $('#modal_request_update').modal('show');
            }
        });
        return false;
    }





</script>
