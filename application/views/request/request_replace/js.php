<?php
	$data_js = array();
	echo $this->load->view('task_item/js', $data_js, TRUE);
?>


<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	tinymce.init({
		selector: '.wysiwyg',
		statusbar:  false,
		menubar:    false,
		rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ],
		setup: function(editor) {
			editor.on('change', function(e) {
				var isi = this.getContent();
				$('.fake_tinymce').val(isi);
			});
		}
	});

	function show_this(x)
	{
		console.log(x);
		$("#modal_detail_ro_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		$('#modal_detail_ro').modal('show');
	}

	$('#up_select_insert').change(function(){
		var par = $(this).val();
		// console.log(par);
		// $("#current_location_div_insert").load("<?php echo base_url(); ?>ajax/location_dismatle_info/"+par);
		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>ajax/location_replace_info/'+par,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#fakename_insert').val(response.location_name);
				$('#location_insert').val(response.parent_detail.location);
				$('#location_id_insert').val(response.parent_detail.location_id);

				//buka lock
				$('#add_task_item_locker').val('');
            }
        });
		return false;
	});

    function update(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

				$('#add_task_item_locker').val('');

				// form customize
                $("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);

                // ext

                // form customize

				up_selected(response.up);
				$('#location_update').val(response.location);
                $('#location_id_update').val(response.location_id);

				getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_in/'+response.id+'/update/item_in_update/item_replace_in', 'item_in_update');
				getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_out/'+response.id+'/update/item_out_update/item_replace_out', 'item_out_update');

                $('#modal_request_update').modal('show');

            }
        });
        return false;
    }

	function up_selected(up)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>ajax/up_selected/'+up,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#up_select_subject').val(response.subject);
				$('#up_select_update').val(response.id);
			}
		});
		return false;
	}

    function input()
    {
		// alert('ini');
		clearcart();
		$('#location_insert').val('');
		$('#location_id_insert').val('');
		$('#add_task_item_locker').val('Referensi pekerjaan belum dipilih');
		tinyMCE.get('body_insert').setContent('');
		set_option('<?php echo base_url(); ?>select_option/request/<?php echo $modul['code']; ?>/ref_task_replace', 'up_select_insert', '');
		getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_in/0/insert/item_in_insert/item_replace_in', 'item_in_insert');
		getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_out/0/insert/item_out_insert/item_replace_out', 'item_out_insert');
		$('#replace_cart_div_insert').load('<?php echo base_url(); ?>ajax_request/replace_cart/insert');
		$('#modal_request_insert').modal('show');

        return false;
    }

	function buka_modal_barang_keluar(prefix)
	{
		var location = $('#location_'+prefix).val();
		var location_id = $('#location_id_'+prefix).val();
		if(location_id==''){
			alert('Referensi pekerjaan belum dipilih');
			return false;
		}

		$('#modal_rpc_out_div').load('<?php echo base_url(); ?>xhr/request_replace/cart_out/'+prefix);
		$('#modal_rpc_out_form').attr('action', '<?php echo base_url(); ?>xhr/request_replace/cart_out/'+prefix);
		$('#modal_rpc_out').modal('show');
		return false;
	}

	function buka_modal_barang_kembali(prefix)
	{
        var location = $('#location_'+prefix).val();
		var location_id = $('#location_id_'+prefix).val();
		if(location_id==''){
			alert('Referensi pekerjaan belum dipilih');
			return false;
		}
        $('#modal_rpc_in_div').load('<?php echo base_url(); ?>xhr/request_replace/cart_in/'+location+'/'+location_id+'/'+prefix);
		$('#modal_rpc_in_form').attr('action', '<?php echo base_url(); ?>xhr/request_replace/cart_in/'+location+'/'+location_id+'/'+prefix);
        $('#modal_rpc_in').modal('show');
		return false;
	}

	function cart_update_in(rowid, prefix)
	{
		// alert(rowid);
        var urla = "<?php echo base_url(); ?>xhr/request_replace/cart_in_update/"+rowid+"/"+prefix;
		$.get(urla, function( data ) {
			console.log(data);
            $('#modal_cart_update_in_form').attr('action', urla);
			$('#modal_cart_update_in_div').html(data);
			$('#modal_cart_update_in').modal('show');
		});
		return false;
	}

	function cart_update_out(rowid, prefix)
	{
        var urla = "<?php echo base_url(); ?>xhr/request_replace/cart_out_update/"+rowid+"/"+prefix;
		$.get(urla, function( data ) {
			// console.log(data);
            $('#modal_cart_update_out_form').attr('action', urla);
			$('#modal_cart_update_out_div').html(data);
			$('#modal_cart_update_out').modal('show');
		});
		return false;
	}

	function cart_delete(rowid, prefix)
	{
		$.get("<?php echo base_url(); ?>cart/delete/"+rowid, function( data ) {
			$('#replace_cart_div_'+prefix).load('<?php echo base_url(); ?>ajax_request/replace_cart/'+prefix);
			// getajax('<?php echo base_url(); ?>ajax_request/loadcart/pengadaan/'+prefix, 'cartdiv_'+prefix);
			// getajax('<?php echo base_url(); ?>ajax_request/loadcart/pembanding/'+prefix, 'pembandingdiv_'+prefix);
		});
		return false;
	}

    function current_update(mode, id)
    {
        // console.log(mode);
        // console.log(id);
        var urla = "<?php echo base_url(); ?>xhr/request_replace/current_update/"+mode+"/"+id;
		$.get(urla, function( data ) {
			// console.log(data);
            $('#modal_current_update_form').attr('action', urla);
			$('#modal_current_update_div').html(data);
			$('#modal_current_update').modal('show');
		});
		return false;
    }

    function current_delete(mode, id)
    {
        // console.log(mode);
        // console.log(id);
        var urla = "<?php echo base_url(); ?>xhr/request_replace/current_delete/"+mode+"/"+id;
		$.get(urla, function( res ) {
			var response = jQuery.parseJSON(res);
            $('#current_div').load('<?php echo base_url(); ?>xhr/request_replace/current/'+response.detail.task_id);
		});
        return false;
    }

	function clearcart()
	{
		// alert('ok');
		$.get("<?php echo base_url(); ?>cart/destroy");
	}

</script>
