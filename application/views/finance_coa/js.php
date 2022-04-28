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
	var height_table = height_windows - height_navbar - height_page - 315;
	var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);
	
	table = $('#datamain_datatable').DataTable({ 
		dom: '<"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"B>',
		buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy3 position-left"></i> Copy'
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> Excel',
                    fieldSeparator: '\t',
                }
            ]
        },
		"pageLength": 100,
		aaSorting: [[0, 'asc']],
		"processing": true, 
		"serverSide": true, 
		"ajax": {
			"url": pageUri+'get_data_table',
			"type": "POST",
			"data": function (data) {
				data.search_keyword = $('#search_keyword').val();
				data.searchlevel = $('#searchlevel').val();
			},
			beforeSend: function(){
				blockElement('datamain_datatable_wrapper');
			},
		},"drawCallback": function( settings ) {
			unBlockElement('datamain_datatable_wrapper');
		},
		columnDefs: [{ 
				orderable: false,
				width: '120px',
				targets: [1,2,3,4, tabel_kolom ]
			},{ 
				className: "text-right", 
				"targets": []
			},{ 
				className: "text-center", 
				"targets": []
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

	$('.currency').blur(function(){
		$('.currency').formatNumber();
	});

	$("#formulir_modal").validate({
		rules: {
			nama: {required: true},
			level: {required: true},
			number: {required: true, number: true},
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
							get_number_type($('#parent').val());
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
							$('#id, #number_lama').val($('#group_type').val()+$('#number').val());
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
	$('#parent').html('<option value="">Loading...</option>');
	get_select_parent(0,0,'');
	$('#formulir_modal').clearForm();
	$("#formulir_modal").attr('transaksi', 'tambah');
	$('#formSearch').dialog('close');
	$('#modal_finance_coa').modal('show');
	return false;
}
	
function update_data(id){
	var pageUri = $('#pageUri').val();
	$("#formulir_modal").attr('transaksi', 'edit');
	$('#id').val(id);
	
	$.ajax({
		type:'POST', 
		data:$('#formulir_modal').serialize(),
		url: pageUri+'select_data',
		dataType: "json",
		success: function(html){
			if(html != ''){
				$.each(html, function(i,n){
					get_select_parent(id, n["parent"], n["kelompok"]);
					$('#id, #number_lama').val(id);
					$('#tukar').val(n["tukar"]);
					$('#saldo').val(n["saldo"]);
					$("#saldo").maskMoney('mask');
					$('#nama').val(n["nama"]);
					$('#tanggal').val(n["tanggal"]);
					$('#number').val(n["account_number"]);
					$('#level').val(n["level"]);
					$('#modal_finance_coa').modal('show');
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
			success: function(response){
				if(response == '1'){
					table.ajax.reload(null, false);
					alert('Data berhasil dihapus');
				}else if(response == '0'){
					alert('Data gagal dihapus');
				}else{
					alert(response);
				}
			}
		});
	}
}

function get_select_parent(id, pilih, kelompok){
	$('#parent').html('<option value="">Loading...</option>');
	var pageUri = $('#pageUri').val();
	
	$.ajax({
		url: pageUri+'select_parent/'+id+'/'+pilih+'/'+kelompok,
		success: function(html){
			$('#parent').html(html);
			$('#group_type').val(0);
			get_number_type($('#parent').val());
		}
	});
	return false;
}

function get_number_type(number){
	$('#group_type').val(0);
	var pageUri = $('#pageUri').val();
	
	$.ajax({
		url: pageUri+'get_number_type/'+number,
		dataType: "json",
		success: function(html){
			if(html != ''){
				$.each(html, function(i,n){
					$('#group_type').val(n['kelompok']);
					$('#tukar').val(n['tukar']);
				});
			}
		}
	});
	return false;	
}

</script>
