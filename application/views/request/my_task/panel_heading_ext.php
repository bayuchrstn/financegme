<?php 
	$jenis_pekerjaan = $this->master->master_by_category('jenis_pekerjaan_teknis');
?>
<div class="form-group">
<input type="hidden" name="category" value="all">
<?php if ( count($jenis_pekerjaan) > 0 ): ?>
<select name="select_task_category" id="select_task_category" class="form-control" onchange="select_task_category();">
	<option value="all">Semua</option>
	<?php foreach ($jenis_pekerjaan as $row): 
		$value = filter_serialthis(array('category' => $row['code']));
	?>
		<option value="<?php echo $value; ?>"><?php echo $row['name']; ?></option>
	<?php endforeach ?>
</select>
<?php endif; ?>
</div>