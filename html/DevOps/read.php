<?php
$ch = curl_init();
$id= $_POST['id'];
curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/users/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$tab = json_decode($result,true);
$chaine="<table border='1px'><tr><td>ID</td><td>PRENOM</td><td>NOM</td><td>EMAIL</
td></tr>";
foreach( $tab as $donnee) {
$id= $donnee['id'];
$prenom= $donnee['first_name'];
$nom= $donnee['last_name'];
$email= $donnee['email'];
$chaine = $chaine."<tr><td>".$id."</td>"."<td>".$prenom."</td>"."<td>".$nom."</td>"."<td>".
$email."</td></tr>";
}
$chaine=$chaine."</table>";
echo $chaine;
?>
