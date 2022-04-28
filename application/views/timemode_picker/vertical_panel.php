<?php
    $uid = (isset($uid)) ? $uid : 'ws';
    $mode_name = (isset($mode_name)) ? $mode_name.'_'.$uid : 'mode'.'_'.$uid;
    $mode_selected = (isset($mode_selected)) ? $mode_selected : 'bulan';

    $arr_mode = array(
        'tanggal'   => 'Tanggal',
        'bulan'     => 'Bulan',
        'tahun'     => 'Tahun',
    );

    // pre($mode_selected);
?>
<div class="form-group">
    <?php echo form_dropdown($mode_name, $arr_mode, $mode_selected, 'class="form-control timemode_picker_mode" id="'.$mode_name.'"'); ?>
</div>

<div id="tmps_<?php echo $uid?>">
    <?php
        $dtc = array();

        switch ($mode_selected) {
            case 'tanggal':
                $dtc['selected_data'] = (isset($selected_data)) ? $selected_data : date('Y-m-d');
            break;

            case 'tahun':
                $dtc['selected_data'] = (isset($selected_data)) ? $selected_data : date('Y');
            break;

            default:
                $dtc['selected_data'] = (isset($selected_data)) ? $selected_data : date('Y-m');
            break;
        }

        echo $this->load->view('timemode_picker/'.$mode_selected, $dtc, TRUE);
    ?>
</div>
