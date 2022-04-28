<script type="text/javascript">
$(function() {
	var pageUri = $('#pageUri').val();
	
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
					success: function(response) {
						if(response == '1'){
							$('#formulir_modal').clearForm();
							alert('Data berhasil disimpan');
							searchTable();
						}else if(response == '0'){
							alert('Data gagal disimpan');
						}else{
							alert(response);
						}
					}
				});
			}else if(cekTransaksi == 'edit'){
				$.ajax({
					type:'POST', 
					url:pageUri+'edit_data', 
					data:$('#formulir_modal').serialize(),
					success: function(response) {
						if(response == '1'){
							alert('Data berhasil disimpan');
							searchTable();
						}else if(response == '0'){
							alert('Data gagal disimpan');
						}else{
							alert(response);
						}
					}
				});
			}
			return false;
		}
	});
	
	get_tabel_data();
});

function searchTable(){
	var pageUri 	= $('#pageUri').val();
	
	$('#tableData').flexOptions({ 
		url: pageUri+'get_data_table',
		params: [{name:'callId', value:'tableData'}].concat($('#pencarian').serializeArray()),
	}).flexReload();
}

function get_tabel_data(){
	var pageUri 	= $('#pageUri').val();
	
	$("#tableData").flexigrid({
		url : pageUri+'get_data_table',
		params: [{name:'callId', value:'tableData'}].concat($('#pencarian').serializeArray()),
		dataType : 'json',
		colModel : [{ display : 'no',	name : 'no', width : 30, sortable : false, align : 'right' },
					{ display : 'Nama',	name : 'a.nama', width : 200, sortable : true, align : 'left' },
					{ display : '#',	name : 'edit', width : 50, sortable : false, align : 'left' }],
		sortname : "a.nama",
		sortorder : "asc",
		usepager : true,
		useRp : true,
		rp : 100,
		showTableToggleBtn : false,
		width : '100%',
		height : $(window).height()-260,
		singleSelect : true,
	});
}

function open_search(){
	$('#formSearch').dialog('open');
	return false;
}
	
function input_data(){
	$('#formulir_modal').clearForm();
	$("#formulir_modal").attr('transaksi', 'tambah');
	$("#title_modal_flexible").html('Tambah');
	$('#formSearch').dialog('close');
	$('#modal_dialog_formulir').modal('show');
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
		success: function(html){
			if(html != ''){
				$.each(html, function(i,n){
					$('#id').val(id);
					$('#nama').val(n["nama"]);
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
			success: function(response){
				if(response == '1'){
					searchTable();
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

</script>
