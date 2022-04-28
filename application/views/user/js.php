<script type="text/javascript">

    // Regional -> Area Chained Selects
    $(function(){
        regional_picker('<?php echo session_scope_regional(); ?>', '<?php echo session_scope_area(); ?>', 'regional_insert', 'area_insert');
    });

    $(document).ready(function(){
        $('#regional_insert').change(function(){
            var selected_regional = $(this).val();
            regional_picker(selected_regional, '', 'regional_insert', 'area_insert');
            return false;
        });

        $('#regional_update').change(function(){
            var selected_regional = $(this).val();
            regional_picker(selected_regional, '', 'regional_update', 'area_update');
            return false;
        });
    });
    // Regional -> Area Chained Selects

    jQuery(function($) { $('#input_password_insert').pwstrength(); });
    jQuery(function($) { $('#input_password_update').pwstrength(); });

    function input_user()
    {
		set_option('<?php echo base_url(); ?>select_option/user/status', 'status_insert', 'active');
		// set_option('<?php echo base_url(); ?>select_option/yesno', 'flag_karyawan_insert', 'Y');
		// set_option('<?php echo base_url(); ?>select_option/user/usergroup', 'level_insert', 'Y');
		// set_option('<?php echo base_url(); ?>select_option/user/departement', 'departement_insert', '');

        //divisi
        set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_insert', '');

        set_option('<?php echo base_url(); ?>select_option/kosong', 'department_insert', '');
        set_option('<?php echo base_url(); ?>select_option/kosong', 'sub_department_insert', '');


        $('#modal_user_insert').modal('show');
        return false;
    }

    function update_usergroup_from_user(id)
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

    function dds(trigger)
    {
        alert(trigger);
        return false;
    }

    function update_user(user_id)
    {
		// alert('ini');

        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>user/update/'+user_id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

                $("#form_user_update").attr('action', response.action);
                $("#form_user_update #username_update").val(response.username);
                $("#form_user_update #name_update").val(response.name);
                $("#form_user_update #email_update").val(response.email);
                $("#form_user_update #id_update").val(response.id);
                set_option('<?php echo base_url(); ?>select_option/user/status', 'status_update', response.status);

                //divisi
                set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_update', response.divisi);

                //department
                if(response.divisi){
                    set_option('<?php echo base_url(); ?>select_option/dds/department/'+response.divisi, 'department_update', response.department);
                } else {
                    set_option('<?php echo base_url(); ?>select_option/kosong', 'department_update', '');
                }

                //sub department
                if(response.department){
                    set_option('<?php echo base_url(); ?>select_option/dds/sub_department/'+response.department, 'sub_department_update', response.sub_department);
                } else {
                    set_option('<?php echo base_url(); ?>select_option/kosong', 'sub_department_update', '');
                }

                set_option('<?php echo base_url(); ?>select_option/dds/jabatan', 'jabatan_update', response.jabatan);

                $('#modal_user_update').modal('show');

            }
        });
        return false;
    }

    $(document).ready(function(){
        $('#divisi_update').change(function(){
            var divisi_picker = $(this).val();
            set_option('<?php echo base_url('user/dds/department/'); ?>'+divisi_picker, 'department_update', '');
            return false;
        });

        $('#divisi_insert').change(function(){
            var divisi_picker = $(this).val();
            set_option('<?php echo base_url('user/dds/department/'); ?>'+divisi_picker, 'department_insert', '');
            return false;
        });

        $('#department_update').change(function(){
            var department_picker = $(this).val();
            set_option('<?php echo base_url('user/dds/sub_department/'); ?>'+department_picker, 'sub_department_update', '');
            return false;
        });

        $('#department_insert').change(function(){
            var department_picker = $(this).val();
            set_option('<?php echo base_url('user/dds/sub_department/'); ?>'+department_picker, 'sub_department_insert', '');
            return false;
        });
    });



    $(document).ready(function() {

        $(".privileges_checkbox").change(function() {
			var ischecked= $(this).is(':checked');
		   	if(!ischecked){
				var sta = 'uncheck';
		   	} else {
                var sta = 'check';
			}

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

        $('#input_level_insert').change(function(){
            var level = $(this).val();
            if(level=='su'){
                $('#input_view_scope_insert').val('global');
            }
            return false;
        });

        $('#input_level_update').change(function(){
            var level = $(this).val();
            if(level=='su'){
                $('#input_view_scope_update').val('global');
            }
            return false;
        });

    });
</script>
