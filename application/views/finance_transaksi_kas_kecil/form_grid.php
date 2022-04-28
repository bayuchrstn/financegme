<input type="hidden" id="id" name="id" />

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            <label>kas / bank</label>
            <select class="form-control" id="kas_bank" name="kas_bank">
                <option value=""></option>
                <?php
                $q = $this->finance_transaksi_kas_kecil->finance_bank();
                if ($q->num_rows() > 0) {
                    foreach ($q->result_array() as $r) {
                        echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-lg-4">
            <label>Cabang</label>
            <select class="form-control" id="cabang" name="cabang">
                <option value="1">Semarang</option>
                <option value="2">Salatiga</option>
            </select>
        </div>
        <div class="col-lg-5">
            <label>kategori divisi</label>
            <select class="form-control" id="divisi_cat" name="divisi_cat">
                <option value=""></option>
                <?php
                $q = $this->model_global->gmd_finance_master_divisi();
                if ($q->num_rows() > 0) {
                    foreach ($q->result_array() as $r) {
                        echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-lg-6">
            <label>nomor nota</label>
            <input class="form-control" type="text" id="nomor" name="nomor" />
        </div>
        <div class="col-lg-6">
            <label>tanggal</label>
            <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" />
        </div>
    </div>
</div>

<!-- <div class="form-group">
    <label>deskripsi</label>
    <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
</div> -->
<div class="form_add">
    <div class="row">
        <div class="col-lg-3">
            <label>kode coa</label>
            <select class="form-control guna" name="guna[]" onchange="load_card(this)">
            </select>
        </div>
        <div class="col-lg-2">
            <label>card</label>
            <select class="form-control card" name="card[]">
            </select>
        </div>
        <div class="col-lg-2">
            <label>debit</label>
            <input class="form-control currdebit" type="text" name="debit[]" style="text-align:right">
        </div>
        <div class="col-lg-4">
            <label>note</label>
            <input class="form-control" type="text" name="note[]">
        </div>
    </div>
</div>
<div class="row">
    <a class="add_form_field" style="color:blue;float:right">Add More <i class="icon-plus-circle2"></i></a>
    <hr>
</div>
<div class="row">
    <div class="col-lg-6">
        <label>jumlah</label>
        <input class="form-control" style="text-align:right" type="text" id="jumlah" name="jumlah" />
    </div>
</div>