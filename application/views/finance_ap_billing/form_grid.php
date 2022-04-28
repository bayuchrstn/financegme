<input type="hidden" id="id" name="id" />

<div class="form-group">
    <input type="hidden" id="id_invoice" name="id_invoice" />
    <label>no invoice</label>
    <input class="form-control" type="text" id="val_no_invoice" name="val_no_invoice" onkeyup="clearDetTransaksi()" />
</div>

<div class="form-group">
    <label>detail invoice</label>
    <textarea class="form-control" id="result_no_invoice" name="result_no_invoice" readonly="readonly" rows="5" ></textarea>
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
