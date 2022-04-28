<?php $modul='marketing_fee'; ?>
<?php if (!modul_full_access($modul) && !modul_full_view($modul)): ?>
<input type="hidden" name="id" value="<?php echo my_id();?>">
<?php else: ?>
<div class="form-group">
	<label>Nama Marketing</label>
	<select class="form-control" name="id">
		<?php 
		if (!empty($user_marketing)) :
			foreach ($user_marketing['data'] as $row) :
				$selected = $row['id']==my_id() ? ' selected ' : '';
		?>
			<option value="<?php echo $row['id']; ?>" <?php echo $selected; ?> ><?php echo $row['name']; ?></option>
		<?php
			endforeach;
		endif;
		?>
	</select>
</div>
<?php endif ?>

<div class="form-group">
	<label>Triwulan</label>
	<select name="triwulan" class="form-control">
		<option value="1" selected="">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
	</select>
</div>