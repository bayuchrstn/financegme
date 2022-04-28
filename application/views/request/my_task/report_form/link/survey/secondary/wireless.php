<?php
    $prefix  = $ps;
    $default_value = array();
    $wr_survey = $this->ui->forms_by_section('task_report', 'wr_survey_secondary', $default_value, $prefix);
    $forms_report = $this->ui->forms('task_report', $default_value, $prefix);

    // pre($report_id);

    $survey_link_secondary = ($report_id !='0') ? $this->task_report->get_survey_link($report_id, 'secondary') : array();

    // pre($survey_link_secondary);
?>

<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_bts_secondary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_bts_jarak_secondary']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_bts_alternative_secondary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_bts_jarak_alternative_secondary']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_jenis_tower_secondary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_tinggi_tower_secondary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_kabel_secondary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_access_point_secondary']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_tangga_secondary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo $wr_survey['note_secondary']; ?>
    </div>
</div>

<script type="text/javascript">
    var survey_link_secondary = <?php echo json_encode($survey_link_secondary); ?>;
    $('#wireless_bts_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_bts);
    $('#wireless_bts_jarak_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_bts_jarak);
    $('#wireless_bts_alternative_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_bts_alternative);
    $('#wireless_bts_jarak_alternative_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_bts_jarak_alternative);
    $('#wireless_jenis_tower_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_jenis_tower);
    $('#wireless_tinggi_tower_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_tinggi_tower);
    $('#wireless_kabel_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_kabel);
    $('#wireless_access_point_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_access_point);
    $('#wireless_tangga_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.wireless_tangga);
    $('#note_secondary_<?php echo $prefix; ?>').val(survey_link_secondary.note);
</script>
