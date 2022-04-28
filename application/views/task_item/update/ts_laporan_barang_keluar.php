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
	$cancel_forms = $this->ui->forms('cancel_install', $default_value, $prefix);
	$task_item_forms = $this->ui->forms('task_item', $default_value, $prefix);
?>

<div id="form_msg_div"></div>

<?php

    echo $cancel_forms['nama_barang'];
    echo $cancel_forms['nomor_barang'];
    echo $cancel_forms['mac_address'];
    echo $cancel_forms['note'];

    echo $task_item_forms['table'];
    echo $task_item_forms['prefix'];
    echo $task_item_forms['task_id'];
    echo $task_item_forms['target_div'];
    echo $task_item_forms['parent_modul'];
    echo $task_item_forms['id'];
?>

<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;
    $('#nama_barang_<?php echo $prefix; ?>').val(detail.nama_barang);
    $('#nomor_barang_<?php echo $prefix; ?>').val(detail.nomor_barang);
    $('#mac_address_<?php echo $prefix; ?>').val(detail.mac_address);
</script>
