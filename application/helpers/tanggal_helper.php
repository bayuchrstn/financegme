<?php 
function selisih_tgl($tgl1, $tgl2)
{	
	$diff  = date_diff(date_create($tgl1), date_create($tgl2));
	$data["tahun"] =  $diff->y;
	$data["bulan"] =  $diff->m;
	$data["hari"] =  $diff->d;
	$data["jam"] =  $diff->h;
	$data["menit"] =  $diff->i;
	$data["detik"] =  $diff->s;

	$periode = "";
	foreach ($data as $key => $value) 
	{
		if ($value != 0 ) {
			$periode .= " ".$value." ".$key;
		}
	}
	return $periode;
}

function konversi_tgl($tgl)
{
	$dateObject = new DateTime($tgl);
	return $dateObject->format('d, M Y G:i');
}

?>