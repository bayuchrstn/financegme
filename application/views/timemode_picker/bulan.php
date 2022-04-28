<?php
    // pre($selected_data);
    if(isset($selected_data)):
        $split_selected_data = explode('-', $selected_data);
        $selected_month = $split_selected_data[1];
        $selected_year = $split_selected_data[0];
    else:
        $selected_month = date('m');
        $selected_year = date('Y');
    endif;


    $arr_bulan = array();
    for ($i=1; $i <=12 ; $i++) {
        $arr_bulan[$i] = number_to_month($i);
    }

    $tahun_sekarang = (int) date('Y');
    $tahun_mulai = $tahun_sekarang - 10;
    $tahun_selesai = $tahun_sekarang + 10;

    $arr_tahun = array();
    for ($i=$tahun_mulai; $i <=$tahun_selesai; $i++) {
        $arr_tahun[$i] = $i;
    }

?>

<div class="form-group">
    <?php echo form_dropdown('tmp_bulan', $arr_bulan, $selected_month, 'class="form-control tmp_bulan" id=""'); ?>
</div>

<div class="form-group">
    <?php echo form_dropdown('tmp_tahun', $arr_tahun, $selected_year, 'class="form-control tmp_tahun" id=""'); ?>
</div>
