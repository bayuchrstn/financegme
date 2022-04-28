<?php
    // pre($detail);
    $prefix = 'update';
	$default_value = array();

	$forms = $this->ui->forms('cancel_install', $default_value, $prefix);
    echo $forms['nama_barang'];
    echo $forms['nomor_barang'];
    echo $forms['mac_address'];
    echo $forms['note'];
    echo $forms['id'];
?>
<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;
    $('#nama_barang_<?php echo $prefix; ?>').val(detail.nama_barang);
    $('#nomor_barang_<?php echo $prefix; ?>').val(detail.nomor_barang);
    $('#mac_address_<?php echo $prefix; ?>').val(detail.mac_address);
    $('#note_<?php echo $prefix; ?>').val(detail.note);
    $('#id_<?php echo $prefix; ?>').val(detail.id);
    // set_option('<?php echo base_url(); ?>select_option/yesno', 'required_<?php echo $prefix; ?>', detail.required);
    // set_option('<?php echo base_url(); ?>select_option/user/approval', 'user_id_<?php echo $prefix; ?>', detail.user_id);

</script>
