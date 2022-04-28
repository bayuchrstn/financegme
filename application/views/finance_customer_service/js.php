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
				[1, 'asc']
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": pageUri + 'get_data_table',
				"type": "POST",
				"data": function(data) {
					data.search_keyword = $('#search_keyword').val();
					data.searchstatus = $('#searchstatus').val();
					data.searchbilling_cycle = $('#searchbilling_cycle').val();
					data.searchkat_inv = $('#searchkat_inv').val();
					data.searchkategori = $('#searchkategori').val();
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
				service_id: {
					required: true
				},
				customer_id: {
					required: true
				},
				customer_id_val: {
					required: true
				},
				customer_group: {
					required: true
				},
				nama: {
					required: true
				},
				alamat: {
					required: true
				},
				telp: {
					required: true
				},
				product_description: {
					required: true
				},
				//product_note: {required: true},
				date_invoice: {
					required: true
				},
				date_due: {
					required: true
				},
				ppn: {
					required: true
				},
				bhp_uso: {
					required: true
				},
				billing_cycle: {
					required: true
				},
				jenis_ppn: {
					required: true
				},
				mf_cycle: {
					required: true
				},
				payment_to: {
					required: true
				},
				status_service: {
					required: true
				},
				status_maxi: {
					required: true
				},
				status_cabang: {
					required: true
				},
				msa: {
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
								alert('Data berhasil disimpan');
								table.ajax.reload(null, false);
								update_data(id);
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

		$("#customer_id_val").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: pageUri + 'select_autocomplite_customer',
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
				$('#cid').val(ui.item.id);
				$('#customer_id').val(ui.item.customer_id);
				$('#customer_id_val').val(ui.item.customer_id);
				$('#customer_group').val(ui.item.nama);
				return false;
			}
		}).autocomplete("instance")._renderItem = function(ul, item) {
			var hasil_result = "<div>";
			hasil_result += "Customer ID: <b>" + item.customer_id + "</b><br>";
			hasil_result += "Nama: <b>" + item.nama + "</b><br>";
			hasil_result += "</div>";
			return $("<li>")
				.append(hasil_result)
				.appendTo(ul);
		};

		$("#tambahDetailInvoice").click(function() {
			var service_produk = $('#tambah_service_produk').val();
			if (service_produk == '') {
				alert('Deskipsi mohon diisi');
			} else {
				var note = $('#tambah_service_note').val();
				var bw = $('#tambah_bw').val();
				var colo = $('#tambah_colo').val();
				var instalasi = $('#tambah_instalasi').val();
				var perangkat = $('#tambah_perangkat').val();
				var lain2 = $('#tambah_lain2').val();
				var form = '<tr class="remove">';
				form += '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:270px;" readonly="readonly" name="tambah_service_produk[]" value="' + service_produk + '" /><br><input class="form-control" type="text" style="width:270px;" readonly="readonly" name="tambah_service_note[]" value="' + note + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_bw[]" value="' + bw + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_colo[]" value="' + colo + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_instalasi[]" value="' + instalasi + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_perangkat[]" value="' + perangkat + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_lain2[]" value="' + lain2 + '" /></td>';
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
				$('#tambah_service_produk').val('');
				$('#tambah_service_note').val('');
				$('#tambah_bw').val('');
				$('#tambah_colo').val('');
				$('#tambah_instalasi').val('');
				$('#tambah_perangkat').val('');
				$('#tambah_lain2').val('');
			}
			return false;
		});

	});

	function open_search() {
		$('#formSearch').dialog('open');
		return false;
	}

	function input_data() {
		$('#formulir_modal').clearForm();
		$("#formulir_modal").attr('transaksi', 'tambah');
		$("#tabelDetailInvoice tbody tr.remove").remove();
		$("#title_modal_flexible").html('Tambah');
		$('#formSearch').dialog('close');
		$('#modal_dialog_formulir').modal('show');
		return false;
	}

	function update_data(id) {
		var pageUri = $('#pageUri').val();
		$("#formulir_modal").attr('transaksi', 'edit');
		$("#tabelDetailInvoice tbody tr.remove").remove();
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
						$('#service_id, #service_id_old').val(n["service_id"]);
						$('#nama').val(n["nama"]);
						$('#alamat').val(n["alamat"]);
						$('#telp').val(n["telp"]);
						$('#cp').val(n["cp"]);
						$('#cid').val(n["cid"]);
						$('#customer_id, #customer_id_val').val(n["customer_id"]);
						$('#customer_group').val(n["customer_group"]);
						$('#product_description').val(n["product_description"]);
						$('#product_note').val(n["product_note"]);
						$('#bandwith').val(n["bandwith"]);
						$("#bandwith").maskMoney('mask');
						$('#colocation').val(n["colocation"]);
						$("#colocation").maskMoney('mask');
						$('#instalasi').val(n["instalasi"]);
						$("#instalasi").maskMoney('mask');
						$('#perangkat').val(n["perangkat"]);
						$("#perangkat").maskMoney('mask');
						$('#lain2').val(n["lain2"]);
						$("#lain2").maskMoney('mask');
						$('#date_invoice').val(n["date_invoice"]);
						$('#date_due').val(n["date_due"]);
						$('#ppn').val(n["ppn"]);
						$('#bhp_uso').val(n["bhp_uso"]);
						$('#billing_cycle').val(n["billing_cycle"]);
						$('#mf').val(n["mf"]);
						$("#mf").maskMoney('mask');
						$('#mf_cycle').val(n["mf_cycle"]);
						$('#barcode').val(n["barcode"]);
						$('#jenis_ppn').val(n["jenis_ppn"]);
						$('#status_service').val(n["status_service"]);
						$('#invoice_name').val(n["invoice_name"]);
						$('#invoice_address').val(n["invoice_address"]);
						$('#invoice_attention').val(n["invoice_attention"]);
						$('#invoice_phone').val(n["invoice_phone"]);
						$('#status_maxi').val(n["status_maxi"]);
						$('#status_cabang').val(n["status_cabang"]);
						$('#msa').val(n["msa"]);
						$("#payment_to option:selected").removeAttr("selected");
						$.each(n["payment_to"].split(","), function(i, e) {
							$("#payment_to option[value='" + e + "']").prop("selected", true);
						});
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
								unBlockUI();
							}
						});
						$('#modal_dialog_formulir').modal('show');
					});
				} else {
					alert('Data tidak ditemukan');
				}
			}
		});
	}

	function delete_data(id) {
		var pageUri = $('#pageUri').val();

		if (confirmProses('Yakin ingin menghapus data?') == true) {
			$.ajax({
				type: 'POST',
				url: pageUri + 'delete_data',
				data: {
					id: id
				},
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

	function delDetailInvoice(sy) {
		var ind = $(sy).index("#tabelDetailInvoice tbody button");
		$("#tabelDetailInvoice tbody tr:eq(" + (ind + 1) + ")").remove();
	}
</script>