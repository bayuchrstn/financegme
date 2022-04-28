
<?php
	$data_js = array();
	echo $this->load->view('task_item/js', $data_js, TRUE);
?>



<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');

	$('#modal_request_update').on('shown.bs.modal', function () {
		cart_destroy();
	});
	$('#modal_request_insert').on('shown.bs.modal', function () {
		cart_destroy();
	});
	$('#modal_request_update').on('hidden.bs.modal', function () {
		cart_destroy();
	});
	$('#modal_request_insert').on('hidden.bs.modal', function () {
		cart_destroy();
	});

	function show_this(x)
	{
		console.log(x);
		$("#show_detail_mp_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		$('#modal_detail_mp').modal('show');
	}

	<?php echo $this->load->view('component/misc/wysiwyg', '', TRUE); ?>

	function asearch()
	{
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/pre_customer', 'location_id_search', '');
		set_option('<?php echo base_url(); ?>select_option/request/marketing_progress/marketing', 'author_search', '');
		$('#modal_asearch').modal('show');
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

				// form customize
                $("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);
				// form customize

				// task item --------------------------------------------
				// param
				//1.nama table item
				//2.task id (jika belum ada dikasih angka nol 0 )
				//3.prefix
				//4.target div
				//5.parent modul

				getajax('<?php echo base_url(); ?>xhr/task_item/index/task_pengadaan/'+response.id+'/update/task_item_div_update/po_request', 'task_item_div_update');
				// task item -------------------------------------------

				set_option('<?php echo base_url(); ?>select_option/request/po_request/status_request', 'status_update', response.status);
				set_option('<?php echo base_url(); ?>select_option/request/po_request/po_category', 'category_id_update', response.category);
				location_picker(response.location, response.location_id, 'location_update', 'location_id_update');


                $('#modal_request_update').modal('show');
            }
        });
        return false;
    }

    function input()
    {
		// alert('d');
		$('.cos').val('');
		tinyMCE.get('body_insert').setContent('');
        set_option('<?php echo base_url(); ?>select_option/request/<?php echo $req_code; ?>/customer', 'location_id_insert', '');
		set_option('<?php echo base_url(); ?>select_option/request/po_request/po_category', 'category_id_insert', '');
		location_picker('customer', '', 'location_insert', 'location_id_insert');

		// task item --------------------------------------------
		// param
		//1.nama table item
		//2.task id (jika belum ada dikasih angka nol 0 )
		//3.prefix
		//4.target div
		//5.parent modul

		getajax('<?php echo base_url(); ?>xhr/task_item/index/task_pengadaan/0/insert/task_item_div_insert/po_request', 'task_item_div_insert');
		// task item -------------------------------------------

		set_option('<?php echo base_url(); ?>select_option/request/po_request/status_request', 'status_insert', 'requestor');

		$('#modal_request_insert').modal('show');
        return false;
    }

	// $('#location_id_insert').change(function(){
	// 	var customer_id = $(this).val();
	// 	// console.log(customer_id);
	// 	set_option('<?php echo base_url(); ?>select_option/marketing_progress_category/'+customer_id, 'category_id_insert', '');
	// });

	$('#category_id_insert').change(function(){
		var mp_level = $(this).val();
		// console.log(mp_level);
		if(mp_level=='mp_survey' || mp_level=='mp_instalasi'){
			$('#tgl_request_date_insert').removeClass('hide');
		} else {
			$('#tgl_request_date_insert').addClass('hide');

		}

		// set_option('<?php echo base_url(); ?>select_option/marketing_progress_category/'+customer_id, 'category_id_insert', '');
	});

	// location picker **************************************************
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
			location_picker(location, '', 'location_insert', 'location_id_insert');
		});
	}

	if( $('#location_update').length ){
		$('#location_update').change(function(){
			var location = $(this).val();
			location_picker(location, '', 'location_update', 'location_id_update');
		});
	}
	// location picker **************************************************



</script>
