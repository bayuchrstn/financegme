<div class="row">
	<br>
	<div class="col-lg-6">
		<div class="form-group">
			<label for="site_a">Site A</label>
			<input type="hidden" name="product_note_name[]" value="site_a">
			<input type="text" name="product_note[]" class="form-control" placeholder="Site A" id="site_a">
		</div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
			<label for="site_b">Site B</label>
			<input type="hidden" name="product_note_name[]" value="site_b">
			<input type="text" name="product_note[]" class="form-control" placeholder="Site B" id="site_b">
		</div>
	</div>
</div>
<?php if (!empty($data)): ?>
<script type="text/javascript">
	var dt = <?php echo json_encode($data); ?>;
	for (var key in dt){
		var dtx = dt[key];
		if (dtx.product_note!='' && dtx.product_note!=null) {
			var product_note = $.parseJSON(dtx.product_note);
			$('#site_a').val(product_note.site_a);
			$('#site_b').val(product_note.site_b);
		}
	}
</script>
<?php endif ?>