<?php

    $prefix = 'update';
	$default_value = array();

	$forms = $this->ui->forms('approval', $default_value, $prefix);

    echo $forms['user_id'];
    echo $forms['options'];
    echo $forms['final_option'];
    echo $forms['sort'];
    echo $forms['required'];
    echo $forms['id'];
?>
<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;
    $('#options_<?php echo $prefix; ?>').val(detail.options);
    $('#final_option_<?php echo $prefix; ?>').val(detail.final_option);
    $('#sort_<?php echo $prefix; ?>').val(detail.sort);
    $('#id_<?php echo $prefix; ?>').val(detail.id);
    set_option('<?php echo base_url(); ?>select_option/yesno', 'required_<?php echo $prefix; ?>', detail.required);
    set_option('<?php echo base_url(); ?>select_option/user/approval', 'user_id_<?php echo $prefix; ?>', detail.user_id);

</script>
