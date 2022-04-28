<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	<?php //echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>
	// init dual tinymce dalam 1 form
	tinymce.init({
		selector: '.wysiwyg',
		statusbar:  false,
		menubar:    false,
		rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ],
		setup: function(editor) {
			editor.on('change', function(e) {
				var editorid;
				var isi = this.getContent();
				if (editor.id.substring(0,6)=='respon') editorid= editor.id.substring(0,6)+'_fake'+editor.id.substring(6);
				else if(editor.id.substring(0,4)=='note') editorid= editor.id.substring(0,4)+'_fake'+editor.id.substring(4);
				else editorid = editor.id;
				// console.log(editorid);
				$('#'+editorid).val(isi);
			});
		}
	});


	function show_this(id)
	{
		$("#modal_show_this_div").load("<?php echo base_url(); ?>customer_visit/show/" + id + "/echo", function() {
			// Todo:
			// - add loading code on modal

			getTaskDetail(id, (d) => {
				// Product
				var product = d.data_location.data_product ? d.data_location.data_product[0] : {};

				$('#customer_name_show').append(d.data_location.customer_name);
				$('#product_name_show').append(product.name);
				$('#id_show').append(d.data_location.customer_id + ' - ' + d.data_location.service_id);
				$('#customer_address_show').append(d.data_location.customer_address);
				$('#email_show').append(d.data_location.email);
				$('#contact_person_show').append(d.data_location.contact_person);
				$('#telephone_home_show').append(d.data_location.telephone_home);
				$('#telephone_mobile_show').append(d.data_location.telephone_mobile);
				$('#telephone_work_show').append(d.data_location.telephone_work);
			});
		});
		$('#modal_show_this').modal('show');
	}

	function getTaskDetail(id, cb) {
		var url = '<?php echo base_url(); ?>xhr/task_report/get_task_detail/' + id; // json

		$.ajax({ type: 'GET', url, success: function(res) {
			cb(res);
		}});
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
				// console.log(response);
				$('#layanan_'+prefix).val(response.product_name);
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
    	var prefix = 'insert';

		$('#layanan_'+prefix).val('');
		$('#address_'+prefix).val('');
		$('#email_'+prefix).val('');
		$('#contact_person_'+prefix).val('');
		$('#telephone_home_'+prefix).val('');
		$('#telephone_mobile_'+prefix).val('');
		$('#telephone_work_'+prefix).val('');
		$('#cis_sid_'+prefix).val('');
		$('#respon_'+prefix).val('');
		$('#respon_fake_'+prefix).val('');
		$('#note_'+prefix).val('');
		$('#note_fake_'+prefix).val('');

		$('#form_<?php echo $modul['code']; ?>_insert').attr('action', '<?php echo base_url() ?>xhr/customer_care/insert');
		set_option('<?php echo base_url(); ?>select_option/request/customer_call/customer', 'customer_id_insert', '');
		set_option('<?php echo base_url(); ?>select_option/request/customer_call/category', 'category_insert', '');
		set_option('<?php echo base_url(); ?>select_option/request/customer_call/feedback', 'scale_insert', '');
		set_option('<?php echo base_url(); ?>select_option/request/customer_call/status', 'status_insert', 'open');
		// getajax('<?php echo base_url(); ?>ajax/cart_boq', 'cart_boq_div_insert');
		$('.cos').val('');
		// $('#attachment_ul_insert').html('');
		// $('#body_fake_insert').val('');
		// tinyMCE.get('body_insert').setContent('');
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

                $('#modal_request_update').modal('show');
            }
        });
        return false;
    }





</script>
