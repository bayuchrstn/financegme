<?php
    $prefix  = $ps;
    $default_value = array();
    $wr_survey = $this->ui->forms_by_section('task_report', 'wr_install_primary', $default_value, $prefix);
    $forms_report = $this->ui->forms('task_report', $default_value, $prefix);
    // pre($report_id);
    $survey_link_primary = ($report_id !='0') ? $this->task_report->get_survey_link($report_id, 'primary') : array();

    // pre($survey_link_primary);

?>
<!-- install primari wr -->
<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_bts_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_jarak_primary']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_signal_strenght_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_kualitas_signal_primary']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_antena_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_radio_primary']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_jenis_kabel_primary']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $wr_survey['wireless_jarak_kabel_primary']; ?>
    </div>
</div>

<script type="text/javascript">
    var survey_link_primary = <?php echo json_encode($survey_link_primary); ?>;
    $('#wireless_bts_primary_<?php echo $prefix; ?>').val(survey_link_primary.wireless_bts);
    $('#wireless_bts_jarak_primary_<?php echo $prefix; ?>').val(survey_link_primary.wireless_bts_jarak);
    $('#wireless_bts_alternative_primary_<?php echo $prefix; ?>').val(survey_link_primary.wireless_bts_alternative);
    $('#wireless_bts_jarak_alternative_primary_<?php echo $prefix; ?>').val(survey_link_primary.wireless_bts_jarak_alternative);
    $('#wireless_jenis_tower_primary_<?php echo $prefix; ?>').val(survey_link_primary.wireless_jenis_tower);
    $('#wireless_tinggi_tower_primary_<?php echo $prefix; ?>').val(survey_link_primary.wireless_tinggi_tower);
    $('#wireless_kabel_primary_<?php echo $prefix; ?>').val(survey_link_primary.wireless_kabel);
    $('#wireless_radio_primary_<?php echo $prefix; ?>').val(survey_link_primary.wireless_access_point);
</script>
