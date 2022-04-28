<?php
    $arr_bulan = array();
    for($i=1; $i<13; $i++):
        $formated_bulan = subzero($i, 2);
        $arr_bulan[$formated_bulan] = number_to_month($i);
    endfor;
?>
<div id="msg_alert_generate">

</div>
<div class="form-group">
    <label for="">Bulan</label>
    <?php
        echo form_dropdown('bulan_generate', $arr_bulan, date('m'), 'class="form-control" id="bulan_generate"');
    ?>
</div>

<?php

    $tahun_sekarang = (int) date('Y');
    $tahun_kemarin = $tahun_sekarang-1;
    $tahun_depan = $tahun_sekarang+2;

    $arr_tahun = array();
    for ($i=$tahun_kemarin; $i < $tahun_depan; $i++) {
        $arr_tahun[$i] = $i;
    }
?>

<div class="form-group">
    <label for="">Tahun</label>
    <?php
        echo form_dropdown('tahun_generate', $arr_tahun, date('Y'), 'class="form-control" id="tahun_generate"');
    ?>
</div>

<!-- <div class="form-group">
    <div class="progress">
        <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
    </div>
    <div class="msg"></div>
</div> -->
