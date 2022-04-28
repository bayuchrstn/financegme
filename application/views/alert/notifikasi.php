<script type="text/javascript">
    <?php
    if(!empty($alerts)):
        foreach($alerts as $alert):
    ?>
    push_alert('<?php echo $alert['title']; ?>', '<?php echo $alert['content']; ?>', '', '<?php echo base_url('alert'); ?>');
    <?php
        endforeach;
    endif;
    ?>

    get_notif();

    function get_notif() {
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>alert_notif/my_notif',
            success: function(res) {
                var response = $.parseJSON(res);
                var alert = response.length;
                // console.log(alert);
                $('#alert_notif').empty().append(alert);
            }
        });
        return false;
    }
</script>
