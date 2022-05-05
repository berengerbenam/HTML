<?php
$id = $_POST["id"];
$url = "url_to_post";
$data = array("id"=>$id);
$donnee = json_encode($data);
$curl = curl_init($url);

curl_setopt($curl,CURLOPT_POSTFIELDS,$donnee);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type:application/json"));
curl_setopt($curl,CURLOPT_URL,"http://api.ec2lt.sn/supprimer/".$id);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"DELETE");

$result = curl_exec($curl);
curl_close($curl);

echo $result;

?>



