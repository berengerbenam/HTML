<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/users');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$post = json_encode($_POST);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
echo 'Error:' . curl_error($ch);
}
curl_close($ch);
echo "effecuer avec succes";
?>
