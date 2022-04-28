<?php
    $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('usergroup', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
    echo $forms['divisi'];
    echo $forms['department'];
    echo $forms['name'];
?>
<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;
    console.log(detail);

    set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', detail.divisi_data.code);
    set_option('<?php echo base_url(); ?>select_option/dds/department/'+detail.divisi_data.code, 'department_insert', detail.code);
</script>
