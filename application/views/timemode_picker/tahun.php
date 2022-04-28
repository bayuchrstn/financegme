<?php

    if(isset($selected_data)):
        $selected_year = $selected_data;
    else:
        $selected_year = date('Y');
    endif;

    // $selected_year = date('Y');

    $tahun_sekarang = (int) date('Y');
    $tahun_mulai = $tahun_sekarang - 10;
    $tahun_selesai = $tahun_sekarang + 10;

    $arr_tahun = array();
    for ($i=$tahun_mulai; $i <=$tahun_selesai; $i++) {
        $arr_tahun[$i] = $i;
    }

?>


<div class="form-group">
    <?php echo form_dropdown('tmp_tahun', $arr_tahun, $selected_year, 'class="form-control tmp_tahun" id=""'); ?>
</div>
