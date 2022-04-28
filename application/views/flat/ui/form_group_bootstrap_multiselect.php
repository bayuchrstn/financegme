<div class="form-group">
	<label><?php echo $label; ?></label>
	<div class="multi-select-full">
		<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="multiselect" multiple="multiple">
			<?php
				if(!empty($option)):
					foreach($option as $opt=>$val):
			?>
			<option value="<?php echo $opt; ?>" ><?php echo $val; ?></option>
			<?php
					endforeach;
				endif;
			?>
		</select>
	</div>
</div>
