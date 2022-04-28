<?php

    $prefix = 'insert';
	$default_value = array();

	$forms = $this->ui->forms('approval', $default_value, $prefix);

    echo $forms['user_id'];
    echo $forms['options'];
    echo $forms['final_option'];
    echo $forms['sort'];
    echo $forms['required'];
?>
<script type="text/javascript">

    set_option('<?php echo base_url(); ?>select_option/yesno', 'required_<?php echo $prefix; ?>', 'Y');
    set_option('<?php echo base_url(); ?>select_option/user/approval', 'user_id_<?php echo $prefix; ?>', '');

</script>
