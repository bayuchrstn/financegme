<?php 
	$table = 'gmd_people';	
	$column = $this->db->list_fields('people');
	$arr_column = array();
	foreach ($column as $value) {
		$arr_column[] = array(
			'key' => $table.'.'.$value,
			'value'	=> ucwords(str_replace('_', ' ', $value))
		);
	}
?>

<div class="row form-horizontal">
	<div class="col-lg-12">
		<div class="form-group">
			 <div class="col-sm-6">
			 	<select name="search_key[]" class="form-control">
			 		<?php if (count($arr_column)>0): ?>
			 			<?php foreach ($arr_column as $value): ?>
			 			<option value="<?=$value['key'];?>"><?=$value['value'];?></option>
			 			<?php endforeach ?>
			 		<?php endif ?>
			 	</select>
			 </div>
			 <div class="col-sm-6">
			 	<input type="text" name="search_value[]" class="form-control">
			 </div>			 
		</div>
	</div>
	<div id="extra_form"></div>
	<div class="col-lg-12">
		<a class="btn btn-primary" onclick="add_filter_search()">Add Filter</a>
	</div>
</div>

<script type="text/javascript">
	var total_click_extra = 0;
	function add_filter_search() {
		var extra = '<div class="col-lg-12" id="extra'+total_click_extra+'"><div class="form-group"><div class="col-sm-5"><select name="search_key[]" class="form-control">';
		<?php 
		if (count($arr_column)>0): 
		foreach ($arr_column as $value): 
		?>
		extra += '<option value="<?=$value['key'];?>"><?=$value['value'];?></option>';
		<?php 
		endforeach;
 		endif; 
 		?>
 		extra += '</select></div><div class="col-sm-5"><input type="text" name="search_value[]" class="form-control"></div><div class="col-sm-2"><a class="btn btn-danger" onclick="remove_extra_filter('+total_click_extra+')"><span class="icon-cross"></span></a></div></div></div>';
 		$('#extra_form').append(extra);
 		total_click_extra++;
	}
	function remove_extra_filter(id) {
		var action_id = '#extra'+id;
		$(action_id).remove();
	}
</script>