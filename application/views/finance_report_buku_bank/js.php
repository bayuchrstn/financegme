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
		var height_table = height_windows - height_navbar - height_page - 170;
		var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);

		table = $('#datamain_datatable').DataTable({
			dom: '<"datatable-header"B><"datatable-scroll datatable-scroll-wrap"t>',
			buttons: {
				buttons: [{
						extend: 'copyHtml5',
						className: 'btn btn-default',
						text: '<i class="icon-copy3 position-left"></i> Copy'
					},
					{
						extend: 'excelHtml5',
						className: 'btn btn-default',
						text: '<i class="icon-file-spreadsheet position-left"></i> Excel',
						fieldSeparator: '\t',
					}
				]
			},
			aaSorting: [
				[1, 'desc']
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": pageUri + 'get_data_table',
				"type": "POST",
				"data": function(data) {
					data.id_biaya = $('#id_biaya').val();
					data.search_keyword = $('#search_keyword').val();
					data.searchDateFirst = $('#searchDateFirst').val();
					data.searchDateFinish = $('#searchDateFinish').val();
					data.id_card = $('#id_card').val();
				},
				beforeSend: function() {
					blockElement('datamain_datatable_wrapper');
				},
			},
			"drawCallback": function(settings) {
				unBlockElement('datamain_datatable_wrapper');
			},
			"ordering": false,
			columnDefs: [{
				className: "text-right",
				"targets": [5, 6, 7]
			}, {
				className: "text-center",
				"targets": [1]
			}, {
				className: "text-wrap",
				"targets": [8]
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
			//scrollX: true,
			//scrollY: height_windows - 200,
			scrollX: true,
			scrollY: height_table,
			scrollCollapse: true,
			fixedColumns: {
				leftColumns: 1,
				rightColumns: 1
			},
		});

		$('#buttonPencarian').click(function() {
			gmd_finance_coa_info();
			table.ajax.reload();
		});
		$('.dataTables_length select').select2({
			minimumResultsForSearch: Infinity,
			width: 'auto',
		});
		//END SET DATATABLES

		$('#button_dropdown_search').on('click', function(e) {
			$(this).next().toggle();
		});
		$('#button_dropdown_search.keep-open').on('click', function(e) {
			e.stopPropagation();
		});
		gmd_finance_coa_info();
	});

	function gmd_finance_coa_info() {
		var pageUri = $('#pageUri').val();

		$.ajax({
			url: pageUri + 'gmd_finance_coa_info/' + $('#id_biaya').val(),
			success: function(response) {
				$('#info_coa').html(response);
			}
		});
	}

	function get_coa() {
		var pageUri = $('#pageUri').val();
		var id = $('#id_biaya').val();
		$.ajax({
			url: pageUri + 'get_card',
			data: {
				id: id
			},
			type: "POST",
			success: function(response) {
				$('#id_card').html(response);
			}
		});
	}

	function search() {
		gmd_finance_coa_info();
		table.ajax.reload();
	}

	function import_data() {
		$('#formulir_modal_import').clearForm();
		$("#formulir_modal_import").attr('transaksi', 'tambah');
		$("#title_modal_flexible").html('Tambah');
		$('#formSearch').dialog('close');
		$('#modal_finance_tax_import').modal('show');
		$('#import_table').empty();
		$('#excel_file').val('');
		return false;
	}

	function upload_file(form_id, input_id) {
		var pageUri = $('#pageUri').val();
		var form = $('#' + form_id);
		var input = $('#' + input_id);
		var tipe = $('#tipe_upload').val();

		var file_data = input.prop('files')[0];
		var form_data = new FormData();
		form_data.append(input_id, file_data);

		$.ajax({
			type: 'POST',
			data: form_data,
			url: pageUri + 'upload_file_' + tipe,
			contentType: false,
			cache: false,
			processData: false,
			success: function(response) {
				html = '';
				i = 0;
				index_approve = '';
				$.each(response['data'], function(index, value) {
					html += "<tr>";
					html += "<td>"
					html += i + 1;
					html += "</td>"
					html += "<td>"
					html += '<p>' + value['sheet_name'] + '</p>';
					html += "</td>"
					html += "<td>"
					html += '<p>' + value['jumlah_data'] + '</p>';
					html += "</td>"
					html += "<td>"
					html += value['cekformat'] == 'format diterima' ? '<p style="color:green">' + value['cekformat'] + '</p>' : '<p style="color:red">' + value['cekformat'] + '</p>';
					html += "</td>"
					html += "</tr>";
					if (value['cekformat'] == 'format diterima') {
						index_approve += i == 0 ? value['sheet_name'] : ',' + value['sheet_name']
					}
					i++;
				});
				$('#id_confirmed').val(index_approve);
				$('#location_file').val(response['excel_tmp']);
				$('#import_table').html(html);
				toastr.success('berhasil membaca data excel');
			},
			error: function(request, status, error) {
				toastr.error('tidak berhasi membaca file excel');
			}
		});
	}

	$('#formulir_modal_import').submit(function(event) {
		var tipe = $('#tipe_upload').val();

		if ($('#id_confirmed').val !== '') {

			$.ajax({
				type: 'POST',
				url: $('#pageUri').val() + 'import_' + tipe,
				data: $('#formulir_modal_import').serialize(),
				beforeSend: function() {
					blockUI();
				},
				success: function(response) {
					if (response['status'] == "success") {
						toastr.success(response['message']);
						table.ajax.reload(null, false);
						$('#modal_finance_tax_import').modal('hide');
					} else {
						toastr.error(response['message']);
					}
					unBlockUI();

				}
			});
			return false;
		} else {
			return false;
		}

	});

	function update_data(id) {
		var pageUri = $('#pageUri').val();
		$("#formulir_modal").attr('transaksi', 'edit');
		$('#id').val(id);

		$.ajax({
			type: 'POST',
			data: $('#formulir_modal').serialize(),
			url: pageUri + 'select_data',
			dataType: "json",
			success: function(html) {
				if (html != '') {
					$.each(html, function(i, n) {
						$('#id').val(id);
						$('#ket').val(n['detail']);
						$('#modal_finance_coa').modal('show');
					});
				} else {
					alert('Data tidak ditemukan');
				}
			}
		});
	}

	$("#formulir_modal").validate({
		rules: {},
		submitHandler: function(form) {
			var cekTransaksi = $("#formulir_modal").attr('transaksi');
			var pageUri = $('#pageUri').val();
			if (cekTransaksi == 'edit') {
				$.ajax({
					type: 'POST',
					url: pageUri + 'edit_data',
					data: $('#formulir_modal').serialize(),
					beforeSend: function() {
						blockUI();
					},
					success: function(response) {
						if (response == '1') {
							$('#formulir_modal').clearForm();
							toastr.success('Data berhasil disimpan');
							table.ajax.reload(null, false);
						} else if (response == '0') {
							toastr.warning('Data gagal disimpan');
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

	function clearDetTransaksi() {
		$('#id_rek').val('');
		$('#result_no_invoice').val('');
	}

	function check_bank(obj) {
		var ket = $(obj).val();
		if (ket == '3' || ket == '4' || ket == '5' || ket == '6' || ket == '11' || ket == '14') {
			$("#tipe_upload").val('bca');
			toastr.success("Format Tersedia");
			$("#excel_file").css("display", "block");
		} else if (ket == '7') {
			$("#tipe_upload").val('bri');
			toastr.success("Format Tersedia");
			$("#excel_file").css("display", "block");
		} else if (ket == '8') {
			$("#tipe_upload").val('bni');
			toastr.success("Format Tersedia");
			$("#excel_file").css("display", "block");
		} else {
			toastr.warning("Format Belum Tersedia");
			$("#excel_file").css("display", "none");
		}
	}
</script>