<?php $this->load->view('editable/index', ''); ?>

<script type="text/javascript">



    function open_modal_generate()
    {
        var action = '<?php echo base_url(); ?>invoice/generate/';
        // alert(action);
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);
                $('#modal_generate_invoice_div').html(response.html);
                $('#modal_generate_invoice').modal('show');
            }
        });
        return false;
    }

    function open_bulan_selector()
    {
        $('#modal_month_selector').modal('show');
    }

    function search_invoice()
    {
        $('#modal_search_invoice').modal('show');
    }

    $(document).ready(function(){
        $('#invoice_status_switcher').change(function(){
            var sti = $(this).val();
            var fil = $('#js_invoice_filter').val();
            // alert(sti+' '+fil);
            location.href='<?php echo base_url(); ?>invoice/'+sti+'/'+fil;
        });
    });

    function update(x)
    {
        var action = '<?php echo base_url(); ?>invoice/update/'+x;
        // alert(action);
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                // var response = jQuery.parseJSON(res);
				// console.log(response);
                $('#update_div').html(res);
                $('#modal_editor_invoice').modal('show');
            }
        });
        return false;

    }

</script>
