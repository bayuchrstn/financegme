<?php
    $prefix = 'update';
    $def = array();
    $forms = $this->ui->forms('usergroup', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
    echo $forms['divisi'];
    echo $forms['department'];
    echo $forms['name'];
    echo $forms['id'];
?>

<script type="text/javascript">
$(document).ready(function(){
    var detail = <?php echo json_encode($detail); ?>;
    console.log(detail);
    $('#name_<?php echo $prefix; ?>').val(detail.name);
    $('#id_<?php echo $prefix; ?>').val(detail.id);
    set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_update', detail.divisi);
    set_option('<?php echo base_url(); ?>select_option/dds/department', 'department_update', detail.up);
    $('#divisi_update').change(function(){
        var divisi_picker = $(this).val();
        // alert(divisi_picker);
        set_option('<?php echo base_url('user/dds/department/'); ?>'+divisi_picker, 'department_update', '');
        return false;
    });
});

</script>
