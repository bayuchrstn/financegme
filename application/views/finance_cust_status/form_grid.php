<input type="hidden" id="id" name="id" />

<div class="row">
	<div class="col-lg-6">
    <label>Detail Customer</label>
    <div id="detail_customer"></div>	
	</div>
	<div class="col-lg-6">
        <div class="row">
        <label>status</label>
        <select class="form-control" id="status_active" name="status_active">
            <option value="1">AKTIF</option>
            <option value="0">NON AKTIF</option>
        </select>
        </div>
        <div class="row">
        <label>tanggal non aktif</label>
        <input class="form-control date_picker" type="text" id="nonaktif_date" name="nonaktif_date" readonly="readonly" />
        </div>
        <div class="row">
        <label>alasan non aktif</label>
        <input class="form-control" type="text" id="nonaktif_reason" name="nonaktif_reason" />
        </div>
	</div>
</div>
