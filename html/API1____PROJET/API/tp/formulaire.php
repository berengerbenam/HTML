<?php
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$password = $_POST["password"];
$solde = $_POST["solde"];
$url = "url_to_post";
$data = array("prenom"=>$prenom,"nom"=>$nom,"email"=>$email,"password"=>$password,"solde"=>$solde);
$donnee = json_encode($data);
$curl = curl_init($url);


curl_setopt($curl,CURLOPT_POST,1);
curl_setopt($curl,CURLOPT_POSTFIELDS,$donnee);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type:application/json"));
curl_setopt($curl,CURLOPT_URL,"http://api.ec2lt.sn/compte");
//curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");
$result = curl_exec($curl);
curl_close($curl);

echo $donnee;

?>



