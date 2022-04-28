<?php
	// pre($modul);
	// pre($prefix);
	// pre($req_code);
    $prefix = 'open_ticket';
	$default_value = array();
	$default_value['task_category'] = 'ticket';
	// $default_value['status'] = 'request';
	// $default_value['req_code'] = $req_code;
	// pre($default_value);
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_ticket = $this->ui->forms('ticket', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));

	//required
	echo $forms['task_category'];
	// echo $forms['status'];
	// echo $forms['req_code'];
?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['location']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['location_id']; ?>
	</div>
</div>

<?php
	echo $forms_ticket['email'];
	echo $forms['subject'];
	echo $forms['body'];
?>

<div class="row">
	<div class="col-lg-4">
		<?php echo $forms_ticket['status']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms_ticket['ticket_type']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms_ticket['ticket_priority']; ?>
	</div>
</div>


<input type="hidden" name="prefix" value="<?php echo $prefix; ?>">
<?php
	echo $forms['id'];
	// echo ($prefix == 'update') ? $forms['id'] : '';
?>

<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;

    $('#subject_open_ticket').val(detail.subject);
    $('#email_<?php echo $prefix; ?>').val(detail.fromaddr);
    $('#id_<?php echo $prefix; ?>').val(detail.id);
    // alert('ok');
    set_option('<?php echo base_url(); ?>select_option/request/ticket/ticket_status', 'status_open_ticket', 'open');
    set_option('<?php echo base_url(); ?>select_option/request/ticket/ticket_type', 'ticket_type_open_ticket', 'default');
    set_option('<?php echo base_url(); ?>select_option/request/ticket/ticket_priority', 'ticket_priority_open_ticket', 'medium');
    location_picker('customer', '', 'location_open_ticket', 'location_id_open_ticket');

    // TinyMCE=========================================================
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

        tinymce.get('body_open_ticket').setContent(detail.body);
        $("#body_fake_<?php echo $prefix; ?>").val(detail.body);
    });
    // TinyMCE=========================================================

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

	if( $('#location_<?php echo $prefix; ?>').length ){
		$('#location_<?php echo $prefix; ?>').change(function(){
			var location = $(this).val();
			location_picker(location, '', 'location_<?php echo $prefix; ?>', 'location_id_<?php echo $prefix; ?>');
		});
	}


	// location picker-------------------------------------------------------------------
</script>
