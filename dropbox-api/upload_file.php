<?php
require 'config.php';

if (!$_FILES) {
  exit();
}

$filename = date('YmdHis').'_'.$_FILES['file_gambar']['name'];
$filepath = $_FILES['file_gambar']['tmp_name'];
$folder_path = $_POST['path'] ? $_POST['path'] : '';

// print_r($_FILES['file_gambar']);

/*curl upload*/
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://content.dropboxapi.com/2/files/upload",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => file_get_contents($filepath),
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".$token,
    "content-type: application/octet-stream",
    "dropbox-api-arg: {\"path\": \"".$folder_path."/".$filename."\",\"mode\": \"add\",\"autorename\": true,\"mute\": false}"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
  exit();
}

$decode_response = json_decode($response,true);
$id = $decode_response['id'];
$path = $decode_response['path_lower'];

/*curl shorten url*/

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.dropboxapi.com/2/sharing/create_shared_link",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"path\": \"".$path."\",    \"short_url\": true}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".$token,
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
  exit();
} 

$decode_response = json_decode($response, true);
header("Content-Type: application/json");
echo json_encode($decode_response);

?>