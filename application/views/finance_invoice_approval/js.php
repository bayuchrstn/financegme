<script type="text/javascript">
	$(function() {
		var pageUri = $('#pageUri').val();

		$("#cekall_invoice").click(function() {
			if ($("#cekall_invoice").is(":checked")) {
				$("input[name^=checkbox_invoice]").prop('checked', true);
			} else {
				$("input[name^=checkbox_invoice]").prop('checked', false);
			}
		});

		get_tabel_data();
	});

	function get_tabel_data() {
		var pageUri = $('#pageUri').val();
		$('#data_invoice_belum_approve').html('<em>Loading...</em>');
		$.ajax({
			type: 'POST',
			data: $('#pencarian').serialize(),
			url: pageUri + 'get_data_table',
			beforeSend: function() {
				blockUI();
			},
			success: function(html) {
				var a = JSON.parse(html);
				$('#data_invoice_belum_approve').html(a.data);
				$('#total_belum').html(a.total);
				unBlockUI();

				//alert(htmlnya);
			}
		});

	}

	function get_data_table_sudah() {
		var pageUri = $('#pageUri').val();
		$('#data_invoice_sudah_approve').html('<em>Loading...</em>');
		$.ajax({
			type: 'POST',
			data: $('#pencarian').serialize(),
			url: pageUri + 'get_data_table_sudah',
			beforeSend: function() {
				blockUI();
			},
			success: function(htmlnya) {
				var a = JSON.parse(htmlnya);
				$('#data_invoice_sudah_approve').html(a.data);
				$('#total_sudah').html(a.total);
				unBlockUI();
				//alert(htmlnya);
			}
		});

	}

	function approve_invoice() {
		var pageUri = $('#pageUri').val();
		var checkboxinvo = [];
		var n = '';
		$('input[name^=checkbox_invoice]:checked').each(function(index, elem) {
			checkboxinvo.push($(elem).val());
		});
		n = checkboxinvo.join(',');
		if (n != '') {
			$.ajax({
				type: 'POST',
				data: {
					id: n
				},
				url: pageUri + 'approve_invoice',
				beforeSend: function() {
					blockUI();
				},
				success: function(response) {
					if (response == '1') {
						toastr.success('Proses berhasil');
						get_tabel_data();
						get_data_table_sudah();
					} else if (response == '0') {
						toastr.error('Proses gagal');
					} else {
						toastr.warning(response);
					}
					unBlockUI();

				}
			});
		}
	}
	$(document).ready(function() {
		var d = new Date();
		var n = d.getMonth();
		var bln = String(n + 1).padStart(2, '0');
		$("#searchbln_inv").val(bln).change();
	});

	function input_data(elem) {
		var id = $(elem).attr("id");
		$('#no_invoice').val(id);
		get_head(id);
	}

	function get_head(id) {
		var pageUri = $('#pageUri').val();
		$.ajax({
			type: 'POST',
			data: {
				id: id
			},
			dataType: 'JSON',
			url: pageUri + 'get_header',
			success: function(response) {
				$('#pilihhead').html(response.data);
				$('input:radio[name="header"][value=' + response.id + ']').prop('checked', true);
				$('#modalHeader').modal('show');
			}
		});
	}

	function set_head() {
		var pageUri = $('#pageUri').val();
		var id = $('#no_invoice').val();
		var id_head = $("input[name='header']:checked").val();
		$.ajax({
			type: 'POST',
			data: {
				id: id,
				id_head: id_head
			},
			dataType: 'JSON',
			url: pageUri + 'set_header',
			success: function(response) {
				if (response = 1) {
					window.open(pageUri + 'print_selected' + '?inv=' + id, '_blank ');
					$('#modalHeader').modal('hide');
				}
			}
		});
	}
</script>