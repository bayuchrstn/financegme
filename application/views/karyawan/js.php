<script type="text/javascript">
	function input_karyawan()
	{
		// alert('ok');
		set_option('<?php echo base_url(); ?>select_option/karyawan/pendidikan', 'pendidikan_insert', '');
		set_option('<?php echo base_url(); ?>select_option/karyawan/agama', 'agama_insert', '');
		set_option('<?php echo base_url(); ?>select_option/karyawan/jenis_kelamin', 'jenis_kelamin_insert', '');
		set_option('<?php echo base_url(); ?>select_option/karyawan/golongan_darah', 'golongan_darah_insert', '');
		set_option('<?php echo base_url(); ?>select_option/karyawan/status_pernikahan', 'status_pernikahan_insert', '');
		set_option('<?php echo base_url(); ?>select_option/yesno', 'asuransi_insert', '');
		set_option('<?php echo base_url(); ?>select_option/karyawan/jabatan', 'jabatan_insert', '');
		set_option('<?php echo base_url(); ?>select_option/karyawan/departemen', 'departemen_insert', '');
		set_option('<?php echo base_url(); ?>select_option/yesno', 'flag_account_insert', 'Y');
		set_option('<?php echo base_url(); ?>select_option/karyawan/status_karyawan', 'status_karyawan_insert', 'aktif');
		set_option('<?php echo base_url(); ?>select_option/karyawan/level', 'usergroup_insert', '');
		set_option('<?php echo base_url(); ?>select_option/karyawan/regional', 'regional_insert', '');
		$('#modal_karyawan_insert').modal('show');
	}

	function nik_regional_onchange(regional)
    {
        block_this('nik_loader');
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>karyawan/get_next_nik/'+regional,
            success: function(res) {
                unblock_this('nik_loader');
                $('#nik_empat').val(res);
            }
        });
        return false;
    }

	function update(id)
	{
		var action = '<?php echo base_url(); ?>karyawan/update/'+id;
        block_this('js_table_karyawan');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
				$('#div_data_karyawan').load('<?php echo base_url(); ?>karyawan/ext/detail/'+response.id);
				$('#form_update_detail_karyawan').attr('action',response.action);
				$('#div_riwayat_pendidikan').load('<?php echo base_url(); ?>karyawan/ext/pendidikan/'+response.kode_karyawan);
				$('#div_pengalaman_kerja').load('<?php echo base_url(); ?>karyawan/ext/pengalaman_kerja/'+response.kode_karyawan);
				$('#div_dokumen').load('<?php echo base_url(); ?>karyawan/ext/dokumen/'+response.kode_karyawan);

                $('#modal_karyawan_update').modal('show');
                unblock_this('js_table_karyawan');
            }
        });
        return false;
	}

	function input_ext(type, person_id)
	{
		var action = '<?php echo base_url(); ?>karyawan/input_ext/'+type+'/'+person_id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

				$('#modal_people_ext_insert h4 span').html(response.modal_title);

				$('#people_ext_insert_div').html(response.form);
				$('#person_id_insert').val(response.person_id);
				$('#type_insert').val(response.type);
				$('#form_people_ext_insert').attr('action', response.action);
                $('#modal_people_ext_insert').modal('show');
            }
        });
        return false;
	}

	function update_ext(id)
	{
		var action = '<?php echo base_url(); ?>karyawan/update_ext/'+id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

                $('#modal_people_ext_update h4 span').html(response.modal_title);
                $('#people_ext_update_div').html(response.forms);

				$('#form_people_ext_update').attr('action', response.action);
				switch (response.type) {
					case 'pengalaman_kerja':
						$('#form_people_ext_update #jabatan_update').val(response.jabatan);
						$('#form_people_ext_update #jobdesc_update').val(response.jobdesc);
						$('#form_people_ext_update #gaji_update').val(response.gaji);
					break;

					case 'dokumen':
						$('#form_people_ext_update #dokumen_name_update').val(response.dokumen_name);
					break;

					default:
						$('#form_people_ext_update #nama_update').val(response.nama);
						$('#form_people_ext_update #gelar_update').val(response.gelar);
					break;
				}
				$('#form_people_ext_update #kota_update').val(response.kota);
				$('#form_people_ext_update #mulai_update').val(response.mulai);
				$('#form_people_ext_update #selesai_update').val(response.selesai);
				$('#form_people_ext_update #id_update').val(response.id);
				$('#form_people_ext_update #person_id_update').val(response.person_id);

                $('#modal_people_ext_update').modal('show');
            }
        });
        return false;
	}

	function delete_ext(id)
	{
		var action = '<?php echo base_url(); ?>karyawan/delete_ext';
		$.ajax({
			type:'POST',
			url: action,
			data: {
				'id': id,
			},
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				switch (response.detail.type) {
					case 'pengalaman_kerja':
						$('#div_pengalaman_kerja').load('<?php echo base_url(); ?>karyawan/ext/pengalaman_kerja/'+response.person_id);
					break;

					case 'dokumen':
						$('#div_dokumen').load('<?php echo base_url(); ?>karyawan/ext/dokumen/'+response.person_id);
					break;

					default:
						$('#div_riwayat_pendidikan').load('<?php echo base_url(); ?>karyawan/ext/pendidikan/'+response.detail.person_id);
					break;
				}

				create_alert('ext_update_alert', 'Data berhasil dihapus', 'bg-success');
			}
		});
		return false;
	}

	function advance_search() {
		$('#modal_karyawan_search').modal('show');
	}

	$('#flag_account_insert').change(function(){
		var flag = $(this).val();
		if(flag=='Y'){
			$('#optional_account_div').removeClass('hidden');
		} else {
			$('#optional_account_div').addClass('hidden');
		}
		return false;
	});

	$('#regional_insert').change(function(){
		block_this('nik_loader');
		var regional = $('#regional_insert').val();
		// alert(regional);
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>karyawan/get_next_nik/'+regional,
            success: function(res) {
                unblock_this('nik_loader');
                $('#nik_empat').val(res);
                $('#nik_dua').val(regional);
            }
        });
        return false;
	});
	$('#form_karyawan_search').submit(function(e){
		var action = $(this).attr('action');
		var form_data = $(this).serialize();
		$.ajax({
			type: 'POST',
			url : action,
			data: form_data,
			success: function(res){
				var response = $.parseJSON(res);
				$('#js_table_karyawan').DataTable({
					destroy: true,
					"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
		            aoColumns:[
						{"searchable": false, "orderable": false},
						{"searchable": false, "orderable": false, "visible": false},
						{"searchable": true, "orderable": false},
						{"searchable": true, "orderable": false},
						{"searchable": false, "orderable": false},
						{"searchable": false, "orderable": false},
						{"searchable": false, "orderable": false},
					],
		            "iDisplayLength": 10,
		            "order": [[ 1, "asc" ]],
					data : response.data
		        });
		        $('#modal_karyawan_search').modal('hide');
			}
		});

		e.preventDefault();
	});

</script>
