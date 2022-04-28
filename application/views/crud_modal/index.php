<?php
    $randid = substr(MD5(microtime()), 0, 5);
?>

<div class="" id="<?php echo $randid; ?>">
    ini div <?php echo $randid; ?>

    <a href="#" class="gp">klik</a>
</div>

<script type="text/javascript">

    $('.gp').off().on('click', function(){
        loadmain();
    });

    function loadmain()
    {
        $('#<?php echo $randid; ?>').html('wahe fu');
    }
</script>
