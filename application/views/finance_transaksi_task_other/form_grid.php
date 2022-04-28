<input type="hidden" id="id" name="id" />

<div class="row">
	<div class="col-lg-6">
    <label>tanggal</label>
    <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" readonly="readonly" />
	</div>
	<div class="col-lg-6">
    <label>jumlah</label>
    <input class="form-control price_decimal" type="text" id="jumlah" name="jumlah" />
	</div>
</div>

<div class="form-group">
    <label>deskripsi</label>
    <textarea class="form-control" id="deskripsi" name="deskripsi" ></textarea>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>file kwitansi</label>
    <input class="form-control" type="file" id="kwitansi_file" name="kwitansi_file" onChange="upload_file('formulir_modal','kwitansi_file');" />
	</div>
	<div class="col-lg-6">
    <label>departement</label>
    <select class="form-control" id="departement" name="departement" onchange="get_karyawan(this.value, 0);">
    	<option value=""></option>
        <?php
			$q = $this->finance_transaksi_task_other->departement();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					echo '<option value="'.$r['code'].'">'.$r['name'].'</option>';
				}
			}
        ?>
    </select>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>file url</label>
    <input class="form-control" type="text" id="dropbox_url" name="dropbox_url" readonly="readonly" />
    <input type="hidden" id="dropbox_path_old" name="dropbox_path_old" readonly="readonly" />
    <input type="hidden" id="dropbox_path" name="dropbox_path" readonly="readonly" />
    <div id="img_dropbox"></div>
	</div>
	<div class="col-lg-6">
    <label>karyawan</label>
    <select class="form-control" id="karyawan" name="karyawan">
    	<option value=""></option>
    </select>
	</div>
</div>
