<?php
	// pre($detail);
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
?>

<?php
	echo $forms['task_category'];
	echo $forms['status'];
	echo $forms['req_code'];
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
	echo $forms_admin_sales['flag_send_request'];
	echo ($prefix == 'update') ? $forms['id'] : '';
	echo $forms_admin_sales['flag_email'];
	echo $forms_admin_sales['category'];

?>
<input type="hidden" name="mode" value="general">

<div class="form-group">
	<label>Attachment</label>
	<div class="attachment"></div>
</div>

<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	var task_ext = <?php echo json_encode($task_ext); ?>;

	set_option('<?php echo base_url(); ?>select_option/yesno', 'flag_send_request_update', 'Y');

	location_picker(detail.location, detail.location_id, 'location_update', 'location_id_update');
	$("#subject_update").val(detail.subject);
	$("#date_request_start_update").val(task_ext.date_request_start);
	$("#body_fake_update").val(detail.body);
	$("#id_update").val(detail.id);

	$('#flag_email_update').prop('checked', true);
	$('#category_update').val(detail.category);


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

		$('#body_update').val(detail.body);

		// tinymce.get('body_update').setContent(detail.body);
	});

	if( $('#location_update').length ){
		$('#location_update').change(function(){
			var location = $(this).val();
			location_picker(location, 'x', 'location_update', 'location_id_update');
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
