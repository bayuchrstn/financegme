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
</script>
