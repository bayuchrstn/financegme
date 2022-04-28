<?php
	// pre($detail);
	// pre($task_ext);
	// pre($customer_data);

	$default_value = array();
	$default_value['task_category'] = 'mrk';
	$default_value['subject'] = 'mrk';
	$default_value['body_fake'] = 'mrk';
	$prefix = 'update';

	// $forms = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_admin_sales = $this->ui->forms('admin_sales', $default_value, $prefix);

	echo $forms['task_category'];
	// echo $forms['subject'];
	// echo $forms['body_fake'];
	echo $forms['id'];
?>

<?php
	echo $forms_admin_sales['customer_group'];
	echo $forms_admin_sales['customer_id'];
	echo $forms_admin_sales['service_id'];
?>

<div class="form-group">
	<label>Harga</label>
	<input type="text" name="price_update" id="price_update" maxlength="100" class="form-control"  disabled="">
</div>

<?php
	echo $forms_admin_sales['customer_name'];
	echo $forms_admin_sales['flag_send_request'];
?>

<?php if($prefix=='update'): ?>
<div id="request_div">
	<?php
	echo $forms_admin_sales['id_am'];
	echo $forms['subject'];
	echo $forms['body'];
	echo $forms_admin_sales['date_request_start'];
	?>
</div>
<?php endif; ?>
<input type="hidden" name="mode" value="new">

<div class="form-group">
	<label>Attachment</label>
	<div id="attachment_update" maxlength="100" class="form-control" type="text"></div>
	<div id="attachment_timeline"></div>
</div>

<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;

	$("#subject_update").val(detail.subject);
	$("#body_fake_update").val(detail.body);
	$("#id_update").val(detail.id);
	// tinyMCE.get('body_update').setContent(detail.body);

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

		$("#body_update").val(detail.body);

		// tinymce.get('body_update').setContent(detail.body);
	});

	// tinyMCE.get('note_update').remove();
	// $("#note_update").tinyMCE().remove();

	var customer_data = <?php echo json_encode($customer_data); ?>;
	var task_ext = <?php echo json_encode($task_ext); ?>;
	$("#customer_id_update").val(customer_data.customer_id);
	$('#service_id_update').val(customer_data.service_id);
	$('#customer_name_update').val(customer_data.customer_name);
	$('#id_am_update').val(customer_data.am_name);
	$('#date_request_start_update').val(task_ext.date_request_start);
	$('#price_update').val(customer_data.layanan[0].product_price);
	// alert('wwkwk');

	//chosen usergroup
	set_option('<?php echo base_url(); ?>select_option/request/admin_sales/customer_group', 'customer_group_update', 'pelanggan_baru');
	//chosen flaq kirim
	set_option('<?php echo base_url(); ?>select_option/yesno', 'flag_send_request_update', 'Y');

	$(document).ready(function(){
		$('#customer_group_update').change(function(){
			var group_status = $(this).val();
			$.ajax({
				type:'GET',
				url: '<?php echo base_url(); ?>ajax_request/admin_sales_grouping/'+group_status,
				success: function(res) {
					// var response = jQuery.parseJSON(res);
					// console.log(response);
					$('#customer_id_update').val(res);
				}
			});
			return false;
		});

		$('#flag_send_request_update').change(function(){
			var r = $(this).val();
			if(r=='N'){
				$('#request_div').addClass('hidden');
			} else {
				$('#request_div').removeClass('hidden');
			}
			return false;
		});

		$(function() {
		    if( $('.date_picker').length ) {
		        $( ".date_picker" ).datepicker({
		            changeMonth: true,
		            changeYear: true,
		            dateFormat: 'yy-mm-dd'
		        });
		    }
		});
	});
</script>
