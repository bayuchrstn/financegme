<?php
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$forms = $this->ui->forms('task_hidden', $default_value, $prefix);
	$form_task_marketing_approval = $this->ui->forms('task_marketing_approval', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));
	// pre($this->ui->forms_debug($form_task_marketing_approval));

	echo $forms['task_category'];

	echo $forms['subject'];
	echo $forms['body_fake'];
	echo $forms['id'];


	echo $form_task_marketing_approval['status'];
	echo $form_task_marketing_approval['note'];
?>
