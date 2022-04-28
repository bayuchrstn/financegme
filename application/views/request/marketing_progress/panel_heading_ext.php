<?php
	$company_data = $this->master->arr('company');
?>
<form id="form_owner_filter" class="heading-form" action="<?php echo base_url(); ?>poe" method="post">
	<div class="form-group" style="width:150px;">
		<?php
			echo form_dropdown('company_picker', $company_data, $company, 'class="form-control chosen" id="company_picker"')
		?>
	</div>

</form>
