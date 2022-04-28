<script type="text/javascript">
$(function() {
	var pageUri = $('#pageUri').val();
	
	$("#formulir_modal").validate({
		rules: {
			kelompok: {required: true, number: true},
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
							$('#id').val($('#kelompok').val()+'00000');
							$('#kelompok_lama').val($('#kelompok').val());
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
					{ display : 'group number',	name : 'a.kelompok', width : 100, sortable : true, align : 'center' },
					{ display : 'Nama account',	name : 'a.nama', width : 250, sortable : true, align : 'left' },
					{ display : 'mekanisme',	name : 'mekanisme', width : 150, sortable : true, align : 'center' },
					{ display : '#',	name : 'edit', width : 50, sortable : false, align : 'left' }],
		sortname : "a.kelompok",
		sortorder : "asc",
		usepager : true,
		useRp : true,
		rp : 100,
		showTableToggleBtn : false,
		width : '100%',
		height : $(window).height()-215,
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
	$('#formSearch').dialog('close');
	$('#modal_finance_coa_category').modal('show');
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
					$('#id').val(id);
					$('#kelompok_lama').val(n["kelompok"]);
					$('#kelompok').val(n["kelompok"]);
					$('#nama').val(n["nama"]);
					$('#tukar').val(n["tukar"]);
					$('#modal_finance_coa_category').modal('show');
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
