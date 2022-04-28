<script type="text/javascript">

	function show_this(customer_id)
	{
		// console.log(customer_id);
		getajax('<?php echo base_url(); ?>customer/show/'+customer_id+'/detail/echo', 'show_detail_customer');
		getajax('<?php echo base_url(); ?>customer/show/'+customer_id+'/item_terpasang/echo', 'daftar_perangkat');
		$('#modal_show_this').modal('show');
	}



	// tinymce.init({
	// 	selector: '.wysiwyg',
	// 	statusbar:  false,
	// 	menubar:    false,
	// 	rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ],
	// 	setup: function(editor) {
	// 		editor.on('change', function(e) {
	// 			var isi = this.getContent();
	// 			$('.fake_tinymce').val(isi);
	// 		});
	// 	}
	// });

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

    // $('.chosen').chosen();

    //input marketing progress
	function input_marketing_progress(pre_customer_id)
	{
		block_this('js_table_pre_customer');

		// tinyMCE.get('body_insert').setContent('');

		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>pre_customer/marketing_progress/'+pre_customer_id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);

				show_modal_alert('modal_marketing_progress_insert_alert', response);

				$("#form_marketing_progress_insert #location_id_insert").val(response.id);
				$('#category_insert').html(response.progress_options).chosen().trigger('chosen:updated');
			    unblock_this('js_table_pre_customer');
                $('#modal_marketing_progress_insert').modal('show');
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
		// alert('update customer');
		getajax('<?php echo base_url(); ?>customer/customer_update_global/'+id, 'div_edit_global');
		getajax('<?php echo base_url(); ?>customer/customer_update_product/'+id, 'div_edit_product');
		getajax('<?php echo base_url(); ?>customer/customer_update_invoice_marketing/'+id, 'div_edit_invoice_marketing');
		getajax('<?php echo base_url(); ?>customer/customer_update_teknis/'+id, 'div_edit_teknis');
		getajax('<?php echo base_url(); ?>customer/customer_update_item', 'div_edit_item');
		$('#modal_customer_update').modal('show');
	}


    function update2(id)
    {
        var action = '<?php echo base_url(); ?>pre_customer/update/'+id;
        block_this('js_table_customer');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                console.log(response);

				getajax('<?php echo base_url(); ?>customer/customer_update_global', 'div_edit_global');

				// set_option('<?php echo base_url(); ?>select_option/yesno', 'contract_status_update', response.contract_status);
				// set_option('<?php echo base_url(); ?>select_option/yesno', 'nmc_update', response.nmc);
				// set_option('<?php echo base_url(); ?>select_option/yesno', 'ppn_update', response.ppn);
				// set_option('<?php echo base_url(); ?>select_option/link_type', 'link_type_update', response.link_type);
				// set_option('<?php echo base_url(); ?>select_option/customer_type', 'customer_type_update', response.customer_type);

				// set_product(response.product_category, response.current_product, 'product_category_update', 'product_div_selector_update');

                // $("#form_customer_update").attr('action', response.action);
                // $("#form_customer_update #customer_name_update").val(response.customer_name);
                // $("#form_customer_update #customer_address_update").val(response.customer_address);
                // $("#form_customer_update #contact_person_update").val(response.contact_person);
                // $("#form_customer_update #telephone_home_update").val(response.telephone_home);
                // $("#form_customer_update #telephone_mobile_update").val(response.telephone_mobile);
                // $("#form_customer_update #telephone_work_update").val(response.telephone_work);
                // $("#form_customer_update #fax_update").val(response.fax);
                // $("#form_customer_update #email_update").val(response.email);
                // $("#form_customer_update #note_update").val(response.note);
                // $("#form_customer_update #contract_update").val(response.contract);


				// $("#form_customer_update #id_update").val(response.id);

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


    function insert_customer()
    {
        // $('#main_form_insert').addClass('hidden');
        // $('.cos').val('');
		// set_option('<?php echo base_url(); ?>select_option/customer_type', 'customer_type_insert', 'xxx');

		$("#insert_area_div").load( "<?php echo base_url(); ?>pre_customer/new_customer_mode/picker", function(){
			set_option('<?php echo base_url(); ?>select_option/usergroup_active', 'existing_customer_picker', 'xxx');
		});

        $('#modal_customer_insert').modal('show');
        return false;
    }

	function back_to_picker()
	{
		$("#insert_area_div").load( "<?php echo base_url(); ?>pre_customer/new_customer_mode/picker", function(){
			set_option('<?php echo base_url(); ?>select_option/usergroup_active', 'existing_customer_picker', 'xxx');
		});
		return false;
	}

	function new_customer_mode(mode)
    {
		if(mode=='existing'){
			var group = $('#existing_customer_picker').val();
			if(group === null){
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
						set_option('<?php echo base_url(); ?>select_option/yesno', 'contract_status_insert', 'N');
						set_option('<?php echo base_url(); ?>select_option/yesno', 'nmc_insert', 'N');
						set_option('<?php echo base_url(); ?>select_option/yesno', 'ppn_insert', 'N');
						set_option('<?php echo base_url(); ?>select_option/yesno', 'custom_address_insert', 'N');
						set_option('<?php echo base_url(); ?>select_option/link_type', 'link_type_insert', 'wr');
						$('#insert_area_div').html(res);
						set_product('maxi', '', 'product_category_insert', 'product_div_selector_insert');
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
					set_option('<?php echo base_url(); ?>select_option/yesno', 'contract_status_insert', 'N');
					set_option('<?php echo base_url(); ?>select_option/yesno', 'nmc_insert', 'N');
					set_option('<?php echo base_url(); ?>select_option/yesno', 'ppn_insert', 'N');
					set_option('<?php echo base_url(); ?>select_option/link_type', 'link_type_insert', 'wr');
					set_option('<?php echo base_url(); ?>select_option/customer_type', 'customer_type_insert', '');
					$('#insert_area_div').html(res);
					set_product('maxi', '', 'product_category_insert', 'product_div_selector_insert');
				}
			});
		}

        return false;
    }

	$(document).ajaxComplete(function(){
		$('#product_category_insert').change(function(e){
			e.preventDefault();
			var product_category = $(this).val();
			set_product(product_category, '', 'product_category_insert', 'product_div_selector_insert');
		});



		$('#contract_status_insert').change(function(e){
			e.preventDefault();
			var yesno = $(this).val();
			if(yesno=='Y'){
				$('#contract_insert_div').removeClass('hidden');
			}else{
				$('#contract_insert_div').addClass('hidden');
			}
		});

		// $('#contract_status_update').change(function(e){
		// 	e.preventDefault();
		// 	var yesno = $(this).val();
		// 	if(yesno=='Y'){
		// 		$('#contract_update_div').removeClass('hidden');
		// 	}else{
		// 		$('#contract_update_div').addClass('hidden');
		// 	}
		// });

		$('#custom_address_insert').change(function(e){
			e.preventDefault();
			var yesno = $(this).val();
			if(yesno=='Y'){
				$('#custom_address_div').removeClass('hidden');
			}else{
				$('#custom_address_div').addClass('hidden');
			}
		});
	});

	function search_customer()
    {
        $('.cos').val('');
        $('#modal_search').modal('show');
        return false;
    }

	$

</script>
