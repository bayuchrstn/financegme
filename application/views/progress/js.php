<?php
    $arr_label = explode(',', $detail['label']);
    $arr_code = explode(',', $detail['code']);
    $arr_show_url = explode(',', $detail['show_url']);
    $arr_task_id = explode(',', $detail['task_id']);
?>

<script type="text/javascript">

    function progress_comment(x)
    {
        $.ajax({
    		type:'GET',
    		url: '<?php echo base_url('comment/index/progress/'); ?>'+x,
    		success: function(res) {
    			$('#modal_comment_form').attr('action', '<?php echo base_url('comment/index/progress/'); ?>'+x);
    			$('#modal_comment_div').html(res);
    			$('#modal_comment').modal('show');
    		}
    	});
    	return false;
    }

    function select_this()
    {
        return false;
    }

    <?php
        $tabs = $arr_task_id;
        $urut = 0;
        foreach($tabs as $tab):
            $div_id = $arr_code[$urut].'_'.$arr_task_id[$urut];
    ?>
        $(document).ready(function(){
            $('#<?php echo $div_id; ?>_div').load('<?php echo base_url($arr_show_url[$urut]); ?>');
        });
    <?php
            $urut++;
        endforeach;
    ?>

</script>
