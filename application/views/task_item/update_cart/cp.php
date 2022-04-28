<?php
	// pre($detail);
	// $prefix = 'insert';
	$default_value = array();
	// $default_value['qty'] = '1';
	$default_value['table'] = $table;
	$default_value['prefix'] = $prefix;
	$default_value['task_id'] = $task_id;
	$default_value['target_div'] = $target_div;
	$default_value['parent_modul'] = $parent_modul;
	$default_value['id'] = $id;
	$cp_forms = $this->ui->forms('cp', $default_value, $prefix);
	$task_item = $this->ui->forms('task_item', $default_value, $prefix);
?>

<div id="form_msg_div"></div>


<?php
	echo $cp_forms['name'];
	echo $cp_forms['telephone_home'];
	echo $cp_forms['telephone_mobile'];
	echo $cp_forms['telephone_office'];
	echo $cp_forms['fax'];
	echo $cp_forms['email'];
	echo $cp_forms['customer_id'];

	echo $task_item['table'];
	echo $task_item['prefix'];
	echo $task_item['task_id'];
	echo $task_item['target_div'];
	echo $task_item['parent_modul'];
	echo $task_item['id'];
?>


<script type="text/javascript">

	var detail = <?php echo json_encode($detail); ?>;
	console.log(detail);
	$('#name_<?php echo $prefix; ?>').val(detail.name);
	$('#telephone_home_<?php echo $prefix; ?>').val(detail.options.telephone_home);
	$('#telephone_mobile_<?php echo $prefix; ?>').val(detail.options.telephone_mobile);
	$('#telephone_office_<?php echo $prefix; ?>').val(detail.options.telephone_office);
	$('#fax_<?php echo $prefix; ?>').val(detail.options.fax);
	$('#email_<?php echo $prefix; ?>').val(detail.options.email);


</script>
