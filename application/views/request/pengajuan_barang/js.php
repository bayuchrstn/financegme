<?php
	$data_js = array();
	echo $this->load->view('task_item/js', $data_js, TRUE);
?>

<script type="text/javascript">

	$('#modal_request_insert').on('shown.bs.modal', function () {
		clearcart();
	});

	$('#modal_request_insert').on('hidden.bs.modal', function () {
		clearcart();
	});

	$('#modal_request_update').on('shown.bs.modal', function () {
		clearcart();
	});

	$('#modal_request_update').on('hidden.bs.modal', function () {
		clearcart();
	});

	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>

	function show_this(x)
	{
		// console.log(x);
		$("#modal_show_this_div").load("<?php echo base_url(); ?>pengajuan_barang/show/"+x+"/echo");
		$('#modal_show_this').modal('show');
	}

	function open_pengadaan_modal(prefix)
	{
		// alert('ok');
		$('#barang_div').removeClass('hidden');
		$('#custom_div').addClass('hidden');
		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/item_selector', 'item_selector_insert', 'barang');
		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/supplier', 'supplier_insert', '');

		$('#prefix_fcart').val(prefix);
		$('#modal_pengadaan').modal('show');
		return false;
	}

	function open_pembanding_modal(prefix)
	{
		// alert('ok');
		$('#barang_div_pembanding').removeClass('hidden');
		$('#custom_div_pembanding').addClass('hidden');
		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/item_selector', 'item_selector_pembanding', 'barang');
		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/supplier', 'supplier_pembanding', '');
		$('#prefix_fcart_pembanding').val(prefix);
		$('#modal_pembanding').modal('show');
		return false;
	}

	function cart_delete(rowid, prefix)
	{
		$.get("<?php echo base_url(); ?>cart/delete/"+rowid, function( data ) {
			getajax('<?php echo base_url(); ?>ajax_request/loadcart/pengadaan/'+prefix, 'cartdiv_'+prefix);
			getajax('<?php echo base_url(); ?>ajax_request/loadcart/pembanding/'+prefix, 'pembandingdiv_'+prefix);
		});
		return false;
	}

	function cart_update(rowid, prefix)
	{
		// alert(rowid);
		$.get("<?php echo base_url(); ?>ajax_request/update_cart/pengadaan/"+rowid+"/"+prefix, function( data ) {
			$('#modal_cart_update_div').html(data);
			$('#modal_cart_update').modal('show');
		});
		return false;
	}

	function current_update(id, table)
	{
		// alert(rowid);
		$.get("<?php echo base_url(); ?>ajax_request/pengadaan_update_item/"+id+"/"+table, function( data ) {
			$('#modal_current_update_form').prop('action', '<?php echo base_url(); ?>ajax_request/pengadaan_update_item/'+id+'/'+table)
			$('#modal_current_update_div').html(data);
			$('#modal_current_update').modal('show');
		});
		return false;
	}

	function current_delete(id)
	{
		$.get("<?php echo base_url(); ?>cart/delete/"+rowid, function( data ) {
			// getajax('<?php echo base_url(); ?>ajax_request/loadcart/pengadaan', 'cartdiv');
			// getajax('<?php echo base_url(); ?>ajax_request/loadcart/pembanding', 'pembandingdiv');
		});
		return false;
	}

	function open_search_modal()
	{
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/pre_customer', 'location_id_search', '');
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/author', 'author_search', '');
		$('#modal_marketing_progress_search').modal('show');
	}

	function input()
	{
		//clear
		$('.cos').val('');

		//tinyMCE
		$('#body_fake_insert').val('');
		tinyMCE.get('body_insert').setContent('');

		location_picker('customer', 'x', 'location_insert', 'location_id_insert');

		getajax('<?php echo base_url(); ?>xhr/task_item/index/task_pengadaan/0/insert/po_insert/po', 'po_insert');
		getajax('<?php echo base_url(); ?>xhr/task_item/index/task_pengadaan_pembanding/0/insert/pembanding_insert/po_pembanding', 'pembanding_insert');

		// bcn_picker('1', '4', '3', 'item_brand_insert', 'item_category_insert', 'item_name_insert');
		// bcn_picker('1', '4', '3', 'item_brand_pembanding', 'item_category_pembanding', 'item_name_pembanding');

		// getajax('<?php echo base_url(); ?>ajax_request/loadcart/pengadaan/insert', 'cartdiv_insert');
		// getajax('<?php echo base_url(); ?>ajax_request/loadcart/pembanding/insert', 'pembandingdiv_insert');

		set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/status_request', 'status_insert', 'warehouse');

		$('#modal_request_insert').modal('show');
		return false;
	}

    function update(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

				$("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);

				location_picker(response.location, response.location_id, 'location_update', 'location_id_update');

				getajax('<?php echo base_url(); ?>xhr/task_item/index/task_pengadaan/'+response.id+'/update/po_update/po', 'po_update');
				getajax('<?php echo base_url(); ?>xhr/task_item/index/task_pengadaan_pembanding/'+response.id+'/update/pembanding_update/po_pembanding', 'pembanding_update');

				set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/status_request_gudang', 'status_update', response.status);
                $('#modal_request_update').modal('show');
            }
        });
        return false;
    }

	function set_info_request(task_id)
	{
		$('#detail_request_update').load('<?php echo base_url(); ?>barang_keluar/show/'+task_id+'/echo');
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
				$('#form_item_detail_approval #current_approved_item_detail').val(response.current_approved_item_detail);
				$("#item_detail_picker").html(response.options).val('').chosen({search_contains:true}).trigger('chosen:updated');
				$('#modal_item_detail_approval').modal('show');
            }
        });
	}

	function location_picker(location, location_id, flocation, flocation_id)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>location_picker/all/'+location+'/'+location_id,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#'+flocation).html(response.location).val(location).chosen().trigger('chosen:updated');
				$('#'+flocation_id).html(response.location_id).val(location_id).chosen().trigger('chosen:updated');
			}
		});
	}

	if( $('#location_insert').length ){
		$('#location_insert').change(function(){
			var location = $(this).val();
			location_picker(location, 'x', 'location_insert', 'location_id_insert');
		});
	}

	if( $('#location_update').length ){
		$('#location_update').change(function(){
			var location = $(this).val();
			location_picker(location, 'x', 'location_update', 'location_id_update');
		});
	}

	// bcn here

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

	if( $('#item_brand_pembanding').length ){
		$('#item_brand_pembanding').change(function(){
			var brand = $(this).val();
			bcn_picker(brand, '', '', 'item_brand_pembanding', 'item_category_pembanding', 'item_name_pembanding');
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

	if( $('#item_category_pembanding').length ){
		$('#item_category_pembanding').change(function(){
			var brand = $('#item_brand_pembanding').val();
			var cat = $(this).val();
			// alert(brand+' '+cat);
			// alert(brand);
			bcn_picker(brand, cat, '', 'item_brand_pembanding', 'item_category_pembanding', 'item_name_pembanding');
		});
	}

	function loadcart()
	{
		// $('.cartdiv').html('wkwkwk');
	}

	function clearcart()
	{
		// alert('ok');
		$.get("<?php echo base_url(); ?>cart/destroy");
	}

	$(document).ready(function(){
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

		$('#item_selector_pembanding').change(function(){
			var mode = $(this).val();
			if(mode=='barang'){
				$('#barang_div_pembanding').removeClass('hidden');
				$('#custom_div_pembanding').addClass('hidden');
			} else {
				$('#barang_div_pembanding').addClass('hidden');
				$('#custom_div_pembanding').removeClass('hidden');
			}
			return false;
		});
	});


</script>
