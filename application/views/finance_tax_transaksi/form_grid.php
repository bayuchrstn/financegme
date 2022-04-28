<input type="hidden" id="id" name="id" />

<div class="row"> 
    <div class="col-lg-6">
        <label>jenis</label>
        <select class="form-control" id="tipe" name="tipe">
        	<option value=""></option>
            <option value="1">Masukan / Bukti Potong</option>
            <option value="0">Keluaran / Terbit</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label>kategori</label>
        <select class="form-control" id="tax_type" name="tax_type">
            <option value=""></option>
            <?php
                $q = $this->model_global->gmd_finance_master_cat_tax_type();
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
        <label>tanggal faktur</label>
        <input class="form-control date_picker" type="text" id="tanggal_faktur" name="tanggal_faktur" readonly="readonly" />
    </div>
    <div class="col-lg-6">
        <label>nama PKP</label>
        <input class="form-control" type="text" id="nama_pkp" name="nama_pkp" />
    </div>
</div>

<div class="row"> 
    <div class="col-lg-3">
        <label>cabang</label>
        <select class="form-control" id="cabang" name="cabang">
            <option value=""></option>
            <?php
                $q = $this->model_global->gmd_regional();
                if($q->num_rows() > 0){
                    foreach($q->result_array() as $r){
                        echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-lg-3">
        <label>faktur</label>
        <select class="form-control" id="msa" name="msa">
            <option value="0">MSD</option>
            <option value="1">MSA</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label>no seri faktur</label>
        <input class="form-control" type="text" id="no_seri_faktur" name="no_seri_faktur" />
    </div>
</div>

<div class="row"> 
    <div class="col-lg-6">
        <label>deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" ></textarea>
    </div>
    <div class="col-lg-6">
        <label>jumlah</label>
        <input class="form-control price" type="text" id="jumlah" name="jumlah" />
    </div>
</div>
