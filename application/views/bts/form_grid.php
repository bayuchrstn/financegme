<?php
    // $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('bts', $def, $prefix);
    // pre($this->ui->forms_debug($forms));

	echo $forms['bts_name'];
	echo $forms['bts_address'];
	echo $forms['bts_note'];

	if($prefix=='update'):
		echo $forms['id'];
	endif;
?>
