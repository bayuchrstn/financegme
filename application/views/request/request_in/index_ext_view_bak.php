<?php
$data = array();
$data['prefix'] = 'update';

$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_request_updatessssss';
$options['modal_size'] = 'modal-xs';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'xixixi';
// $options['modal_footer'] = 'no';
$options['form_id'] = 'form_'.$modul['code'].'_updatesdsds';
$options['form_action'] = '';
$options['main_content'] = 'hasek';
echo $this->ui->load_component($options);
?>


<form class="cart_form" id="cart_form_item_in" action="<?php echo base_url(); ?>cart/insert" method="post">
	<input type="hidden" class="cart_cos" name="cart_id" id="cart_id" value="">
	<input type="hidden" name="cart_qty" id="cart_qty" value="1">
	<input type="hidden" name="cart_price" id="cart_price" value="1">
	<input type="hidden" class="cart_cos" name="cart_name" id="cart_name" value="">
	<input type="hidden" name="options[nomor_barang]" id="cart_options_nomor_barang" value="">
	<input type="hidden" name="options[mac_address]" id="cart_options_mac_address" value="">
	<input type="hidden" name="options[kondisi]" id="cart_options_mac_address" value="baik">
	<input type="hidden" name="options[transaction_id]" id="cart_options_transaction_id" value="">
</form>

<?php
    $data = array();
    echo $this->load->view('task_item/modal', $data, TRUE);
?>

<input type="hidden" name="add_task_item_locker" id="add_task_item_locker" value="Referensi pekerjaan belum dipilih">
