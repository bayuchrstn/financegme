<?php
	// pre($detail);
	// pre($detail);
	$prefix = 'update';
	$forms = $this->ui->forms('people_ext', $detail, $prefix);
	// pre($this->ui->forms_debug($forms));

	echo $forms['dokumen_name'];
	echo $forms['person_id'];
	echo $forms['type'];
?>
