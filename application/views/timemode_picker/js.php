<script type="text/javascript">
    $(document).ready(function(){
        $('.timemode_picker_mode').change(function(){
            var mode = $(this).val();
            $("#tmps_<?php echo $uid; ?>").load('<?php echo base_url(); ?>xhr/timemode_picker/index/'+mode);
        });

        //checkbox fire
        $('#statistics_task_teknis_control_form :checkbox').change(function() {
            $.ajax({
    			type:'POST',
    			url: $('#statistics_task_teknis_control_form').attr('action'),
    			data: $('#statistics_task_teknis_control_form').serialize(),
    			success: function(res) {
    				// var response = jQuery.parseJSON(res);
    			}
    		});
        });
    });


</script>
