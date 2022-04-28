<?php
    $prefix = 'update';
    $def = array();
    $forms = $this->ui->forms('usergroup', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
    echo $forms['divisi'];
    echo $forms['name'];
    echo $forms['jabatan_struktur'];
    echo $forms['id'];
?>
<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;
    // console.log(detail);
    set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_update', detail.up);
    $('#name_<?php echo $prefix; ?>').val(detail.name);
	$('#id_<?php echo $prefix; ?>').val(detail.id);
	$('#jabatan_struktur_<?php echo $prefix; ?>').val(detail.jabatan_struktur);
</script>
