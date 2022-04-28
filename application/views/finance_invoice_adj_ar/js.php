<script type="text/javascript">
$(function() {
	var pageUri = $('#pageUri').val();

	//SET DATATABLES
	$.extend( $.fn.dataTable.defaults, {
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
		aaSorting: [[1, 'desc']],
		"processing": true, 
		"serverSide": true, 
		"ajax": {
			"url": pageUri+'get_data_table',
			"type": "POST",
			"data": function (data) {
				data.search_keyword = $('#search_keyword').val();
				data.searchDateFirst = $('#searchDateFirst').val();
				data.searchDateFinish = $('#searchDateFinish').val();
				data.searchkategori = $('#searchkategori').val();
				data.searchkat_inv = $('#searchkat_inv').val();
				data.searchstatus_inv = $('#searchstatus_inv').val();
				data.searchlunas = $('#searchlunas').val();
			},
			beforeSend: function(){
				blockElement('datamain_datatable_wrapper');
			},
		},"drawCallback": function( settings ) {
			unBlockElement('datamain_datatable_wrapper');
		},
		
		columnDefs: [{ 
				orderable: false,
				width: '60px',
				targets: [0, tabel_kolom ]
			},{ 
				className: "text-right", 
				"targets": [5,6,7]
			},{ 
				className: "text-center", 
				"targets": [1,2]
			}
		],
		language: {
			lengthMenu: '<span>Show:</span> _MENU_',
			paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
		},
		scrollX: true,
		scrollY: height_table,
		scrollCollapse: false,
		fixedColumns: {
			leftColumns: 0,
			rightColumns: 1
		},
	});
	
	$('#buttonPencarian').click(function(){ 
		table.ajax.reload(null, false);
	});
	$('.dataTables_length select').select2({
		minimumResultsForSearch: Infinity,
		width: 'auto',
	});
	//END SET DATATABLES
	
	$("#formulir_modal").validate({
		rules: {
			service_id_val: {required: true},
			nama: {required: true},
			customer_id: {required: true},
			customer_group_name: {required: true},
			date_invoice: {required: true},
			date_due: {required: true},
			periode_invoice: {required: true},
		},
		submitHandler: function(form) {
			var cekTransaksi = $("#formulir_modal").attr('transaksi');
			if(cekTransaksi == 'tambah'){
				$.ajax({
					type:'POST', 
					url:pageUri+'insert_data', 
					data:$('#formulir_modal').serialize(),
					beforeSend: function(){
						blockUI();
					},
					success: function(response) {
						if(response == '1'){
							$('#formulir_modal').clearForm();
							$("#tabelDetailInvoice tbody tr.remove").remove();
							alert('Data berhasil disimpan');
							table.ajax.reload(null, false);
						}else if(response == '0'){
							alert('Data gagal disimpan');
						}else{
							alert(response);
						}
						unBlockUI();
					}
				});
			}else if(cekTransaksi == 'edit'){
				$.ajax({
					type:'POST', 
					url:pageUri+'edit_data', 
					data:$('#formulir_modal').serialize(),
					beforeSend: function(){
						blockUI();
					},
					success: function(response) {
						if(response == '1'){
							var id = $('#id').val();
							$('#formulir_modal').clearForm();
							$("#tabelDetailInvoice tbody tr.remove").remove();
							alert('Data berhasil disimpan');
							table.ajax.reload(null, false);
							update_data(id);
						}else if(response == '0'){
							alert('Data gagal disimpan');
						}else{
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

function open_search(){
	$('#formSearch').dialog('open');
	return false;
}
	
function input_data(){
	$('#formulir_modal').clearForm();
	$("#tabelDetailInvoice tbody tr.remove").remove();
	$("#formulir_modal").attr('transaksi', 'tambah');
	$("#title_modal_flexible").html('Tambah');
	$('#formSearch').dialog('close');
	$('#modal_dialog_formulir').modal('show');
	return false;
}
	
function get_service_id(){
	var pageUri = $('#pageUri').val();
	//alert($('#service_id_val').val());
					$('#ppn,#service_id,#customer_id,#nama,#customer_group_name').val('');
	$.ajax({
		type:'POST', 
		data:$('#formulir_modal').serialize(),
		url: pageUri+'select_autocomplite_service',
		dataType: "json",
		beforeSend: function(){
			blockUI();
		},
		success: function(html){
			if(html != ''){
				$.each(html, function(i,n){
					$('#ppn').val(n["ppnnya"]);
					$('#service_id').val(n["service_id"]);
					//$('#service_id_val').val(n["ppnnya"]);
					$('#customer_id').val(n["customer_id"]);
					$('#nama').val(n["nama"]);
					$('#customer_group_name').val(n["customer_group_name"]);
					$('#service_produk').val(n["product_description"]);
					$('#bw').val(n["bandwith"]);
					$('#colo').val(n["colocation"]);
					$('#instalasi').val(n["instalasi"]);
					$('#perangkat').val(n["perangkat"]);
					$('#lain2').val(n["lain2"]);
					
					$.ajax({
						url: pageUri+'select_autocomplite_service_add/'+n["id"],
						success: function(html_detail){
							$("#tabelDetailInvoice tbody tr.remove").remove();
							$("#tabelDetailInvoice tbody").append(html_detail);
							$("#tabelDetailInvoice tbody button").button({icons:{primary: "ui-icon-trash"},text: false});
							$('#tabelDetailInvoice tbody button').unbind("click").bind("click", function(){
								delDetailInvoice(this);
								return false;
							});
							count_harga();
							unBlockUI();
						}
					});
					
					
				});
			}
			unBlockUI();
		}
	});
	
}

function update_data(id){
	var pageUri = $('#pageUri').val();
	$("#tabelDetailInvoice tbody tr.remove").remove();
	$("#formulir_modal").attr('transaksi', 'edit');
	$("#title_modal_flexible").html('Edit');
	$('#id').val(id);
	
	$.ajax({
		type:'POST', 
		data:$('#formulir_modal').serialize(),
		url: pageUri+'select_data',
		dataType: "json",
		beforeSend: function(){
			blockUI();
		},
		success: function(html){
			if(html != ''){
				$.each(html, function(i,n){
					$('#id').val(id);
					$('#ppn').val(n["ppnnya"]);
					$('#service_id, #service_id_val').val(n["service_id"]);
					$('#date_invoice').val(n["date_invoice"]);
					$('#date_due').val(n["date_due"]);
					$('#no_invoice').val(n["no_invoice"]);
					$('#periode_invoice').val(n["periode_invoice"]);
					$('#service_produk').val(n["product_desc"]);
					$('#service_note').val(n["product_note"]);
					$('#bw').val(n["bw"]);
					$('#colo').val(n["colo"]);
					$('#instalasi').val(n["instalasi"]);
					$('#perangkat').val(n["perangkat"]);
					$('#lain2').val(n["lain2"]);
					$('#potongan').val(n["potongan"]);
					$('#ppnnya').val(n["ppn"]);
					$('#pph2223').val(n["pph2223"]);
					$('#mf').val(n["mf"]);
					$('#bupot_ppn').val(n["bupot_ppn"]);
					$('#customer_id').val(n["customer_id"]);
					$('#nama').val(n["nama"]);
					$('#customer_group_name').val(n["customer_group_name"]);
					//$('#service_produk').val(n["product_description"]);
					$('#jenis_potongan').val(n["jenis_potongan"]);
					count_harga();
						$.ajax({
							type:'POST', 
							data:$('#formulir_modal').serialize(),
							url: pageUri+'select_data_detail_invoice',
							success: function(html_detail){
								$("#tabelDetailInvoice tbody tr.remove").remove();
								$("#tabelDetailInvoice tbody").append(html_detail);
								$("#tabelDetailInvoice tbody button").button({icons:{primary: "ui-icon-trash"},text: false});
								$('#tabelDetailInvoice tbody button').unbind("click").bind("click", function(){
									delDetailInvoice(this);
									return false;
								});
								count_harga();
								unBlockUI();
							}
						});
					$('#modal_dialog_formulir').modal('show');
				});
			}else{
				alert('Data tidak ditemukan');
			}
		}
	});
}

function delete_data(id){
	var pageUri = $('#pageUri').val();
	
	if(confirmProses('Yakin ingin menghapus data?') == true) {
		$.ajax({
			type:'GET', 
			url: pageUri+'delete_data/'+id, 
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				if(response == '1'){
					invoice_info();
					table.ajax.reload(null, false);
					alert('Data berhasil dihapus');
				}else if(response == '0'){
					alert('Data gagal dihapus');
				}else{
					alert(response);
				}
				unBlockUI();
			}
		});
	}
}

function invoice_belum_edit(id){
	var pageUri = $('#pageUri').val();
	
		$.ajax({
			type:'GET', 
			url: pageUri+'invoice_belum_edit/'+id, 
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				if(response == '1'){
					table.ajax.reload(null, false);
					alert('Proses berhasil');
				}else if(response == '0'){
					alert('Proses gagal');
				}else{
					alert(response);
				}
				unBlockUI();
			}
		});
}

function invoice_sudah_edit(id){
	var pageUri = $('#pageUri').val();
	
		$.ajax({
			type:'GET', 
			url: pageUri+'invoice_sudah_edit/'+id, 
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				if(response == '1'){
					table.ajax.reload(null, false);
					alert('Proses berhasil');
				}else if(response == '0'){
					alert('Proses gagal');
				}else{
					alert(response);
				}
				unBlockUI();
			}
		});
}


function invoice_sudah_approve(id){
	var pageUri = $('#pageUri').val();
	
		$.ajax({
			type:'GET', 
			url: pageUri+'invoice_sudah_approve/'+id, 
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				if(response == '1'){
					table.ajax.reload(null, false);
					alert('Proses berhasil');
				}else if(response == '0'){
					alert('Proses gagal');
				}else{
					alert(response);
				}
				unBlockUI();
			}
		});
}


function invoice_sudah_print(id){
	var pageUri = $('#pageUri').val();
	
		$.ajax({
			type:'GET', 
			url: pageUri+'invoice_sudah_print/'+id, 
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				if(response == '1'){
					table.ajax.reload(null, false);
					alert('Proses berhasil');
				}else if(response == '0'){
					alert('Proses gagal');
				}else{
					alert(response);
				}
				unBlockUI();
			}
		});
}

function print_invoice(id, alamat){
	var pageUri = $('#pageUri').val();
	pageUri = pageUri+''+alamat+'/'+id+'/'+1;
	//open_post_new_window(pageUri, 'id', id);
	//window.location.href = pageUri;
	popup(pageUri,800,500,'yes')
	return false;
}

function pdf_invoice(id, alamat){
	var pageUri = $('#pageUri').val();
	pageUri = pageUri+''+alamat+'/'+id+'/'+1;
	//open_post_new_window(pageUri);
	//window.location.href = pageUri;
	popup(pageUri,800,500,'yes')
	return false;
}

function open_modal_generate_invoice(){
	$('#modalGenerateInvoice').dialog('open');
	return false;
}

function invoice_info(){
	var pageUri = $('#pageUri').val();
	$('#info_invoice').html('<em>Loading...</em>');
		$.ajax({
			type:'GET', 
			url: pageUri+'invoice_info',
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				$('#info_invoice').html(response);
				unBlockUI();
			}
		});
}

function invoiceCreate(){
	var pageUri = $('#pageUri').val();
	alert('Data invoice akan di create secara otomatis. Data Invoice yang sudah dicreate tidak akan di create ulang.');
	
	if(confirmProses('Yakin ingin membuat invoice?') == true) {
		$.ajax({
			type:'POST', 
			data:$('#form_generate_invoice').serialize(),
			url: pageUri+'invoice_create',
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				if(response == '1'){
					invoice_info();
					alert('Data berhasil diproses');
					table.ajax.reload(null, false);
				}else if(response == '0'){
					alert('Data gagal diproses');
				}else{
					alert(response);
				}
				unBlockUI();
			}
		});
	}
}

function invoiceDelete(){
	var pageUri = $('#pageUri').val();
	alert('Semua data invoice akan dihapus.');
	
	if(confirmProses('Yakin ingin menghapus invoice?') == true) {
		$.ajax({
			type:'POST', 
			data:$('#form_generate_invoice').serialize(),
			url: pageUri+'invoice_delete',
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				if(response == '1'){
					invoice_info();
					alert('Data berhasil dihapus');
					table.ajax.reload(null, false);
				}else if(response == '0'){
					alert('Data gagal dihapus');
				}else{
					alert(response);
				}
				unBlockUI();
			}
		});
	}
}

function delDetailInvoice(sy)
{
    var ind = $(sy).index("#tabelDetailInvoice tbody button");
	$("#tabelDetailInvoice tbody tr:eq("+(ind+1)+")").remove();
	count_harga();
}

function count_harga(){
	var potongan = ($('#potongan').val() == '')?0:filter_currency($('#potongan').val());
	var ppnnya = ($('#ppnnya').val() == '')?0:filter_currency($('#ppnnya').val());
	var bw = ($('#bw').val() == '')?0:filter_currency($('#bw').val());
	var colo = ($('#colo').val() == '')?0:filter_currency($('#colo').val());
	var instalasi = ($('#instalasi').val() == '')?0:filter_currency($('#instalasi').val());
	var perangkat = ($('#perangkat').val() == '')?0:filter_currency($('#perangkat').val());
	var lain2 = ($('#lain2').val() == '')?0:filter_currency($('#lain2').val());
	
	var total = ppnnya - potongan;
	total += bw + colo + instalasi + perangkat + lain2;
	$("#tabelDetailInvoice tbody input[name^=tambah_service_produk]").each(function(index) {
		var tambah_bw = filter_currency($("#tabelDetailInvoice tbody input[name^=tambah_bw]:eq("+index+")").val());
		var tambah_colo = filter_currency($("#tabelDetailInvoice tbody input[name^=tambah_colo]:eq("+index+")").val());
		var tambah_instalasi = filter_currency($("#tabelDetailInvoice tbody input[name^=tambah_instalasi]:eq("+index+")").val());
		var tambah_perangkat = filter_currency($("#tabelDetailInvoice tbody input[name^=tambah_perangkat]:eq("+index+")").val());
		var tambah_lain2 = filter_currency($("#tabelDetailInvoice tbody input[name^=tambah_lain2]:eq("+index+")").val());
		total += tambah_bw + tambah_colo + tambah_instalasi + tambah_perangkat + tambah_lain2;
	});
	
	$("#total_tagihan").val(total);
	$("#total_tagihan").maskMoney('mask');
}


</script>
