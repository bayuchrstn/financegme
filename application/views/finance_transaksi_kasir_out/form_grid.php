<input type="hidden" id="id" name="id" />

<div class="form-group">
    <label>kas / bank</label>
    <select class="form-control" id="kas_bank" name="kas_bank">
    	<option value=""></option>
        <?php
			$q = $this->finance_transaksi_kasir_out->finance_bank();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					echo '<option value="'.$r['id'].'">'.$r['name'].' ('.$r['account_number'].' a.n. '.$r['account_name'].')</option>';
				}
			}
        ?>
    </select>
</div>
<div class="row">
	<div class="col-lg-6">
    <label>kategori fixcost</label>
    <select class="form-control" id="fixcost_cat" name="fixcost_cat">
        <option value=""></option>
        <option value="0">Lain-lain</option>
        <?php
            $q = $this->model_global->gmd_finance_fixcost_cat();
            if($q->num_rows() > 0){
                foreach($q->result_array() as $r){
                    echo '<option value="'.$r['id'].'">'.$r['nama'].'</option>';
                }
            }
        ?>
    </select>
    </div>
	<div class="col-lg-6">
    <label>kategori divisi</label>
    <select class="form-control" id="divisi_cat" name="divisi_cat">
        <option value=""></option>
        <option value="0">Lain-lain</option>
        <?php
            $q = $this->model_global->gmd_finance_master_divisi();
            if($q->num_rows() > 0){
                foreach($q->result_array() as $r){
                    echo '<option value="'.$r['id'].'">'.$r['nama'].'</option>';
                }
            }
        ?>
    </select>
    </div>
</div>
<div class="row">
	<div class="col-lg-6">
    <label>tanggal</label>
    <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" readonly="readonly" />
    </div>
	<div class="col-lg-6">
    <label>jumlah</label>
    <input class="form-control price" type="text" id="jumlah" name="jumlah" />
    </div>
</div>

<div class="form-group">
    <label>deskripsi</label>
    <textarea class="form-control" id="deskripsi" name="deskripsi" ></textarea>
</div>

<?php /*
<div class="row">
	<div class="col-lg-6">
    <label>departement</label>
    <select class="form-control" id="departement" name="departement" onchange="get_karyawan(this.value, 0);">
    	<option value=""></option>
        <?php
			$q = $this->finance_transaksi_kasir_out->departement();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					echo '<option value="'.$r['code'].'">'.$r['name'].'</option>';
				}
			}
        ?>
    </select>
	</div>
	<div class="col-lg-6">
    <label>jumlah</label>
    <input class="form-control price_decimal" type="text" id="jumlah" name="jumlah" />
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>karyawan</label>
    <select class="form-control" id="karyawan" name="karyawan">
    	<option value=""></option>
    </select>
	</div>
</div>

*/
?>