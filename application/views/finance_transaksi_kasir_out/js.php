<script type="text/javascript">
$(function() {
	var pageUri = $('#pageUri').val();

	//SET DATATABLES
	$.extend( $.fn.dataTable.defaults, {
		//autoWidth: true,
		"sLength": "form-control",
	});
	//$.fn.dataTable.ext.classes.sPageButton = 'paginate_button current bg-indigo';
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
				data.searchkas_bank = $('#searchkas_bank').val();
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
				"targets": [0,4]
			},{ 
				className: "text-center", 
				"targets": [tabel_kolom, 1]
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
			tanggal: {required: true},
			fixcost_cat: {required: true},
			kas_bank: {required: true},
			jumlah: {required: true},
			deskripsi: {required: true},
			divisi_cat: {required: true},
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
	$("#formulir_modal").attr('transaksi', 'tambah');
	$("#title_modal_flexible").html('Tambah');
	$('#formSearch').dialog('close');
	$('#modal_finance_transaksi_kasir_out').modal('show');
	return false;
}
	
function update_data(id){
	var pageUri = $('#pageUri').val();
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
					$('#fixcost_cat').val(n["fixcost_cat"]);
					$('#tanggal').val(n["tanggal"]);
					$('#kas_bank').val(n["kas_bank"]);
					$('#divisi_cat').val(n["divisi_cat"]);
					$('#deskripsi').val(n["deskripsi"]);
					$('#jumlah').val(n["jumlah"]);
					$("#jumlah").maskMoney('mask');
					$('#modal_finance_transaksi_kasir_out').modal('show');
					unBlockUI();
				});
			}else{
				alert('Data tidak ditemukan');
				unBlockUI();
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

function get_karyawan(id, valnya){
	var pageUri = $('#pageUri').val();
	
		$.ajax({
			type:'GET', 
			url: pageUri+'get_karyawan/'+id, 
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				$('#karyawan').html(response);
				$('#karyawan').val(valnya);
				unBlockUI();
			}
		});
}            

</script>