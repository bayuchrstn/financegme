<?php
    $prefix  = $ps;
    $default_value = array();
    $fo_survey = $this->ui->forms_by_section('task_report', 'fo_install_primary', $default_value, $prefix);
    $forms_report = $this->ui->forms('task_report', $default_value, $prefix);

    // pre($report_id);
    $survey_link_primary = ($report_id !='0') ? $this->task_report->get_survey_link($report_id, 'primary') : array();

    // pre($survey_link_primary);
    // pre($survey_link_secondary);
?>
<!-- install primari fos -->
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_odp_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_jenis_kabel_primary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_jarak_kabel_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_ont_onu_primary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_serial_number_ont_onu_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_mac_address_fo_ont_onu_primary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_power_optic_odp_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_power_optic_roset_primary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_ip_ptv_privat_primary']; ?>
    </div>
    <div class="col-lg-6">
        
    </div>
</div>

<?php //echo $fo_survey['fo_accessories_primary']; ?>

<script type="text/javascript">
    var survey_link_primary = <?php echo json_encode($survey_link_primary); ?>;
    // console.log(survey_link_primary);

    $('#fo_distribusi_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_distribusi);
    $('#fo_jarak_odp_server_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_jarak_odp_server);
    $('#fo_start_point_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_start_point);
    $('#fo_end_point_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_end_point);
    $('#fo_jenis_kabel_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_jenis_kabel);
    $('#fo_status_kabel_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_status_kabel);
    $('#fo_tiang_7_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_tiang_7);
    $('#fo_tiang_9_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_tiang_9);
    $('#fo_accessories_primary_<?php echo $prefix; ?>').val(survey_link_primary.fo_accessories);
</script>
