<input type="hidden" id="id" name="id" />

<div class="row">
	<div class="col-lg-6">
    <label>service ID</label>
    <input type="hidden" id="ppn" name="ppn" />
    <input type="hidden" id="service_id" name="service_id" />
    <input class="form-control" type="text" id="service_id_val" name="service_id_val" onblur="get_service_id()" onkeyup="get_service_id()" />
	</div>
	<div class="col-lg-6">
    <label>customer ID</label>
    <input class="form-control" type="text" id="customer_id" name="customer_id" readonly />
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>nama service / nama invoice</label>
    <input class="form-control" type="text" id="nama" name="nama" readonly />
	</div>
	<div class="col-lg-6">
    <label>group customer</label>
    <input class="form-control" type="text" id="customer_group_name" name="customer_group_name" readonly />
	</div>
</div>

<div class="row" style="margin-top:30px;">
	<div class="col-lg-6">
    <label>no invoice <em style="color:#006600;">(Jika kosong maka akan di create otomatis)</em></label>
    <input class="form-control" type="text" id="no_invoice" name="no_invoice" />
	</div>
	<div class="col-lg-6">
    <label>periode invoice</label>
    <input class="form-control" type="text" id="periode_invoice" name="periode_invoice" />
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>tanggal invoice</label>
    <input class="form-control date_picker" type="text" id="date_invoice" name="date_invoice" />
	</div>
	<div class="col-lg-6">
    <label>tanggal jatuh tempo</label>
    <input class="form-control date_picker" type="text" id="date_due" name="date_due" />
	</div>
</div>

<div class="row">
    <table id="tabelDetailInvoice" class="tabel_report" border="1" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
    <thead>
    <tr>
        <th valign="top"><strong>Description</strong></th>
        <th valign="top" width="10"><strong>bandwidth</strong></th>
        <th valign="top" width="10"><strong>colocation</strong></th>
        <th valign="top" width="10"><strong>instalasi</strong></th>
        <th valign="top" width="10"><strong>perangkat</strong></th>
        <th valign="top" width="10"><strong>lain2</strong></th>
        <th valign="top" width="10">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    	<td valign="top"><input class="form-control" type="text" style="width:270px;" id="service_produk" name="service_produk" />
        <input class="form-control" type="text" style="width:270px;" id="service_note" name="service_note" /></td>
    	<td valign="top"><input class="form-control price" type="text" style="width:100px;" id="bw" name="bw" onkeyup="count_harga()" onblur="count_harga()" /></td>
    	<td valign="top"><input class="form-control price" type="text" style="width:100px;" id="colo" name="colo" onkeyup="count_harga()" onblur="count_harga()" /></td>
    	<td valign="top"><input class="form-control price" type="text" style="width:100px;" id="instalasi" name="instalasi" onkeyup="count_harga()" onblur="count_harga()" /></td>
    	<td valign="top"><input class="form-control price" type="text" style="width:100px;" id="perangkat" name="perangkat" onkeyup="count_harga()" onblur="count_harga()" /></td>
    	<td valign="top"><input class="form-control price" type="text" style="width:100px;" id="lain2" name="lain2" onkeyup="count_harga()" onblur="count_harga()" /></td>
    	<td>&nbsp;</td>
    </tr>
    </tbody>
    </table>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>potongan</label><br />
    <select class="form-control" id="jenis_potongan" name="jenis_potongan" style="display:inline; width:120px;">
    	<option value="0">Diskon</option>
        <option value="1">Potongan</option>
    </select>
    <input class="form-control price" type="text" id="potongan" name="potongan" onkeyup="count_harga()" onblur="count_harga()" style="display:inline; width:295px;" />
	</div>
	<div class="col-lg-3">
    <label>PPN</label>
    <input class="form-control price" type="text" id="ppnnya" name="ppnnya" onkeyup="count_harga()" onblur="count_harga()" />
	</div>
	<div class="col-lg-3">
    <label>total tagihan</label>
    <input class="form-control price" type="text" id="total_tagihan" name="total_tagihan" readonly />
	</div>
</div>

<div class="row">
	<div class="col-lg-3">
    <label>bukti potong pph 22/23</label>
    <input class="form-control price" type="text" id="pph2223" name="pph2223" />
	</div>
	<div class="col-lg-3">
    <label>mf</label>
    <input class="form-control price" type="text" id="mf" name="mf" />
	</div>
	<div class="col-lg-3">
    <label>bupot ppn</label>
    <input class="form-control price" type="text" id="bupot_ppn" name="bupot_ppn" />
	</div>
</div>
