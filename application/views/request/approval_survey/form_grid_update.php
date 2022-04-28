
<?php
	// pre($modul);
	// pre($prefix);
	// pre($req_code);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['req_code'] = $req_code;
	// pre($default_value);


	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_ticket = $this->ui->forms('ticket', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));

	//required
	echo $forms['task_category'];
	// echo $forms['status'];
	echo $forms['req_code'];
?>

<div id="ticket_view_msg">

</div>

<div class="row">
	<div class="col-lg-8">

		<!-- Main Ticket -->
		<form id="forms_ticket_main_update" action="<?php echo base_url(); ?>xhr/ticket/update_part/main" method="post">
			<?php
				echo $forms_ticket['subject_ticket'];
				echo $forms_ticket['body_ticket'];
			?>

			<input type="hidden" name="id" id="id_ticket_update" value="">
			<div class="text-right">
				<input type="submit" class="btn btn-info" name="update_ticket_button" value="Update Ticket">
			</div>
		</form>
		<!-- Main Ticket -->

		<!-- ticket balasan  -->
		<div id="reply_ticket_div"></div>
		<!-- ticket balasan  -->
	</div>

	<div class="col-lg-4">
		<?php
			echo $forms_ticket['status'];
			echo $forms_ticket['ticket_type'];
			echo $forms_ticket['ticket_priority'];
		?>
		<!-- Ticket Attachment -->
		<div id="ticket_attachment_div"></div>
	</div>
</div>

<input type="hidden" name="prefix" value="<?php echo $prefix; ?>">
<?php
	echo $forms['id'];
?>
