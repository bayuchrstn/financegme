<?php
	// $prefix = 'insert';
	$default_value = array();
	$default_value['qty'] = '1';
	$default_value['table'] = $table;
	$default_value['prefix'] = $prefix;
	$default_value['task_id'] = $task_id;
	$default_value['target_div'] = $target_div;
	$default_value['parent_modul'] = $parent_modul;
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
?>

<?php
	echo $task_item['table'];
	echo $task_item['prefix'];
	echo $task_item['task_id'];
	echo $task_item['target_div'];
	echo $task_item['parent_modul'];
?>

<input type="hidden" name="sender" value="1">
<script type="text/javascript">
</script>
