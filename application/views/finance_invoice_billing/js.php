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
				"targets": [0, 3]
			}, {
				className: "text-center",
				"targets": [tabel_kolom, 1]
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

		$('.currency').blur(function() {
			$('.currency').formatNumber();
		});
		$("#formulir_modal").validate({
			rules: {
				tanggal: {
					required: true
				},
				kas_bank: {
					required: true
				},
				guna: {
					required: true
				},
				deskripsi: {
					required: true
				},
				transaksi: {
					required: true
				},
				val_id_ref: {
					required: true
				},
				result_id_ref: {
					required: true
				},
				kat_gl: {
					required: true
				}
			},
			submitHandler: function(form) {
				var cekTransaksi = $("#formulir_modal").attr('transaksi');
				if (cekTransaksi == 'tambah') {
					swal({
						title: "Anda Yakin?",
						text: "Anda akan proses pembayaran invoice ini.",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes!",
						closeOnConfirm: false
					}, function() {
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
									$('.form_add').html('<div class="row" style="margin-bottom:10px"><div class="col-lg-2"><label>kode coa</label><select class="form-control guna" name="guna[]" onchange="load_card(this)"></select></div><div class="col-lg-2"><label>card</label><select class="form-control card" name="card[]"></select></div><div class="col-lg-2 text-center"><label>debit</label><input class="form-control currdebit" type="text" name="debit[]" style="text-align:right"></div><div class="col-lg-2 text-center"><label>kredit</label></div><div class="col-lg-3"><label>note</label><input class="form-control" type="text" name="note[]"></div></div>');
									toastr.success('Data berhasil disimpan');
									load_jurnal();
									table.ajax.reload(null, false);
								} else if (response == '0') {
									toastr.warning('Data gagal disimpan');
								} else {
									toastr.error(response);
								}
								swal.close();
								unBlockUI();
							}
						});
					});
				} else if (cekTransaksi == 'edit') {
					swal({
						title: "Anda Yakin?",
						text: "Anda akan edit pembayaran invoice ini.",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes!",
						closeOnConfirm: false
					}, function() {
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
								} else if (response == '0') {
									toastr.warning('Data gagal disimpan');
								} else {
									toastr.error(response);
								}
								swal.close();
								unBlockUI();
							}
						});
					});
				}
				return false;
			}
		});

		$("#val_no_invoice").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: pageUri + 'select_autocomplite',
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
				$('#no_invoice').val(ui.item.id);
				$('#val_no_invoice').val(ui.item.nomor);
				detail_reference(ui.item.id)
				return false;
			}
		}).autocomplete("instance")._renderItem = function(ul, item) {
			return $("<li>")
				.append(item.konten)
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
		$('#modal_formulir').modal('show');
		var set = 0;
		$(".currdebit").val(set);
		$("#kredittot").val(set);
		$("#debittot").val(set);
		$("#ppn").val(set).change();
		$("#pph23").val(set).change();
		$("#blain2").val(set).change();
		$("#plain2").val(set).change();
		$("#piut").val(set);
		$(".form_add").html('<div class="row" style="margin-bottom:10px"><div class="col-lg-2"><label>kode coa</label><select class="form-control guna" name="guna[]" onchange="load_card(this)"></select></div><div class="col-lg-2"><label>card</label><select class="form-control card" name="card[]"></select></div><div class="col-lg-2 text-center"><label>debit</label><input class="form-control currdebit" type="text" name="debit[]" style="text-align:right"></div><div class="col-lg-2 text-center"><label>kredit</label></div><div class="col-lg-3"><label>note</label><input class="form-control" type="text" name="note[]"></div></div>');
		$('#val_no_invoice').attr('readonly',false);
		call_no_invoice();
		
		load_jurnal();
		load_card();
		return false;
	}

	function call_no_invoice(){
		var pageUri = $('#pageUri').val();
		$("#val_no_invoice").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: pageUri + 'select_autocomplite',
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
				$('#no_invoice').val(ui.item.id);
				$('#val_no_invoice').val(ui.item.nomor);
				detail_reference(ui.item.id)
				return false;
			}
		}).autocomplete("instance")._renderItem = function(ul, item) {
			return $("<li>")
				.append(item.konten)
				.appendTo(ul);
		};
	}
	function update_data(id) {
		var pageUri = $('#pageUri').val();
		$("#formulir_modal").attr('transaksi', 'edit');
		$("#title_modal_flexible").html('Edit');
		$('#id').val(id);
		var total = 0;

		$.ajax({
			type: 'POST',
			data: $('#formulir_modal').serialize(),
			url: pageUri + 'select_data',
			dataType: "json",
			beforeSend: function() {
				blockUI();
			},
			success: function(html_detail) {
				if (html_detail != '') {
					$('.form_add').html(html_detail.data);
					detail_reference(html_detail.no_invoice);
					load_jurnal();
					$.each(html_detail.detail, function(i, n) {
						load_numeric();
						console.log(i);
						$('#debit_' + i).val(n["debit"]);
						$('#note_' + i).val(n["note"]);
						$('#jum').val(n['jml_bayar']);
						$('#blain2').val(n['blain2']);
						$('#plain2').val(n['plain2']);
						$('#tanggal').val(n['tanggal']);
						$('#ppn').val(n['ppn']);
						$('#piut').val(n['piut']);
						$('#pph23').val(n['pph23']);
						$('#sisa').autoNumeric();
						$('#sisa').val(n['sisa']).change();
						$('#jml_tagih').autoNumeric();
						$('#jml_tagih').val(n['jumlah_piutang']).change();
						$('#no_invoice').val(n['id_arpost']);
						$('#guna_' + i).empty().append($("<option/>").val(n["id"]).text(n["coa"])).trigger('change');
						$('#card_' + i).empty().append($("<option/>").val(n["card_id"]).text(n["card_name"])).trigger('change');
						$('#kat_gl').val(n["kode"]);
						$('#val_no_invoice').val(n["nomor"]).trigger('change');
						count_harga();
					});
					// $('#outbalance').val(total);
					$('#modal_formulir').modal('show');
					unBlockUI();
				} else {
					alert('Data tidak ditemukan');
					unBlockUI();
				}
			}
		});
	};

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

	function clearDetTransaksi() {
		$('#no_invoice').val('');
		$('#result_no_invoice').val('');
	}

	function detail_reference(no_invoice) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			url: pageUri + 'select_detail_ref/' + no_invoice,
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
				blockUI();
			},
			success: function(result) {
				$('#result_no_invoice').val(result.html);
				$('#deposit').val(result.deposit);
				$("#deposit").maskMoney('mask');
				$("#depositid").val(result.depositid);
				// $('#tanggal').val(result.tanggal);
				// $('#piut').val(result.piutang);
				$('#jml_tagih').autoNumeric();
				$('#sisa').autoNumeric();
				var id = $('#result_no_invoice').val();
				if(id != '' ){
					$('#jml_tagih').val(result.sisa);
				}else{
					$('#jml_tagih').val(result.jml_piutang);
				}
				
				$('#sisa').val(result.sisa);
				if($('#id').val().length > 0){
				$('#val_no_invoice').attr('onkeyup',false);
				$('#val_no_invoice').attr('readonly',true);
				}
				count_harga();
				unBlockUI();
			}
		});
		return false;
	}

	$(document).ready(function() {
		$(".guna").select2({
			placeholder: "Pilih Kode COA",
			width: "100%",
			ajax: {
				url: base_url + "Finance_invoice_billing/get_coa",
				type: "post",
				dataType: 'json',
				data: function(params) {
					return {
						searchTerm: params.term,
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

	function load_jurnal() {
		$(".guna").select2({
			placeholder: "Pilih Kode COA",
			width: "100%",
			ajax: {
				url: base_url + "Finance_invoice_billing/get_coa",
				type: "post",
				dataType: 'json',
				data: function(params) {
					return {
						searchTerm: params.term,
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
		$(".currdebit").maskMoney();
		$(".currdebit").on('keyup', function() {
			count_harga();
		});
	}

	function load_card(lod) {
		var pageUri = $('#pageUri').val();
		var coa = $(lod).val();
		var pageUri = $('#pageUri').val();
		$(lod).closest("div.row").find(".card").val('');
		$(lod).closest("div.row").find(".card").select2({
			placeholder: "No Card",
			width: "100%",
			ajax: {
				url: pageUri + "get_card/" + coa,
				type: "post",
				dataType: 'json',
				data: function(params) {
					return {
						searchTerm: params.term,
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
	}

	function load_card_id(id, coa) {
		var pageUri = $('#pageUri').val();
		$('#card' + id).val('');
		$('#card' + id).select2({
			placeholder: "No Card",
			width: "100%",
			ajax: {
				url: pageUri + "get_card/" + coa,
				type: "post",
				dataType: 'json',
				data: function(params) {
					return {
						searchTerm: params.term,
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
	}

	function load_numeric() {
		$(".currdebit").autoNumeric();
		// $(".currdebit").val('0');
		$("#ppn").maskMoney();
		// $("#ppn").val('0');
		$("#pph23").maskMoney();
		$("#blain2").maskMoney();
		$("#plain2").maskMoney();
		$(".currdebit").on('keyup', function() {
			count_harga();
		});
		$("#ppn").on('keyup', function() {
			count_harga();
		});
		$("#pph23").on('keyup', function() {
			count_harga();
		});
		$("#blain2").on('keyup', function() {
			count_harga();
		});
		$("#plain2").on('keyup', function() {
			count_harga();
		});
	}
	$(document).ready(function() {

		$(".currdebit").maskMoney();
		$("#ppn").maskMoney();
		$("#pph23").maskMoney();
		$("#blain2").maskMoney();
		$("#plain2").maskMoney();
		$(".currdebit").on('keyup', function() {
			count_harga();
		});
		$("#ppn").on('keyup', function() {
			count_harga();
		});
		$("#pph23").on('keyup', function() {
			count_harga();
		});
		$("#blain2").on('keyup', function() {
			count_harga();
		});
		$("#plain2").on('keyup', function() {
			count_harga();
		});
	});

	$(document).ready(function() {
		var max_fields = 10;
		var wrapper = $(".form_add");
		var add_button = $(".add_form_field");

		var x = 1;
		$(add_button).click(function(e) {
			e.preventDefault();
			if (x < max_fields) {
				x++;
				$(wrapper).append('<div class="row adder" style="margin-bottom:10px"qqqq><div class="col-lg-2"><select class="form-control guna" name="guna[]" onchange="load_card(this)"></select></div><div class="col-lg-2"><select class="form-control card" name="card[]"></select></div><div class="col-lg-2"><input class="form-control currdebit" type="text" name="debit[]" value="0" style="text-align:right"/></div><div class="col-lg-2"></div><div class="col-lg-3"><input class="form-control" type="text" name="note[]"></div><a href="#" class="delete" style="color:red">Delete</a></a><br></div>'); //add input box
				load_jurnal();
				$(".currdebit").change();
			} else {
				toastr.warning('You Reached the limits');
			}
		});

		$(wrapper).on("click", ".delete", function(e) {
			e.preventDefault();
			$(this).parent('div').remove();
			x--;
			count_harga();
		})
	});

	function count_harga() {
		var totaldebit = 0;
		var totalkredit = 0;
		var ppn = $("#ppn").val().replace(/[,]+/g, "");
		var pph = $("#pph23").val().replace(/[,]+/g, "");
		var blain2 = $("#blain2").val().replace(/[,]+/g, "");
		var plain2 = $("#plain2").val().replace(/[,]+/g, "");
		var piut = $("#piut").val().replace(/[,]+/g, "");
		var tagih = $("#jml_tagih").val().replace(/[,]+/g, "");
		var bayar = 0;
		var sisa = 0;

		if(ppn.length!=0){
			ppn = parseFloat(parseFloat(ppn, 10)).toFixed(2);
		}else{
			ppn =0;
		}
		
		if(pph.length!=0){
			pph = parseFloat(parseFloat(pph, 10)).toFixed(2);
		}else{
			pph =0;
		}

		if(blain2.length!=0){
			blain2 = parseFloat(parseFloat(blain2, 10)).toFixed(2);
		}else{
			blain2 =0;
		}

		if(plain2.length!=0){
			plain2 = parseFloat(parseFloat(plain2, 10)).toFixed(2);
		}else{
			plain2 =0;
		}

		if(piut.length!=0){
			piut = parseFloat(parseFloat(piut, 10)).toFixed(2);
		}else{
			piut =0;
		}

		if(tagih.length!=0){
			tagih = parseFloat(parseFloat(tagih, 10)).toFixed(2);
		}else{
			tagih =0;
		}

		$(".currdebit").each(function(index, elem) {
			bayar = $(elem).val().replace(/[,]+/g, "");
			if (bayar > 0) {
				totaldebit = parseFloat(parseFloat(totaldebit, 10) + parseFloat(bayar, 10)).toFixed(2);
				totaldebit = parseFloat(parseFloat(totaldebit, 10) + parseFloat(ppn, 10) + parseFloat(pph, 10) + parseFloat(blain2, 10)).toFixed(2);
			}

		});
		piut = parseFloat(parseFloat(totaldebit, 10) - parseFloat(plain2, 10)).toFixed(2);
		totalkredit = parseFloat(parseFloat(totalkredit, 10) + parseFloat(piut, 10) + parseFloat(plain2, 10)).toFixed(2);
		sisa = parseFloat(parseFloat(tagih, 10) - parseFloat(totaldebit, 10)).toFixed(2);
		// $("#outbalance").val(totaldebit - totalkredit);
		// $("#outbalance").autoNumeric();
		$("#debittot").autoNumeric();
		$("#kredittot").autoNumeric();
		$("#piut").autoNumeric();
		$("#piut").val(piut);
		$("#debittot").val(totaldebit);
		$("#kredittot").val(totalkredit);
		if (sisa >= 0) {
			$("#sisa").val(sisa);
		}
		
	}
</script>