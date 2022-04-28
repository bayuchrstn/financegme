<style>
	table{
		font-size:12px;
		width: 100%;
		max-width: 100%;
		margin-bottom: 18px;
	}
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
	  padding: 5px;
	  line-height: 1.42857143;
	  vertical-align: top;
	  border-top: 1px solid #f0f0f0;
	}
	.table > thead > tr > th {
	  vertical-align: bottom;
	  border-bottom: 2px solid #f0f0f0;
	  text-transform: uppercase;
	}
	.table-bordered {
	  border: 1px solid #f0f0f0;
	}

	.table-bordered > thead > tr > th,
	.table-bordered > tbody > tr > th,
	.table-bordered > tfoot > tr > th,
	.table-bordered > thead > tr > td,
	.table-bordered > tbody > tr > td,
	.table-bordered > tfoot > tr > td {
	  border: 1px solid #f0f0f0;
	}

	.table-bordered > thead > tr > th,
	.table-bordered > thead > tr > td {
	  border-bottom-width: 2px;
	}

</style>
<center>
	
	<?php 
	$title = str_replace('_',' ',$title);
	echo strtoupper($title).'<br>'.$label;
	echo '<small>'.$titlenote.'</small><br><br><hr><br>';
	echo $table;
	echo '<small>printed at : '.date('Y-m-d H:i:s').'</small><br>';
	?>
	
</center>