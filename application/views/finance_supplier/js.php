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
		var height_table = height_windows - height_navbar - height_page - 370;
		var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);

		table = $('#datamain_datatable').DataTable({
			dom: '<"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"pli>',
			"pageLength": 25,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
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
				width: '60px',
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
				rightColumns: 0
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
				name: {
					required: true
				},
				account_name: {
					required: true
				},
				account_number: {
					required: true
				},
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
								alert('Data berhasil disimpan');
								table.ajax.reload(null, false);
							} else if (response == '0') {
								alert('Data gagal disimpan');
							} else {
								alert(response);
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
								alert('Data berhasil disimpan');
								table.ajax.reload(null, false);
							} else if (response == '0') {
								alert('Data gagal disimpan');
							} else {
								alert(response);
							}
							unBlockUI();
						}
					});
				}
				return false;
			}
		});

		// get_tabel_data();
	});

	function searchTable() {
		var pageUri = $('#pageUri').val();

		$('#tableData').flexOptions({
			url: pageUri + 'get_data_table',
			params: [{
				name: 'callId',
				value: 'tableData'
			}].concat($('#pencarian').serializeArray()),
		}).flexReload();
	}

	// function get_tabel_data() {
	// 	var pageUri = $('#pageUri').val();

	// 	$("#tableData").flexigrid({
	// 		url: pageUri + 'get_data_table',
	// 		params: [{
	// 			name: 'callId',
	// 			value: 'tableData'
	// 		}].concat($('#pencarian').serializeArray()),
	// 		dataType: 'json',
	// 		colModel: [{
	// 				display: 'no',
	// 				name: 'no',
	// 				width: 30,
	// 				sortable: false,
	// 				align: 'right'
	// 			},
	// 			{
	// 				display: 'Nama',
	// 				name: 'a.name',
	// 				width: 200,
	// 				sortable: true,
	// 				align: 'left'
	// 			},
	// 			{
	// 				display: 'atas nama',
	// 				name: 'a.account_name',
	// 				width: 200,
	// 				sortable: true,
	// 				align: 'left'
	// 			},
	// 			{
	// 				display: 'no referensi',
	// 				name: 'a.account_number',
	// 				width: 200,
	// 				sortable: true,
	// 				align: 'left'
	// 			},
	// 			{
	// 				display: '#',
	// 				name: 'edit',
	// 				width: 50,
	// 				sortable: false,
	// 				align: 'left'
	// 			}
	// 		],
	// 		sortname: "a.name",
	// 		sortorder: "asc",
	// 		usepager: true,
	// 		useRp: true,
	// 		rp: 100,
	// 		showTableToggleBtn: false,
	// 		width: '100%',
	// 		height: $(window).height() - 260,
	// 		singleSelect: true,
	// 	});
	// }

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
						alert('Data berhasil dihapus');
					} else if (response == '0') {
						alert('Data gagal dihapus');
					} else {
						alert(response);
					}
					unBlockUI();
				}
			});
		}
	}
</script>