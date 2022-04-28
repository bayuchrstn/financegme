<?php
	// pre($detail);
	// pre($detail);
	$prefix = 'update';
	$forms = $this->ui->forms('people_ext', $detail, $prefix);
	// pre($this->ui->forms_debug($forms));

    echo $forms['nama'];
	echo $forms['kota'];
	echo $forms['jabatan'];
	echo $forms['jobdesc'];
	echo $forms['gaji'];
	echo $forms['mulai'];
	echo $forms['selesai'];
	echo $forms['id'];
	echo $forms['person_id'];
	echo $forms['type'];
?>
