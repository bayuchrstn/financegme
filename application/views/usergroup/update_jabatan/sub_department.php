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
    echo $forms['jabatan_struktur'];
    echo $forms['id'];
?>
<script type="text/javascript">
$(document).ready(function(){
    var detail = <?php echo json_encode($detail); ?>;
    $('#name_<?php echo $prefix; ?>').val(detail.name);
	$('#id_<?php echo $prefix; ?>').val(detail.id);
	$('#jabatan_struktur_<?php echo $prefix; ?>').val(detail.jabatan_struktur);
    set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', detail.divisi_data.code);
    set_option('<?php echo base_url(); ?>select_option/dds/department/'+detail.divisi_data.code, 'department_insert', detail.department_data.code);
    set_option('<?php echo base_url(); ?>select_option/dds/sub_department/'+detail.department_data.code, 'sub_department_insert', detail.sub_department_data.code);
    $('#divisi_insert').change(function(){
        var divisi_picker = $(this).val();
        set_option('<?php echo base_url('user/dds/department/'); ?>'+divisi_picker, 'department_insert', '');
        return false;
    });
    $('#department_insert').change(function(){
        var department_picker = $(this).val();
        set_option('<?php echo base_url('user/dds/sub_department/'); ?>'+department_picker, 'sub_department_insert', '');
        return false;
    });
});

</script>
