<div id="msg_alert"></div>
<div class="panel panel-flat">
	<div class="panel-heading">
		<h6 class="panel-title">Setting</h6>
    </div>

	<div class="panel-body">
        <form class="valid" id="form_update" action="<?php echo base_url(); ?>setting" method="post">
        <?php echo show_flash('message'); ?>
		<div id="tab_div"></div>
		<div class="form-group text-right">
			<input type="hidden" name="fake_setting" value="1">
			<button type="submit" class="btn btn-success" ><i class="icon-checkmark position-left"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
		</div>
        </form>
	</div>
</div>
<?php
	echo $view_insert;
?>
