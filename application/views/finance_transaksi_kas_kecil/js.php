<script type="text/javascript">
	$(function() {
		var pageUri = $('#pageUri').val();

		// function format(d) {
		// 	var div = $('<div/>').addClass('loading text-center').text('Loading...');
		// 	$.ajax({
		// 		url: pageUri + 'get_detail',
		// 		type: 'POST',
		// 		data: {
		// 			id: d
		// 		},
		// 		dataType: 'json',
		// 		success: function(response) {
		// 			div.html(response.html).removeClass('loading');
		// 		}
		// 	});
		// 	return div;
		// }
		//SET DATATABLES
		$.extend($.fn.dataTable.defaults, {
			//autoWidth: true,
			"sLength": "form-control",
		});
		//$.fn.dataTable.ext.classes.sPageButton = 'paginate_button current bg-indigo';
		var height_windows = $(window).height();
		var height_navbar = $('#navbar-main').height();
		var height_page = $('#page-header').height();
		var height_table = height_windows - height_navbar - height_page - 270;
		var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);

		table = $('#datamain_datatable').DataTable({
			dom: '<"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"pli>',
			"pageLength": 100,
			aaSorting: [
				[0, 'asc']
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
					data.searchkas_bank = $('#searchkas_bank').val();
				},
				beforeSend: function() {
					blockElement('datamain_datatable_wrapper');
				},
			},
			"drawCallback": function(settings) {
				unBlockElement('datamain_datatable_wrapper');
			},
			"columns": [{
					"data": "no"
				},
				{
					"data": "kode_jurnal"
				},
				{
					"data": "nomor"
				},
				{
					"data": "tanggal"
				},
				{
					"data": "cabang"
				},
				{
					"data": "divisi"
				},
				{
					"data": "jumlah"
				},
				{
					"data": "deskripsi"
				},
				{
					"data": "opsi"
				}
			],
			columnDefs: [{
				orderable: false,
				width: '120px',
				targets: [0, tabel_kolom]
			}, {
				className: "text-right",
				"targets": [0, 4]
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
			lengthMenu: [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
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

		$('#search_keyword').keyup(function() {
			table.ajax.reload(null, false);
		});
		$('.dataTables_length select').select2({
			minimumResultsForSearch: Infinity,
			width: 'auto',
		});
		// var detailRows = [];
		// $('#datamain_datatable tbody').on('click', 'td.details-control', function() {
		// 	var tr = $(this).closest('tr');
		// 	var row = table.row(tr);

		// 	if (row.child.isShown()) {
		// 		row.child.hide();
		// 		tr.removeClass('details');
		// 	} else {
		// 		row.child(format(tr.attr('id'))).show();
		// 		tr.addClass('details');
		// 	}
		// });


		$("#formulir_modal").validate({
			rules: {
				tanggal: {
					required: true
				},
				nomor: {
					required: true
				},
				kas_bank: {
					required: true
				},
				jumlah: {
					required: true
				},
				divisi_cat: {
					required: true
				},
			},
			submitHandler: function(form) {
				var tanggal = $("#tanggal").val();
				var tdate = new Date();
				var day = tdate.getDate(); //yields day
				var month = tdate.getMonth(); //yields month
				var year = tdate.getFullYear(); //yields year
				var currentDate= year + "-" +( month+1) + "-" + day;
				var cekTransaksi = $("#formulir_modal").attr('transaksi');
				if (cekTransaksi == 'tambah' && currentDate!==tanggal) {
					swal({
						title: "Anda Yakin?",
						text: "Anda akan proses input di tanggal yg berbeda dengan hari ini.",
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
								toastr.success('Data berhasil disimpan');
								table.ajax.reload(null, false);
								$('#modal_finance_transaksi_kas_kecil').modal('hide');
							} else if (response == '0') {
								toastr.error('Data gagal disimpan');
							} else {
								toastr.warning(response);
							}
							swal.close();
							unBlockUI();
							}
						});
					});
				} else if (cekTransaksi == 'tambah') {
					swal({
						title: "Anda Yakin?",
						text: "Anda akan proses inputan hari ini.",
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
								toastr.success('Data berhasil disimpan');
								table.ajax.reload(null, false);
								$('#modal_finance_transaksi_kas_kecil').modal('hide');
							} else if (response == '0') {
								toastr.error('Data gagal disimpan');
							} else {
								toastr.warning(response);
							}
							swal.close();
							unBlockUI();
							}
						});
					});
				} else if (cekTransaksi == 'edit' && currentDate!== tanggal) {
					swal({
						title: "Anda Yakin?",
						text: "Anda akan proses edit di tanggal yg berbeda dengan hari ini.",
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
								$('#modal_finance_transaksi_kas_kecil').modal('hide');
							} else if (response == '0') {
								toastr.error('Data gagal disimpan');
							} else {
								toastr.warning(response);
							}
							swal.close();
							unBlockUI();
						}
					});
				});
				} else if (cekTransaksi == 'edit' ) {
					swal({
						title: "Anda Yakin?",
						text: "Anda akan proses edit di hari ini.",
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
								$('#modal_finance_transaksi_kas_kecil').modal('hide');
							} else if (response == '0') {
								toastr.error('Data gagal disimpan');
							} else {
								toastr.warning(response);
							}
							swal.close();
							unBlockUI();
						}
					});
				});
				};  
				return false;
			}
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
		$('#modal_finance_transaksi_kas_kecil').modal('show');
		$(".currdebit").val('0').change();
		$(".form_add").html('<div class="row"><div class="col-lg-3"><label>kode coa</label><select class="form-control guna" name="guna[]" onchange="load_card(this)"></select></div><div class="col-lg-2"><label>card</label><select class="form-control card" name="card[]"></select></div><div class="col-lg-2"><label>debit</label><input class="form-control currdebit" type="text" name="debit[]" style="text-align:right"></div><div class="col-lg-4"><label>note</label><input class="form-control" type="text" name="note[]"></div></div>');
		load_jurnal();
		$( "#tanggal" ).datepicker({dateFormat:"yyy-mm-dd"}).datepicker("setDate",new Date());
		return false;
	}

	function update_data(id) {
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
					$('.form_add').html(html.data);
					load_jurnal();
					$('#id').val(id);
					$('#kas_bank').val(html.head["kode"]);
					$('#tanggal').val(html.head["tanggal"]);
					$('#divisi_cat').val(html.head["divisi"]);
					$('#cabang').val(html.head['branch']);
					$('#nomor').val(html.head['nomor']);
					$('#deskripsi').val(html.head["deskripsi"]);
					$('#jumlah').val(html.head["jumlah"]);
					$("#jumlah").maskMoney('mask');
					$("#jumlah").attr('readonly', 'readonly');
					$.each(html.detail, function(i, n) {
						load_card_id(i, n['id_coa']);
						$('#debit_' + i).val(n["nominal"]);
						$('#note_' + i).val(n["memo"]);
						$('#guna_' + i).empty().append($("<option/>").val(n["id_coa"]).text(n["nama_coa"])).trigger('change');
						$('#guna_' + i).on('change', function() {
							load_card(this);
						});
						$('#card' + i).empty().append($("<option/>").val(n["id_card"]).text(n["card_name"])).trigger('change');
					});
					$('#modal_finance_transaksi_kas_kecil').modal('show');
					unBlockUI();
				} else {
					toastr.error('Data tidak ditemukan');
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

	function get_karyawan(id, valnya) {
		var pageUri = $('#pageUri').val();

		$.ajax({
			type: 'GET',
			url: pageUri + 'get_karyawan/' + id,
			beforeSend: function() {
				blockUI();
			},
			success: function(response) {
				$('#karyawan').html(response);
				$('#karyawan').val(valnya);
				unBlockUI();
			}
		});
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
		$(".currdebit").autoNumeric();
		$(".currkredit").autoNumeric();
		$(".currdebit").on('keyup', function() {
			count_harga();
		});
		$(".currkredit").on('keyup', function() {
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

	$(document).ready(function() {

		$(".currdebit").autoNumeric();
		$(".currdebit").on('keyup', function() {
			count_harga();
		});
	});

	$(document).ready(function() {
		var wrapper = $(".form_add");
		var add_button = $(".add_form_field");

		var x = 1;
		$(add_button).click(function(e) {
			e.preventDefault();
			x++;
			$(wrapper).append('<div class="row adder"><div class="col-lg-3"><label>kode coa</label><select class="form-control guna" name="guna[]" onchange="load_card(this)"></select></div><div class="col-lg-2"><label>card</label><select class="form-control card" name="card[]"></select></div><div class="col-lg-2"><label>debit</label><input class="form-control currdebit" type="text" name="debit[]" value="0" style="text-align:right"/></div><div class="col-lg-4"><label>note</label><input class="form-control" type="text" name="note[]"></div><a href="#" class="delete" style="color:red">Delete</a></a><br></div>'); //add input box
			load_jurnal();
			$(".currdebit").change();
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
		var bayar = 0;

		$(".currdebit").each(function(index, elem) {
			bayar = $(elem).val().replace(/[,]+/g, "");
			totaldebit = parseFloat(parseFloat(totaldebit, 10) + parseFloat(bayar, 10)).toFixed(2);
		});
		$("#jumlah").val(totaldebit);
		$("#jumlah").autoNumeric();
		$("#jumlah").maskMoney('mask');
		$("#jumlah").attr('readonly', 'readonly');
	}
</script>