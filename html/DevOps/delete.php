<?php
$ch = curl_init();
$id= $_POST['id'];
curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/users/'.$id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
$headers = array();
$headers[] = 'Content-Type: application/json';curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
echo 'Error:' . curl_error($ch);
}
curl_close($ch);
echo "effecuer avec succes";
?>









