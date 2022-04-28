<?php
    // pre($detail);
    $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('usergroup', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
    echo $forms['divisi'];
    echo $forms['department'];
    echo $forms['sub_department'];
    echo $forms['name'];
?>
<script type="text/javascript">
$(document).ready(function(){
    var detail = <?php echo json_encode($detail); ?>;
    set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', detail.divisi_data.code);
    set_option('<?php echo base_url(); ?>select_option/dds/department/'+detail.divisi_data.code, 'department_insert', detail.department_data.code);
    set_option('<?php echo base_url(); ?>select_option/dds/sub_department/'+detail.department_data.code, 'sub_department_insert', detail.code);
    $('#divisi_insert').change(function(){
        var divisi_picker = $(this).val();
        // alert(divisi_picker);
        set_option('<?php echo base_url('user/dds/department/'); ?>'+divisi_picker, 'department_insert', '');
        return false;
    });
});

</script>
