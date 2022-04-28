<script type="text/javascript">
function map_r(latitude, longitude)
{
	$('#us3').locationpicker({
		location: {
			latitude: latitude,
			longitude: longitude
		},
		radius: 0,
		inputBinding: {
			latitudeInput: $('#us3-lat'),
			longitudeInput: $('#us3-lon'),
			radiusInput: $('#us3-radius'),
			locationNameInput: $('#us3-address')
		},
		// markerInCenter: true,
		markerDraggable: true,
		enableAutocomplete: true,
		onchanged: function (currentLocation, radius, isMarkerDropped) {
			console.log(currentLocation);
		}
	});
}

// map_r(-7.802619282371105, 110.36447427508551);


$('#modal_map_form').submit(function(){
	// alert('ok');
	var latitude = $('#us3-lat').val();
	var longitude = $('#us3-lon').val();
	koordinat = latitude+','+longitude;
	// alert(koordinat);

	$('#'+$('#form_target').val()).val(koordinat);
	$('#modal_map').modal('hide');
	return false;
});

$('#modal_map').on('shown.bs.modal', function (e) {
	linkid = e.relatedTarget.attributes;
	// console.log(linkid);
	// console.log(linkid[1].value);
	// console.log(linkid[2].value);
	// console.log(linkid[2].value);

	$(this).attr('style','display: block; z-index: 1051;');

	var target_form = linkid[3].value;
	$('#form_target').val(target_form);


	if($('#koordinat_update').length && $('#koordinat_update').val() !=''){
		var koordinat = $('#koordinat_update').val();
		var str_split = koordinat.split(',');
		// console.log(str_split);
		var latitude = str_split[0].trim();
		var longitude = str_split[1].trim();

	}else if($('#koordinat_insert').length && $('#koordinat_insert').val() !=''){
		var koordinat = $('#koordinat_insert').val();
		var str_split = koordinat.split(',');
		var latitude = str_split[0].trim();
		var longitude = str_split[1].trim();
	}else if($('#koordinat_existing').length && $('#koordinat_existing').val() !=''){
		var koordinat = $('#koordinat_existing').val();
		var str_split = koordinat.split(',');
		var latitude = str_split[0].trim();
		var longitude = str_split[1].trim();
	} else {
		var latitude = linkid[1].value;
		var longitude = linkid[2].value;
	}
	// console.log(latitude);
	// console.log(longitude);

	map_r(latitude, longitude);
	$('#us3').locationpicker('autosize');
});

function show_this(customer_id)
{
	// console.log(customer_id);
	getajax('<?php echo base_url(); ?>customer/show/'+customer_id+'/pre_customer/echo', 'show_detail_customer');
	// getajax('<?php // echo base_url(); ?>customer/show/'+customer_id+'/item_terpasang/echo', 'daftar_perangkat');

	getProgressByCustomer(customer_id, (progress) => {
		if (progress.length > 0) $('#marketing_progress_show').append(progress[0].name);
	});

	$('#modal_show_this').modal('show');
}

function show_timeline(customer_id) {
	getajax('<?php echo base_url(); ?>pre_customer/timeline/'+customer_id, 'detail_customer_timeline');
	$('#modal_customer_timeline').modal('show');
}

function detail_task(x) {
	getajax('<?php echo base_url(); ?>xhr/task_report/get_task_detail/'+x+'/echo', 'detail_task_detail');
	$.ajax({
		type: 'GET',
		url : '<?=base_url();?>ajax/get_task_comment/'+x,
		success: function(res){
			var response = $.parseJSON(res);
			$('#show_komentar_div').empty();
			append_tag = '';
			if (response.data.length > 0) {
				const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
				for (var i = 0; i < response.data.length; i++) {
					var tanggal = new Date(response.data[i].date_post*1000);
					var tanggal_array = {
						'tahun' : tanggal.getFullYear(),
						'bulan' : ('0'+(tanggal.getMonth()+1)).slice(-2),
						'tanggal' : ('0'+tanggal.getDate()).slice(-2),
						'jam' : ('0'+tanggal.getHours()).slice(-2),
						'menit' : ('0'+tanggal.getMinutes()).slice(-2),
						'detik' : ('0'+tanggal.getSeconds()).slice(-2)
					};
					var tanggal_post = tanggal_array.tanggal+' '+monthNames[tanggal_array.bulan-1]+' '+tanggal_array.tahun+' '+tanggal_array.jam+':'+tanggal_array.menit;
					// var tanggal_post = '';

					append_tag += '<div class="row"><div class="col-md-12"><div class="media-body">'+response.data[i].content+'<div class="media-annotation">'+response.data[i].author_name+' pada '+tanggal_post+'</div></div></div></div>';
				}
				append_tag += '<br>';
			}
			append_tag += '<a class="btn btn-primary" onclick="addComment('+x+');"><i class="icon-comments"></i> Komentar</a>';
			$('#show_komentar_div').append(append_tag);
		}
	});
	$('#modal_task_detail').modal('show');
}

// function show_maps()
// {
// 	$('#modal_map').modal('show');
// }

// $('#modal_map').on('shown.bs.modal', function () {
//     $('#us3').locationpicker('autosize');
// });

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

//product picker js
$('.panel-heading a').on('click',function(e){
	if($(this).parents('.panel').children('.panel-collapse').hasClass('in')){
		e.stopPropagation();
	}
});

$('#accordion-control').on('show.bs.collapse', function (x) {
	// $(".all").attr("checked", false);
	$(".all").removeAttr('checked');
});
//product picker js


//input marketing progress
function input_marketing_progress(pre_customer_id)
{
	$.ajax({
		type:'GET',
		url: '<?php echo base_url(); ?>pre_customer/marketing_progress/'+pre_customer_id,
		success: function(res) {
			var response = jQuery.parseJSON(res);
			console.log(response);

			// show_modal_alert('modal_marketing_progress_insert_alert', response);
            //
			// $("#form_marketing_progress_insert #location_id_insert").val(response.id);
			// $('#category_insert').html(response.progress_options).chosen().trigger('chosen:updated');
			// unblock_this('js_table_pre_customer');
			$('#modal_mp_div').html(response.html);
			$('#modal_mp').modal('show');
		}
	});
	return false;
}



$('#modal_customer_insert').on('shown.bs.modal', function () {
	// $('#existing_customer_picker', this).chosen();
});


jQuery(function($) { $('#password_insert').pwstrength(); });
jQuery(function($) { $('#password_update').pwstrength(); });

function update(id)
{
	getajax('<?php echo base_url(); ?>customer/customer_update_global/'+id, 'div_edit_global');
	getajax('<?php echo base_url(); ?>customer/customer_update_product/'+id, 'div_edit_product');
	getajax('<?php echo base_url(); ?>customer/customer_update_invoice_marketing/'+id, 'div_edit_invoice_marketing');
	$('#modal_customer_update').modal('show');
}

function update_customer(id)
{
	var action = '<?php echo base_url(); ?>pre_customer/update/'+id;
	block_this('js_table_customer');
	$.ajax({
		type:'GET',
		url: action,
		success: function(res) {
			var response = jQuery.parseJSON(res);
			// console.log(response);
			$("#modal_customer_update_form").attr('action', response.action);
			$('#modal_customer_update_div').html(response.html);
			$('#modal_customer_update').modal('show');
			unblock_this('js_table_customer');
		}
	});
	return false;
}

function delete_customer(id)
{
	var action = '<?php echo base_url(); ?>customer/delete/'+id;

	block_this('js_table_customer');
	$.ajax({
		type:'GET',
		url: action,
		success: function(res) {
			var response = jQuery.parseJSON(res);
			console.log(response);
			$("#form_customer_delete").attr('action', response.action);
			$("#form_customer_delete #delete_id").val(response.id);

			$('#data_info_delete').html('').append(response.data_info);
			$('#remove_confirm').html('').append(response.remove_confirm);
			$('#modal_customer_delete').modal('show');

			if(response.removable=='no'){
				$('#modal_delete_footer').addClass('hide_me');
			} else {
				$('#modal_delete_footer').removeClass('hide_me');
			}

			unblock_this('js_table_customer');
		}
	});
	return false;
}

//insert step 1
function insert_customer()
{
	//tampilkan pilihan pelanggan baru atau existing
	$("#insert_area_div").load( "<?php echo base_url(); ?>pre_customer/new_customer_mode/picker", function(){
	});

	$('#modal_customer_insert').modal('show');
	return false;
}

function back_to_picker()
{
	//tampilkan pilihan pelanggan baru atau existing
	$("#insert_area_div").load( "<?php echo base_url(); ?>pre_customer/new_customer_mode/picker", function(){
		// set_option('<?php echo base_url(); ?>select_option/usergroup_active', 'existing_customer_picker', 'xxx');
	});

	$('#modal_customer_insert').modal('show');
	return false;
}

// trigger tombol pilihan pelanggan baru atau existing
function new_customer_mode(mode)
{
	if(mode=='existing'){
		var group = $('#existing_customer_picker').val();
		if(group ==''){
			alert('Existing pelanggan belum dipilih');
			return false;
		} else {
			var url = '<?php echo base_url(); ?>pre_customer/new_customer_mode/lawas/'+group;

			$.ajax({
				type:'GET',
				url: url,
				success: function(res) {
					// var response = jQuery.parseJSON(res);
					// console.log(res);
					// set_option('<?php echo base_url(); ?>select_option/satunol', 'contract_status_insert', '0');
					// set_option('<?php echo base_url(); ?>select_option/satunol', 'nmc_insert', '0');
					// set_option('<?php echo base_url(); ?>select_option/satunol', 'ppn_insert', '0');
					// set_option('<?php echo base_url(); ?>select_option/yesno', 'custom_address_insert', 'N');
					// set_option('<?php echo base_url(); ?>select_option/link_type', 'link_type_insert', 'wr');
					// set_option('<?php echo base_url(); ?>select_option/customer_type', 'customer_type_insert', '');
					$('#insert_area_div').html(res);
					// set_product('dedicated', '', 'product_category_insert', 'product_div_selector_insert');
				}
			});

		}
	} else {
		var url = '<?php echo base_url(); ?>pre_customer/new_customer_mode/new/';
		$.ajax({
			type:'GET',
			url: url,
			success: function(res) {
				// var response = jQuery.parseJSON(res);
				// console.log(res);
				// set_option('<?php echo base_url(); ?>select_option/satunol', 'contract_status_insert', '0');
				// set_option('<?php echo base_url(); ?>select_option/satunol', 'nmc_insert', '0');
				// set_option('<?php echo base_url(); ?>select_option/satunol', 'ppn_insert', '0');
				// set_option('<?php echo base_url(); ?>select_option/link_type', 'link_type_insert', 'wr');
				// set_option('<?php echo base_url(); ?>select_option/customer_type', 'customer_type_insert', '');
				// set_product('dedicated', '', 'product_category_insert', 'product_div_selector_insert');
				$('#insert_area_div').html(res);
			}
		});
	}

	return false;
}

function search_customer()
{
	$('.cos').val('');
	$('#modal_search').modal('show');
	return false;
}

function input_isp(select_target)
{
	$.ajax({
		type:'GET',
		url: '<?php echo base_url('pre_customer/isp/form/'); ?>'+select_target,
		success: function(res) {
			var response = jQuery.parseJSON(res);
			$('#modal_isp_div').html(response.html);
			$('#modal_isp').modal('show');
		}
	});
	return false;
}

function getProgressByCustomer(customerId, cb) {
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>customer/get_marketing_progress',
		data: { customerId },
		success: function(res) {
			cb(res);
		}
	});
}

	function addComment(x) {
		$('#comment_task_id').val(x);
		$('#modal_add_comment').modal('show');
	}

	$('#form_add_comment').on('submit', function(){
		var task_id = $("input#comment_task_id").val();
		$.ajax({
			type: 'POST',
			url : $(this).attr('action'),
			data: $(this).serialize(),
			success: function(res){
				var response = $.parseJSON(res);
				if (response.status=='success') {
					$('#modal_task_detail').modal('hide');
					$('#modal_add_comment').modal('hide');
					detail_task(task_id);
					$('#show_komentar').tab('show');
				} else {
					alert(response.status);
				}
			}
		});
		return false;
	});
</script>

<?php
	$data_js = array();
	echo $this->load->view('task_item/js', $data_js, TRUE);
?>