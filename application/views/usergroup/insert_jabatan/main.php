<?php
    // pre($detail);
    $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('usergroup', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
    echo $forms['level_jabatan'];
    echo $forms['divisi'];
?>
<div id="department_div" class="hidden">
    <?php echo $forms['department']; ?>
</div>

<div id="sub_department_div" class="hidden">
    <?php echo $forms['sub_department']; ?>
</div>

<?php echo $forms['name']; ?>

<script type="text/javascript">
    $(document).ready(function(){
        set_option('<?php echo base_url(); ?>select_option/level_jabatan', 'level_jabatan_insert', 'divisi');
        set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', '');
        set_option('<?php echo base_url(); ?>select_option/kosong', 'department_insert', '');
        set_option('<?php echo base_url(); ?>select_option/kosong', 'sub_department_insert', '');

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

        $('#level_jabatan_insert').change(function(){
            var level_jabatan = $(this).val();
            if(level_jabatan=='divisi'){
                $('#department_div').removeClass('').addClass('hidden');
                $('#sub_department_div').removeClass('').addClass('hidden');
            }else if (level_jabatan=='department') {
                $('#department_div').removeClass('hidden');
                $('#sub_department_div').removeClass('').addClass('hidden');
            }else if (level_jabatan=='sub_department') {
                $('#department_div').removeClass('hidden');
                $('#sub_department_div').removeClass('hidden');

            }
            return false;
        });
    });
</script>
