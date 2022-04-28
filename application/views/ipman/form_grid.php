<?php
    // $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('ipman', $def, $prefix);
    // pre($this->ui->forms_debug($forms));

	echo $forms['ip'];
	echo $forms['netmask'];
	// echo $forms['bts_note'];

	if($prefix=='update'):
		echo $forms['id'];
	endif;
?>
