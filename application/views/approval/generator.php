<form class="" action="<?php echo base_url(); ?>xhr/approval/checkbox_generator" method="post">
    <input type="hidden" name="sender" value="1">
    <textarea name="option" rows="8" cols="80">approve|Approve,revisi|Revisi,hold|Hold,denied|Denied</textarea>
    <input type="submit" name="submit" value="ok">
</form>
