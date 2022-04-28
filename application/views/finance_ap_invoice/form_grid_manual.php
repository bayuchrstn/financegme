<input type="hidden" id="id2" name="id" />

<div class="row">
    <div class="col-lg-6">
        <label>vendor / supplier</label>
        <select class="form-control" id="supplier2" name="supplier">
        </select>
    </div>
    <div class="col-lg-6">
        <label>invoice supplier</label>
        <input class="form-control" type="text" id="inv_supplier2" name="inv_supplier" />
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <label>Kas / Bank</label>
        <select class="form-control" id="kas_bank2" name="kat_gl">
            <option value=""></option>
            <?php
            $q = $this->finance_ap_invoice->finance_bank();
            if ($q->num_rows() > 0) {
                foreach ($q->result_array() as $r) {
                    echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="col-lg-3">
        <label>tanggal invoice</label>
        <input class="form-control date_picker" type="text" id="tanggal2" name="tanggal" />
    </div>
    <div class="col-lg-3">
        <label>jatuh tempo</label>
        <input class="form-control date_picker" type="text" id="date_due2" name="date_due" />
    </div>
    <div class="col-lg-3">
        <label>keterangan</label>
        <input class="form-control" type="text" id="ket2" name="keterangan" />
    </div>
</div>

<hr>
<div class="row" style="margin-top:5px;margin-bottom:15px">
    <div class="col-md-2 pull-right">
        <a class="btn btn-primary col-md-12" onclick="add_more();"><i class="icon-plus-circle2"></i> Add</a>
    </div>
</div>
<input type="hidden" id="no_urut" value="1">
<div class="form_add2">
    <div class="row">
        <div class="col-lg-1">
            <label>No</label>
            <input class="form-control no_urut" type="text" disabled>
        </div>
        <div class="col-lg-2">
            <label>Jurnal</label>
            <select class="form-control jurnal" name="jurnal[]">
                <?php
                $q = $this->finance_ap_invoice->finance_jurnal();
                if ($q->num_rows() > 0) {
                    foreach ($q->result_array() as $r) {
                        echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-lg-3">
            <label>Nama Barang</label>
            <input class="form-control nama_barang" type="text" name="nama_barang[]" onchange="count_all2()">
        </div>
        <div class="col-lg-1">
            <label>QTY</label>
            <input class="form-control jumlah_barang2" type="text" name="qty[]" onkeyup="hitung4(this)" onblur="hitung4(this)">
        </div>
        <div class=" col-lg-1">
            <label>Satuan</label>
            <input class="form-control" type="text" name="satuan[]">
        </div>
        <div class="col-lg-1">
            <label>Harga</label>
            <input class="form-control harga_brg" type="text" name="harga[]" style="text-align:right" onkeyup="hitung3(this)" onblur="hitung3(this)">
        </div>
        <div class="col-lg-2">
            <label>Jumlah</label>
            <input class="form-control total_harga2" type="text" name="jumlah_harga[]" style="text-align:right" readonly>
        </div>
        <div class="col-lg-1">
            <label>Action</label>
            <br>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-3">
        <label>Ongkos Kirim</label>
        <input class="form-control price" type="text" id="ongkir2" name="ongkir" onkeyup="count_all2()" onblur="count_all2()" />
    </div>
    <!-- <div class="col-lg-3">
        <label>Diskon</label>
        <input class="form-control price" type="text" id="diskon2" name="diskon" onkeyup="count_all2()" onblur="count_all2()" />
    </div> -->
    <div class="col-lg-3">
        <label>materai</label>
        <input class="form-control text-right" type="text" id="materai2" name="materai" onkeyup="count_all2()" onblur="count_all2()" />
    </div>
    <div class="col-lg-3">
        <label>total hutang supplier</label>
        <input class="form-control price" type="text" id="jumlah2" name="jumlah" readonly="readonly" />
    </div>
    <div class="col-lg-3">
        <label>total hutang pph</label>
        <input class="form-control price" type="text" name="pph" id="val_pph2" readonly="readonly" />
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <label>PPN</label>
        <!-- <input class="form-control price" type="text" id="ppn" name="ppn" onkeyup="count_all()" onblur="count_all()" /> -->
        <select class="form-control" id="ppn2" onkeyup="count_all2()" onchange="count_all2()">
            <option value="0">Tidak</option>
            <option value="1">Ya</option>
        </select>
        <input type="hidden" name="ppn" id="val_ppn2" />
    </div>
    <div class="col-lg-3">
        <label>Pajak</label>
        <select class="form-control" id="pph2" name="kd_pajak" onkeyup="count_all2()" onchange="count_all2()">
            <option value="0">Tidak</option>
            <option value="1">PPh 23</option>
            <option value="2">PPh 4 ayat 2</option>

        </select>
    </div>
    <div class="col-lg-6">
        <label>total hutang</label>
        <input class="form-control price" type="text" id="total2" readonly="readonly" />
    </div>
</div>