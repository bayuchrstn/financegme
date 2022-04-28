<script type="text/javascript">

    // Regional -> Area Chained Selects
    $(function(){
        // regional_picker('<?php echo session_scope_regional(); ?>', '<?php echo session_scope_area(); ?>', 'regional_insert', 'area_insert');
    });

    $(document).ready(function(){
        // $('#regional_insert').change(function(){
        //     var selected_regional = $(this).val();
        //     regional_picker(selected_regional, '', 'regional_insert', 'area_insert');
        //     return false;
        // });
        //
        // $('#regional_update').change(function(){
        //     var selected_regional = $(this).val();
        //     regional_picker(selected_regional, '', 'regional_update', 'area_update');
        //     return false;
        // });
    });
    // Regional -> Area Chained Selects



    function input_usergroup(mode)
    {
        $.ajax({
            type:'GET',
            url: '<?php echo base_url('usergroup/insert/'); ?>'+mode,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);

                switch (mode) {
                    case 'sub_department':
                            // set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', '');
                            // set_option('<?php echo base_url(); ?>select_option/kosong', 'department_insert', '');
                            // set_option('<?php echo base_url(); ?>select_option/kosong', 'sub_department_insert', '');
                        break;
                    case 'department':
                            // set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', '');
                            // set_option('<?php echo base_url(); ?>select_option/kosong', 'department_insert', '');
                            // set_option('<?php echo base_url(); ?>select_option/kosong', 'sub_department_insert', '');
                        break;
                    default:

                }


                $('#modal_usergroup_insert h4 span').html('<?php echo $ui['button_input'] ?>');
                $('#modal_usergroup_insert_form').attr('action', '<?php echo base_url('usergroup/insert/'); ?>'+mode);
                $('#modal_usergroup_insert_div').html(response.html);
                $('#modal_usergroup_insert').modal('show');
            }
        });
        return false;
    }

    // function input_jabatan(mode)
    // {
    //     $.ajax({
    //         type:'GET',
    //         url: '<?php echo base_url('usergroup/insert_jabatan/'); ?>'+mode,
    //         success: function(res) {
    //             var response = jQuery.parseJSON(res);
	// 			// console.log(response);
    //             $('#modal_usergroup_insert h4 span').html('<?php echo $ui['button_input'] ?>');
    //             $('#modal_usergroup_insert_form').attr('action', '<?php echo base_url('usergroup/insert/'); ?>'+mode);
    //             $('#modal_usergroup_insert_div').html(response.html);
    //             $('#modal_usergroup_insert').modal('show');
    //         }
    //     });
    //     return false;
    // }



    function update_usergroup(id)
    {
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>usergroup/update/'+id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                // console.log(response);

                $('#modal_usergroup_update h4 span').html('<?php echo $ui['button_update'] ?>');
                $("#modal_usergroup_update_form").attr('action', response.action);
                $("#modal_usergroup_update_div").html(response.html);
                $('#modal_usergroup_update').modal('show');
            }
        });
        return false;
    }

    function input_jabatan(id)
    {
        // alert(id);
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>usergroup/jabatan/'+id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                // console.log(response);

                $('#modal_jabatan h4 span').html('Input Jabatan');
                $("#modal_jabatan_form").attr('action', response.action);
                $("#modal_jabatan_div").html(response.html);
                $('#modal_jabatan').modal('show');
            }
        });
        return false;
    }

    function input_jabatan_main(id)
    {
        // alert(id);
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>usergroup/insert_jabatan/',
            success: function(res) {
                var response = jQuery.parseJSON(res);
                // console.log(response);
                $("#modal_input_jabatan_div").html(response.html);
                $('#modal_input_jabatan').modal('show');
            }
        });
        return false;
    }

	function modul_view(id)
	{
		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>usergroup/modul_view/'+id,
            success: function(res) {
                // var response = jQuery.parseJSON(res);
                console.log(res);
				$('#modal_usergroup_modul_view_form').prop('action', '<?php echo base_url(); ?>usergroup/modul_view/'+id);
				$('#modal_usergroup_modul_view_form_div').html(res);
                $('#modal_usergroup_modul_view').modal('show');
            }
        });
        return false;
	}

    function update_privileges(id)
    {
        $('.privileges_checkboxs').prop('checked', false);

        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>usergroup/set_privileges/'+id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                console.log(response);

                $('#ul_priv').tree();
                $('#usergroup_info_div').html('').append(response.data_info);

                $("#form_usergroup_privileges").attr('action', response.action);
                $("#form_usergroup_privileges #usergroup_code").val(response.code);
                $("#form_usergroup_privileges #id_privileges").val(response.id);

                $.each(response.current_privileges, function( index, value ) {
                    // console.log(value);
                    $('#chk_'+value).prop('checked', true);
                });
                $('#modal_usergroup_privileges').modal('show');
            }
        });
        return false;
    }

    function delete_usergroup(id)
    {
        var action = '<?php echo base_url(); ?>usergroup/delete/'+id;

        block_this('js_table_usergroup');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                //

                $("#form_usergroup_delete").attr('action', response.action);
                $("#form_usergroup_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_usergroup_delete').modal('show');
                unblock_this('js_table_usergroup');
            }
        });
        return false;
    }

    $(document).ready(function() {
        // alert('ini user');
        var base_admin = '<?php echo base_url(); ?>';


        // $('#usergroup_switcher').change(function(){
        //     var csg = $(this).val();
        //     location.href = "<?php echo base_url(); ?>usergroup/index/"+csg;
        // });

        // modal insert user
        // $('#input_usergroup_button').off().on('click', function(){
        //     $('.cos').val('');
        //     $('#modal_usergroup_insert').modal('show');
        //     return false;
        // });

        //setting privileges pada "update"
        $(".privileges_checkbox").change(function() {
			var ischecked= $(this).is(':checked');
		   	if(!ischecked){
				var sta = 'uncheck';
		   	} else {
                var sta = 'check';
			}

            // block_this('form_usergroup_update');

            var usergroup = $('#code_update').val();
            var modul = $(this).val();

            $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>usergroup/set_privileges/",
                data: { sta: sta, usergroup: usergroup, modul: modul },
                success: function(er){
                    // unblock_this('form_usergroup_update');
                }
            })
            .done(function( res ) {
                var response = jQuery.parseJSON(res);
                if(response.status=='gagal'){
                    ajax_response_failed(response.msg, 'response_update');
                }

            });
	   	});

    });

    function change_divisi(x)
    {
        // console.log(x);
        location.href="<?php echo base_url('usergroup/index/department/'); ?>"+x;
    }

    function change_department(x)
    {
        // console.log(x);
        location.href="<?php echo base_url('usergroup/index/sub_department/'); ?>"+x;
    }



</script>
