<script type="text/javascript">
$(function() {
	var pageUri = $('#pageUri').val();
	
	$("#formulir_modal").validate({
		rules: {
			tanggal: {required: true},
			jumlah: {required: true},
			deskripsi: {required: true},
			departement: {required: true},
			karyawan: {required: true},
			dropbox_url: {required: true},
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
							$('#img_dropbox').html('');
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
					{ display : 'tanggal',	name : 'a.tanggal', width : 70, sortable : true, align : 'center' },
					{ display : 'jumlah',	name : 'a.jumlah', width : 130, sortable : true, align : 'right' },
					{ display : 'deskripsi',	name : 'a.deskripsi', width : 300, sortable : true, align : 'left' },
					{ display : '#',	name : 'edit', width : 50, sortable : false, align : 'left' }],
		sortname : "a.tanggal",
		sortorder : "desc",
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
	$('#img_dropbox').html('');
	$("#formulir_modal").attr('transaksi', 'tambah');
	$("#title_modal_flexible").html('Tambah');
	$('#formSearch').dialog('close');
	$('#modal_formulir').modal('show');
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
					$('#tanggal').val(n["tanggal"]);
					$('#jumlah').val(n["jumlah"]);
					$("#jumlah").maskMoney('mask');
					$('#deskripsi').val(n["deskripsi"]);
					$('#departement').val(n["code"]);
					$('#dropbox_url').val(n["dropbox_url"]);
					$('#dropbox_path').val(n["dropbox_path"]);
					$('#dropbox_path_old').val(n["dropbox_path"]);
					//$('#img_dropbox').html('<a href="'+n["dropbox_url"]+'" target="blank">[Lihat Gambar]</a>');
					dropbox_get_thumbnail(n["dropbox_path"], n["dropbox_url"]);
					get_karyawan(n["code"], n["karyawan"])
					$('#modal_formulir').modal('show');
				});
			}else{
				alert('Data tidak ditemukan');
			}
		}
	});
}

function delete_data(id, dropbox_path){
	var pageUri = $('#pageUri').val();

	if(confirmProses('Yakin ingin menghapus data?') == true) {
		$.ajax({
			type:'GET', 
			url: pageUri+'delete_data/'+id, 
			success: function(response){
				if(response == '1'){
					$.ajax({
						type: 'POST',
						data: {path : dropbox_path},
						url : pageUri+'delete_dropbox',
					});
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

function get_karyawan(id, valnya){
	var pageUri = $('#pageUri').val();
	
		$.ajax({
			type:'GET', 
			url: pageUri+'get_karyawan/'+id, 
			success: function(response){
				$('#karyawan').html(response);
				$('#karyawan').val(valnya);
			}
		});
}            

function upload_file(form_id, input_id) {
	var pageUri = $('#pageUri').val();
                var form = $('#'+form_id);
                var input = $('#'+input_id);

                var file_data = input.prop('files')[0];
                var form_data = new FormData(); 
                form_data.append(input_id, file_data);

                $.ajax({
                    type: 'POST',
                    data: form_data,
                    url : pageUri+'upload_dropbox',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response){
                        // var response = $.parseJSON(res);
                        $('#dropbox_url').empty().val(response.url);
                        $('#dropbox_path').empty().val(response.path);
                        //$('#dropbox_path_old').empty().val(response.path);
                        dropbox_get_thumbnail(response.path, response.url);
						delete_dropbox();
						if($('#id').val() != '' && $('#id').val() != '0'){
							save_dropbox();
						}
                    }
                });
}
			
function dropbox_get_thumbnail(dropbox_path, dropbox_url){
	var pageUri = $('#pageUri').val();
					$('#img_dropbox').html('Loading image...');
                $.ajax({
                    type: 'POST',
                    data: {path : dropbox_path},
                    url : pageUri+'get_thumbnail_dropbox',
                    success: function(response){
						$('#img_dropbox').html('<a href="'+dropbox_url+'" target="blank"><img src="'+response+'" alt=""></a>');
                    }
                });
}
			
function delete_dropbox(){
	var pageUri = $('#pageUri').val();
	var path_new = $('#dropbox_path').val();
	var path_old = $('#dropbox_path_old').val();
	
	if(path_old != ''){
                $.ajax({
                    type: 'POST',
                    data: {path : path_old},
                    url : pageUri+'delete_dropbox',
                    success: function(response){
						$('#dropbox_path_old').val($('#dropbox_path').val());
                    }
                });
	}
}
			
function save_dropbox(){
	var pageUri = $('#pageUri').val();
	
                $.ajax({
                    type: 'POST',
                    data:$('#formulir_modal').serialize(),
                    url : pageUri+'save_dropbox',
                    success: function(response){
						searchTable();
                    }
                });
}

</script>
