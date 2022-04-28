<?php
    $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('cuti', $def, $prefix);
    // pre($this->ui->forms_debug($forms));

	// if($prefix=='update'):
	// 	echo $forms['id'];
	// endif;
?>
<?php if (!empty($people)): ?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>Nama</label>
			<select class="form-control" id="karyawan" name="karyawan">
				
			</select>
		</div>
	</div>
</div>
<?php endif ?>
<div class="row">
	<div class="col-md-12">
		<?php echo $forms['cuti_category']; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<?php echo $forms['cuti_date_start']; ?>
	</div>
	<div class="col-md-6">
		<?php echo $forms['cuti_date_end']; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php echo $forms['cuti_note']; ?>
	</div>
</div>