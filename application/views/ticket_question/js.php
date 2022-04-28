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
		aaSorting: [[1, 'asc']],
		"processing": true, 
		"serverSide": true, 
		"ajax": {
			"url": pageUri+'get_data_table',
			"type": "POST",
			"data": function (data) {
				data.search_keyword = $('#search_keyword').val();
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
				"targets": [0]
			},{ 
				className: "text-center", 
				"targets": [tabel_kolom]
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
		table.ajax.reload();
	});
	$('.dataTables_length select').select2({
		minimumResultsForSearch: Infinity,
		width: 'auto',
	});
	//END SET DATATABLES
	
	$("#formulir_modal").validate({
		rules: {
			nama: {required: true},
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
								$("#tabelDetailInvoice tbody").html('');
							alert('Data berhasil disimpan');
							table.ajax.reload();
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
							alert('Data berhasil disimpan');
							$("#tabelDetailInvoice tbody").html('');
							table.ajax.reload();
							view_data(id);
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
	
	$("#tambahDetailInvoice").click(function(){
		if($('#tambah_pertanyaan').val() == ''){
			alert('Pertanyaan mohon diisi');
		}else{
			var pertanyaan = $('#tambah_pertanyaan').val();
			
			var form = '<tr class="remove">';
				form += '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_pertanyaan[]" value="'+pertanyaan+'" /></td>';
				form += '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
			form += '</tr>';
			$("#tabelDetailInvoice tbody").append(form);
			$("#tabelDetailInvoice tbody button").button({icons:{primary: "ui-icon-trash"},text: false});
			$('#tabelDetailInvoice tbody button').unbind("click").bind("click", function(){
				delDetailInvoice(this);
				return false;
			});
			$('#tambah_pertanyaan').val('');
		}
		return false;
	});

});

function open_search(){
	$('#formSearch').dialog('open');
	return false;
}
	
function input_data(){
	$('#formulir_modal').clearForm();
	$("#formulir_modal").attr('transaksi', 'tambah');
	$("#tabelDetailInvoice tbody").html('');
	$("#title_modal_flexible").html('Tambah');
	$('#formSearch').dialog('close');
	$('#modal_dialog_formulir').modal('show');
	return false;
}
	
function view_data(id){
	var pageUri = $('#pageUri').val();
	$("#formulir_modal").attr('transaksi', 'edit');
	$("#tabelDetailInvoice tbody").html('');
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
					$('#nama').val(n["nama"]);
						$.ajax({
							type:'POST', 
							data:$('#formulir_modal').serialize(),
							url: pageUri+'select_data_detail',
							success: function(html_detail){
								$("#tabelDetailInvoice tbody").html(html_detail);
								$("#tabelDetailInvoice tbody button").button({icons:{primary: "ui-icon-trash"},text: false});
								$('#tabelDetailInvoice tbody button').unbind("click").bind("click", function(){
									delDetailInvoice(this);
									return false;
								});
								unBlockUI();
							}
						});
					$('#modal_dialog_formulir').modal('show');
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
					table.ajax.reload();
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

function delDetailInvoice(sy)
{
    var ind = $(sy).index("#tabelDetailInvoice tbody button");
	$("#tabelDetailInvoice tbody tr:eq("+(ind)+")").remove();
}

</script>
