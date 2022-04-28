<input type="hidden" id="id" name="id" />

<div class="row">
	<div class="col-lg-6">
    <label>service ID</label>
    <input class="form-control" type="text" id="service_id" name="service_id" />
    <input type="hidden" id="service_id_old" name="service_id_old" />
	</div>
	<div class="col-lg-6">
    <label>nama</label>
    <input class="form-control" type="text" id="nama" name="nama" />
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>customer ID <a href="<?php echo base_url().'finance_customer'; ?>" target="_blank">[Tambah Customer ID]</a></label>
    <input class="form-control" type="text" id="customer_id_val" name="customer_id_val" />
    <input type="hidden" id="customer_id" name="customer_id" />
    <input type="hidden" id="cid" name="cid" />
	</div>
	<div class="col-lg-6">
    <label>customer group</label>
    <input class="form-control" type="text" id="customer_group" name="customer_group" readonly="readonly" />
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>alamat</label>
    <input class="form-control" type="text" id="alamat" name="alamat" />
	</div>
	<div class="col-lg-6">
    <label>telp</label>
    <input class="form-control" type="text" id="telp" name="telp" />
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>contact person</label>
    <input class="form-control" type="text" id="cp" name="cp" />
	</div>
	<div class="col-lg-6">
    <label>pelanggan</label>
    <select class="form-control" id="msa" name="msa">
    	<option value=""></option>
    	<option value="1">MEDIA SARANA AKSES</option>
    	<option value="0">MEDIA SARANA DATA</option>
    </select>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>MAXI</label>
    <select class="form-control" id="status_maxi" name="status_maxi">
    	<option value=""></option>
    	<option value="1">YA</option>
    	<option value="0">TIDAK</option>
    </select>
	</div>
	<div class="col-lg-6">
    <label>cabang</label>
    <select class="form-control" id="status_cabang" name="status_cabang">
    	<option value=""></option>
    	<option value="1">YA</option>
    	<option value="0">TIDAK</option>
    </select>
	</div>
</div>

<div class="row" style="margin-top:50px;">
	<div class="col-lg-6">
    <label>PPN</label>
    <select class="form-control" id="ppn" name="ppn">
    	<option value=""></option>
    	<option value="1">YA</option>
    	<option value="0">TIDAK</option>
    </select>
	</div>
	<div class="col-lg-6">
    <label>jenis faktur pajak</label>
    <select class="form-control" id="jenis_ppn" name="jenis_ppn">
    	<option value=""></option>
    	<option value="0">STANDAR</option>
    	<option value="1">SEDERHANA</option>
    </select>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>status layanan</label>
    <select class="form-control" id="status_service" name="status_service">
    	<option value=""></option>
    	<option value="1">NON AKTIF</option>
    	<option value="0">AKTIF</option>
    </select>
	</div>
	<div class="col-lg-6">
    <label>BHP USO</label>
    <select class="form-control" id="bhp_uso" name="bhp_uso">
    	<option value=""></option>
    	<option value="1">YA</option>
    	<option value="0">TIDAK</option>
    </select>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>barcode</label>
    <select class="form-control" id="barcode" name="barcode">
    	<option value=""></option>
    	<option value="1">YA</option>
    	<option value="0">TIDAK</option>
    </select>
	</div>
	<div class="col-lg-6">
    <label>billing cycle</label>
    <select class="form-control" id="billing_cycle" name="billing_cycle">
    	<option value=""></option>
    	<option value="1">YA</option>
    	<option value="0">TIDAK</option>
    </select>
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
	<div class="col-lg-6">
    <label>biaya MF</label>
    <input class="form-control price" type="text" id="mf" name="mf" />
	</div>
	<div class="col-lg-6">
    <label>MF cycle</label>
    <select class="form-control" id="mf_cycle" name="mf_cycle">
    	<option value=""></option>
    	<option value="1">YA</option>
    	<option value="0">TIDAK</option>
    </select>
	</div>
</div>

<div class="row">
    <table id="tabelDetailInvoice" class="tabel_report" border="1" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
    <thead>
    <tr>
    	<td style="border:0; vertical-align:middle;"><input class="form-control" type="text" style="width:270px;" id="tambah_service_produk" /><br />
        <input class="form-control" type="text" style="width:270px;" id="tambah_service_note" /></td>
    	<td style="border:0; vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="tambah_bw" /></td>
    	<td style="border:0; vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="tambah_colo" /></td>
    	<td style="border:0; vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="tambah_instalasi" /></td>
    	<td style="border:0; vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="tambah_perangkat" /></td>
    	<td style="border:0; vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="tambah_lain2" /></td>
    	<td style="border:0; vertical-align:middle;"><a href="#" id="tambahDetailInvoice"><i class="material-icons">&#xE147;</i></a></td>
    </tr>
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
    	<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:270px;" id="product_description" name="product_description" /><br />
        <input class="form-control" type="text" style="width:270px;" id="product_note" name="product_note" /></td>
    	<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="bandwith" name="bandwith" /></td>
    	<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="colocation" name="colocation" /></td>
    	<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="instalasi" name="instalasi" /></td>
    	<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="perangkat" name="perangkat" /></td>
    	<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="lain2" name="lain2" /></td>
    	<td>&nbsp;</td>
    </tr>
    </tbody>
    </table>
</div>

<div class="form-group">
    <label>payment to <em style="font-size:11px; font-weight:bold;">(CTRL + LEFT CLICK TO SELECT)</em></label>
    <select class="form-control" id="payment_to" name="payment_to[]" multiple="multiple" size="5">
        <?php
			$q = $this->m_global->payment_to();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					echo '<option value="'.$r['id'].'">'.$r['name'].' - '.$r['account_name'].' - '.$r['account_number'].'</option>';
				}
			}
        ?>
    </select>
</div>


<div class="row">
	<div class="col-lg-6">
    <label>invoice nama</label>
    <input class="form-control" type="text" id="invoice_name" name="invoice_name" />
	</div>
	<div class="col-lg-6">
    <label>invoice alamat</label>
    <input class="form-control" type="text" id="invoice_address" name="invoice_address" />
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
    <label>invoice telp</label>
    <input class="form-control" type="text" id="invoice_phone" name="invoice_phone" />
	</div>
	<div class="col-lg-6">
    <label>invoice CP</label>
    <input class="form-control" type="text" id="invoice_attention" name="invoice_attention" />
	</div>
</div>

