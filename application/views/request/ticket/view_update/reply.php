<form id="forms_ticket_reply" action="<?php echo base_url(); ?>xhr/ticket/reply" method="post">
	<?php
		$prefix = 'reply';
		$default_value = array();
		$forms_ticket = $this->ui->forms('ticket', $default_value, $prefix);
		echo $forms_ticket['reply_ticket'];
		//echo $forms['attachment'];
	?>
	<input type="hidden" name="id" id="id_ticket_reply" value="<?php echo $ticket_id; ?>">
	<input type="hidden" name="status" id="status_ticket_reply" value="<?php echo $detail_ticket['status'];?>">
	<input type="hidden" name="sender" value="<?php echo my_id();?>">

	<div class="text-right">
		<input type="submit" class="btn btn-info" name="update_ticket_button" value="Reply Ticket">
	</div>
</form>
<script type="text/javascript">
	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>
</script>
