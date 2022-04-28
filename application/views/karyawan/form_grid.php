<?php
    $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('people', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
?>

<div class="row">
    <div class="col-lg-12">
        <?php echo $forms['name']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['pendidikan']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['agama']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['jenis_kelamin']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['golongan_darah']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['tempat_lahir']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['tanggal_lahir']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo $forms['alamat_asli']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo $forms['alamat_tinggal']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['status_pernikahan']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['jumlah_anak']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['telephone']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['handphone']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['email']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['ym']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['bca']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['asuransi']; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php echo $forms['regional']; ?>
    </div>
</div>

<?php
    // pre($my_reg);
    $arr_nik_gmedia = array();
    $my_reg = $this->regional->arr_regional_nik();
    // pre($my_reg);
    foreach($my_reg as $row=>$val):
        $arr_nik_gmedia[$row] = $val;
    endforeach;
    // pre($arr_nik_gmedia);

    $first_reginal_selected = key($arr_nik_gmedia);
    // pre($first_reginal_selected);

    $get_max_nik = "SELECT MAX(nik_order) AS bigger FROM ".$this->db->dbprefix."people WHERE regional='".$first_reginal_selected."'";
    $qry = $this->db->query($get_max_nik);
    $data_max = $qry->row_array();
    $next_nik = (int) $data_max['bigger']+1;
    $next_nik = sprintf("%03s", $next_nik);
    // pre($data_max);

    $nik_bulan = date('m');
    $nik_tahun = date('y');
    $segment_tiga_current = $nik_bulan.$nik_tahun;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group form-inline">
            <label for="">NIK</label><br>
            <input style="width:60px" type="text" class="form-control" id="nik_satu" name="nik_satu" value="GM">
            <?php //echo form_dropdown('nik_dua', $arr_nik_gmedia, '', 'id="nik_dua" class="form-control" onchange="nik_regional_onchange($(this).val())" ') ?>
            <input style="width:60px" type="text" class="form-control" id="nik_dua" name="nik_dua" value="<?php //echo $nik_segment['dua'] ?>">
            <input style="width:100px" type="text" class="form-control" id="nik_tiga" name="nik_tiga" value="<?php echo $segment_tiga_current; ?>">
            <input style="width:100px" type="text" class="form-control" id="nik_empat" name="nik_empat" value="<?php echo $next_nik; ?>">
        </div>
    </div>
    <div id="nik_loader">&nbsp;</div>
</div>



<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['departemen']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['jabatan']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php echo $forms['status_karyawan']; ?>
    </div>
    <div class="col-lg-6">
        <?php echo $forms['tanggal_masuk']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo $forms['note']; ?>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <?php echo $forms['flag_account']; ?>
    </div>
</div>

<div id="optional_account_div">
	<div class="row">
		<div class="col-lg-12">
			<?php echo $forms['username']; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?php echo $forms['password']; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?php echo $forms['usergroup']; ?>
		</div>
	</div>
</div>
