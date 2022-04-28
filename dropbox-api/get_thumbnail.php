<?php 
require 'config.php';

if (!$_POST['path']) {
	exit();
}
$path = $_POST['path'];

/* get thumbnail */
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://content.dropboxapi.com/2/files/get_thumbnail",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".$token,
    "content-type: text/plain",
    "dropbox-api-arg: {\"path\": \"".$path."\",\"format\": \"jpeg\",\"size\": \"w128h128\",\"mode\": \"bestfit\"}"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo 'data:image/jpg;charset=utf8;base64,'.base64_encode($response);
}

?>