<?php
     $current_product = $this->customer->get_product_serialize($detail_customer['id']);
     // pre($current_product);
?>

<?php
    // pre($detail_customer);
    $default_value = array();
    $customer_info = $this->ui->forms('customer_info', $default_value, $prefix);
?>
<?php
    echo $customer_info['customer_name'];
    echo $customer_info['customer_address'];
?>
<div class="row">
    <div class="col-lg-10">
        <?php echo $customer_info['koordinat']; ?>
    </div>
    <div class="col-lg-2">
        <label for="">&nbsp;</label>
        <!-- <a href="#" class="btn btn-default form-control"><i class="icon-location3"></i></a> -->
        <a data-target="#modal_map" data-latitude='-7.771253761265909' data-longitude='110.36144337889868' data-formtarget='koordinat_<?php echo $prefix; ?>' data-toggle="modal" href="javascript:void(0)" class="btn btn-default form-control"><i class="icon-location3"></i></a>
    </div>
</div>

<?php echo $customer_info['product_category']; ?>

<div class="form-group">
	<div id="product_div_selector_update"></div>
</div>




<script type="text/javascript">
    var detail_customer = <?php echo json_encode($detail_customer); ?>;
    console.log(detail_customer);
    $('#customer_name_insert').val(detail_customer.customer_name);
    $('#customer_address_insert').val(detail_customer.customer_address);
    $('#koordinat_insert').val(detail_customer.koordinat);
    // $('#telephone_home_insert').val(detail_customer.telephone_home);
    // $('#telephone_mobile_insert').val(detail_customer.telephone_mobile);
    // $('#telephone_work_insert').val(detail_customer.telephone_work);
    // $('#contact_person_insert').val(detail_customer.contact_person);
    // $('#fax_insert').val(detail_customer.fax);
    // $('#email_insert').val(detail_customer.email);
    // set_option('<?php echo base_url(); ?>select_option/customer/customer_type', 'customer_type_insert', detail_customer.customer_type);
    // $(function() {
	//     if( $('.date_picker').length ) {
	//         $( ".date_picker" ).datepicker({
	//             changeMonth: true,
	//             changeYear: true,
	//             dateFormat: 'yy-mm-dd'
	//         });
	//     }
	// });

    function set_product(product_category, product, product_category_select, product_list_div)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>customer_product_picker/index/'+product_category+'/'+product,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				$('#'+product_category_select).html(response.product_category).val(product_category);
				$('#'+product_list_div).html(response.product_lists);
			}
		});
	}

    set_product(detail_customer.product_category, '<?php echo $current_product; ?>', 'product_category_insert', 'product_div_selector_update');

    $(document).ready(function(){
		$('#product_category_insert').change(function(e){
			e.preventDefault();
			var product_category = $(this).val();
			set_product(product_category, '', 'product_category_insert', 'product_div_selector_update');
		});
	});


    $('#modal_map').on('shown.bs.modal', function (e) {
    	linkid = e.relatedTarget.attributes;
    	// console.log(linkid);
    	// console.log(linkid[1].value);
    	// console.log(linkid[2].value);
    	// console.log(linkid[2].value);

    	var target_form = linkid[3].value;
    	$('#form_target').val(target_form);


    	if($('#koordinat_update').length && $('#koordinat_update').val() !=''){
    		var koordinat = $('#koordinat_update').val();
    		var str_split = koordinat.split(',');
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
    		markerInCenter: true,
    		enableAutocomplete: true,
    		onchanged: function (currentLocation, radius, isMarkerDropped) {
    			console.log(currentLocation);
    			// alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
    		}
    	});
    }

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

</script>
