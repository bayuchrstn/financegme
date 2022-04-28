<?php
	$default_value = array();
	$forms = $this->ui->forms('task_search', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));
	echo $forms['location_id'];
	echo $forms['author'];

?>
<input type="hidden" name="filtered_page" value="<?php echo base_url(); ?>marketing_progress/index/">
