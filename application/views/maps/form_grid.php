<?php
    $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('maps', $def, $prefix);
    // pre($this->ui->forms_debug($forms));

	// if($prefix=='update'):
	// 	echo $forms['id'];
	// endif;
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>Kategori</label>
			<select onchange="get_customer();" name="maps_type" id="maps_type" class="form-control">
				<!-- {category} -->
				<option value="{maps_type_code}">{maps_type_name}</option>
				<!-- {/category} -->
			</select>
		</div>
	</div>
</div>
<div class="row" id="row_customer" style="display: none;">
	<div class="col-md-12">
		<div class="form-group">
			<label>Customer</label>
			<select name="customer" id="select_customer" class="form-control">
				
			</select>
		</div>
	</div>
</div>
<div class="row" id="row_maps_name_insert">
	<div class="col-md-12">
		<?php echo $forms['maps_name']; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<?php echo $forms['maps_lat']; ?>
	</div>
	<div class="col-md-6">
		<?php echo $forms['maps_lng']; ?>
	</div>
</div>
<div class="row" id="row_line_2" style="display: none;">
	<div class="col-md-6">
		<div class="form-group">
			<label>Latitude Point 2</label>
			<input type="text" name="maps_lat_line_2" id="maps_lat_line_2" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Longtitude Point 2</label>
			<input type="text" name="maps_lng_line_2" id="maps_lng_line_2" class="form-control">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php echo $forms['maps_desc']; ?>
	</div>
</div>