<div class="row">
	<?php //pre($detail); ?>
	<div id="detail_karyawan_msg_alert"></div>
	<form  method="post" action="" id="form_update_detail_karyawan">
		<input type="hidden" name="id" id="id">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="name" id="name" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Pendidikan</label>
					<select name="pendidikan" id="pendidikan" class="form-control">
						<!-- {pendidikan} -->
						<option value="{code}">{name}</option>
						<!-- {/pendidikan} -->
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Agama</label>
					<select class="form-control" name="agama" id="agama">
						<!-- {agama} -->
						<option value="{code}">{name}</option>
						<!-- {/agama} -->
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<div class="col-md-12">
						<label class="radio-inline">
							<input type="radio" name="kelamin" value="laki_laki"> Laki laki
						</label>
						<label class="radio-inline">
							<input type="radio" name="kelamin" value="perempuan"> Perempuan
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Golongan Darah</label>
					<select name="golongan_darah" id="golongan_darah" class="form-control">
						<!-- {golongan_darah} -->
						<option value="code">{name}</option>
						<!-- {/golongan_darah} -->
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="text" name="tanggal_lahir" id="tanggal_lahir" class="cos form-control date_picker">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Alamat Asal</label>
					<textarea name="alamat_asli" id="alamat_asli" class="form-control"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Alamat Tinggal</label>
					<textarea name="alamat_tinggal" id="alamat_tinggal" class="form-control"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Status Pernikahan</label>
					<select name="status_pernikahan" id="status_pernikahan" class="form-control">
						<!-- {status_pernikahan} -->
						<option value="{code}">{name}</option>
						<!-- {/status_pernikahan} -->
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Jumlah Anak</label>
					<input type="number" name="jumlah_anak" id="jumlah_anak" class="form-control" min="0" max="20">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Telepon</label>
					<input type="text" name="telepon" id="telepon" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Handphone</label>
					<input type="text" name="handphone" id="handphone" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" id="email" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>YM ID</label>
					<input type="text" name="ym" id="ym" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Rekening BCA</label>
					<input type="text" name="rekening" id="rekening" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Asuransi</label>
					<select name="asuransi" id="asuransi" class="form-control">
						<option value="1">Ya</option>
						<option value="0">Tidak</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Departemen</label>
					<select name="departemen" id="departemen" class="form-control">
						<!-- {departemen} -->
						<option value="{code}">{name}</option>
						<!-- {/departemen} -->
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Jabatan</label>
					<select name="jabatan" id="jabatan" class="form-control">
						<!-- {jabatan} -->
						<option value="{code}">{name}</option>
						<!-- {/jabatan} -->
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Status</label>
					<select name="status" id="status" class="form-control">
						<option>Aktif</option>
						<option>Non Aktif</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Tanggal Masuk</label>
					<input type="text" name="tanggal_masuk" id="tanggal_masuk" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Keterangan</label>
					<textarea name="note" id="note" class="form-control"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-xs-push-6 text-right">
				<button class="btn btn-success" type="submit">
					<i class="position-left icon-checkmark"></i>
					Submit
				</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	// alert('bbbb');
	var detail = <?php echo json_encode($detail); ?>

	// alert(detail.name);
	$('form#form_update_detail_karyawan').attr('action',detail.action);
	$('input#id').val(detail.id);
	$('input#name').val(detail.name);
	$('#tempat_lahir').val(detail.tempat_lahir);
	$('#tanggal_lahir').val(detail.tanggal_lahir);
	$('#alamat_asli').text(detail.alamat_asli);
	$('#alamat_tinggal').text(detail.alamat_tinggal);
	$('#pendidikan').val(detail.pendidikan);
	$('#agama').val(detail.agama);
	$('input[name="kelamin"][value="'+detail.jenis_kelamin+'"]').prop('checked', true);
	$('#telepon').val(detail.telephone);
	$('#handphone').val(detail.handphone);
	$('#email').val(detail.email);
	$('#ym').val(detail.ym);
	$('#status_pernikahan').val(detail.status_pernikahan);
	(detail.jumlah_anak!='' && detail.jumlah_anak!=null) ? $('#jumlah_anak').val(detail.jumlah_anak) : $('#jumlah_anak').val('0');
	(detail.asuransi!='' && detail.asuransi!=null) ? $('#asuransi').val(detail.asuransi) : $('#asuransi').val('0');
	$('#rekening').val(detail.bca);
	$('#departemen').val(detail.departemen);
	$('#jabatan').val(detail.jabatan);
	$('#note').text(detail.note);

	// function submit_update_detail_karyawan() {
	// 	var form = $('form#form_update_detail_karyawan');
	// 	var action = form.attr('action');
	// 	var data = serialize()
	// }
	$('form#form_update_detail_karyawan').on("submit", function(e){
		e.preventDefault();
		var action = $(this).attr('action');
		var form_data = $(this).serialize();
		$.ajax({
			type: 'POST',
			data: form_data,
			url : action,
			success: function(result) {
				var response = $.parseJSON(result);
				// alert(response.msg);
				$('#js_table_karyawan').DataTable().ajax.reload( null, false );
				create_alert('detail_karyawan_msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
			}
		});
	});

	$(function() {
	    if( $('.date_picker').length ) {

	        $( ".date_picker" ).datepicker({
	            changeMonth: true,
	            changeYear: true,
	            dateFormat: 'yy-mm-dd'
	        });
	    }

	    if( $('.datetime_picker').length ) {

	        $( ".datetime_picker" ).datetimepicker({
	            changeMonth: true,
	            changeYear: true,
	            dateFormat: 'yy-mm-dd',
	            timeFormat: 'HH:mm:ss'
	        });
	    }

	});
</script>