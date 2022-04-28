<input type="hidden" id="id" name="id" />

<div class="row">
    <div class="col-lg-6">
        <label>kategori</label>
        <select class="form-control" id="tax_type" name="tax_type">
            <option value=""></option>
            <?php
                $q = $this->m_global->gmd_finance_master_cat_tax_type();
                if($q->num_rows() > 0){
                    foreach($q->result_array() as $r){
                        echo '<option value="'.$r['id'].'">'.$r['nama'].'</option>';
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-lg-6">
        <label>faktur</label>
        <select class="form-control" id="msa" name="msa">
            <option value="0">MSD</option>
            <option value="1">MSA</option>
        </select>
    </div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>tanggal bayar</label>
    <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" readonly="readonly" />
	</div>
	<div class="col-lg-6">
    <label>jumlah bayar</label>
    <input class="form-control price" type="text" id="jumlah" name="jumlah" />
	</div>
</div>
