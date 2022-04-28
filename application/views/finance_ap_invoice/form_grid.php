<input type="hidden" id="id" name="id" />

<div class="row">
    <div class="col-lg-6">
        <label>vendor / supplier</label>
        <select class="form-control" id="supplier" name="supplier">
        </select>
    </div>
    <div class="col-lg-6">
        <label>invoice supplier</label>
        <input class="form-control" type="text" id="inv_supplier" name="inv_supplier" />
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <label>Kas / Bank</label>
        <select class="form-control kas_bank" id="kas_bank" name="kat_gl">
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
        <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" />
    </div>
    <div class="col-lg-3">
        <label>jatuh tempo</label>
        <input class="form-control date_picker" type="text" id="date_due" name="date_due" />
    </div>
    <div class="col-lg-3">
        <label>keterangan</label>
        <input class="form-control" type="text" id="ket" name="keterangan" />
    </div>
</div>
<div class="row" style="margin-top:5px">
    <div class="col-md-5">
        <input class="form-control" type="text" id="search_no" name="search_no" placeholder="Search PO/Penerimaan" />
    </div>
</div>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <td style="text-align: center;width:60px">*</td>
                <td style="text-align: center;width:210px">No Penerimaan</td>
                <td style="text-align: center;width:210px">No PO</td>
                <td style="text-align: center;width:310px">Nama</td>
                <td style="text-align: center;width:120px">Tanggal</td>
                <td style="text-align: center;width:160px">Total</td>
            </tr>
        </thead>
    </table>
</div>
<div class="row" style="overflow-y:scroll;height:70px;overflow-x:hidden">
    <table class="table" id="mytable" style="padding: 0;">
    </table>
</div>
<hr>
<div class="detail_barang" style="overflow-y:scroll;height:250px;overflow-x:hidden">

</div>
<div class="row">
    <!-- <div class="col-lg-6">
        <label>potongan</label>
        <input class="form-control price" type="text" id="potongan" name="potongan" onkeyup="count_all()" onblur="count_all()" />
    </div> -->
    <div class="col-lg-3">
        <label>PPN</label>
        <!-- <input class="form-control price" type="text" id="ppn" name="ppn" onkeyup="count_all()" onblur="count_all()" /> -->
        <select class="form-control" id="ppn" onkeyup="count_all()" onchange="count_all()">
            <option value="0">Tidak</option>
            <option value="1">Ya</option>
        </select>
        <input type="hidden" name="ppn" id="val_ppn" />
    </div>
    <div class="col-lg-3">
        <label>materai</label>
        <input class="form-control text-right" type="text" id="materai" name="materai" onkeyup="count_all()" onblur="count_all()" />
    </div>
    <div class="col-lg-3">
        <label>total hutang supplier</label>
        <input class="form-control price" type="text" id="jumlah" name="jumlah" readonly="readonly" />
    </div>
    <div class="col-lg-3">
        <label>total hutang pph</label>
        <input class="form-control price" type="text" name="pph" id="val_pph" readonly="readonly" />
    </div>
</div>

<div class="row">

    <div class="col-lg-6">
        <label>Pajak</label>
        <select class="form-control" id="pph" name="kd_pajak" onkeyup="count_all()" onchange="count_all()">
            <option value="0">Tidak</option>
            <option value="1">PPh 23</option>
            <option value="2">PPh 4 ayat 2</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label>total hutang</label>
        <input class="form-control price" type="text" id="total" readonly="readonly" />
    </div>
</div>