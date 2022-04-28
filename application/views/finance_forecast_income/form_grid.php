<input type="hidden" id="id" name="id" />

<div class="row"> 
    <div class="col-lg-6">
        <label>kategori</label>
        <select class="form-control" id="tipe_detail" name="tipe_detail">
            <option value=""></option>
            <?php
                $q = $this->model_global->gmd_finance_forecast_cat();
                if($q->num_rows() > 0){
                    foreach($q->result_array() as $r){
                        echo '<option value="'.$r['id'].'">'.$r['nama'].'</option>';
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-lg-6">
        <label>tanggal</label>
        <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" readonly />
    </div>
</div>

<div class="row"> 
    <div class="col-lg-6">
        <label>jumlah</label>
        <input class="form-control price" type="text" id="jumlah" name="jumlah" />
    </div>
    <div class="col-lg-6">
        <label>deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" ></textarea>
    </div>
</div>
