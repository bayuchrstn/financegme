<?php
    $uid = (isset($uid)) ? $uid : 'ws';

    $mode_name = (isset($mode_name)) ? $mode_name.'_'.$uid : 'mode'.'_'.$uid;
    $mode_selected = (isset($mode_selected)) ? $mode_selected : 'bulan';

    $arr_mode = array(
        'tanggal'   => 'Tanggal',
        'bulan'     => 'Bulan',
        'tahun'     => 'Tahun',
    );
?>
<div class="form-group">
    <?php echo form_dropdown($mode_name, $arr_mode, $mode_selected, 'class="form-control chosen" id="'.$mode_name.'"'); ?>
</div>

<div id="tmps_<?php echo $uid?>">
    <?php
        echo $this->load->view('timemode_picker/month', '', TRUE);
    ?>
</div>
