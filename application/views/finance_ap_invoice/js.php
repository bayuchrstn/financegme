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
			"pageLength": 100,
			aaSorting: [
				[1, 'desc']
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": pageUri + 'get_data_table',
				"type": "POST",
				"data": function(data) {
					data.search_keyword = $('#search_keyword').val();
					data.searchDateFirst = $('#searchDateFirst').val();
					data.searchDateFinish = $('#searchDateFinish').val();
					data.searchlunas = $('#searchlunas').val();
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
				width: '150px',
				targets: [0, tabel_kolom]
			}, {
				className: "text-right",
				"targets": [4, 8]
			}, {
				className: "text-center",
				"targets": [tabel_kolom, 0, 1, 2, 3, 4]
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

		$('.currency').blur(function() {
			$('.currency').formatNumber();
		});
		$("#formulir_modal").validate({
			rules: {
				supplier: {
					required: true
				},
				tanggal: {
					required: true
				},
				date_due: {
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
								$("#tabelDetailInvoice tbody").html('');
								toastr.success('Data berhasil disimpan');
								table.ajax.reload(null, false);
								$('#jumlah').maskMoney('destroy');
								$('#supplier').empty();
								if ($('#supplier').data('select2')) {
									$('#supplier').select2('destroy');
								}
								$('#mytable').html('');
								$('.detail_barang').html('');
								get_supplier();
							} else if (response == '0') {
								toastr.warning('Data gagal disimpan');
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
								$('#modal_finance_ap_invoice').modal('hide');
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

		$("#formulir_modal_manual").validate({
			rules: {
				supplier: {
					required: true
				},
				tanggal: {
					required: true
				},
				date_due: {
					required: true
				},
				qty: {
					required: true
				}
			},
			submitHandler: function(form) {
				var cekTransaksi = $("#formulir_modal_manual").attr('transaksi');
				if (cekTransaksi == 'tambah') {
					$.ajax({
						type: 'POST',
						url: pageUri + 'insert_data_manual',
						data: $('#formulir_modal_manual').serialize(),
						beforeSend: function() {
							blockUI();
						},
						success: function(response) {
							if (response == '1') {
								$('#formulir_modal_manual').clearForm();
								toastr.success('Data berhasil disimpan');
								$('.form_add2').html('');
								load_init_manual();
								table.ajax.reload(null, false);
							} else if (response == '0') {
								toastr.warning('Data gagal disimpan');
							} else {
								toastr.error(response);
							}
							unBlockUI();
						}
					});
				} else if (cekTransaksi == 'edit') {
					$.ajax({
						type: 'POST',
						url: pageUri + 'edit_data_manual',
						data: $('#formulir_modal_manual').serialize(),
						beforeSend: function() {
							blockUI();
						},
						success: function(response) {
							if (response == '1') {
								$('#formulir_modal_manual').clearForm();
								toastr.success('Data berhasil disimpan');
								table.ajax.reload(null, false);
								$('#modal_finance_ap_invoice_manual').modal('hide');
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

		$("#tambahDetailInvoice").click(function() {
			if ($('#tambah_description').val() == '') {
				toastr.warning('Description mohon diisi');
			} else if ($('#tambah_jumlah').val() == '') {
				toastr.warning('Debet atau Kredit mohon diisi');
			} else {
				var description = $('#tambah_description').val();
				var jumlah = ($('#tambah_jumlah').val() == '') ? '0.00' : $('#tambah_jumlah').val();

				var form = '<tr class="remove">';
				form += '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:300px;" readonly="readonly" name="tambah_description[]" value="' + description + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:200px;" readonly="readonly" name="tambah_jumlah[]" value="' + jumlah + '" /></td>';
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
				$('#tambah_description').val('');
				$('#tambah_jumlah').val('');
				cek_balance();
			}
			return false;
		});

	});


	function add_detail(supp, id_head, id_buy) {
		var pageUri = $('#pageUri').val();
		$.ajax({
			type: "POST",
			url: pageUri + 'get_detail_barang',
			data: {
				id_supp: supp,
				id_header: id_head,
				id_pembelian: id_buy
			},
			dataType: "json",
			success: function(response) {
				if ($('#supplier').data('select2')) {
					$('#supplier').select2('destroy');
					$('#supplier').attr('readonly', true);
				}

				$('.detail_barang').append(response.html);
				count_all();
			}
		});
	}

	function open_search() {
		$('#formSearch').dialog('open');
		return false;
	}

	function input_data() {
		$('#jumlah').maskMoney('destroy');
		$('#val_pph').maskMoney('destroy');
		$('#total').maskMoney('destroy');
		// $('#potongan').maskMoney();
		$('#materai').autoNumeric();
		$('#formulir_modal').clearForm();
		$("#formulir_modal").attr('transaksi', 'tambah');
		$("#tabelDetailInvoice tbody").html('');
		$("#title_modal_flexible").html('Tambah');
		$('#formSearch').dialog('close');
		$('#modal_finance_ap_invoice').modal('show');
		$('#supplier').empty();
		if ($('#supplier').data('select2')) {
			$('#supplier').select2('destroy');
		}
		$('#mytable').html('');
		$('.detail_barang').html('');
		get_supplier();
		return false;
	}

	function input_data_manual() {
		$('#jumlah2').maskMoney('destroy');
		$('#val_pph2').maskMoney('destroy');
		$('#total2').maskMoney('destroy');
		$('#materai2').autoNumeric();
		// $('#potongan2').maskMoney();
		$('#formulir_modal_manual').clearForm();
		$("#formulir_modal_manual").attr('transaksi', 'tambah');
		$("#tabelDetailInvoice tbody").html('');
		$("#title_modal_flexible_manual").html('Tambah Manual');
		$('#formSearch').dialog('close');
		$('#modal_finance_ap_invoice_manual').modal('show');
		$(".harga_brg").autoNumeric();
		$(".total_harga2").autoNumeric();
		$('#supplier2').empty();
		if ($('#supplier2').data('select2')) {
			$('#supplier2').select2('destroy');
		}
		$('.form_add2').html('');
		load_init_manual();
		get_supplier2();
		return false;
	}

	function load_init_manual() {
		var pageUri = $('#pageUri').val();
		var no = 1;
		$('#no_urut').val(no);
		$.ajax({
			type: 'GET',
			url: pageUri + 'load_kd_jurnal',
			success: function(response) {
				$('.form_add2').append('<div class="row"><div class="col-lg-1"><label>No</label><input class="form-control no_urut" type="text" value="' + no + '" disabled/></div><div class="col-lg-2"><label>Jurnal</label><select class="form-control jurnal" name="jurnal[]">' + response + '</select></div><div class="col-lg-3"><label>Nama Barang</label><input class="form-control nama_barang" type="text" name="nama_barang[]" onchange="count_all2()"></div><div class="col-lg-1"><label>QTY</label><input class="form-control jumlah_barang2" type="text" name="qty[]" onkeyup="hitung4(this)" onblur="hitung4(this)"></div><div class=" col-lg-1"><label>Satuan</label><input class="form-control" type="text" name="satuan[]"></div><div class="col-lg-1"><label>Harga</label><input class="form-control harga_brg" type="text" name="harga[]" style="text-align:right" onkeyup="hitung3(this)" onblur="hitung3(this)"></div><div class="col-lg-2"><label>Jumlah</label><input class="form-control total_harga2" type="text" name="jumlah_harga[]" style="text-align:right" readonly></div><div class="col-lg-1"><label>Action</label><br></div></div>');
			}
		});
		return false;
	}

	function view_data(id) {
		var pageUri = $('#pageUri').val();
		$.ajax({
			type: 'POST',
			data: {
				id: id
			},
			url: pageUri + 'view_data',
			dataType: "json",
			beforeSend: function() {
				blockUI();
			},
			success: function(html) {
				if (html != '') {
					$('#modal_finance_ap_invoice_view').find('.modal-footer').html('<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> Close</button>');
					$('#modal_finance_ap_invoice_view').modal('show');
					$('.form_add').html('');
					$('.form_add').append(html.det);
					$('#jumlah3').maskMoney('destroy');
					$('#total3').maskMoney('destroy');
					$('#val_pph3').maskMoney('destroy');
					$('#tanggal3').val(html.res["tanggal"]);
					$('#inv_supplier3').val(html.res["no_referensi"]);
					$('#date_due3').val(html.res["date_due"]);
					$('#no_inv3').val(html.res["no_ap"]);
					$('#kas_bank3').val(html.res["kat_gl"]);
					$('#supplier3').val(html.res["nama_perusahaan"]);
					// $('#potongan3').val(formatMoney(html.res["potongan"]));
					$('#materai3').val(formatMoney(html.res["materai"]));
					$('#ket3').val(html.res["ket"]);
					$('#ongkir3').val(formatMoney(html.res["ongkir"]));
					$('#jumlah3').val(formatMoney(html.res["total_harga"]));
					$('#total3').val(formatMoney(Number(html.res["total_harga"]) + Number(html.res["pph"])));
					$('#val_pph3').val(formatMoney(html.res["pph"]));
					if (html.res["ppn"] > 0) {
						$('#ppn3').val('Ya - Rp ' + formatMoney(html.res['ppn']));
					} else {
						$('#ppn3').val('Tidak');
					}
					if (html.res["pajak"] == 1) {
						$('#pph3').val('PPh 23');
					} else if (html.res["pajak"] == 2) {
						$('#pph3').val('PPh 4 Ayat 2');
					} else {
						$('#pph3').val('Tidak');
					}
					unBlockUI();
				} else {
					toastr.warning('Data tidak ditemukan');
					unBlockUI();
				}
			}
		});
	}

	function update_data(id) {
		var pageUri = $('#pageUri').val();

		$("#tabelDetailInvoice tbody").html('');
		$("#title_modal_flexible").html('Edit');
		$('#id').val(id);
		var supp = 0;
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
					if (html.flag == 1) {
						$("#formulir_modal").attr('transaksi', 'edit');
						$('#modal_finance_ap_invoice').modal('show');
						$('.detail_barang').html('');
						$('.detail_barang').append(html.det);
						count_all();
						$.each(html.res, function(i, n) {
							$('#mytable').html('');
							$('#id').val(id);
							$('#tanggal').val(n["tanggal"]);
							$('#kas_bank').val(n['kat_gl']);
							$('#inv_supplier').val(n["no_referensi"]);
							$('#date_due').val(n["date_due"]);
							if ($('#supplier').data('select2')) {
								$('#supplier').select2('destroy');
								$('#supplier').attr('readonly', true);
							}
							$('#supplier').empty().append($("<option/>").val(n["supplier"]).text(n["nama"])).trigger('change');
							// $('#potongan').val(n["potongan"]);
							// $("#potongan").maskMoney('mask');
							$('#materai').autoNumeric();
							$('#materai').val(formatMoney(n["materai"]));
							$('#ket').val(n["ket"]);
							if (n["ppn"] > 0) {
								$('#ppn').val(1).change();
							} else {
								$('#ppn').val(0).change();
							}
							$('#pph').val(n["pajak"]).change();

							get_supplier();
							unBlockUI();
						});
					} else {
						$("#formulir_modal_manual").attr('transaksi', 'edit');
						$('#modal_finance_ap_invoice_manual').modal('show');
						$('.form_add2').html('');
						$('#id2').val(id);
						$('.form_add2').append(html.det);
						$('.harga_brg').autoNumeric();
						$('#supplier2').empty().append($("<option/>").val(html.res["supplier"]).text(html.res["nama"])).trigger('change');
						$('#inv_supplier2').val(html.res["no_referensi"]);
						$('#kas_bank2').val(html.res['kat_gl']);
						$('#tanggal2').val(html.res["tanggal"]);
						$('#date_due2').val(html.res["date_due"]);
						$('#ongkir2').val(html.res["bea_ongkir"]);
						$('#materai2').autoNumeric();
						$('#materai2').val(html.res["bea_materai"]);
						$('#ket2').val(html.res["ket"]);
						$('#jumlah2').maskMoney('destroy');
						$('#total2').maskMoney('destroy');
						$('#val_pph2').maskMoney('destroy');
						if (html.res["ppn"] > 0) {
							$('#ppn2').val(1).change();
						} else {
							$('#ppn2').val(0).change();
						}
						$('#pph2').val(html.res["pajak"]).change();

						get_supplier();
						unBlockUI();
					}
				} else {
					toastr.warning('Data tidak ditemukan');
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

	function clearDetTransaksi() {
		$('#id_ref').val('');
		$('#result_id_ref').val('');
	}

	function detail_reference(trx, id_ref) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			url: pageUri + 'select_detail_ref/' + trx + '/' + id_ref,
			success: function(html) {
				$('#result_id_ref').val(html);
			}
		});
		return false;
	}

	function cek_balance() {
		// var potongan = ($('#potongan').val() == '') ? 0 : filter_currency($('#potongan').val());
		var materai = ($('#materai').val() == '') ? 0 : filter_currency($('#materai').val());
		var ppn = ($('#ppn').val() == '') ? 0 : filter_currency($('#ppn').val());
		var jumlah = 0;
		$("#tabelDetailInvoice tbody input[name^=tambah_jumlah]").each(function(index) {
			var val_jumlah = filter_currency($("#tabelDetailInvoice tbody input[name^=tambah_jumlah]:eq(" + index + ")").val());
			jumlah = jumlah + val_jumlah;
		});

		jumlah = jumlah + materai + ppn;

		$("#jumlah").val(jumlah);
		$("#jumlah").maskMoney('mask');
	}

	function delDetailInvoice(sy) {
		var ind = $(sy).index("#tabelDetailInvoice tbody button");
		$("#tabelDetailInvoice tbody tr:eq(" + (ind) + ")").remove();
		cek_balance();
	}

	function get_supplier() {
		var pageUri = $('#pageUri').val();
		$("#supplier").select2({
			placeholder: "Masukan Nama Supplier",
			width: "100%",
			ajax: {
				url: pageUri + 'get_supplier',
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
				cache: false
			}
		});
	};

	function get_supplier2() {
		var pageUri = $('#pageUri').val();
		$("#supplier2").select2({
			placeholder: "Masukan Nama Supplier",
			width: "100%",
			ajax: {
				url: pageUri + 'get_supplier',
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
				cache: false
			}
		});
	};

	function count_all() {
		var tot = 0;
		var total = 0;
		var total2 = 0;
		$('.total_harga').each(function() {
			tot += Number($(this).val().replace(/[,]+/g, ""));
		});
		// var potongan = ($('#potongan').val() == '') ? 0 : filter_currency($('#potongan').val());
		var materai = ($('#materai').val() == '') ? 0 : filter_currency($('#materai').val());
		var ppn = $('#ppn').val();
		var pph = $('#pph').val();
		if (ppn == 1) {
			ppn = tot * 10 / 100;
			$("#val_ppn").val(ppn);
		} else {
			ppn = 0;
		}
		if (pph == 1) {
			pph = tot * 2 / 100;
			$("#val_pph").val(formatMoney(pph));
		} else if (pph == 2) {
			pph = tot * 10 / 100;
			$("#val_pph").val(formatMoney(pph));
		} else {
			pph = 0;
			$("#val_pph").val(formatMoney(pph));
		}

		total = parseFloat(tot + materai + ppn - pph).toFixed(2);
		total2 = parseFloat(tot + materai + ppn).toFixed(2);
		total = formatMoney(total);
		$('#jumlah').val(total);
		total2 = formatMoney(total2);
		$('#total').val(total2);
		// $('#jumlah').maskMoney('mask');
	}

	function count_all2() {
		var tot = 0;
		var total = 0;
		var total2 = 0;
		var ongkir = $('#ongkir2').val();
		var temp = 0;
		$('.total_harga2').each(function() {
			temp = Number($(this).val().replace(/[,]+/g, ""));
			tot += temp;
		});
		// var potongan = ($('#potongan2').val() == '') ? 0 : filter_currency($('#potongan2').val());
		var materai = ($('#materai2').val() == '') ? 0 : filter_currency($('#materai2').val());
		var ongkir = ($('#ongkir2').val() == '') ? 0 : filter_currency($('#ongkir2').val());
		var ppn = $('#ppn2').val();
		var pph = $('#pph2').val();
		if (ppn == 1) {
			ppn = tot * 10 / 100;
			$("#val_ppn2").val(ppn);
		} else {
			ppn = 0;
		}
		if (pph == 1) {
			pph = tot * 2 / 100;
			$("#val_pph2").val(formatMoney(pph));
		} else if (pph == 2) {
			pph = tot * 10 / 100;
			$("#val_pph2").val(formatMoney(pph));
		} else {
			pph = 0;
			$("#val_pph2").val(formatMoney(pph));
		}

		total = parseFloat(tot + materai + ppn - pph + ongkir).toFixed(2);
		total2 = parseFloat(tot + materai + ppn + ongkir).toFixed(2);
		total = formatMoney(total);
		$('#jumlah2').val(total);
		total2 = formatMoney(total2);
		$('#total2').val(total2);
		// $('#jumlah').maskMoney('mask');
	}

	function hitung1(obj) {
		var a = $(obj).closest('tr').find('.harga_barang').attr('id');
		var b = $(obj).val();
		if (b == null || b == 'undefined') {
			b = 0;
		}
		var c = $(obj).closest('tr').find('.harga_barang').val().replace(/[,]+/g, "");
		if (c == null || c == 'undefined') {
			c = 0;
		}
		var tot = parseFloat(b * parseFloat(c, 10), 10).toFixed(2);
		if (tot > 0) {
			tot = tot;
		} else {
			tot = 0;
		}
		$('#total_' + a).val(tot).autoNumeric();
		$(obj).closest('tr').find('.total_harga').val(tot).autoNumeric();
		count_all();
	}

	function hitung2(obj) {
		var a = $(obj).attr('id');
		var b = $(obj).closest('tr').find('.jumlah_barang').val();
		if (b == null || b == 'undefined') {
			b = 0;
		}
		var c = $(obj).val().replace(/[,]+/g, "");
		if (c == null || c == 'undefined') {
			c = 0;
		}
		var tot = parseFloat(b * parseFloat(c, 10), 10).toFixed(2);
		if (tot > 0) {
			tot = tot;
		} else {
			tot = 0;
		}
		$('#total_' + a).val(tot).autoNumeric();
		$(obj).closest('tr').find('.total_harga').val(tot).autoNumeric();
		count_all();
	}

	function hitung3(obj) {
		var a = $(obj).closest('.row').find('.nama_barang').val();
		var z = 'DISKON';
		var b = $(obj).closest('.row').find('.jumlah_barang2').val();
		if (b == null || b == 'undefined') {
			b = 0;
		}
		var c = $(obj).val().replace(/[,]+/g, "");
		if (c == null || c == 'undefined') {
			c = 0;
		}
		var tot = parseFloat(b * parseFloat(c, 10), 10).toFixed(2);
		if (isNaN(tot)) {
			tot = 0;
		} else {
			if (a.toUpperCase().indexOf(z) > -1 || a.toUpperCase().indexOf(z) > -1) {
				tot = tot * (-1);
			} else {
				tot = tot;
			}
		}
		$(obj).closest('.row').find('.total_harga2').val(formatMoney(tot)).autoNumeric();
		count_all2();
	}

	function hitung4(obj) {
		var a = $(obj).closest('.row').find('.nama_barang').val();
		var z = 'DISKON';
		var b = $(obj).val();
		if (b == null || b == 'undefined') {
			b = 0;
		}
		var c = $(obj).closest('.row').find('.harga_brg').val().replace(/[,]+/g, "");
		if (c == null || c == 'undefined') {
			c = 0;
		}
		var tot = parseFloat(b * parseFloat(c, 10), 10).toFixed(2);
		if (isNaN(tot)) {
			tot = 0;
		} else {
			if (a.toUpperCase().indexOf(z) > -1 || a.toUpperCase().indexOf(z) > -1) {
				tot = tot * (-1);
			} else {
				tot = tot;
			}
		}
		$(obj).closest('.row').find('.total_harga2').val(formatMoney(tot)).autoNumeric();
		count_all2();
	}

	function autonumber(obj) {
		$(obj).autoNumeric();
	}

	function set_up(obj, supp, id_head, id_buy) {
		var pageUri = $('#pageUri').val();
		if ($(obj).is(':checked')) {
			$(obj).attr("checked", true);
			add_detail(supp, id_head, id_buy);
		} else {
			$(obj).attr("checked", false);
			del_detail(id_head, id_buy);
		}
		count_all();
	}


	function del_detail_edit(id_head, id_buy) {
		$('div.detail_barang').find('table.edit_' + id_head + '_' + id_buy).remove();
		count_all();
	}

	function del_detail(id_head, id_buy) {
		$('div.detail_barang').find('table.' + id_head + '_' + id_buy).remove();
		$('.check_po_' + id_head + '_' + id_buy).attr("checked", false);
		count_all();
	}

	function del_per_detail(obj) {
		$(obj).closest('tr').remove();
		count_all();
	}

	function get_po_supp() {
		var pageUri = $('#pageUri').val();
		var id = $('#supplier').val();
		if ($('#supplier').val() != null || $('#supplier').val() != 'undefined') {
			$.ajax({
				type: "POST",
				url: pageUri + 'select_po',
				data: {
					id: id
				},
				dataType: "json",
				success: function(response) {
					$('#mytable').html(response.html);
				}
			});

		}
	}


	$("#search_no").on("keyup", function() {
		var value = $(this).val().toUpperCase();

		$("#mytable tr").each(function(index) {

			$row = $(this);

			var id = $row.find("td:eq(1)").text().toUpperCase();
			var id2 = $row.find("td:eq(2)").text().toUpperCase();
			if (id.indexOf(value) > -1 || id2.indexOf(value) > -1) {
				$row.show();

			} else {
				$row.hide();
			}
		});
	});


	function add_more() {
		var pageUri = $('#pageUri').val();

		$.ajax({
			type: 'GET',
			url: pageUri + 'load_kd_jurnal',
			success: function(response) {
				$('.form_add2').append('<div class="row" style="margin-top:15px"><div class="col-lg-1"><input class="form-control no_urut" type="text" disabled></div><div class="col-lg-2"><select class="form-control jurnal" name="jurnal[]">' + response + '</select></div><div class="col-lg-3"><input class="form-control nama_barang" type="text" name="nama_barang[]" onchange="count_all2();"></div><div class="col-lg-1"><input class="form-control jumlah_barang2" type="text" name="qty[]" onkeyup="hitung4(this)" onblur="hitung4(this)"></div><div class=" col-lg-1"><input class="form-control" type="text" name="satuan[]"></div><div class="col-lg-1"><input class="form-control harga_brg" type="text" name="harga[]" style="text-align:right" onkeyup="hitung3(this)" onblur="hitung3(this)"></div><div class="col-lg-2"><input class="form-control total_harga2" type="text" name="jumlah_harga[]" style="text-align:right" readonly></div><div class="col-lg-1"><a class="del_detail2" onclick="del_detail2(this);"><i class="btn btn-danger icon-minus-circle2" title="delete" style="color:white;padding-top: 7px;padding-bottom: 7px;"></i></a></div></div>');
				$(".harga_brg").autoNumeric();
				pemberian_no();
			}
		});
		return false;
	}

	function pemberian_no() {
		var no_urut = parseInt($("#no_urut").val());
		var tObj = document.getElementsByClassName('no_urut');
		for (var i = 0; i < tObj.length; i++) {

			tObj[i].value = no_urut;
			no_urut += parseInt(1);
		}

	};

	function del_detail2(obj) {
		$(obj).closest(".row").remove();
		pemberian_no();
		count_all2();
	}

	function search_po() {
		var pageUri = $('#pageUri').val();
		var id = $('#supplier').val();
		var char = $('#search_no').val();
		var checkboxinvo = {};
		var n = '';
		$('input[type="checkbox"][name="po"]:checked').each(function(index, elem) {
			if (typeof(checkboxinvo[index]) == 'undefined') {
				checkboxinvo[index] = [];
			}
			checkboxinvo[index].push($(elem).val());
		});
		if ($('#supplier').val() != null || $('#supplier').val() != 'undefined') {
			$.ajax({
				type: "POST",
				url: pageUri + 'search_po',
				data: {
					id: id,
					kode: char,
					check: checkboxinvo
				},
				dataType: "json",
				success: function(response) {
					$('.po_perusahaan').html(response.html);
				}
			});
		}
	}

	function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
		try {
			decimalCount = Math.abs(decimalCount);
			decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

			const negativeSign = amount < 0 ? "-" : "";

			let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
			let j = (i.length > 3) ? i.length % 3 : 0;

			return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
		} catch (e) {
			console.log(e)
		}
	}

	$(document).ready(function() {
		// $("#supplier").select2({
		// 	placeholder: "Masukan Nama Supplier",
		// 	width: "100%"
		// });
		get_supplier();
		$('#supplier').change(function() {
			get_po_supp();
		});

		function myFunction() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("search_no");
			filter = input.value.toUpperCase();
			table = document.getElementById("mytable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
				td2 = tr[i].getElementsByTagName("td")[2];
				if (td || td2) {
					txtValue = td.textContent || td.innerText;
					txtValue2 = td2.textContent || td2.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	});
</script>