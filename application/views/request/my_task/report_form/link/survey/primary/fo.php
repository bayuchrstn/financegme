<?php
    $prefix  = $ps;
    $default_value = array();
    $fo_survey = $this->ui->forms_by_section('task_report', 'fo_survey_primary', $default_value, $prefix);
    $forms_report = $this->ui->forms('task_report', $default_value, $prefix);

    // pre($report_id);
    $survey_link_primary = ($report_id !='0') ? $this->task_report->get_survey_link($report_id, 'primary') : array();

    // pre($survey_link_primary);
    // pre($survey_link_secondary);
?>

<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_distribusi_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_jarak_odp_server_primary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_start_point_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_end_point_primary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_jenis_kabel_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_status_kabel_primary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_tiang_7_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $fo_survey['fo_tiang_9_primary']; ?>
    </div>
</div>

<?php echo $fo_survey['fo_accessories_primary']; ?>

<div class="row">
    <div class="col-lg-12">
        <?php echo $fo_survey['note_primary']; ?>
    </div>
</div>

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
    $('#note_primary_<?php echo $prefix; ?>').val(survey_link_primary.note);
</script>
