<?php
	if(!empty($savename)){
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$savename.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");		
	}

	echo '<center><b>PT MEDIA SARANA DATA</b>';
	echo isset($title)?$title:'';
	echo isset($title2)?$title2:'';
	echo '</center>';
	echo '<br><br><small>'.$table.'</small>';
?>