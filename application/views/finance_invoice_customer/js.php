<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ColReorderWithResize.js"></script> -->
<script type="text/javascript">
	$(function() {
		var pageUri = $('#pageUri').val();

		// SET DATATABLES
		$.extend($.fn.dataTable.defaults, {
			//autoWidth: true,
			"sLength": "form-control"
		});
		var height_windows = $(window).height();
		var height_navbar = $('#navbar-main').height();
		var height_page = $('#page-header').height();
		var height_table = height_windows - height_navbar - height_page - 310;
		var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);

		table = $('#datamain_datatable').DataTable({
			dom: 'B J<"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"pli>',
			buttons: {
				buttons: [{
					extend: 'excelHtml5',
					className: 'btn btn-default btn-raised',
					text: '<i class="icon-file-spreadsheet position-left"></i> Excel',
					fieldSeparator: '\t',
				}]
			},
			"pageLength": 25,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			aaSorting: [
				[1, 'asc']
			],
			"processing": true,
			"ajax": {
				"url": pageUri + 'get_data_table',
				"type": "POST",
				"data": function(data) {
					data.search_keyword = $('#search_keyword').val();
					data.searchDateFirst = $('#searchDateFirst').val();
					data.searchDateFinish = $('#searchDateFinish').val();
					data.searchkategori = $('#searchkategori').val();
					data.searchkat_inv = $('#searchkat_inv').val();
					data.searchstatus_inv = $('#searchstatus_inv').val();
					data.searchlunas = $('#searchlunas').val();
					data.sortid = $('#sortbyid').val();
				},
				beforeSend: function() {
					blockElement('datamain_datatable_wrapper');
				},
			},
			"drawCallback": function(settings) {
				unBlockElement('datamain_datatable_wrapper');
			},
			columnDefs: [{
				className: "text-center",
				orderable: false,
				targets: [14]
			}, {
				orderable: false,
				targets: 0
			}, {
				orderable: false,
				targets: -1,
			}, {
				orderable: false,
				width: '150px',
				targets: [tabel_kolom]
			}, {
				className: "text-right",
				"targets": [, 9, 10, 11, 12, 13, 14]
			}, {
				className: "text-left",
				width: '400px',
				"targets": [6]
			}, {
				className: "text-center",
				"targets": [0, 1, 2]
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
			fixedColumns: {
				leftColumns: 1,
				rightColumns: 1
			},
			colReorder: {
				fixedColumnsLeft: 1,
				fixedColumnsRight: 1
			},
			"footerCallback": function(row, data, start, end, display) {
				var api = this.api(),
					data;

				// Remove the formatting to get integer data for summation
				var intVal = function(i) {
					return typeof i === 'string' ? i.split(',').join('') * 1 :
						typeof i === 'number' ?
						i : 0;
				};

				// Total over all pages
				total = api
					.column(15)
					.data()
					.reduce(function(a, b) {
						return intVal(a) + intVal(b);
					}, 0);

				// Total over this page
				pageTotal = api
					.column(15, {
						page: 'current'
					})
					.data()
					.reduce(function(a, b) {
						return intVal(a) + intVal(b);
					}, 0);
				// Update footer

				$(api.column(15).footer()).html(

					convertToRupiah(pageTotal) + ',-&nbsp;'
				);
			},
			rowCallback: function(row, data) {
				// Set the checked state of the checkbox in the table
				$('input.editor-active', row).prop('checked', data.active == 1);
			}

		});
		new $.fn.dataTable.FixedColumns(table, {
			leftColumns: 1,
			rightColumns: 1
		});

		function convertToRupiah(angka) {
			var rupiah = '';
			var angkarev = angka.toString().split('').reverse().join('');
			for (var i = 0; i < angkarev.length; i++)
				if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ',';
			return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
		}

		$('#buttonPencarian').click(function() {
			table.ajax.reload(null, false);
			$('#button_form_dropdown_search').next().toggle();
		});

		$('#search_keyword').keyup(function() {
			table.ajax.reload(null, false);
		});
		$('.dataTables_length select').select2({
			minimumResultsForSearch: Infinity,
			width: 'auto',
		});

		//END SET DATATABLES

		$("#modalGenerateInvoice:ui-dialog").dialog("destroy");
		$("#modalGenerateInvoice").dialog({
			title: "Form Ganerate Invoice",
			autoOpen: false,
			resizable: false,
			closeOnEscape: false,
			width: 400,
			modal: false,
			position: "top",
			draggable: false,
			closeText: '',
			position: {
				my: "right top",
				at: "right top",
				of: '#tombol_open_generate_invoice'
			},
		});

		$("#formulir_modal").validate({
			rules: {
				service_id_val: {
					required: true
				},
				nama: {
					required: true
				},
				customer_id: {
					required: true
				},
				customer_group_name: {
					required: true
				},
				date_invoice: {
					required: true
				},
				date_due: {
					required: true
				},
				periode_invoice: {
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
								$("#tabelDetailInvoice tbody tr.remove").remove();
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
								var id = $('#id').val();
								$('#formulir_modal').clearForm();
								$("#tabelDetailInvoice tbody tr.remove").remove();
								toastr.success('Data berhasil disimpan');
								table.ajax.reload(null, false);
								update_data(id);
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
		$("#tambah_service_produk").click(function() {
			$('#sel_tambah_service_produk').val('').change();
		});

		invoice_info();

	});

	function head_data(elem) {
		var id = $(elem).attr("id");
		$('#no_invoice').val(id);
		get_head(id);
	}

	function get_head(id) {
		var pageUri = $('#pageUri').val();
		$.ajax({
			type: 'POST',
			data: {
				id: id
			},
			dataType: 'JSON',
			url: pageUri + 'get_header',
			success: function(response) {
				$('#pilihhead').html(response.data);
				$('input:radio[name="header"][value=' + response.id + ']').prop('checked', true);
				$('#modalHeader').modal('show');
			}
		});
	}

	function set_head() {
		var pageUri = $('#pageUri').val();
		var id = $('#no_invoice').val();
		var id_head = $("input[name='header']:checked").val();
		$.ajax({
			type: 'POST',
			data: {
				id: id,
				id_head: id_head
			},
			dataType: 'JSON',
			url: pageUri + 'set_header',
			success: function(response) {
				if (response = 1) {
					window.open(pageUri + 'print_selected' + '?inv=' + id, '_blank ');
					$('#modalHeader').modal('hide');
				}
			}
		});
	}

	function removefixedheader() {
		$('.DTFC_LeftHeadWrapper').closest('.DTFC_LeftWrapper').remove();
	}

	function toggle(source) {
		removefixedheader();
		checkboxes = document.getElementsByClassName('check_invoice');
		for (var i = 0, n = checkboxes.length; i < n; i++) {
			checkboxes[i].checked = source.checked;
		}
		$('.check_invoice').change();
	}

	function open_search() {
		$('#formSearch').dialog('open');
		return false;
	}

	function input_data() {
		$('#formulir_modal2').clearForm();
		$("#tabelDetailInvoice tbody tr.remove").remove();
		$("#formulir_modal2").attr('transaksi', 'tambah');
		$("#title_modal_flexible").html('Tambah');
		$('#formSearch').dialog('close');
		$('#modal_dialog_formulir2').modal('show');
		return false;
	}

	$(document).on('change', '.check_invoice', cekinvo);

	function cekinvo() {
		var m = $('input[type="checkbox"][name="invoice"]:checked').map(function() {
			return this.value;
		}).get().join(',');
		var n = m.length;
		if (m != '') {
			$("#printinv").show();
			$("#emailinv").show();
			$("#fakturinv").show();
		}
		if (n > 5) {
			document.getElementById("mergeinv").style.display = "inline";
		}
		if (n <= 5 && n > 0) {
			document.getElementById("mergeinv").style.display = "none";
		}
		if (n < 1) {
			$("#printinv").hide();
			$("#emailinv").hide();
			$("#fakturinv").hide();
			$("#mergeinv").hide();
		}
	}

	$("#printinv").click(function() {
		var pageUri = $('#pageUri').val();
		var checkboxinvo = [];
		var n = '';
		$('input[type="checkbox"][name="invoice"]:checked').each(function(index, elem) {
			checkboxinvo.push($(elem).val());
		});
		n = checkboxinvo.join(',');
		if (n != '') {
			$.ajax({
				type: 'POST',
				url: pageUri + 'get_print',
				data: {
					inv: n
				},
				beforeSend: function() {
					blockUI();
				},
				success: function(response) {
					if (response == 1) {
						$('.check_invoice').attr('checked', false);
						$("#tabelDetailInvoice tbody tr.remove").remove();
						toastr.success('Invoice siap dicetak');
						table.ajax.reload(null, false);
						window.open(pageUri + 'print_selected' + '?inv=' + n, '_blank ');
					} else if (response == 0) {
						toastr.warning('Invoice gagal dicetak');
					} else {
						toastr.error(response);
					}
					unBlockUI();
				}
			});
		}


	});


	$("#fakturinv").click(function() {
		var pageUri = $('#pageUri').val();
		var checkboxinvo = [];
		var n = '';
		$('input[type="checkbox"][name="invoice"]:checked').each(function(index, elem) {
			checkboxinvo.push($(elem).val());
		});
		n = checkboxinvo.join(',');
		if (n != '') {
			$.ajax({
				type: 'POST',
				url: pageUri + 'faktur_selected',
				data: {
					inv: n
				},
				beforeSend: function() {
					blockUI();
				},
				success: function(response) {
					if (response == 1) {
						$('.check_invoice').attr('checked', false);
						$("#tabelDetailInvoice tbody tr.remove").remove();
						toastr.success('Faktur berhasil dibuat');
						table.ajax.reload(null, false);
					} else if (response == 0) {
						toastr.warning('Faktur gagal dibuat');
					} else {
						toastr.error(response);
					}
					unBlockUI();
				}
			});
		}
	});

	$("#emailinv").click(function() {
		var pageUri = $('#pageUri').val();
		var checkboxinvo = [];
		var n = '';
		$('input[type="checkbox"][name="invoice"]:checked').each(function(index, elem) {
			checkboxinvo.push($(elem).val());
		});
		n = checkboxinvo.join(',');
		if (n != '') {
			$.ajax({
				type: 'POST',
				url: pageUri + 'email_selected',
				data: {
					inv: n
				},
				beforeSend: function() {
					blockUI();
				},
				success: function(response) {
					if (response == 1) {
						$('.check_invoice').attr('checked', false);
						$("#tabelDetailInvoice tbody tr.remove").remove();
						toastr.success('Invoice berhasil dikirim');
						table.ajax.reload(null, false);
					} else if (response == 0) {
						toastr.warning('Invoice gagal dikirim');
					} else {
						toastr.error(response);
					}
					unBlockUI();
				}
			});
		}
	});

	// $(document).ready(function() {
	// 	var pageUri = $('#pageUri').val();
	// 	$("#service_id_val").select2({
	// 		placeholder: "Masukan Service ID",
	// 		width: "100%",
	// 		ajax: {
	// 			url: pageUri + 'select_autocomplite_service',
	// 			type: "post",
	// 			dataType: 'json',
	// 			data: function(params) {
	// 				return {
	// 					searchTerm: params.term
	// 				};
	// 			},
	// 			processResults: function(response) {
	// 				return {
	// 					results: response
	// 				};
	// 			},
	// 			cache: true
	// 		}
	// 	});
	// });

	$(document).ready(function() {
		var pageUri = $('#pageUri').val();
		$("#sel_tambah_service_produk").select2({
			placeholder: "Masukan Layanan",
			width: "100%",
			ajax: {
				url: pageUri + 'select_autocomplite_layanan',
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

		$("#id_client").select2({
			placeholder: "Jika Kosong,Generate Semua",
			width: "100%",
			ajax: {
				url: pageUri + 'get_cust_site',
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
	$("#sel_tambah_service_produk").change(function() {
		$('#tambah_service_produk').val('');
	});

	// $("#service_id_val").change(function() {
	// 	var pageUri = $('#pageUri').val();
	// 	var id = $('#service_id_val').val();
	// 	$('#ppn,#service_id,#customer_id,#nama,#customer_group_name').val('');
	// 	$.ajax({
	// 		type: 'POST',
	// 		data: $('#formulir_modal').serialize(),
	// 		url: pageUri + 'select_autocomplite_service2',
	// 		dataType: "json",
	// 		beforeSend: function() {
	// 			blockUI();
	// 		},
	// 		success: function(html) {
	// 			if (html != '') {
	// 				$.each(html, function(i, n) {
	// 					$('#ppn').val(n["ppnnya"]);
	// 					$('#service_id').val(n["service_id"]);
	// 					//$('#service_id_val').val(n["ppnnya"]);
	// 					$('#customer_id').val(n["customer_id"]);
	// 					$('#nama').val(n["nama"]);
	// 					$('#customer_group_name').val(n["customer_group_name"]);
	// 					$('#service_produk').val(n["product_description"]);
	// 					$('#bw').val(n["bandwith"]);
	// 					$('#period').val('');
	// 					$('#instalasi').val(n["instalasi"]);
	// 					$('#lain2').val(n["lain2"]);

	// 					$.ajax({
	// 						url: pageUri + 'select_autocomplite_service_add/' + n["id"],
	// 						success: function(html_detail) {
	// 							$("#tabelDetailInvoice tbody tr.remove").remove();
	// 							$("#tabelDetailInvoice tbody").append(html_detail);
	// 							$("#tabelDetailInvoice tbody button").button({
	// 								icons: {
	// 									primary: "ui-icon-trash"
	// 								},
	// 								text: false
	// 							});
	// 							$('#tabelDetailInvoice tbody button').unbind("click").bind("click", function() {
	// 								delDetailInvoice(this);
	// 								return false;
	// 							});
	// 							count_harga();
	// 							unBlockUI();
	// 						}
	// 					});


	// 				});
	// 			}
	// 			unBlockUI();
	// 		}
	// 	});

	// });




	function update_data(id) {
		var pageUri = $('#pageUri').val();
		$("#tabelDetailInvoice tbody tr.remove").remove();
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
				var a = JSON.parse(html.data);
				if (a != '') {
					$(".alamat").html(html.alamat);
					$.each(a, function(i, n) {
						$('#id').val(id);
						$('#service_id').val(n['id_order']);
						$('#service_id_val').val(n['nomor']);
						$('#alamat').val(n["id_address"]);
						$('#npwp').val(n["taxno"]);
						$('#attention').val(n["attention"]);
						$('#phone').val(n["phone"]);
						$('#email').val(n["email"]);
						$('#tanggal_invoice').val(n["tanggal_invoice"]);
						$('#due_date').val(n["due_date"]);
						$('#customer_id').val(n["idcust"]);
						$('#id_cust').val(n["id_cust"]);
						$('#id_address').val(n["id_address"]);
						$('#id_contact').val(n["id_contact"]);
						$('#id_order').val(n["id_order"]);
						$('#site_id').val(n["id_site"]);
						$('#servid').val(n["servid"]);
						$('#nama_cust').val(n["nama_cust"]);
						$('#nama_site').val(n["nama_site"]);
						$('#periode_dari').val(n["periode_dari"]);
						$('#periode_sampai').val(n["periode_sampai"]);
						$('#ppnnya').autoNumeric();
						if (n['ppn'] > 0) {
							$('#ppnnya').val(n["ppn"]);
						}
					});
					get_detail();
				} else {
					alert('Data tidak ditemukan');
				}
			}
		});
	}

	function get_detail() {
		var pageUri = $('#pageUri').val();
		$.ajax({
			type: 'POST',
			data: $('#formulir_modal').serialize(),
			url: pageUri + 'select_data_detail_invoice',
			success: function(html_detail) {
				$("#tabelDetailInvoice tbody tr.remove").remove();
				$("#tabelDetailInvoice tbody").append(html_detail);
				$("#tabelDetailInvoice tbody button").button({
					icons: {
						primary: "ui-icon-trash"
					},
					text: false
				});
				$('#tabelDetailInvoice tbody button').unbind("click").bind("click", function() {
					delDetailInvoice(this);
					return false;
				});
				count_harga();
				unBlockUI();
			}
		});
		$('#sel_tambah_service_produk').val('').change();
		$('#modal_dialog_formulir').modal('show');
	}

	function invoice_belum_edit(id) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			type: 'GET',
			url: pageUri + 'invoice_belum_edit/' + id,
			beforeSend: function() {
				blockUI();
			},
			success: function(response) {
				if (response == '1') {
					table.ajax.reload(null, false);
					alert('Proses berhasil');
				} else if (response == '0') {
					alert('Proses gagal');
				} else {
					alert(response);
				}
				unBlockUI();
			}
		});
	}

	function invoice_sudah_edit(id) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			type: 'GET',
			url: pageUri + 'invoice_sudah_edit/' + id,
			beforeSend: function() {
				blockUI();
			},
			success: function(response) {
				if (response == '1') {
					table.ajax.reload(null, false);
					alert('Proses berhasil');
				} else if (response == '0') {
					alert('Proses gagal');
				} else {
					alert(response);
				}
				unBlockUI();
			}
		});
	}


	function invoice_sudah_approve(id) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			type: 'GET',
			url: pageUri + 'invoice_sudah_approve/' + id,
			beforeSend: function() {
				blockUI();
			},
			success: function(response) {
				if (response == '1') {
					table.ajax.reload(null, false);
					alert('Proses berhasil');
				} else if (response == '0') {
					alert('Proses gagal');
				} else {
					alert(response);
				}
				unBlockUI();
			}
		});
	}


	function invoice_sudah_print(id) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			type: 'GET',
			url: pageUri + 'invoice_sudah_print/' + id,
			beforeSend: function() {
				blockUI();
			},
			success: function(response) {
				if (response == '1') {
					table.ajax.reload(null, false);
					alert('Proses berhasil');
				} else if (response == '0') {
					alert('Proses gagal');
				} else {
					alert(response);
				}
				unBlockUI();
			}
		});
	}

	function invoice_info() {
		var pageUri = $('#pageUri').val();
		$('#info_invoice').html('<em>Loading...</em>');
		$.ajax({
			type: 'GET',
			url: pageUri + 'invoice_info',
			beforeSend: function() {
				blockUI();
			},
			success: function(response) {
				$('#info_invoice').html(response);
				unBlockUI();
			}
		});
	}

	function count_harga() {
		// var potongan = ($('#potongan').val() == '') ? 0 : filter_currency($('#potongan').val());
		var ppnnya = ($('#ppnnya').val() == '') ? 0 : filter_currency($('#ppnnya').val());
		// var bw = ($('#bw').val() == '') ? 0 : filter_currency($('#bw').val());
		// var instalasi = ($('#instalasi').val() == '') ? 0 : filter_currency($('#instalasi').val());
		var tambah_jumlah = 0;
		var jumlah = 0;
		var total = 0;
		// ppnnya = parseFloat(ppnnya, 10);
		// alert(ppnnya);
		var total = parseFloat(total) + parseFloat(ppnnya);
		$("#tabelDetailInvoice tbody input[name^=tambah_service_produk]").each(function(index) {
			tambah_jumlah = $("#tabelDetailInvoice tbody input[name^=tambah_jumlah]:eq(" + index + ")").val().replace(/[,]+/g, "");
			// tambah_jumlah = parseFloat(tambah_jumlah, 10);
			total = parseFloat(total) + parseFloat(tambah_jumlah);
		});
		// $("#total_tagihan").autoNumeric();
		$("#total_tagihan").val(parseFloat(total).toFixed(2));
		$("#total_tagihan").maskMoney('mask');
	}

	function to_periode() {
		var period = $('#period').val();
		if (period != '' || period != null || period != 'undefined') {
			var d = new Date(period);
			var n = d.getMonth();
			var months = ["Januari", "Februari", "Maret", "April", "Mai", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
			var bulan = months[d.getMonth()];
			var tanggal = period.substr(period.length - 2);
			var tahun = period.substr(0, 4);
			var tanggal_end = new Date(tahun, n + 1, 0).getDate();
			var periode = tanggal + ' - ' + tanggal_end + ' ' + bulan + ' ' + tahun;
			$('#tgl_awal').val(period);
			$('#period').val(periode);
		}
	}

	function delDetailInvoice(sy) {
		var ind = $(sy).index("#tabelDetailInvoice tbody tr.remove button");
		ind = ind + 1;
		$("#tabelDetailInvoice tbody tr:eq(" + ind + ")").remove();
		count_harga();
	}

	$("#sel_tambah_service_produk2").change(function() {
		$('#tambah_service_produk2').val('');
	});

	$("#tambah_service_produk2").click(function() {
		$('#sel_tambah_service_produk2').val('').change();
	});
	$("#tambahDetailInvoice").click(function() {
		var service1 = $('#sel_tambah_service_produk').val();
		var note = $('#tambah_note').val();
		var pilih_tambah = $('#pilih_tambah').val();
		var periode_start = $('#periode_dari').val();
		var tambah_jumlah = ($('#tambah_jumlah').val() == '') ? 0 : $('#tambah_jumlah').val();
		var form = '<tr class="remove">';
		if (pilih_tambah == 'LG') {
			form += '<td style="vertical-align:middle;"><input type="hidden" name="order_service[]" value=""><input type="hidden" name="tgl_transaksi[]" value="' + periode_start + '"><select class="form-control" type="text" name="pilih_tambah[]"><option value="' + pilih_tambah + '">Layanan</option></select></td>';
			form += '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_service_produk[]" value="' + service1 + '" /></td>';
		}
		if (pilih_tambah == 'MT') {
			form += '<td style="vertical-align:middle;"><input type="hidden" name="order_service[]" value=""><input type="hidden" name="tgl_transaksi[]" value="' + periode_start + '"><select class="form-control" type="text" name="pilih_tambah[]"><option value="' + pilih_tambah + '">Materai</option></select></td>';
			form += '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_service_produk[]" value="Biaya Materai" /></td>';
		}
		if (pilih_tambah == 'LL') {
			form += '<td style="vertical-align:middle;"><input type="hidden" name="order_service[]" value=""><input type="hidden" name="tgl_transaksi[]" value="' + periode_start + '"><select class="form-control" type="text" name="pilih_tambah[]"><option value="' + pilih_tambah + '">Lain-Lain</option></select></td>';
			form += '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_service_produk[]" value="' + service1 + '" /></td>';
		}
		if (pilih_tambah == 'BI') {
			form += '<td style="vertical-align:middle;"><input type="hidden" name="order_service[]" value=""><input type="hidden" name="tgl_transaksi[]" value="' + periode_start + '"><select class="form-control" type="text" name="pilih_tambah[]"><option value="' + pilih_tambah + '">Instalasi</option></select></td>';
			form += '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_service_produk[]" value="Biaya Instalasi" /></td>';
		}
		form += '<td style="vertical-align:middle;width:200px"><input class="form-control" type="text" name="tambah_note[]" value="' + note + '"/></td>';
		form += '<td style="vertical-align:middle;"><input class="form-control price_decimal" type="text" name="tambah_jumlah[]" value="' + tambah_jumlah + '" readonly/></td>';
		form += '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
		form += '</tr>';
		$("#tabelDetailInvoice tbody").append(form);
		$("#tabelDetailInvoice tbody button").button({
			icons: {
				primary: "ui-icon-trash"
			},
			text: false
		});
		$('#tabelDetailInvoice tbody button').unbind("click").bind("click", function() {
			delDetailInvoice(this);
			return false;
		});
		$('#sel_tambah_service_produk').val('').change();
		$('#tambah_note').val('');
		$('#tambah_jumlah').val('');
		count_harga();
	});

	function count_harga2() {
		var potongan = ($('#potongan2').val() == '') ? 0 : filter_currency($('#potongan2').val());
		var ppnnya = ($('#ppnnya').val() == '') ? 0 : filter_currency($('#ppnnya2').val());
		var bw = ($('#bw2').val() == '') ? 0 : filter_currency($('#bw2').val());
		var instalasi = ($('#instalasi2').val() == '') ? 0 : filter_currency($('#instalasi2').val());

		var lain2 = ($('#lain22').val() == '') ? 0 : filter_currency($('#lain22').val());

		var total = ppnnya - potongan;
		total += bw + instalasi + lain2;
		$("#tabelDetailInvoice2 tbody input[name^=tambah_service_produk]").each(function(index) {
			var tambah_bw = filter_currency($("#tabelDetailInvoice2 tbody input[name^=tambah_bw]:eq(" + index + ")").val());
			var tambah_instalasi = filter_currency($("#tabelDetailInvoice2 tbody input[name^=tambah_instalasi]:eq(" + index + ")").val());
			var tambah_lain2 = filter_currency($("#tabelDetailInvoice2 tbody input[name^=tambah_lain2]:eq(" + index + ")").val());
			total += tambah_bw + tambah_instalasi + tambah_lain2;
		});

		$("#total_tagihan2").val(total);
		$("#total_tagihan2").maskMoney('mask');
	}

	function to_periode2() {
		var period = $('#period2').val();
		if (period != '' || period != null || period != 'undefined') {
			var d = new Date(period);
			var n = d.getMonth();
			var months = ["Januari", "Februari", "Maret", "April", "Mai", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
			var bulan = months[d.getMonth()];
			var tanggal = period.substr(period.length - 2);
			var tahun = period.substr(0, 4);
			var tanggal_end = new Date(tahun, n + 1, 0).getDate();
			var periode = tanggal + ' - ' + tanggal_end + ' ' + bulan + ' ' + tahun;
			$('#tgl_awal2').val(period);
			$('#period2').val(periode);
		}
	}

	function delDetailInvoice2(sy) {
		var ind = $(sy).index("#tabelDetailInvoice2 tbody button");
		$("#tabelDetailInvoice2 tbody tr:eq(" + (ind + 1) + ")").remove();
		count_harga2();
	}

	$("#formulir_modal2").validate({
		rules: {
			customer_inv: {
				required: true
			},
			date_inv: {
				required: true
			},
			date_due_inv: {
				required: true
			},
		},
		submitHandler: function(form) {
			var cekTransaksi = $("#formulir_modal2").attr('transaksi');
			var pageUri = $('#pageUri').val();
			if (cekTransaksi == 'tambah') {
				$.ajax({
					type: 'POST',
					url: pageUri + 'insert_data',
					data: $('#formulir_modal2').serialize(),
					beforeSend: function() {
						blockUI();
					},
					success: function(response) {
						if (response == '1') {
							$('#formulir_modal2').clearForm();
							$("#tabelDetailInvoice2 tbody tr.remove").remove();
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

	$(document).ready(function() {
		var pageUri = $('#pageUri').val();
		//alert($('#service_id_val').val());
		$("#service_inv").select2({
			placeholder: "Masukan Customer",
			width: "100%",
			ajax: {
				url: pageUri + 'select_customer',
				type: "post",
				dataType: 'json',
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response.hasil
					};
					$("#customer_inv").val(response.custid);
					alert(response.custid);
				},
				cache: true
			}
		});
	});

	$('#service_inv').change(function() {
		var pageUri = $('#pageUri').val();
		var id = $('#service_inv').val();
		if (id != '' || id != null || id != 'undefined') {
			$.ajax({
				type: 'GET',
				url: pageUri + 'get_customer_id/' + id,
				success: function(response) {
					$('#customer_inv').val(response);
				}
			});
		}
	});

	function pisahinv(id) {
		var pageUri = $('#pageUri').val();
		swal({
			title: "Anda Yakin?",
			text: "Anda akan memisahkan invoice ini.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes!",
			closeOnConfirm: false
		}, function() {
			window.location.href = pageUri + 'split_invoice/' + id;
		});
	};

	function open_modal_generate_invoice() {
		$('#modalGenerateInvoice').dialog('open');
		return false;
	}

	function open_modal_merge() {
		var pageUri = $('#pageUri').val();
		var checkboxinvo = [];
		var n = '';
		$('input[type="checkbox"][name="invoice"]:checked').each(function(index, elem) {
			checkboxinvo.push($(elem).val());
		});
		n = checkboxinvo.join(',');
		if (n != '') {
			$.ajax({
				url: pageUri + 'ajax_get_kontak/',
				type: 'POST',
				data: {
					id: n
				},
				success: function(res) {
					$('#list_site').html(res);
					$('#modalMerge').modal('show');
					$('#input_val').val(n);
				}
			});
		}
	}

	function approve(id) {
		var pageUri = $('#pageUri').val();
		swal({
			title: "Anda Yakin?",
			text: "Anda akan approve invoice ini.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes!",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				type: 'POST',
				data: {
					id: id
				},
				url: pageUri + 'approve_invoice',
				beforeSend: function() {
					blockUI();
				},
				success: function(response) {
					if (response == '1') {
						toastr.success('Invoice berhasil diapprove');
						table.ajax.reload(null, false);
					} else if (response == '0') {
						toastr.error('Invoice gagal jadi piutang');
					} else {
						toastr.warning(response);
					}
					swal.close();
					unBlockUI();
				}
			});
		});
	};
</script>