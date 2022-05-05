<?php
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$password = $_POST["password"];
$solde = $_POST["solde"];
$url = "url_to_post";
$data = array("prenom"=>$prenom,"nom"=>$nom,"email"=>$email,"password"=>$password,"s$
$donnee = json_encode($data);
$curl = curl_init($url);

$ch = curl_init();
	try {
		curl_setopt($ch, CURLOPT_URL, "http://api.ec2lt.sn/compte");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array("nameparam"=>"valeurparam"));
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);   
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);         
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$result = curl_exec($curl);
curl_close($curl);
echo $donnee;

?>

