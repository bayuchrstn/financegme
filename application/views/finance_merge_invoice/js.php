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
		var height_table = height_windows - height_navbar - height_page - 270;
		var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);

		table = $('#datamain_datatable').DataTable({
			dom: '<"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"pli>',
			"pageLength": 100,
			aaSorting: [
				[1, 'asc']
			],
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"ajax": {
				"url": pageUri + 'get_data_table',
				"type": "POST",
				"data": function(data) {
					data.search_keyword = $('#search_keyword').val();
					data.searchbranch = $('#searchkategori1').val();
					data.searchppn = $('#searchkategori2').val();
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
				width: '180px',
				targets: [tabel_kolom]
			}, {
				className: "text-center",
				"targets": [tabel_kolom, ]
			}, ],
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
				leftColumns: 1,
				rightColumns: 1
			},
		});

		$('#buttonPencarian').click(function() {
			table.ajax.reload(null, false);
			$('#formSearch').close();
			$('#button_form_dropdown_search').next().toggle();
		});
		$('.dataTables_length select').select2({
			minimumResultsForSearch: Infinity,
			width: 'auto',
		});
		//END SET DATATABLES
		table2 = $("#example_select").DataTable({
			processing: true,
			responsive: true,
			ajax: pageUri + "get_data_mssite/" + $("#custname").val(),
			order: [
				[1, 'asc']
			],
			columns: [{
					className: 'pick'
				}, {
					className: 'text-center'
				},
				{
					className: 'text-left'
				},
			],
			columnDefs: [{
				'targets': 0,
				"orderable": false,
				"width": "25px",
				'checkboxes': {
					'selectRow': true
				}
			}, {
				'targets': 1,
				"width": "25px"
			}],
			responsive: !0,
			order: [
				[0, "asc"]
			],
			lengthChange: false,
			searching: false
		});
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

	function search_data() {
		table.ajax.reload(null, false);
	}



	$(document).ready(function() {
		var pageUri = $('#pageUri').val();
		$("#example_select").DataTable();
		$("#custname").select2({
			placeholder: "Pilih Nama Customer",
			width: "100%",
			ajax: {
				url: pageUri + "get_nama",
				type: "post",
				dataType: 'json',
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});

	$("#custname").change(function() {
		var pageUri = $('#pageUri').val();
		var id = $("#custname").val();
		if (id != null) {
			var cekTransaksi = $("#formulir_modal").attr('transaksi');
			if (cekTransaksi == 'tambah') {
				table2.destroy();
				table2 = $("#example_select").DataTable({
					processing: true,
					responsive: true,
					ajax: pageUri + "get_data_mssite/" + id,
					order: [
						[1, 'asc']
					],
					columns: [{
							className: 'pick'
						}, {
							className: 'text-center'
						},
						{
							className: 'text-left'
						},
					],
					columnDefs: [{
						'targets': 0,
						"orderable": false,
						'width': "25px",
						'checkboxes': {
							'selectRow': true
						}
					}, {
						'targets': 1,
						"width": "25px"
					}],
					select: {
						'style': 'multi'
					},
					responsive: !0,
					order: [
						[0, "asc"]
					],
					lengthChange: false,
					searching: false
				});
			} else {
				table2.destroy();
				table2 = $("#example_select").DataTable({
					processing: true,
					responsive: true,
					ajax: pageUri + "get_data_mssite2/" + id,
					order: [
						[1, 'asc']
					],
					columns: [{
							className: 'pick'
						}, {
							className: 'text-center'
						},
						{
							className: 'text-center'
						},
					],
					columnDefs: [{
						'targets': 0,
						"orderable": false,
						'width': "25px",
						'checkboxes': {
							'selectRow': true
						}
					}, {
						'targets': 1,
						"width": "25px"
					}],
					select: {
						'style': 'multi'
					},
					responsive: !0,
					order: [
						[0, "asc"]
					],
					lengthChange: false,
					searching: false
				});
			}
		} else {
			table2.destroy();
			table2 = $("#example_select").DataTable({
				processing: true,
				responsive: true,
				ajax: pageUri + "get_data_mssite/" + id,
				order: [
					[1, 'asc']
				],
				columns: [{
						className: 'pick'
					}, {
						className: 'text-center'
					},
					{
						className: 'text-center'
					},
				],
				columnDefs: [{
					'targets': 0,
					"orderable": false,
					'width': "25px",
					'checkboxes': {
						'selectRow': true
					}
				}, {
					'targets': 1,
					"width": "25px"
				}],
				select: {
					'style': 'multi'
				},
				responsive: !0,
				order: [
					[0, "asc"]
				],
				lengthChange: false,
				searching: false
			});
		}
	});

	function clear_form() {
		$("#custname").val('').trigger('change');
	}

	$("#add_new").click(function() {
		$("#addnew").modal({
			backdrop: 'static',
			keyboard: false,
		});
		$("#formulir_modal").attr('transaksi', 'tambah');
		clear_form();

	});

	$('.simpan').click(function() {
		var pageUri = $('#pageUri').val();
		var qty = table2.rows('.selected').data().length;
		var a = [];
		for (var i = 0; i < qty; i++) {
			a.push(table2.rows('.selected').data()[i][1]);
		}
		var id_cust = $('#custname').val();
		var id = $('#id').val();
		var cekTransaksi = $("#formulir_modal").attr('transaksi');
		if (cekTransaksi == 'tambah') {
			$.ajax({
				type: 'POST',
				url: pageUri + "insert_data",
				data: {
					id_site: a,
					id_cust: id_cust,
					id: id
				},
				success: function(response) {
					if (response.sukses) {
						table.ajax.reload(null, false);
						clear_form();
						toastr.success(response.message);
						$('#addnew').modal('hide');
					} else if (response.gagal) {
						toastr.warning(response.message);
					} else {
						toastr.error('Terjadi kesalahan saat menyimpan data');
					}
				}
			});
		} else if (cekTransaksi == 'edit') {
			$.ajax({
				type: 'POST',
				url: pageUri + 'update_data',
				data: {
					id_site: a,
					id_cust: id_cust,
					id: id
				},
				success: function(response) {
					if (response.sukses) {
						toastr.success(response.message);
						clear_form();
						table.ajax.reload(null, false);
						$('#addnew').modal('hide');
					} else if (response.gagal) {
						toastr.warning(response.message);
					} else {
						toastr.error('Terjadi kesalahan saat mengupdate data');
					}
				}
			});
		}
		return false;
	});

	$('.display tbody').on('click', '.dt-checkboxes', function() {
		$(this).closest('tr').toggleClass('selected');
		var qty = table2.rows('.selected').data().length;
		if (qty >= 2) {
			$('.simpan').show("normal");
		} else {
			$('.simpan').hide("normal");
		}

	});


	function edit_data(id) {
		var pageUri = $('#pageUri').val();
		$("#formulir_modal").attr('transaksi', 'edit');
		$('#id').val(id);

		$.ajax({
			type: 'POST',
			data: {
				id: id
			},
			url: pageUri + 'select_data',
			dataType: "json",
			success: function(response) {
				if (response != '') {
					$('#addnew').modal('show');
					$('#custname').empty().append($("<option/>").val(response.id_cust).text(response.nama_cust)).trigger('change');

				} else {
					toastr.error('Data tidak ditemukan');
				}
			}
		});
	}

	function delete_data(id) {
		var pageUri = $('#pageUri').val();
		swal({
			title: "Apakah Anda yakin?",
			text: "Anda akan menghapus data ini",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya, hapus!",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				type: 'GET',
				url: pageUri + 'delete_settingmerge/' + id,
				success: function(response) {
					if (response.sukses) {
						toastr.success(response.message);
						table.ajax.reload(null, false);
						swal.close();
					} else if (response.gagal) {
						toastr.warning(response.message);
					} else {
						toastr.error('Terjadi kesalahan saat menghapus data');
					}
				}
			});
		});
	};
</script>