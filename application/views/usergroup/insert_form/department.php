<?php
    $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('usergroup', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
    echo $forms['divisi'];
    echo $forms['name'];
?>
<script type="text/javascript">
    set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', '');
</script>
