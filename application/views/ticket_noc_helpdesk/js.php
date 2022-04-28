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
			lokasi: {required: true},
			ref_id: {required: true},
			subject: {required: true},
			status: {required: true},
			type: {required: true},
			priority: {required: true},
			forwarded: {required: true},
			report: {required: true},
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
			}
			return false;
		}
	});
		
	$('#comment_line').keypress(function (e) {
		if (e.which == 13 && $('#up_default').val() != '' && $('#up_default').val() != '0') {
			var comment = $('#comment_line').val();
			$.ajax({
				type:'POST', 
				url:pageUri+'insert_comment', 
				data:$('#formulir_modal').serialize(),
				beforeSend: function(){
					blockUI();
					$('#comment_line').val('Loading...');
				},
				success: function(response) {
					$('#timeline').html(response);
					$('#comment_line').val('');
					$('#timeline').animate({scrollTop: $('#timeline')[0].scrollHeight}, 2000);
					unBlockUI();
				}
			});
			
			return false;
		}
	});
	
	(function reqtimeline() {
		var tl_height = parseInt($('#timeline').height());
		var tl_scroll = parseInt($('#timeline').scrollTop());
		var tl_scheight = parseInt($('#timeline')[0].scrollHeight);
		$.ajax({
			type:'POST', 
			url:pageUri+'get_comment', 
			data:$('#formulir_modal').serialize(),
			success: function(response) {
				$('#timeline').html(response);
				if((tl_height + tl_scroll) == tl_scheight){
					$('#timeline').animate({scrollTop: $('#timeline')[0].scrollHeight}, 2000);
				}
			}
		});
		
        setTimeout(reqtimeline, 5000);
    })();
	
});

function open_search(){
	$('#formSearch').dialog('open');
	return false;
}
	
function input_data(){
	$('#formulir_modal').clearForm();
	$('#timeline,#ref_id').html('');
	$("#formulir_modal").attr('transaksi', 'tambah');
	$("#title_modal_flexible").html('Tambah');
	$('#formSearch').dialog('close');
	$('#modal_dialog_formulir').modal('show');
	return false;
}
	
function view_data(id, cek){
	var pageUri = $('#pageUri').val();
	$('#timeline,#ref_id').html('');
	$("#formulir_modal").attr('transaksi', 'edit');
	$("#title_modal_flexible").html('Edit');
	$('#id').val(id);
	
	$.ajax({
		type:'POST', 
		data:$('#formulir_modal').serialize(),
		url: pageUri+'select_data/'+cek,
		dataType: "json",
		beforeSend: function(){
			blockUI();
		},
		success: function(html){
			table.ajax.reload();
			if(html != ''){
				$.each(html, function(i,n){
					$('#id').val(id);
					get_detail_lokasi(n["lokasi"], n["ref_id"]);
					$('#up_default').val(n["up_default"]);
					$('#lokasi').val(n["lokasi"]);
					$('#subject').val(n["subject"]);
					$('#report').val(n["report"]);
					$('#analisys').val(n["analisys"]);
					$('#action').val(n["action"]);
					$('#forwarded').val(n["forwarded"]);
					$('#status').val(n["status"]);
					$('#type').val(n["type"]);
					$('#priority').val(n["priority"]);
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

function get_ticket(id){
	var pageUri = $('#pageUri').val();
	
		$.ajax({
			type:'GET', 
			url: pageUri+'get_ticket/'+id, 
			beforeSend: function(){
				blockUI();
			},
			success: function(response){
				if(response == '1'){
					table.ajax.reload();
					alert('Data berhasil diproses');
				}else if(response == '0'){
					table.ajax.reload();
					alert('Data telah diproses pihak lain');
				}else{
					alert(response);
				}
				unBlockUI();
			}
		});
}
	
function get_detail_lokasi(id, selec){
	var pageUri = $('#pageUri').val();
	
	$.ajax({
		type:'GET', 
		url: pageUri+'get_detail_lokasi/'+id,
		beforeSend: function(){
			blockUI();
		},
		success: function(html){
			$('#ref_id').html(html);
			$('#ref_id').val(selec);
			unBlockUI();
		}
	});
}

</script>
