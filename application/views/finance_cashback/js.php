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
					data.search_status = $('#search_status').val();
					data.searchDateFirst = $('#searchDateFirst').val();
					data.searchDateFinish = $('#searchDateFinish').val();
				},
				beforeSend: function() {
					blockElement('datamain_datatable_wrapper');
				},
			},
			columnDefs: [{
					orderable: false,
					width: '60px',
					className: "text-center",
					targets: [0, tabel_kolom]
				},
				{
					orderable: false,
					className: "text-left",
					targets: [7]
				}
			],
			"drawCallback": function(settings) {
				unBlockElement('datamain_datatable_wrapper');
			},
			language: {
				lengthMenu: '<span>Show:</span> _MENU_',
				paginate: {
					'first': 'First',
					'last': 'Last',
					'next': '&rarr;',
					'previous': '&larr;'
				}
			},
			scrollY: height_table,
			scrollCollapse: false
		});

		$('#buttonPencarian').click(function() {
			table.ajax.reload(null, false);
		});
		$('.dataTables_length select').select2({
			minimumResultsForSearch: Infinity,
			width: 'auto',
		});
		//END SET DATATABLES
	});

	function update_data(id) {
		var pageUri = $('#pageUri').val();
		$("#formulir_modal").attr('transaksi', 'tambah');
		$("#title_modal_flexible").html('Bayar');
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
						let today = new Date().toISOString().slice(0, 10)
						$('#id').val(id);
						$('#tanggal').val(today);
						$('#jumlah').val(n["cashback"]);
						$("#jumlah").maskMoney('mask');
						$('#no_invoice').val(n["no_invoice"]);
						$('#result_no_invoice').val(n["konten"]);
						$('#cashback').val(n["jumlah"]);
						$('#modal_formulir').modal('show');
						unBlockUI();
					});
				} else {
					alert('Data tidak ditemukan');
					unBlockUI();
				}
			}
		});
	}

	$("#formulir_modal").validate({
		rules: {
			tanggal: {
				required: true
			},
			no_invoice: {
				required: true
			},
			guna: {
				required: true
			},
			jumlah: {
				required: true
			},
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var pageUri = $('#pageUri').val();
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
	$(document).ready(function() {
		$("#guna").select2({
			placeholder: "Pilih Kode Jurnal",
			width: "100%",
			ajax: {
				url: base_url + "Finance_cashback/get_coa",
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
</script>