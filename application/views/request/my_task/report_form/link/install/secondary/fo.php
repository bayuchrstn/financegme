<?php
    $prefix  = $ps;
    $default_value = array();
    $fo_survey = $this->ui->forms_by_section('task_report', 'fo_install_secondary', $default_value, $prefix);
    $forms_report = $this->ui->forms('task_report', $default_value, $prefix);

    // pre($report_id);
    $survey_link_secondary = ($report_id !='0') ? $this->task_report->get_survey_link($report_id, 'secondary') : array();

    // pre($survey_link_secondary);
?>

<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_odp_secondary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_jenis_kabel_secondary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_jarak_kabel_secondary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_ont_onu_secondary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_serial_number_ont_onu_secondary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_mac_address_fo_ont_onu_secondary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_power_optic_odp_secondary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_power_optic_roset_secondary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_ip_ptv_privat_secondary']; ?>
    </div>
    <div class="col-lg-6">
        
    </div>
</div>

<?php //echo $fo_survey['fo_accessories_secondary']; ?>


<script type="text/javascript">
    var survey_link_secondary = <?php echo json_encode($survey_link_secondary); ?>;
    // console.log(survey_link_secondary);

    $('#fo_distribusi_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_distribusi);
    $('#fo_jarak_odp_server_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_jarak_odp_server);
    $('#fo_start_point_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_start_point);
    $('#fo_end_point_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_end_point);
    $('#fo_jenis_kabel_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_jenis_kabel);
    $('#fo_status_kabel_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_status_kabel);
    $('#fo_tiang_7_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_tiang_7);
    $('#fo_tiang_9_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_tiang_9);
    $('#fo_accessories_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.fo_accessories);
</script>
