<?php
	// pre($modul);
	// pre($prefix);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['req_code'] = $req_code;
	$default_value['status'] = 'request';
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_approval = $this->ui->forms('task_approval', $default_value, $prefix);

	//required
	// echo $forms['task_category'];
	// echo $forms['req_code'];
	// echo $forms['status'];


?>
<!-- <div class="row">
	<div class="col-lg-6">
		<?php echo $forms['location']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['location_id']; ?>
	</div>
</div> -->
<?php
	// echo $forms['subject'];
	// echo $forms['body'];
?>
<?php //if($prefix == 'update'): ?>
<!-- <div id="current_recomended_div"></div>
<div id="current_pembanding_div"></div> -->
<?php //endif; ?>

<!-- <div class="btn-group btn-group-justified mb-20">
	<a onclick="open_pengadaan_modal('<?php //echo $prefix; ?>');" href="javascript:void(0);" class="btn btn-default btn-block"><i class="icon-plus3 position-left"></i> Tambah Item</a>
	<a onclick="open_pembanding_modal('<?php //echo $prefix; ?>');" href="javascript:void(0);" class="btn btn-default btn-block"><i class="icon-plus3 position-left"></i> Pembanding</a>
</div> -->


<!--
<div id="cartdiv_<?php //echo $prefix; ?>"></div>
<div id="pembandingdiv_<?php //echo $prefix; ?>"></div> -->
<div id="info_approved_<?php echo $prefix; ?>"></div>
<?php
	//required
	echo $forms_task_approval['approval_status'];
	echo $forms_task_approval['approval_note'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
