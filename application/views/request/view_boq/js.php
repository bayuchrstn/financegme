<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>

	function open_item_modal(prefix)
	{
		// alert('ok');
		$('#barang_div').removeClass('hidden');
		$('#custom_div').addClass('hidden');
		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/item_selector', 'item_selector_insert', 'barang');
		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/supplier', 'supplier_insert', '');
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

	function open_laporan_survey_ts(prefix)
	{
		var lap = $('#up_select_'+prefix).val();
		if(lap === null){
			alert('Laporan hasil survey belum dipilih');
		} else {
			getajax('<?php echo base_url(); ?>ajax/boq_view_lap_survey', 'modal_boq_view_lap_survey_ts_div');
			$('#modal_boq_view_lap_survey_ts').modal('show');
		}
		return false;
	}

	//cart action handle
	function cart_delete(rowid, prefix)
	{
		$.get("<?php echo base_url(); ?>cart/delete/"+rowid, function( data ) {
			getajax('<?php echo base_url(); ?>ajax_request/loadcart/boq/'+prefix, 'cartdiv_'+prefix);
		});
		return false;
	}

	function cart_update(rowid, prefix)
	{
		// alert(rowid);
		$.get("<?php echo base_url(); ?>ajax_request/update_cart/boq/"+rowid+"/"+prefix, function( data ) {
			$('#modal_cart_update_div').html(data);
			$('#modal_cart_update').modal('show');
		});
		return false;
	}
	//cart action handle

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

	function current_delete(id)
	{
		$.get("<?php echo base_url(); ?>ajax_request/boq_delete_item/"+id, function( res ) {
			var response = jQuery.parseJSON(res);
			// current
			getajax('<?php echo base_url(); ?>ajax_request/show_boq/'+response.task_id, 'current_div');
		});
		return false;
	}
	//current action handle

	//main input
    function input()
    {
		bcn_picker('1', '4', '3', 'item_brand_insert', 'item_category_insert', 'item_name_insert');
		set_option('<?php echo base_url(); ?>select_option/request/boq/referensi_survey', 'up_select_insert', '');
		// getajax('<?php echo base_url(); ?>ajax/cart_boq', 'cart_boq_div_insert');
		getajax('<?php echo base_url(); ?>ajax_request/loadcart/boq/insert', 'cartdiv_insert');
		$('.cos').val('');
		$('#attachment_ul_insert').html('');
		$('#body_fake_insert').val('');
		tinyMCE.get('body_insert').setContent('');
		$('#modal_request_insert').modal('show');
        return false;
    }

	//main update
	function update(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

				$('#modal_request_update #modal_title_custom').html('Approval BOQ');
				$("#form_<?php echo $modul['code']?>_update").attr('action', '<?php echo base_url(); ?>xhr/view_boq/approval');
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);
				$("#info_approved_update").load("<?php echo base_url(); ?>boq/show/"+response.id+"/echo");
				set_option('<?php echo base_url(); ?>select_option/request/<?php echo $req_code; ?>/approval_boq', 'approval_status_update', '');
				getajax('<?php echo base_url(); ?>xhr/approval/index/'+response.id, 'approved_by_update');

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

				// built_cart_form(sel_name);
			}
		});
	}

	if( $('#item_brand_insert').length ){
		$('#item_brand_insert').change(function(){
			var brand = $(this).val();
			bcn_picker(brand, '', '', 'item_brand_insert', 'item_category_insert', 'item_name_insert');
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

	$(document).ready(function(){
		$('#up_select_insert').change(function(){
			var ref = $('#up_select_insert').val();
			$.ajax({
	            type:'GET',
	            url: '<?php echo base_url(); ?>ajax/json_task_info/'+ref,
	            success: function(res) {
	                var response = jQuery.parseJSON(res);
					console.log(response);
					$('#location_hidden_insert').val(response.location);
					$('#location_id_hidden_insert').val(response.location_id);
	            }
	        });
	        return false;
		});

		$('#item_selector_insert').change(function(){
			var mode = $(this).val();
			if(mode=='barang'){
				$('#barang_div').removeClass('hidden');
				$('#custom_div').addClass('hidden');
			} else {
				$('#barang_div').addClass('hidden');
				$('#custom_div').removeClass('hidden');
			}
			return false;
		});
	});


</script>
