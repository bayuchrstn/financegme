
<?php
	// pre($modul);
	// pre($prefix);
	// pre($req_code);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['status'] = 'request';
	$default_value['req_code'] = $req_code;
	// pre($default_value);
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$wh_boq_forms = $this->ui->forms('wh_boq', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));

	//required
	echo $forms['task_category'];
	// echo $forms['status'];
	echo $forms['req_code'];
?>

<?php
	$this->request->referensi($prefix, 'boq');
	echo $forms['subject'];
	echo $forms['body'];
	echo $forms_task_hidden['location'];
	echo $forms_task_hidden['location_id'];
?>

<!---======================== baru ============================== -->
<div id="boq_item_from_ts"></div>
<?php if($prefix == 'update'): ?>
	<div id="current_div">currentboq</div>
<?php endif; ?>
<?php
	echo $wh_boq_forms['status'];
?>
<!---======================== baru ============================== -->


<!-- <a onclick="open_item_modal('<?php echo $prefix; ?>');" href="javascript:void(0);" class="btn btn-default btn-block"><i class="icon-plus3 position-left"></i> Tambah Item</a> -->
<!-- <div id="cartdiv_<?php echo $prefix; ?>"></div> -->

<input type="hidden" name="prefix" value="<?php echo $prefix; ?>">
<?php
	//echo $forms['attachment'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
