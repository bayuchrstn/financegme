<?php
	// pre($detail);
	// pre($detail_customer);
	$prefix = 'update';
	$task_category = 'mrk';
	$req_code = 'admin_sales';
	$default_value = array();
	$default_value['task_category'] = $task_category;
	$default_value['req_code'] = $req_code;
	$default_value['status'] = 'belum_dikirim';
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_marketing_request = $this->ui->forms('task_marketing_request', $default_value, $prefix);
	$forms_admin_sales = $this->ui->forms('admin_sales', $default_value, $prefix);
	$forms_customer_info = $this->ui->forms('customer_info', $default_value, $prefix);
?>

<?php
	echo $forms['task_category'];
	echo $forms['status'];
	echo $forms['req_code'];
	echo $forms['progress_id'];
?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['location']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['location_id']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['subject']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_task_marketing_request['date_request_start']; ?>
	</div>
</div>

<?php
	echo $forms['body'];
?>







<?php
	echo $forms_admin_sales['flag_send_request'];
	// echo $forms_admin_sales['flag_email'];
	echo $forms_admin_sales['category'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>

<input type="hidden" name="mode" value="general">

<div class="form-group">
	<label>Attachment</label>
	<div class="attachment"></div>
</div>

<script type="text/javascript">
	var detail_customer = <?php echo json_encode($detail_customer); ?>;
	console.log(detail_customer);
	// $('#customer_name_<?php echo $prefix; ?>').val(detail_customer.customer_name);
	// $('#customer_address_<?php echo $prefix; ?>').val(detail_customer.customer_address);
	// $('#telephone_home_<?php echo $prefix; ?>').val(detail_customer.telephone_home);
	// $('#telephone_mobile_<?php echo $prefix; ?>').val(detail_customer.telephone_mobile);
	// $('#telephone_work_<?php echo $prefix; ?>').val(detail_customer.telephone_work);
	// $('#contact_person_<?php echo $prefix; ?>').val(detail_customer.contact_person);
	// $('#fax_<?php echo $prefix; ?>').val(detail_customer.fax);
	// $('#email_<?php echo $prefix; ?>').val(detail_customer.email);
	// set_option('<?php echo base_url(); ?>select_option/customer/customer_type', 'customer_type_<?php echo $prefix; ?>', detail_customer.customer_type);

	var detail = <?php echo json_encode($detail); ?>;
	var task_ext = <?php echo json_encode($task_ext); ?>;

	set_option('<?php echo base_url(); ?>select_option/yesno', 'flag_send_request_<?php echo $prefix; ?>', 'Y');

	location_picker(detail.location, detail.location_id, 'location_<?php echo $prefix; ?>', 'location_id_<?php echo $prefix; ?>');
	$("#subject_<?php echo $prefix; ?>").val(detail.subject);
	$("#date_request_start_<?php echo $prefix; ?>").val(task_ext.date_request_start);
	$("#body_fake_<?php echo $prefix; ?>").val(detail.body);
	$("#id_<?php echo $prefix; ?>").val(detail.id);
	$("#progress_id_<?php echo $prefix; ?>").val(detail.progress_id);


	tinymce.remove();
	$(document).ajaxComplete(function(){
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

		$('#body_<?php echo $prefix; ?>').val(detail.body);

		// tinymce.get('body_<?php echo $prefix; ?>').setContent(detail.body);
	});

	if( $('#location_update').length ){
		$('#location_update').change(function(){
			var location = $(this).val();
			location_picker(location, 'x', 'location_<?php echo $prefix; ?>', 'location_id_<?php echo $prefix; ?>');
		});
	}

	$(function() {
	    if( $('.date_picker').length ) {
	        $( ".date_picker" ).datepicker({
	            changeMonth: true,
	            changeYear: true,
	            dateFormat: 'yy-mm-dd'
	        });
	    }
	});

</script>
