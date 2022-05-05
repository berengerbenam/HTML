<?php
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$password = $_POST["password"];
$url = "url_to_post";
$data = array("prenom"=>$prenom,"nom"=>$nom,"email"=>$email,"password"=>$password);
$donnee = json_encode($data);
$curl = curl_init($url);


curl_setopt($curl,CURLOPT_POST,1);
curl_setopt($curl,CURLOPT_POSTFIELDS,$donnee);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type:application/json"));
curl_setopt($curl,CURLOPT_URL,"http://api.apitrans.sn/compte");
//curl_setopt($curl,CURLOPT_URL,"http://localhost:5000/compte");

$result = curl_exec($curl);
curl_close($curl);
if(result==True){
echo "insertion reussie";
}else{
echo "insertion echoué";
}
echo $donnee;
?>



