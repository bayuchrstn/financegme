<input type="hidden" id="id" name="id" />
<input class="nip_id" type="hidden" id="<?= $this->session->userdata('nip'); ?>" name="nip_request">
<div class="row">
	<div class="col-lg-6">
		<label>customer site</label>
		<select class="form-control" id="id_client" name="id_client" onchange="get_so(this)">
	</select>
	</div>

	<div class="col-lg-6">
		<label>Nomor So</label>
		<select class="form-control" id="no_so" name="nomor_so"></select>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<label>Jenis Terminate</label>
		<select class="form-control" id="jenis_terminate" name="jenis_terminate">
			<option value="1">Sementara</option>
			<option value="2">Permanen</option>
		</select>
	</div>
	<div class="col-lg-6">
		<label>Tanggal Terminate</label>
		<input class="form-control" type="text" id="tgl_terminate" name="tgl_terminate" />
	</div>
	<!-- <div class="col-lg-6">
		<label>Tanggal Dismantle</label>
		<input class="form-control" type="text" id="tgl_dismantle" name="tgl_dismantle" />
	</div> -->
</div>
<div class="row">
	<div class="col-lg-12">
	<label>Alasan Terminate</label>
		<textarea class="form-control" type="text" id="alasan_terminate" name="alasan_terminate"></textarea>
	</div>
</div>