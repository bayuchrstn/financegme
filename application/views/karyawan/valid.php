<script type="text/javascript">
	$(document).ajaxComplete(function(){

		$("#form_people_ext_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                nama: {required: true},
                // body_fake: {required: true},
            },

            messages: {
                nama: {required: "nama harus diisi"},
                // body_fake: {required: "isi Laporan harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_people_ext_update').attr('action'),
                    data  : $('#form_people_ext_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						switch (response.ext_type) {
							case 'pengalaman_kerja':
								$('#div_pengalaman_kerja').load('<?php echo base_url(); ?>karyawan/ext/pengalaman_kerja/'+response.kode_karyawan);
							break;

							case 'dokumen':
								$('#div_dokumen').load('<?php echo base_url(); ?>karyawan/ext/dokumen/'+response.kode_karyawan);
							break;

							default:
								$('#div_riwayat_pendidikan').load('<?php echo base_url(); ?>karyawan/ext/pendidikan/'+response.kode_karyawan);
							break;
						}
						if(response.status=='success'){
							create_alert('ext_update_alert', 'Data berhasil disimpan', 'bg-success');
						} else {
							create_alert('ext_update_alert', 'Data gagal disimpan', 'bg-danger');
						}
						$('#modal_people_ext_update').modal('hide');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#form_people_ext_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                nama: {required: true},
                // body_fake: {required: true},
            },

            messages: {
                nama: {required: "nama harus diisi"},
                // body_fake: {required: "isi Laporan harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_people_ext_insert').attr('action'),
                    data  : $('#form_people_ext_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						switch (response.type) {
							case 'pengalaman_kerja':
								$('#div_pengalaman_kerja').load('<?php echo base_url(); ?>karyawan/ext/pengalaman_kerja/'+response.kode_karyawan);
							break;

							case 'dokumen':
								$('#div_dokumen').load('<?php echo base_url(); ?>karyawan/ext/dokumen/'+response.kode_karyawan);
							break;

							default:
								$('#div_riwayat_pendidikan').load('<?php echo base_url(); ?>karyawan/ext/pendidikan/'+response.kode_karyawan);
							break;
						}

						if(response.status=='success'){
							create_alert('ext_update_alert', 'Data berhasil disimpan', 'bg-success');
						} else {
							create_alert('ext_update_alert', 'Data gagal disimpan', 'bg-danger');
						}
						$('#modal_people_ext_insert').modal('hide');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#form_karyawan_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                name: {required: true},
                pendidikan: {required: true},
                agama: {required: true},
                jenis_kelamin: {required: true},
                tempat_lahir: {required: true},
                tanggal_lahir: {required: true},
                alamat_asli: {required: true},
                alamat_tinggal: {required: true},
                status_pernikahan: {required: true},
                email: {required: true},
                departemen: {required: true},
                jabatan: {required: true},
                status_karyawan: {required: true},
            },

            messages: {
                name: {required: "nama harus diisi"},
                pendidikan: {required: "Pendidikan harus diisi"},
                agama: {required: "Agama harus diisi"},
                jenis_kelamin: {required: "Jenis Kelamin harus diisi"},
                tempat_lahir: {required: "Tempat lahir harus diisi"},
                tanggal_lahir: {required: "Tanggal lahir harus diisi"},
                alamat_asli: {required: "Alamat asli harus diisi"},
                alamat_tinggal: {required: "Alamat tinggal harus diisi"},
                status_pernikahan: {required: "Status pernikahan harus diisi"},
                email: {required: "Email harus diisi"},
                departemen: {required: "Departemen harus diisi"},
                jabatan: {required: "jabatan harus diisi"},
                status_karyawan: {required: "Status karyawan harus diisi"},
                // body_fake: {required: "isi Laporan harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_karyawan_insert').attr('action'),
                    data  : $('#form_karyawan_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);



						// if(response.status=='success'){
						// 	create_alert('ext_update_alert', 'Data berhasil disimpan', 'bg-success');
						// } else {
						// 	create_alert('ext_update_alert', 'Data gagal disimpan', 'bg-danger');
						// }
						// $('#modal_people_ext_insert').modal('hide');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

	});
</script>
