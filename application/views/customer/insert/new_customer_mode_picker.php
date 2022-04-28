<table id="input_mode_table" class="table table-hover table-striped mb-10">
	<tr>
		<td >Existing Customer</td>
		<td class="">
			<?php
			echo form_dropdown('existing_customer_picker', 'usergroup_active', '', 'class="form-control" id="existing_customer_picker"');
			?>
		</td>
		<td width="5" class="">
			<a onclick="new_customer_mode('existing');" class="btn btn-default" href="javascript:void(0)">Pilih</a>
		</td>
	</tr>
	<tr>
		<td class="border-bottom">Pelanggan Baru</td>
		<td class="border-bottom">&nbsp;</td>
		<td class="border-bottom">
			<a onclick="new_customer_mode('new');" class="btn btn-default" href="javascript:void(0)">Pilih</a>
		</td>
	</tr>
</table>
