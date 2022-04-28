<script type="text/javascript">
	$(function() {
		var pageUri = $('#pageUri').val();

		//SET DATATABLES
		$.extend($.fn.dataTable.defaults, {
			//autoWidth: true,
			"sLength": "form-control"
		});
		var height_windows = $(window).height();
		var height_navbar = $('#navbar-main').height();
		var height_page = $('#page-header').height();
		var height_table = height_windows - height_navbar - height_page - 315;
		var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);

		table = $('#datamain_datatable').DataTable({
			dom: '<"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"pli>',
			"pageLength": 100,
			aaSorting: [
				[1, 'asc']
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": pageUri + 'get_data_table',
				"type": "POST",
				"data": function(data) {
					data.search_keyword = $('#search_keyword').val();
				},
				beforeSend: function() {
					blockElement('datamain_datatable_wrapper');
				},
			},
			"drawCallback": function(settings) {
				unBlockElement('datamain_datatable_wrapper');
			},
			columnDefs: [{
				orderable: false,
				width: '120px',
				targets: [0, tabel_kolom]
			}, {
				className: "text-right",
				"targets": [0]
			}, {
				className: "text-center",
				"targets": [tabel_kolom]
			}],
			language: {
				lengthMenu: '<span>Show:</span> _MENU_',
				paginate: {
					'first': 'First',
					'last': 'Last',
					'next': '&rarr;',
					'previous': '&larr;'
				}
			},
			scrollX: true,
			scrollY: height_table,
			scrollCollapse: false,
			fixedColumns: {
				leftColumns: 0,
				rightColumns: 1
			},
		});

		$('#buttonPencarian').click(function() {
			table.ajax.reload(null, false);
		});
		$('.dataTables_length select').select2({
			minimumResultsForSearch: Infinity,
			width: 'auto',
		});
		//END SET DATATABLES

		$("#formulir_modal").validate({
			rules: {
				nama: {
					required: true
				},
				account_name: {
					required: true
				},
				account_number: {
					required: true
				},
				tambah_account_name: {
					required: true
				},
				card_id: {
					required: true
				}
			},
			submitHandler: function(form) {
				var cekTransaksi = $("#formulir_modal").attr('transaksi');
				if (cekTransaksi == 'tambah') {
					$.ajax({
						type: 'POST',
						url: pageUri + 'insert_data',
						data: $('#formulir_modal').serialize(),
						beforeSend: function() {
							blockUI();
						},
						success: function(response) {
							if (response == '1') {
								$('#formulir_modal').clearForm();
								$('#card_id').val('');
								toastr.success('Data berhasil disimpan');
								table.ajax.reload(null, false);
							} else if (response == '0') {
								toastr.warning('Data gagal disimpan');
							} else if (response == '2') {
								toastr.warning('Kode Coa telah dipakai');
							} else {
								toastr.error(response);
							}
							unBlockUI();
						}
					});
				} else if (cekTransaksi == 'edit') {
					$.ajax({
						type: 'POST',
						url: pageUri + 'edit_data',
						data: $('#formulir_modal').serialize(),
						beforeSend: function() {
							blockUI();
						},
						success: function(response) {
							if (response == '1') {
								toastr.success('Data berhasil disimpan');
								table.ajax.reload(null, false);
								$('#modal_dialog_formulir').modal('hide');
							} else if (response == '0') {
								toastr.warning('Data gagal disimpan');
							} else if (response == '2') {
								toastr.warning('Kode Coa telah dipakai');
							} else {
								toastr.error(response);
							}
							unBlockUI();
						}
					});
				}
				return false;
			}
		});

		$("#tambah_account_no").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: pageUri + 'select_autocomplite_coa_id',
					dataType: "json",
					type: 'POST',
					data: {
						term: request.term,
					},
					success: function(data) {
						response(data);
					}
				});
			},
			minLength: 1,
			select: function(event, ui) {
				$('#tambah_account_id, #tambah_account_no').val(ui.item.id);
				$('#tambah_account_name').val(ui.item.nama);
				return false;
			}
		}).autocomplete("instance")._renderItem = function(ul, item) {
			var hasil_result = "<div>";
			hasil_result += "<b>" + item.id + "</b> - " + item.nama;
			hasil_result += "</div>";
			return $("<li>")
				.append(hasil_result)
				.appendTo(ul);
		};

	});

	function open_search() {
		$('#formSearch').dialog('open');
		return false;
	}

	function input_data() {
		$('#formulir_modal').clearForm();
		$("#formulir_modal").attr('transaksi', 'tambah');
		$("#title_modal_flexible").html('Tambah');
		$('#formSearch').dialog('close');
		$('#modal_dialog_formulir').modal('show');
		return false;
	}

	function view_data(id) {
		var pageUri = $('#pageUri').val();
		$("#formulir_modal").attr('transaksi', 'edit');
		$("#title_modal_flexible").html('Edit');
		$('#id').val(id);

		$.ajax({
			type: 'POST',
			data: $('#formulir_modal').serialize(),
			url: pageUri + 'select_data',
			dataType: "json",
			beforeSend: function() {
				blockUI();
			},
			success: function(html) {
				if (html != '') {
					$.each(html, function(i, n) {
						$('#id').val(id);
						$('#nama').val(n["nama"]);
						$('#tambah_account_id, #tambah_account_no').val(n["coa"]);
						$('#tambah_account_name').val(n["nama_coa"]);
						$('#card_id').val(n["code_card"]);
						$('#modal_dialog_formulir').modal('show');
						unBlockUI();
					});
				} else {
					alert('Data tidak ditemukan');
					unBlockUI();
				}
			}
		});
	}

	function delete_data(id) {
		var pageUri = $('#pageUri').val();

		if (confirmProses('Yakin ingin menghapus data?') == true) {
			$.ajax({
				type: 'GET',
				url: pageUri + 'delete_data/' + id,
				beforeSend: function() {
					blockUI();
				},
				success: function(response) {
					if (response == '1') {
						table.ajax.reload(null, false);
						toastr.success('Data berhasil dihapus');
					} else if (response == '0') {
						toastr.warning('Data gagal dihapus');
					} else {
						toastr.error(response);
					}
					unBlockUI();
				}
			});
		}
	}
</script>