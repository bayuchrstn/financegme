<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ColReorderWithResize.js"></script> -->
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
		var height_table = height_windows - height_navbar - height_page - 320;
		var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);

		table = $('#datamain_datatable').DataTable({
			dom: 'J<"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"pli>',
			"pageLength": 25,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			// aaSorting: [
			// 	[2, 'DESC']
			// ],
			"processing": true,
			"ajax": {
				"url": pageUri + 'get_data_table',
				"type": "POST",
				"data": function(data) {
					data.search_keyword = $('#search_keyword').val();
					data.searchDateFirst = $('#searchDateFirst').val();
					data.searchDateFinish = $('#searchDateFinish').val();
					data.searchkat_gl = $('#searchkat_gl').val();
					data.id_biaya = $('#id_biaya').val();
					data.id_card = $('#id_card').val();
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
					width: '100px',
					targets: [tabel_kolom]
				}, {
					orderable: false,
					className: "text-center",
					width: '60px',
					targets: [0]
				}, {
					className: "text-right",
					"targets": [9, 10]
				}, {
					className: "text-center",
					"targets": [tabel_kolom, 2]
				}, {
					width: '100px',
					"targets": [3]
				},
				{
					width: '100px',
					targets: [9, 10]
				}
			],
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

				debetTotal = api
					.column(9, {
						page: 'current'
					})
					.data()
					.reduce(function(a, b) {
						return intVal(a) + intVal(b);
					}, 0);
				// Update footer

				$(api.column(9).footer()).html(

					convertToRupiah(debetTotal)
				);

				// Total over this page
				kreditTotal = api
					.column(10, {
						page: 'current'
					})
					.data()
					.reduce(function(a, b) {
						return intVal(a) + intVal(b);
					}, 0);
				// Update footer

				$(api.column(10).footer()).html(

					convertToRupiah(kreditTotal)
				);
			},
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
			$('#button_dropdown_search').next().toggle();
		});

		$('#search_keyword').keyup(function() {
			table.ajax.reload(null, false);
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
		$("#formulir_modal").validate({
			rules: {
				kat_gl: {
					required: true
				},
				tanggal: {
					required: true
				},
				deskripsi: {
					required: true
				},
				divisi: {
					required: true
				},
				no_referensi: {
					required: true
				},
			},
			submitHandler: function(form) {
				var cekTransaksi = $("#formulir_modal").attr('transaksi');
				var out_of_balance = $("#out_of_balance").val();
				if (out_of_balance != '' && out_of_balance != '0' && out_of_balance != '0.0' && out_of_balance != '0.00') {
					alert('Out Of Balance');
				} else if ($('#debet').val() == '' || $('#debet').val() == '0' || $('#kredit').val() == '' || $('#kredit').val() == '0') {
					alert('Detail jurnal harap diisi');
				} else {
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
									var id = $('#id').val();
									$('#formulir_modal').clearForm();
									$("#tabelDetailInvoice tbody").html('');
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
				select_card(ui.item.id);
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

		$("#tambahDetailInvoice").click(function() {
			if ($('#tambah_account_no').val() == '') {
				toastr.warning('Account number mohon diisi');
			} else if ($('#tambah_account_name').val() == '') {
				toastr.warning('Account name mohon diisi');
				//}else if($('#tambah_description').val() == ''){
				//	alert('Description mohon diisi');
			} else if ($('#tambah_pra_gl_card').val() == '') {
				toastr.warning('Card name mohon diisi');
			} else if ($('#tambah_debet').val() == '' && $('#tambah_kredit').val() == '') {
				toastr.warning('Debet atau Kredit mohon diisi');
			} else {
				var id = $('#tambah_account_id').val();
				var name = $('#tambah_account_name').val();
				var card_id = $('#tambah_pra_gl_card').val();
				var card_name = $('#tambah_pra_gl_card_name').val();
				var description = $('#tambah_description').val();
				var debet = ($('#tambah_debet').val() == '') ? '0.00' : $('#tambah_debet').val();
				var kredit = ($('#tambah_kredit').val() == '') ? '0.00' : $('#tambah_kredit').val();

				var form = '<tr class="remove">';
				form += '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:90px;" readonly="readonly" name="tambah_account_id[]" value="' + id + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:150px;" readonly="readonly" name="tambah_account_name[]" value="' + name + '" /></td>';
				form += '<td style="vertical-align:middle;"><input type="hidden" name="pra_gl_card_id[]" value="' + card_id + '" /><input class="form-control" type="text" style="width:300px;" readonly="readonly" name="pra_gl_card_name[]" value="' + card_name + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="memo[]" value="' + description + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:150px;" readonly="readonly" name="tambah_debet[]" value="' + debet + '" /></td>';
				form += '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:150px;" readonly="readonly" name="tambah_kredit[]" value="' + kredit + '" /></td>';
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
				cek_balance();
				$('#tambah_account_id').val('');
				$('#tambah_account_no').val('');
				$('#tambah_account_name').val('');
				$('#tambah_description').val('');
				$('#tambah_debet').val('');
				$('#tambah_kredit').val('');
			}
			return false;
		});
		open_auto_update_data();
	});

	function open_auto_update_data() {
		var index3 = $('#index3').val();
		if (index3 != '' && index3 != '0') {
			update_data(index3);
		}
		return false;
	}

	function open_search() {
		$('#formSearch').dialog('open');
		return false;
	}

	function search() {
		table.ajax.reload();
	}

	function input_data() {
		$('#formulir_modal').clearForm();
		$("#formulir_modal").attr('transaksi', 'tambah');
		$("#tabelDetailInvoice tbody").html('');
		$("#title_modal_flexible").html('Tambah');
		$('#formSearch').dialog('close');
		$('#modal_dialog_formulir').modal('show');
		return false;
	}

	function update_data(id) {
		var pageUri = $('#pageUri').val();
		$("#formulir_modal").attr('transaksi', 'edit');
		$("#tabelDetailInvoice tbody").html('');
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
						$('#kat_gl').val(n["kat_gl"]);
						$('#jurnal_group').val(n["jurnal_group"]);
						$('#tanggal').val(n["tanggal"]);
						$('#deskripsi').val(n["deskripsi"]);
						$('#divisi').val(n["divisi"]);
						$('#memo').val('');
						$('#no_referensi').val(n["no_referensi"]);
						$('#ppn').val(n["ppn"]);
						$.ajax({
							type: 'POST',
							data: $('#formulir_modal').serialize(),
							url: pageUri + 'select_data_detail_invoice',
							success: function(html_detail) {
								$("#tabelDetailInvoice tbody").html(html_detail);
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
								cek_balance();
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

	function cek_balance() {
		var totaldebet = 0;
		var totalkredit = 0;
		var balance = 0;
		$("#tabelDetailInvoice tbody input[name^=tambah_account_id]").each(function(index) {
			var val = $("#tabelDetailInvoice tbody input[name^=tambah_account_id]:eq(" + index + ")").val();
			if (val != '') {
				var val_debet = filter_currency($("#tabelDetailInvoice tbody input[name^=tambah_debet]:eq(" + index + ")").val());
				var val_kredit = filter_currency($("#tabelDetailInvoice tbody input[name^=tambah_kredit]:eq(" + index + ")").val());
				totaldebet += val_debet;
				totalkredit += val_kredit;
			}
		});

		balance = totaldebet - totalkredit;

		$("#debet").val(totaldebet);
		$("#debet").maskMoney('mask');
		$("#kredit").val(totalkredit);
		$("#kredit").maskMoney('mask');
		$("#out_of_balance").val(balance);
		$("#out_of_balance").maskMoney('mask');
	}

	function delDetailInvoice(sy) {
		var ind = $(sy).index("#tabelDetailInvoice tbody button");
		$("#tabelDetailInvoice tbody tr:eq(" + (ind) + ")").remove();
		cek_balance();
	}

	function select_card(coa) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			type: 'POST',
			url: pageUri + 'select_card',
			data: {
				tambah_account_id: coa
			},
			success: function(html) {
				$('#tambah_pra_gl_card').html(html);
			}
		});
		return false;
	}

	function select_card_name(id) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			type: 'POST',
			url: pageUri + 'select_card_name',
			data: {
				id: id
			},
			success: function(html) {
				//alert(html);
				$('#tambah_pra_gl_card_name').val(html);
			}
		});
		return false;
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
				if (response) {
					$('#id_card').html(response);
				} else {
					$('#id_card').val('').change();
				}
			}
		});
	}
</script>