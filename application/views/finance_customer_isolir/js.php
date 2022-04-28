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
			"ajax": {
				"url": pageUri + 'get_data_table',
				"type": "POST",
				"data": function(data) {
					data.searchdatefirst = $('#searchDateFirst').val();
					data.searchdatefinish = $('#searchDateFinish').val();
					data.search_keyword = $('#search_keyword').val();
					data.searchkategori = $('#searchkategori').val();
					data.searchkategori1 = $('#searchkategori1').val();
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
			$('#button_form_dropdown_search').next().toggle();
		});
		$('.dataTables_length select').select2({
			minimumResultsForSearch: Infinity,
			width: 'auto',
		});

		$('#search_keyword').keyup(function(){
			table.ajax.reload(null, false);
		});
		//END SET DATATABLES

		$("#formulir_modal").validate({
			rules: {
				id_client: {
					required: true
				},
				nomor_so: {
					required: true
				},
				jenis_terminate: {
					required: true
				},
				tgl_terminate: {
					required: true
				},
			},
			submitHandler: function(form) {
				var cekTransaksi = $("#formulir_modal").attr('transaksi');
				if (cekTransaksi == 'tambah') {
					$.ajax({
						type: 'POST',
						url: 'https://erpsmg.gmedia.id/erp_project/public/request_task/terminate_layanan',
						data: $('#formulir_modal').serialize(),
						beforeSend: function() {
							blockUI();
						},
						success: function(response) {
							if (response != '') {
								$.each(response.metadata, function(i, n) {
									if(n['status']=200){
										$('#formulir_modal').clearForm();
										$('#id_client').val('').change();
										toastr.success('Request berhasil dikirim');
										table.ajax.reload(null, false);
										$('#modal_dialog_formulir').modal('hide');
									}else if(n['status']=400){
										toastr.warning('Request gagal dikirim');
									}
									return false;
								});
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

	});

	function open_search() {
		$('#formSearch').dialog('open');
		return false;
	}

	function input_data() {
		$("#tgl_terminate").datepicker({ dateFormat: 'dd-mm-yy' });
		$("#tgl_dismantle").datepicker({ dateFormat: 'dd-mm-yy' });
		$('#formulir_modal').clearForm();
		$('.nip_id').val($('.nip_id').attr('id'));
		$("#formulir_modal").attr('transaksi', 'tambah');
		$("#title_modal_flexible").html('Tambah');
		$('#formSearch').dialog('close');
		$('#modal_dialog_formulir').modal('show');
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
					$.each(html, function(i, n) {
						$('#id').val(id);
						$('#customer_id, #customer_id_old').val(n["customer_id"]);
						$('#nama').val(n["nama"]);
						$('#alamat').val(n["alamat"]);
						$('#telp').val(n["telp"]);
						$('#kategori').val(n["kategori"]);
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

	$(document).ready(function() {
		
		var pageUri = $('#pageUri').val();

		$("#id_client").select2({
			placeholder: "Pilih Site",
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

	function get_so(lod){
		var pageUri = $('#pageUri').val();
		var so = $(lod).val();
		$(lod).closest("div.row").find("#no_so").val('');
		$(lod).closest("div.row").find("#no_so").select2({
			placeholder: "Pilih No SO",
			width: "100%",
			ajax: {
				url: pageUri + "get_so/" + so,
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
</script>