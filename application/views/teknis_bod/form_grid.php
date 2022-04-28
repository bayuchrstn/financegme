<input type="hidden" id="id" name="id" />
<input type="hidden" id="task_id" name="task_id" />

<div class="form-group">
    <label for="nama">judul</label>
    <input class="form-control" type="text" id="subject" name="subject" />
</div>

<div class="form-group">
    <label>shift</label>
    <select class="form-control" id="shift" name="shift">
    	<option value="shift_1">Shift 1</option>
    	<option value="shift_2">Shift 2</option>
    	<option value="shift_3">Shift 3</option>
    </select>
</div>

<div class="row">
        <div class="col-lg-6">
        <label>waktu mulai</label>
        <input class="form-control datetime_picker" type="text" id="date_start" name="date_start" readonly="readonly" />
        </div>
        <div class="col-lg-6">
        <label>waktu selesai</label>
        <input class="form-control datetime_picker" type="text" id="date_due" name="date_due" readonly="readonly" />
        </div>
</div>

<div class="row">
	<div class="col-lg-6">
    <input type="hidden" id="location_id" name="location_id" />
    <label>pelanggan</label>
    <input class="form-control" type="text" id="pelanggan" name="pelanggan" />
	</div>
	<div class="col-lg-6">
    <label>service id</label>
    <input class="form-control" type="text" id="service_id" name="service_id" readonly="readonly" />
	</div>
</div>

<div class="form-group">
    <label for="pesan">isi laporan</label>
    <textarea class="form-control" id="pesan" name="pesan" rows="5" ></textarea>
</div>
