<?php
	$data_js = array();
	echo $this->load->view('task_item/js', $data_js, TRUE);
?>
<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');

	// $('#modal_request_insert').on('shown.bs.modal', function () {
	//
	// 	$('#show_cart_div').html('');
	// });
	//
	// $('#modal_request_insert').on('hidden.bs.modal', function () {
	// 	$('#show_cart_div').html('');
	// });
	//
	// $('#modal_request_update').on('shown.bs.modal', function () {
	//
	// 	$('#show_cart_div').html('');
	// });
	//
	// $('#modal_request_update').on('hidden.bs.modal', function () {
	// 	$('#show_cart_div').html('');
	//
	// });

	function show_this(x)
	{
		console.log(x);
		$("#modal_detail_ro_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		$('#modal_detail_ro').modal('show');
	}

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

	// $('#up_select_insert').change(function(){
	// 	var par = $(this).val();
	// 	console.log(par);
	// 	// $("#location_hidden_div").load("<?php echo base_url(); ?>ajax/up_request_forms/"+par+"/location");
	// 	return false;
	// });

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
				$('#location_insert').val(response.parent_detail.location);
				$('#location_id_insert').val(response.parent_detail.location_id);

				//buka lock
				$('#add_task_item_locker').val('');
            }
        });
		return false;
	});

	function buka_modal_barang_keluar(prefix)
	{
		var location = $('#location_'+prefix).val();
		var location_id = $('#location_id_'+prefix).val();
		if(location_id==''){
			alert('Referensi pekerjaan belum dipilih');
			return false;
		}

		$('#modal_rpc_out_div').load('<?php echo base_url(); ?>xhr/request_out/cart_out/'+prefix);
		$('#modal_rpc_out_form').attr('action', '<?php echo base_url(); ?>xhr/request_out/cart_out/'+prefix);
		$('#modal_rpc_out').modal('show');
		return false;
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
				$('#add_task_item_locker').val('');
				// form customize
                $("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);

				up_selected(response.up);
				$('#location_update').val(response.location);
                $('#location_id_update').val(response.location_id);

				getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_out/'+response.id+'/update/item_out_update/item_out', 'item_out_update');


                $('#modal_request_update').modal('show');
                unblock_this('js_table_marketing_progress');
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
		$('#add_task_item_locker').val('Referensi pekerjaan belum dipilih');
		clearcart();
		// show_cart('show_cart_div_insert');
		tinyMCE.get('body_insert').setContent('');
		getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_out/0/insert/item_out_insert/item_out', 'item_out_insert');

		$('#modal_request_insert').modal('show');
        return false;
    }

	function show_cart(target_div)
	{
		// alert(target_div);
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>ajax/cart_item_out/'+target_div,
			success: function(res) {
				// var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#'+target_div).html(res);
			}
		});
	}

	// bcn_picker
	function bcn_picker(brand, category, name, fbrand, fcategory, fname)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>bcn_picker/index/'+brand+'/'+category,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);

				// console.log(brand);
				// console.log(category);
				// console.log(name);

				var sel_brand = (brand !='') ? brand : response.selected_brand;
				var sel_category = (category !='') ? category : response.selected_category;
				var sel_name = (name !='') ? name : response.selected_name;

				// console.log(sel_brand);
				// console.log(sel_category);
				// console.log(sel_name);

				$('#'+fbrand).html(response.brand).val(sel_brand).chosen().trigger('chosen:updated');
				$('#'+fcategory).html(response.category).val(sel_category).chosen().trigger('chosen:updated');
				$('#'+fname).html(response.name).val(sel_name).chosen().trigger('chosen:updated');

				built_cart_form(sel_name);
			}
		});
	}

	function built_cart_form(sel_name)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>ajax/built_cart_form/'+sel_name,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#cart_id').val(response.id);
				$('#cart_name').val(response.item_name);
			}
		});
	}

	if( $('#item_brand_insert').length ){
		$('#item_brand_insert').change(function(){
			var brand = $(this).val();
			bcn_picker(brand, '', '', 'item_brand_insert', 'item_category_insert', 'item_name_insert');
		});
	}

	if( $('#item_brand_update').length ){
		$('#item_brand_update').change(function(){
			var brand = $(this).val();
			bcn_picker(brand, '', '', 'item_brand_update', 'item_category_update', 'item_name_update');
		});
	}

	if( $('#item_category_insert').length ){
		$('#item_category_insert').change(function(){
			var brand = $('#item_brand_insert').val();
			var cat = $(this).val();
			// alert(brand+' '+cat);
			// alert(brand);
			bcn_picker(brand, cat, '', 'item_brand_insert', 'item_category_insert', 'item_name_insert');
		});
	}

	if( $('#item_category_update').length ){
		$('#item_category_update').change(function(){
			var brand = $('#item_brand_update').val();
			var cat = $(this).val();
			// alert(brand+' '+cat);
			// alert(brand);
			bcn_picker(brand, cat, '', 'item_brand_update', 'item_category_update', 'item_name_update');
		});
	}

	if( $('#item_name_insert').length ){
		$('#item_name_insert').change(function(){
			var brand = $('#item_brand_insert').val();
			var cat = $('#item_category_insert').val();
			var name = $(this).val();
			// alert(brand+' '+cat);
			// alert(brand);
			bcn_picker(brand, cat, name, 'item_brand_insert', 'item_category_insert', 'item_name_insert');
		});
	}

	if( $('#item_name_update').length ){
		$('#item_name_update').change(function(){
			var brand = $('#item_brand_update').val();
			var cat = $('#item_category_update').val();
			var name = $(this).val();
			// alert(brand+' '+cat);
			// alert(brand);
			bcn_picker(brand, cat, name, 'item_brand_update', 'item_category_update', 'item_name_update');
		});
	}

	// if( $('#location_update').length ){
	// 	$('#location_update').change(function(){
	// 		var location = $(this).val();
	// 		location_picker(location, '', 'location_update', 'location_id_update');
	// 	});
	// }
	// bcn_picker

	function add_item_out(prefix)
	{
		$.ajax({
			type:'POST',
			data: $('#cart_form_item_out').serialize(),
			url: '<?php echo base_url(); ?>cart/insert',
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				show_cart('show_cart_div_'+prefix);
			}
		});
	}

	function cart_update(row, random, cart_div){

		// var row = $(this).parents('tr').attr("id");
		// console.log(row);
		// console.log(random);
		// return false;

		var edit_qty = $('#'+random+'_cart_qty_'+row).val();
		var edit_option_status = $('#'+random+'_cart_status_'+row).val();
		var edit_rowid = $('#'+random+'_cart_id_'+row).val();

		// console.log(edit_qty);
		// console.log(edit_option_status);
		// console.log(edit_rowid);
		//
		// return false;

		$.ajax({
			type:'POST',
			data: {
				rowid: edit_rowid,
				qty: edit_qty,
				options: {
					item_installed_owner_status: edit_option_status,
				}
			},
			url: '<?php echo base_url(); ?>cart/update',
			success: function(res) {
				// var response = jQuery.parseJSON(res);
				// console.log(response);
				show_cart(cart_div);
				create_alert('cart_alert', 'Item berhasil diupdate', 'bg-success');
			}
		});
		return false;
	}

	function item_out_editor(urut, id)
	{

		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>ajax/item_out_editor/'+id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
				$('#form_item_out_editor h4 span').html(response.title);
				$('#form_item_out_editor').attr('action', '<?php echo base_url(); ?>ajax/item_out_editor/'+response.detail.id);
				$('#div_info_request').load('<?php echo base_url(); ?>item_transaction/out_detail/'+id);
				set_option('<?php echo base_url(); ?>select_option/status_kepemilikan', 'status_kepemilikan_out_item', response.detail.owner_status);

				$('#modal_item_out_editor').modal('show');
            }
        });
	}

	// $(document).ajaxComplete(function(){
	// 	$('.cart_remover_btn').off().on('click', function(){
	// 		var url = $(this).attr('href');
	// 		$.ajax({
	// 			type:'GET',
	// 			url: url,
	// 			success: function(res) {
	// 				show_cart();
	// 			}
	// 		});
	// 		return false;
	// 	});
	//
	//
	//
	// 	$('.current_updater_btnsdfsdfsd').off().change(function(){
	// 		var row = $(this).parents('tr').attr("id");
	// 		// console.log(row);
	//
	// 		var edit_qty = $('#current_qty_'+row).val();
	// 		var edit_status = $('#current_status_'+row).val();
	// 		var edit_id = $('#current_id_'+row).val();
	// 		// console.log(edit_qty);
	// 		// console.log(edit_status);
	// 		// console.log(edit_id);
	//
	// 		$.ajax({
	// 			type:'POST',
	// 			data: {
	// 				id: edit_id,
	// 				qty: edit_qty,
	// 				status: edit_status
	// 			},
	// 			url: '<?php echo base_url(); ?>ajax/update_current_item_out',
	// 			success: function(res) {
	// 				var response = jQuery.parseJSON(res);
	// 				console.log(response);
	// 				// create_alert('cart_alert', 'Item berhasil diupdate', 'bg-success');
	// 			}
	// 		});
	// 		return false;
	// 	});
	// });

	function clean_cart()
	{
		$.ajax({
			type:'GET',
			url: base_url+'cart/destroy',
			success: function(res) {
			}
		});
	}

	function cart_update_out(rowid, prefix)
	{
        var urla = "<?php echo base_url(); ?>xhr/request_out/cart_out_update/"+rowid+"/"+prefix;
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
			$('#cart_div_'+prefix).load('<?php echo base_url(); ?>xhr/request_out/cart/'+prefix);
			// getajax('<?php echo base_url(); ?>ajax_request/loadcart/pengadaan/'+prefix, 'cartdiv_'+prefix);
			// getajax('<?php echo base_url(); ?>ajax_request/loadcart/pembanding/'+prefix, 'pembandingdiv_'+prefix);
		});
		return false;
	}

	function current_update(mode, id)
    {
        // console.log(mode);
        // console.log(id);
        var urla = "<?php echo base_url(); ?>xhr/request_out/current_update/"+mode+"/"+id;
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
        var urla = "<?php echo base_url(); ?>xhr/request_out/current_delete/"+mode+"/"+id;
		$.get(urla, function( res ) {
			var response = jQuery.parseJSON(res);
            $('#current_div').load('<?php echo base_url(); ?>xhr/request_out/current/'+response.detail.task_id);
		});
        return false;
    }

	function clearcart()
	{
		// alert('ok');
		$.get("<?php echo base_url(); ?>cart/destroy");
	}

</script>
