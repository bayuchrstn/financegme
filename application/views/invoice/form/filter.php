<?php
    // pre($arr_filter);
    // pre($status_invoice);

    $arr_bulan = array();
    for($i=1; $i<13; $i++):
        $formated_bulan = subzero($i, 2);
        $arr_bulan[$formated_bulan] = number_to_month($i);
    endfor;

    $gt = $this->db->query('SELECT DISTINCT(invoice_year) as tahun FROM {PRE}invoice ORDER BY invoice_year asc')->result_array();
    // pre($gt);
    $arr_tahun = array();
    if(!empty($gt)):
        foreach($gt as $tahun):
            $arr_tahun[$tahun['tahun']] = $tahun['tahun'];
        endforeach;
    else:
        $arr_tahun[date('Y')] = date('Y');
    endif;

    $arr_status = array(
            'edit'      => 'Belum diedit',
            'ready'     => 'Sudah diedit',
            'approved'  => 'Sudah diapprove',
            'printed'   => 'Sudah dicetak',
        );
?>

<div class="form-group">
    <label for="">Bulan</label>
    <?php
        echo form_dropdown('bulan_switcher', $arr_bulan, $arr_filter['bulan'], 'class="form-control" id="bulan_switcher"');
    ?>
</div>
<div class="form-group">
    <label for="">Tahun</label>
    <?php
        echo form_dropdown('tahun_switcher', $arr_tahun, $arr_filter['tahun'], 'class="form-control" id="tahun_switcher"');
    ?>
</div>
<div class="form-group">
    <label for="">Status</label>
    <?php
        echo form_dropdown('status_switcher', $arr_status, $status_invoice, 'class="form-control" id="status_switcher"');
    ?>
</div>
