<script type="text/javascript">
	$(function() {
		function get_supplier() {
			var pageUri = $('#pageUri').val();
			$("#supplier").select2({
				placeholder: "Masukan Nama Supplier",
				width: "100%",
				ajax: {
					url: pageUri + 'get_supplier',
					type: "post",
					dataType: 'json',
					data: function(params) {
						return {
							searchTerm: params.term
						};
					},
					processResults: function(response) {
						return {
							results: response

						};
					},
					cache: false
				}
			});
		};
		get_supplier();
	});

	function select_date() {
		var id_val = $('#searchTanggal').val();

		if (id_val == '1') {
			$('#date_selected').css('display', '');
			$('#date_closed').css('display', 'none');
		} else if (id_val == '2') {
			$('#date_selected').css('display', 'none');
			$('#date_closed').css('display', 'none');
		} else if (id_val == '3') {
			$('#date_selected').css('display', 'none');
			$('#date_closed').css('display', '');
		}
	}
</script>