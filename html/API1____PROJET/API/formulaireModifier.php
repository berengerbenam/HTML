<?php
$email = $_POST["email"];
$solde = $_POST["montant"];
$url = 'url_to_post';
$data = array("email"=>$email,"montant"=>$solde);
$donnee = json_encode($data);


$curl = curl_init($url);


curl_setopt($curl,CURLOPT_POSTFIELDS,$donnee);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type:application/json"));
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'PUT');
curl_setopt($curl,CURLOPT_URL,"http://api.ec2lt.sn/retrait");
#curl_setopt($curl,CURLOPT_URL,"http://localhost:5000/comptes/
$result = curl_exec($curl);
curl_close($curl);

echo $donnee;

?>

