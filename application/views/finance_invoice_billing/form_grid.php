<input type="hidden" id="id" name="id" />

<div class="row">
	<div class="col-lg-5">
		<input type="hidden" id="no_invoice" name="no_invoice" />
		<label>no invoice</label>
		<input class="form-control" type="text" id="val_no_invoice" name="val_no_invoice" onkeyup="clearDetTransaksi()" />
	</div>
	<div class="col-lg-4">
		<label>tanggal bayar</label>
		<input class="form-control date_picker" type="text" id="tanggal" name="tanggal" readonly />
	</div>
	<div class="col-lg-2">
		<label>kode jurnal</label>
		<select class="form-control" id="kat_gl" name="kat_gl" style="display:inline;">
			<option value=""></option>
			<?php
			$q = $this->m_global->finance_master_kat_gl();
			if ($q->num_rows() > 0) {
				foreach ($q->result_array() as $r) {
					echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
				}
			}
			?>
		</select>
	</div>
</div>

<div class="row">
	<div class="col-lg-11">
		<label>detail invoice</label>
		<textarea class="form-control" id="result_no_invoice" name="result_no_invoice" readonly rows="5"></textarea>
	</div>
</div>
<div class="form_add">
	<div class="row" style="margin-bottom:10px">
		<div class="col-lg-2">
			<label>kode coa</label>
			<select class="form-control guna" name="guna[]" onchange="load_card(this)">
			</select>
		</div>
		<div class="col-lg-2">
			<label>card</label>
			<select class="form-control card" name="card[]">
			</select>
		</div>
		<div class="col-lg-2 text-center">
			<label>debit</label>
			<input class="form-control currdebit" type="text" name="debit[]" style="text-align:right">
		</div>
		<div class="col-lg-2 text-center">
			<label>kredit</label>
			<!-- <input class="form-control currkredit" type="text" name="kredit[]" style="text-align:right"> -->
		</div>
		<div class="col-lg-3">
			<label>note</label>
			<input class="form-control" type="text" name="note[]">
		</div>
	</div>
</div>
<div class="row">
	<a class="add_form_field" style="color:blue;float:right">Add More <i class="icon-plus-circle2"></i></a>
	<hr>
</div>

<div class="row" style="margin-bottom:5px">
	<div class="col-lg-4">
		<label>PPN Bendaharawan</label>
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="ppn" name="ppn" style="text-align:right" />
	</div>
	<div class="col-lg-2">
	</div>
</div>
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-4">
		<label>Uang Muka PPh 23</label>
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="pph23" name="pph23" style="text-align:right" />
	</div>
	<div class="col-lg-2">
	</div>
</div>
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-4">
		<label>Biaya Lain Lain</label>
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="blain2" name="blain2" style="text-align:right" />
	</div>
	<div class="col-lg-2">
	</div>
</div>
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-4">
		<label>Pendapatan Lain Lain</label>
	</div>
	<div class="col-lg-2">
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="plain2" name="plain2" style="text-align:right" />
	</div>
</div>
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-4">
		<label>Piutang</label>
	</div>
	<div class="col-lg-2">
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="piut" name="piut" style="text-align:right" readonly />
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-4">
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="debittot" name="debittot" style="text-align:right" readonly />
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="kredittot" name="kredittot" style="text-align:right" readonly />
	</div>
</div>
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-2">
		<label>Jumlah Tagihan</label>
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="jml_tagih" name="jml_tagih" style="text-align:right" readonly />
	</div>
</div>
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-2">
		<label>Sisa Tagihan</label>
	</div>
	<div class="col-lg-2">
		<input class="form-control" type="text" id="sisa" name="sisa" style="text-align:right" readonly />
	</div>
</div>