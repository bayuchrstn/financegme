<script type="text/javascript">
	function row_table_detail(key='', value='') {
		var ret = '<tr>';
		ret += '<td valign="top" width="150">'+key+'</td>';
		ret += '<td valign="top" width="10">:</td>';
		ret += '<td valign="top">'+value+'</td>';
		ret += '</tr>';
		return ret;
	}
	function detail_barang(id_transaction, status='') {
		$.ajax({
			url : '<?php base_url(); ?>item_trace/detail/'+id_transaction+'/'+status,
			type: 'GET',
			success: function(ret){
				var response = $.parseJSON(ret);
				var html = '';
				html += '<table class="table_data_info"><tbody>';
				html += row_table_detail('<?php echo $this->lang->line('item_detail_brand');?>', response.brand_name);
				html += row_table_detail('<?php echo $this->lang->line('item_detail_category');?>', response.category_name);
				html += row_table_detail('<?php echo $this->lang->line('item_detail_name');?>', response.item_name);
				html += row_table_detail('<?php echo $this->lang->line('item_detail_no_item');?>', response.nomor_barang);
				html += row_table_detail('<?php echo $this->lang->line('item_detail_mac');?>', response.mac_address);
				html += row_table_detail('<?php echo $this->lang->line('item_detail_barcode');?>', response.barcode);
				if (status!='garansi' && status!='available') {
					html += row_table_detail('Lokasi', response.location_name);
					html += row_table_detail('Tanggal Pasang', response.date_install);

					if (response.item_terpasang!=null) {
						html += row_table_detail('Lokasi Saat Ini', response.item_terpasang.location_name);
						html += row_table_detail('Kepemilikan', response.item_terpasang.kepemilikan=='' ? '-' : response.item_terpasang.kepemilikan);
					}

				} else {
					html += row_table_detail('No. Invoice', response.invoice_number);
					html += row_table_detail('Tgl Pembelian', response.buy_date_custom);
				}
				html += '</tbody></table>';

				$('#div_detail_item_trace').empty().append(html);
				$('#modal_detail_item_trace').modal('show');
			}
		});
	}

	$(".search_form").on('keydown', function(e){
		if (e.keyCode==13) {
			$('#btnSearch').click();
			return false;
		}
	});
</script>