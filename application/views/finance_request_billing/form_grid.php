<input type="hidden" id="id" name="id" />
<input type="hidden" id="id_task" name="id_task" />

<div class="row">
	<div class="col-lg-6">
    <label>Detail Customer</label>
    <div id="detail_customer"></div>	
	</div>
	<div class="col-lg-6">
        <div class="row">
        <label>customer id</label>
        <input class="form-control" type="text" id="customer_id" name="customer_id" />
        </div>
        <div class="row">
        <label>service id</label>
        <input class="form-control" type="text" id="service_id" name="service_id" />
        </div>
        <div class="row">
        <label>status</label>
        <select class="form-control" id="status" name="status">
            <option value="pre_customer">pre customer</option>
            <option value="customer">customer</option>
        </select>
        </div>
        <div class="row">
        <label>tanggal billing</label>
        <input class="form-control date_picker" type="text" id="tanggal_billing" name="tanggal_billing" readonly="readonly" />
        </div>
	</div>
</div>
