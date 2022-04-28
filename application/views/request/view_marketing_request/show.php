<?php
    // pre($modul);
    // pre($detail);
    // pre($task_ext);

	$options = array();
	$options['component'] = 'component/table/table_data_info';
	$options['label_width'] = '150';
	$options['sparator_width'] = '10';
	$options['data_row'] = array();

	$options['data_row']['Nama'] = $detail['author_name'];
	$options['data_row']['Lokasi'] = $detail['location_name'];
	$options['data_row']['Judul'] = $detail['subject'];
	$options['data_row']['Keterangan'] = $detail['body'];
	$options['data_row']['Tanggal Request'] = $task_ext['date_request_start'];


	echo $this->ui->load_component($options);
?>
<div class="panel-group" id="detail_cust" role="tablist" aria-multiselectable="true">
	<div class="panel panel-info"> 
		<div class="panel-heading" role="tab" id="heading'+i+'" style="padding: 5px 20px;">
			<h6 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#detail_cust" href="#collapse_cust" aria-expanded="true" aria-controls="collapse_cust"><span class="icon-arrow-right5"></span> Detail Pelanggan</a></h6>
		</div>
		<div id="collapse_cust" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_cust">
			<div class="panel-body">
				<table class="table_data_info" width="100%" border="1" id="detail_cust_table">
					<tbody>
						<tr>
							<td valign="top" width="200">Produk</td>
							<td><span id="cus_produk"></span></td>
						</tr>
						<tr>
							<td valign="top" width="200">Nama Pelanggan</td>
							<td><span id="cus_name"></span></td>
						</tr>
						<tr>
							<td valign="top" width="200">Alamat</td>
							<td><span id="cus_alamat"></span></td>
						</tr>
						<tr>
							<td valign="top" width="200">Koordinat</td>
							<td><span id="cus_koordinat"></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="task_attachment"></div>

<script type="text/javascript">
	$.ajax({
		type: 'GET',
		url : '<?php echo base_url().'xhr/task_report/get_task_detail/'.$detail['id']?>',
		success: function(response) {
			//remove row table after koordinat
			var tableRef = document.getElementById('detail_cust_table').getElementsByTagName('tbody')[0];
			// var newRow   = tableRef.deleteRow();
			var newRow;
			var exist_row = tableRef.getElementsByTagName('tr');
			for (var i = 0; i < exist_row.length; i++) {
				if (i >= 4) {
					newRow = tableRef.deleteRow(i);
				}
			}

			var cus_produk = response.data_location.data_product[0].name + ' - ' + response.data_location.data_product[0].value + ' ' + response.data_location.data_product[0].satuan_bandwidth;
			var cus_name = response.data_location.customer_name;
			var cus_alamat = response.data_location.customer_address;
			var cus_koordinat = response.data_location.koordinat;

			$("#cus_produk").empty().append(cus_produk);
			$("#cus_name").empty().append(cus_name);
			$("#cus_alamat").empty().append(cus_alamat);
			$("#cus_koordinat").empty().append(cus_koordinat);

			// add row PIC
			// console.log(response.data_location.data_contact);
			var extra_row = '';
			if (response.data_location.data_contact.length > 0) {
				for (var i = 0; i < response.data_location.data_contact.length; i++) {
					extra_row = '<td>PIC '+ (i>0 ? i+1 : '') +'</td>';

					extra_row += '<td>';
					extra_row += '<b>'+response.data_location.data_contact[i].name+'</b><br>';
					extra_row += 'Phone: '+ response.data_location.data_contact[i].telephone_home + '/' + response.data_location.data_contact[i].telephone_mobile + '/' + response.data_location.data_contact[i].telephone_office + '<br>';
					extra_row += 'Email: ' + response.data_location.data_contact[i].email;
					extra_row += '</td>';
					newRow = tableRef.insertRow(i+4);
					newRow.innerHTML = extra_row;
				}
			} else {
				extra_row = '<td>PIC</td>';

					extra_row += '<td>';
					extra_row += '<b>'+response.data_location.contact_person+'</b><br>';
					extra_row += 'Phone: '+ response.data_location.telephone_home + '/' + response.data_location.telephone_mobile + '/' + response.data_location.telephone_work + '<br>';
					extra_row += 'Email: ' + response.data_location.email;
					extra_row += '</td>';
					newRow = tableRef.insertRow(4);
					newRow.innerHTML = extra_row;
			}
		}
	});
	$.ajax({
		type: 'GET',
		url : '<?php echo base_url().'xhr/task_report/teknis_mrk_req_attachment/'.$detail['id']; ?>',
		success: function(res){
			var response = $.parseJSON(res);
			// console.log(response);
			var attachment = parseLinkAttachment(response);
			var html = '<b>Attachment</b><br>';
			html += attachment.html=='' ? 'Tidak ditemukan' : attachment.html;
			$('#task_attachment').empty().append(html);
			// console.log(html);
		}
	});

	function parseLinkAttachment(response) {
		var html = '';
		if (response.attachment.length > 0) {
			for (var i = 0; i < response.attachment.length; i++) {
				html += '<a href="<?php echo base_url().'uploads/'?>'+response.attachment[i].file_name+'" class="btn btn-primary" target="_blank">'+response.attachment[i].file_name+'</a>&nbsp;';
			}
		}
		if (typeof(response.parent)!=='undefined') {
			html += parseLinkAttachment(response.parent).html;
		}
		response.html = html;
		return response;
	}
</script>