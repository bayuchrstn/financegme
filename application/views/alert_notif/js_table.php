<?php
foreach ($tabs as $tab) :
	$data_url = base_url() . 'alert_notif/data/' . $tab['code'];
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			$.fn.dataTableExt.sErrMode = 'throw';
			var oTable = $('#js_table_<?= $tab['code']; ?>').DataTable({
				"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
				"iDisplayLength": 10,
				"order": [
					[2, "desc"]
				],
				"columns": [{
						"data": "urut",
						"searchable": false,
						"orderable": false,
						"render": function(data, type, row, meta) {
							return row.is_starred == 1 ? '<a onclick="update_notif(' + row.id + ',\'unstarred\')" id="<?= $tab['code']; ?>_' + row.id + '"><i class="icon-star-full2"></i></a>' : '<a onclick="update_notif(' + row.id + ',\'starred\')" id="<?= $tab['code']; ?>_' + row.id + '"><i class="icon-star-empty3"></i></a>';
						},
					},
					{
						"data": "title",
						"name": "title",
						"searchable": true,
						"orderable": false,
						"render": function(data, type, row, meta) {
							return row.status == 'unread' ? '<a onclick="update_notif(' + row.id + ',\'read\')">' + data + '</a>' : '<a href="<?= base_url(); ?>' + row.url_link + '">' + data + '</a>';
						},
					},
					{
						"data": "content",
						"name": "content",
						"searchable": true,
						"orderable": false
					},
					{
						"data": "date_create",
						"name": "content",
						"searchable": true,
						"orderable": false
					},
				],
				"processing": true,
				"serverSide": true,
				"ajax": {
					url: '<?php echo $data_url; ?>',
					type: 'POST'
				}
			});

			setInterval(function() {
				$('#js_table_<?= $tab['code']; ?>').DataTable().ajax.reload(null, false);
			}, 30000);

			$('.search_form').on('keyup change', function() {
				$('#js_table_<?= $tab['code']; ?>').dataTable().api().search($(this).val()).draw();
			})
		});
	</script>
<?php endforeach; ?>