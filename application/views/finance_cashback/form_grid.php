<input type="hidden" id="id" name="id" />

<div class="row">
    <div class="col-lg-6">
        <label>no invoice</label>
        <input class="form-control" type="text" id="no_invoice" name="no_invoice" readonly />
    </div>
    <div class="col-lg-6">
        <label>tanggal bayar</label>
        <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" readonly />
    </div>
</div>

<div class="row">
    <label>detail invoice</label>
    <textarea class="form-control" id="result_no_invoice" name="result_no_invoice" readonly rows="5"></textarea>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>kode jurnal</label>
        <select class="form-control" id="guna" name="guna">
        </select>
    </div>
    <div class="col-lg-6">
        <label>jumlah bayar</label>
        <input type="hidden" id="cashback" name="cashback" />
        <input class="form-control price" type="text" id="jumlah" name="jumlah" />
    </div>
</div>