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
$(document).ready(function(){
    set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', '');
    set_option('<?php echo base_url(); ?>select_option/kosong', 'department_insert', '');
    $('#divisi_insert').change(function(){
        var divisi_picker = $(this).val();
        // alert(divisi_picker);
        set_option('<?php echo base_url('user/dds/department/'); ?>'+divisi_picker, 'department_insert', '');
        return false;
    });
});

</script>
