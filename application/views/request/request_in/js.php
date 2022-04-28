<?php
	$data_js = array();
	echo $this->load->view('task_item/js', $data_js, TRUE);
?>

    <script type="text/javascript">

	// Modal event handler
	$('#modal_request_insert').on('shown.bs.modal', function () {
		// clean_cart();
		// show_cart();
		// set_option('<?php echo base_url(); ?>select_option/kosong', 'item_terpasang_insert', '');
		// set_option('<?php echo base_url(); ?>select_option/kosong', 'item_detail_terpasang_insert', '');
		// $('#fakename_insert').html('');
	});

	$('#modal_request_insert').on('hidden.bs.modal', function () {
		// clean_cart();
		// show_cart();
		// set_option('<?php echo base_url(); ?>select_option/kosong', 'item_terpasang_insert', '');
		// set_option('<?php echo base_url(); ?>select_option/kosong', 'item_detail_terpasang_insert', '');
		// $('#fakename_insert').html('');
	});

	function show_this(x)
	{
		console.log(x);
		$("#modal_detail_ri_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		$('#modal_detail_ri').modal('show');
	}


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

	// ketika memilih task dismantle
	$('#up_select_insert').change(function(){
		var par = $(this).val();
		// console.log(par);
		// $("#current_location_div_insert").load("<?php echo base_url(); ?>ajax/location_dismatle_info/"+par);
		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>ajax/location_dismatle_info/'+par,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#fakename_insert').val(response.location_name);
				$('#location_insert').val(response.parent_detail.location);
				$('#location_id_insert').val(response.parent_detail.location_id);
				$("#item_terpasang_insert").html(response.item_transaction).val('').chosen().trigger('chosen:updated');

				//buka lock
				$('#add_task_item_locker').val('');
            }
        });
		return false;
	});

	//ketika item barang dipilih (menampilkan detail item barang)
	$('#item_terpasang_insert').change(function(){
		var item_id = $(this).val();
		var location = $('#location_insert').val();
		var location_id = $('#location_id_insert').val();
		// console.log(item_id);
		set_option('<?php echo base_url(); ?>select_option/item_detail_terpasang/'+location+'/'+location_id+'/'+item_id, 'item_detail_terpasang_insert', '');
		return false;
	});

	//membuat cart
	function in_picker_action()
	{
		// console.log('c');
		$.ajax({
			type:'POST',
			data: $('#cart_form_item_in').serialize(),
			url: '<?php echo base_url(); ?>cart/insert',
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				show_cart();
			}
		});
		return false;
	}

	//membuat cartform
	$('#item_detail_terpasang_insert').change(function(){
		var str = $(this).val();
		var opst = str.split("|");



		// var id_item_detail = $(this).val();
		var id_item_detail = opst[0];


		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>ajax/item_detail_info/'+id_item_detail,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
				$('#cart_id').val(response.id)
				$('#cart_name').val(response.bcn)
				$('#cart_options_nomor_barang').val(response.nomor_barang)
				$('#cart_options_mac_address').val(response.mac_address)
				$('#cart_options_transaction_id').val(opst[1])
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
				// console.log(response);
				update_ext(response.up);
				$('#add_task_item_locker').val('');
				// form customize
                $("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);

                // ext
                $('#location_update').val(response.location);
                $('#location_id_update').val(response.location_id);
                $('#up_select_update').val(response.up);

				getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_in/'+response.id+'/update/item_in_update/item_in', 'item_in_update');

                $('#modal_request_update').modal('show');
            }
        });
        return false;
    }

	function update_ext(par)
	{
		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>ajax/location_dismatle_info/'+par,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
				$('#fakename_update').val(response.location_name);
				$('#location_update').val(response.parent_detail.location);
				$('#location_id_insert').val(response.parent_detail.location_id);
				$("#item_terpasang_update").html(response.item_transaction).val('').chosen().trigger('chosen:updated');
            }
        });
		return false;
	}

    function input()
    {
		// alert('wkwkwk'); return false;
		clearcart();
		tinyMCE.get('body_insert').setContent('');
        $('#cart_div_insert').load('<?php echo base_url(); ?>xhr/request_in/cart/insert');
    	$('#modal_request_insert').modal('show');
        getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_in/0/insert/item_in_insert/item_in', 'item_in_insert');
        return false;
    }

	function clean_cart()
	{
		$.ajax({
			type:'GET',
			url: base_url+'cart/destroy',
			success: function(res) {
			}
		});
	}

	function show_cart()
	{
		$(".show_cart_div").load("<?php echo base_url(); ?>ajax/cart_item_in");
	}

	// function location_picker(location, location_id, flocation, flocation_id)
	// {
	// 	$.ajax({
	// 		type:'GET',
	// 		url: '<?php echo base_url(); ?>location_picker/index/'+location+'/'+location_id,
	// 		success: function(res) {
	// 			var response = jQuery.parseJSON(res);
	// 			// console.log(response);
	// 			$('#'+flocation).html(response.location).val(location).chosen().trigger('chosen:updated');
	// 			$('#'+flocation_id).html(response.location_id).val(location_id).chosen().trigger('chosen:updated');
	// 		}
	// 	});
	// }
	//
	// if( $('#location_insert').length ){
	// 	$('#location_insert').change(function(){
	// 		var location = $(this).val();
	// 		location_picker(location, '', 'location_insert', 'location_id_insert');
	// 	});
	// }
	//
	// if( $('#location_update').length ){
	// 	$('#location_update').change(function(){
	// 		var location = $(this).val();
	// 		location_picker(location, '', 'location_update', 'location_id_update');
	// 	});
	// }

	$(document).ajaxComplete(function(){

		// mengedit cart
		$('.cart_updater_btn').off().change(function(){
			var row = $(this).parents('tr').attr("id");
			// console.log(row);

			var edit_option_kondisi = $('#cart_kondisi_'+row).val();
			var edit_option_nomor_barang = $('#cart_nomor_barang_'+row).val();
			var edit_option_mac_address = $('#cart_mac_address_'+row).val();
			var edit_option_transaction_id = $('#cart_transaction_id_'+row).val();
			var edit_rowid = $('#cart_id_'+row).val();
			// console.log(edit_option_kondisi);
			// console.log(edit_rowid);

			$.ajax({
				type:'POST',
				data: {
					rowid: edit_rowid,
					options: {
						nomor_barang: edit_option_nomor_barang,
						mac_address: edit_option_mac_address,
						kondisi: edit_option_kondisi,
						transaction_id: edit_option_transaction_id,
					}
				},
				url: '<?php echo base_url(); ?>cart/update',
				success: function(res) {
					// var response = jQuery.parseJSON(res);
					// console.log(response);
					show_cart();
					// create_alert('cart_alert', 'Item berhasil diupdate', 'bg-success');
				}
			});
			return false;
		});

		// menghapus cart
		$('.cart_remover_btn').off().on('click', function(){
			var url = $(this).attr('href');
			$.ajax({
				type:'GET',
				url: url,
				success: function(res) {
					show_cart();
				}
			});
			return false;
		});
	});


    // new
    function buka_modal_barang_kembali(prefix)
	{
        var location = $('#location_'+prefix).val();
		var location_id = $('#location_id_'+prefix).val();
		if(location_id==''){
			alert('Referensi pekerjaan belum dipilih');
			return false;
		}
        $('#modal_rpc_in_div').load('<?php echo base_url(); ?>xhr/request_in/cart_in/'+location+'/'+location_id+'/'+prefix);
		$('#modal_rpc_in_form').attr('action', '<?php echo base_url(); ?>xhr/request_in/cart_in/'+location+'/'+location_id+'/'+prefix);
        $('#modal_rpc_in').modal('show');
		return false;
	}

    function cart_update_in(rowid, prefix)
	{
		// alert(rowid);
        var urla = "<?php echo base_url(); ?>xhr/request_in/cart_in_update/"+rowid+"/"+prefix;
		$.get(urla, function( data ) {
			console.log(data);
            $('#modal_cart_update_in_form').attr('action', urla);
			$('#modal_cart_update_in_div').html(data);
			$('#modal_cart_update_in').modal('show');
		});
		return false;
	}

    function cart_delete(rowid, prefix)
	{
		$.get("<?php echo base_url(); ?>cart/delete/"+rowid, function( data ) {
			$('#cart_div_'+prefix).load('<?php echo base_url(); ?>xhr/request_in/cart/'+prefix);
		});
		return false;
	}

	function current_update(mode, id)
    {
        // console.log(mode);
        // console.log(id);
        var urla = "<?php echo base_url(); ?>xhr/request_in/current_update/"+mode+"/"+id;
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
        var urla = "<?php echo base_url(); ?>xhr/request_in/current_delete/"+mode+"/"+id;
		$.get(urla, function( res ) {
			var response = jQuery.parseJSON(res);
            $('#current_div').load('<?php echo base_url(); ?>xhr/request_in/current/'+response.detail.task_id);
		});
        return false;
    }

	function clearcart()
	{
		// alert('ok');
		$.get("<?php echo base_url(); ?>cart/destroy");
	}

</script>
