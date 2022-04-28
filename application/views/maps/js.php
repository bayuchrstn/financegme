<script type="text/javascript">

    function update_maps(id,maps_type)
    {
        var action = '<?php echo base_url(); ?>maps/update/'+id;
        block_this('js_table_'+maps_type);
        // set_option('<?=base_url();?>maps/get_people', 'maps_people_update','')
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                var customer_name = (response.maps_customer_id!=null) ? response.maps_customer_id : response.maps_name;

                // is have child
                if (response.maps_parent2==null) {
                    $("#maps_lat2_update").parent().hide();
                    $("#maps_lng2_update").parent().hide();
                } else {
                    $("#maps_lat2_update").parent().show();
                    $("#maps_lng2_update").parent().show();
                }

                // is customer related
                if (response.maps_customer_id!=null) {
                    $("#maps_name_update").parent().hide();
                    $('#maps_customer_update').parent().show();
                    set_option('<?=base_url();?>maps/get_customer', 'maps_customer_update',customer_name);
                    $('#maps_customer_update').val(customer_name).trigger('chosen:updated');
                } else {
                    $('#maps_customer_update').parent().hide();
                    $("#maps_name_update").parent().show();
                    $("#maps_name_update").val(customer_name);
                }

                $("#form_maps_update").attr('action', response.action);
                $("#maps_lat_update").val(response.maps_lat);
                $("#maps_lng_update").val(response.maps_lng);
                $("#maps_lat2_update").val(response.maps_lat2);
                $("#maps_lng2_update").val(response.maps_lng2);
                $("#maps_type_update").val(response.maps_type);
                $('#maps_desc_update').text(response.maps_desc);
                $("#form_maps_update #maps_note_insert").val(response.maps_note);
                $("#form_maps_update #id_update").val(response.maps_id);
                $('#modal_maps_update').modal('show');
                unblock_this('js_table_'+maps_type);
            }
        });
        return false;
    }

    function update_maps_status(id,status_id)
    {
        var action = '<?php echo base_url(); ?>maps/update_status/'+id+'/'+status_id;
        block_this('js_table_maps');
        // set_option('<?=base_url();?>maps/get_people', 'maps_people_update','')
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $('#modal_maps_status #body_maps_update_status').empty().append(response.data_info);
                $('#form_maps_update_status').attr('action',response.action);
                $('#modal_maps_status').modal('show');
                unblock_this('js_table_maps');
            }
        });
        return false;
    }

    $('form#form_maps_insert').on("submit", function(e){
        e.preventDefault();
        var action = $(this).attr('action');
        var form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            data: form_data,
            url : action,
            success: function(result) {
                var response = $.parseJSON(result);
                // alert(response.msg);
                $('#js_table_maps').DataTable().ajax.reload( null, false );
                $('#modal_maps_status').modal('hide');
                create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
            }
        });
    });



    function insert_maps()
    {
        // set_option('<?=base_url();?>maps/get_maps_type', 'maps_type','');
        $('#modal_maps_insert').modal('show');
        // var category = '';
        // $('#maps_category_insert').empty();
        // $.each(category, function(i, cat) {
        //     $('#maps_category_insert').append(
        //         $('<option>', {
        //             value: cat.maps_category_id,
        //             text: cat.maps_category_name
        //         })
        //     );
        // });
        return false;
    }

    function show_maps() {
        $('#tab_modal_maps_detail').hide();
        var url = '<?php echo base_url(); ?>maps/all_maps';
        $('#body_detail_maps').empty();
        $('iframe#maps_frame').attr('src',url);
        $('#modal_maps_detail').modal('show');
        //action_dropmaps();
    }

    function action_dropmaps() {
        (function () {
            var old = console.log;
            var logger = document.getElementById('body_detail_maps');
            var lat, lng, comma;
            console.log = function () {
              for (var i = 0; i < arguments.length; i++) {
                if (arguments[i].substring(0,4) == "@map") {
                    comma = arguments[i].indexOf(",");
                    lat = arguments[i].substring(5,comma);
                    lng = arguments[i].substring(comma+1);
                    // logger.innerHTML = "lat:"+lat+"<br>lng:"+lng;
                    alert(arguments[i]);

                }
                // alert(arguments[i]);
              }
            }
        })();
    }

    function detail_maps(id,maps_type) {
        var action = '<?php echo base_url(); ?>maps/detail/'+id;
        block_this('js_table_'+maps_type);
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = $.parseJSON(res);
                if (response.maps.maps_customer_id==null) {
                    $('#tab_modal_maps_detail').hide();
                    $('#daftar_perangkat').empty();
                } else {
                    $('#tab_modal_maps_detail').show();
                    $.ajax({
                        type: 'GET',
                        url : '<?php echo base_url(); ?>customer/show/'+response.maps.maps_customer_id+'/item_terpasang/echo',
                        success: function(result){
                            // var response_item = $.parseJSON(result);
                            $('#daftar_perangkat').empty().append(result);
                        }
                    });
                }

                $('#body_detail_maps').empty().append(response.data_info);
                // $('#body_detail_maps').empty().append(
                //     $('<div>',{
                //         class: 'col-md-12',
                //         html : response.data_info
                //     })
                // );

                $('iframe#maps_frame').attr('src',response.maps_frame);
                $('#modal_maps_detail').modal('show');
                unblock_this('js_table_'+maps_type);
            }
        });
        return false;
    }

    // on modal detail hidden
    $('#modal_maps_detail').on('hidden.bs.modal', function () {
        $('a[data-toggle="tab"][href="#tab_daftar_perangkat"]').parent().removeClass('active');
        $('#tab_daftar_perangkat').removeClass('active');
        $('a[data-toggle="tab"][href="#show_detail_maps"]').parent().addClass('active');
        $('#show_detail_maps').addClass('active');
        $('#tab_modal_maps_detail').hide();
    });

    function delete_maps(id,maps_type)
    {
        var action = '<?php echo base_url(); ?>maps/delete/'+id;
        block_this('js_table_'+maps_type);
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#form_maps_delete").attr('action', response.action);
                $("#form_maps_delete #delete_id").val(response.maps_id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_maps_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('js_table_'+maps_type);
            }
        });
        return false;
    }


    function get_customer() {
       var maps_type = $('#maps_type option:selected').val();
       if (maps_type.indexOf("customer") >= 0) {
            set_option('<?=base_url();?>maps/get_customer', 'select_customer','');
            $('#row_maps_name_insert').hide();
            $('#row_line_2').hide();
            $('#row_customer').show();
            // $('#row_customer').attr('style','display: block;');
       } else if (maps_type.indexOf("fiber") >= 0) {
            $('#row_maps_name_insert').show();
            $('#row_customer').hide();
            $('#row_line_2').show();
            $('#select_customer').empty();
       } else {
            $('#row_customer').hide();
            $('#row_line_2').hide();
            $('#select_customer').empty();
            $('#row_maps_name_insert').show();
       }
    }

    // $('form#form_maps_insert').on("submit", function(e){
    //     e.preventDefault();
    //     var action = $(this).attr('action');
    //     var form_data = $(this).serialize();
    //     $.ajax({
    //         type: 'POST',
    //         data: form_data,
    //         url : action,
    //         success: function(result) {
    //             var response = $.parseJSON(result);
    //             // alert(response.msg);
    //             $('#js_table_karyawan').DataTable().ajax.reload( null, false );
    //             create_alert('detail_karyawan_msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
    //         }
    //     });
    // });
</script>
