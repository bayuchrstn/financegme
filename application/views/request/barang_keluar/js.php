<script type="text/javascript">


	function show_this(x)
	{
		console.log(x);
		$("#modal_detail_ro_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		$('#modal_detail_ro').modal('show');
	}

    function update(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        block_this('js_table_marketing_progress');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);

				$('#form_barang_keluar_update').attr('action', '<?php echo base_url(); ?>ajax/save_barang_keluar');

				set_info_request(response.id);
				set_form(response.id);

                $('#modal_request_update').modal('show');
                unblock_this('js_table_marketing_progress');
            }
        });
        return false;
    }

	function set_info_request(task_id)
	{
		var action = '<?php echo base_url(); ?>barang_keluar/show/'+task_id+'/echo';
		$.ajax({
			type: 'GET',
			url : action,
			success: function(response){
				$('#detail_request_update').load(response);
			},
			error: function(request, status, error){
				console.log(status);
				$('#detail_request_update').load('<?php echo base_url(); ?>approval_barang_keluar/show/'+task_id+'/echo');
			}
		});
		// $('#detail_request_update').load('<?php echo base_url(); ?>barang_keluar/show/'+task_id+'/echo');
	}

	function set_form(task_id)
	{
		$('#approval_form_update').load('<?php echo base_url(); ?>ajax/item_out_approval/'+task_id);
	}

	function pilih_barang_keluar(urut, id)
	{
		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>ajax/item_detail_select_picker/'+id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
				$('#form_item_detail_approval h4 span').html(response.title);
				$('#form_item_detail_approval #data_row').val(urut);
				$('#form_item_detail_approval #item_out_id').val(id);

				$('#form_item_detail_approval #current_task_id').val(response.task_id);
				$('#form_item_detail_approval #current_item_id').val(response.item_id);


				$('#form_item_detail_approval #current_approved_item_detail').val(response.current_approved_item_detail);
				$("#item_detail_picker").html(response.options).val('').chosen({search_contains:true}).trigger('chosen:updated');
				$('#modal_item_detail_approval').modal('show');
            }
        });
	}







</script>
