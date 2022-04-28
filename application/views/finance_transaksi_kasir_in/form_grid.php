<input type="hidden" id="id" name="id" />

<div class="row">
	<div class="col-lg-6">
    <label>kas / bank</label>
    <select class="form-control" id="kas_bank" name="kas_bank">
    	<option value=""></option>
        <?php
			$q = $this->finance_transaksi_kasir_in->finance_bank();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					echo '<option value="'.$r['id'].'">'.$r['name'].' ('.$r['account_number'].' / '.$r['account_name'].')</option>';
				}
			}
        ?>
    </select>
    </div>
	<div class="col-lg-6">
    <label>kategori setoran</label>
    <select class="form-control" id="setoran_cat" name="setoran_cat">
    	<option value=""></option>
    	<option value="0">Lain-lain</option>
        <?php
			$q = $this->model_global->gmd_finance_master_cat_setoran();
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
    <label>tanggal transaksi</label>
    <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" readonly />
    </div>
	<div class="col-lg-6">
    <label>jumlah</label>
    <input class="form-control price" type="text" id="jumlah" name="jumlah" />
    </div>
</div>

<div class="row">
	<div class="col-lg-12">
    <label>deskripsi transaksi</label>
    <textarea class="form-control" id="deskripsi" name="deskripsi" ></textarea>
    </div>
</div>
