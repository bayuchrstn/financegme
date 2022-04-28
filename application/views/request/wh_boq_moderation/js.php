<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>

	function open_item_modal(prefix)
	{
		// alert('ok');
		$('#barang_div').removeClass('hidden');
		$('#custom_div').addClass('hidden');
		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/item_selector', 'item_selector_insert', 'barang');
		// set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/supplier', 'supplier_insert', '');
		$('#prefix_fcart').val(prefix);
		$('#modal_boq').modal('show');
		return false;
	}

	function show_this(x)
	{
		console.log(x);
		$("#modal_show_this_div").load("<?php echo base_url(); ?>boq/show/"+x+"/echo");
		$('#modal_show_this').modal('show');
	}


	//current action handle
	function current_update(id)
	{
		// alert(rowid);
		$.get("<?php echo base_url(); ?>ajax_request/boq_update_item/"+id, function( data ) {
			$('#modal_current_update_form').prop('action', '<?php echo base_url(); ?>ajax_request/boq_update_item/'+id)
			$('#modal_current_update_div').html(data);
			$('#modal_current_update').modal('show');
		});
		return false;
	}




	//main update
	function update(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
		// alert(action);
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

				$("#form_<?php echo $modul['code']?>_update").attr('action', '<?php echo base_url(); ?>xhr/boq/wh_moderation');
                getajax('<?php echo base_url(); ?>ajax_request/moderasi_boq/'+response.id, 'current_div');
				set_option('<?php echo base_url(); ?>select_option/request/<?php echo $req_code; ?>/wh_boq_moderation_status', 'status_update', response.status);
                $('#modal_request_update').modal('show');
				$('#id_update').val(response.id);
            }
        });
        return false;
    }

</script>
