<?php
	// usage
	// $options['component'] = 'component/grid/12';
	// $options['columns'] = array('kiri', 'kanan');
	// echo $this->ui->load_component($options);
?>
<div class="row">
	<div class="col-lg-12">
		<?php
			if(isset($columns[0])):
				echo $columns[0];
			endif;
		?>
	</div>

</div>
