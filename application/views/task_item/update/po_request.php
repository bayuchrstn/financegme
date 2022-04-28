<?php
	// $prefix = 'insert';
	$default_value = array();
	// $default_value['qty'] = '1';
	$default_value['table'] = $table;
	$default_value['prefix'] = $prefix;
	$default_value['task_id'] = $task_id;
	$default_value['target_div'] = $target_div;
	$default_value['parent_modul'] = $parent_modul;
	$default_value['id'] = $id;
	$pengadaan_forms = $this->ui->forms('task_item', $default_value, $prefix);
?>

<div id="form_msg_div"></div>


<?php
	echo $pengadaan_forms['qty'];
	echo $pengadaan_forms['table'];
	echo $pengadaan_forms['prefix'];
	echo $pengadaan_forms['task_id'];
	echo $pengadaan_forms['target_div'];
	echo $pengadaan_forms['parent_modul'];
	echo $pengadaan_forms['id'];
?>


<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	console.log(detail);
	<?php echo $this->load->view('misc/duit_numeric', '', TRUE); ?>
	$('#qty_<?php echo $prefix; ?>').val(detail.qty);
</script>
