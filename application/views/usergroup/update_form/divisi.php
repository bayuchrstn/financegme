<?php
    $prefix = 'update';
    $def = array();
    $forms = $this->ui->forms('usergroup', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
    echo $forms['name'];
    echo $forms['id'];
?>

<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	$('#name_<?php echo $prefix; ?>').val(detail.name);
	$('#id_<?php echo $prefix; ?>').val(detail.id);
</script>
