<?php
$prenom = $_REQUEST['prm'];
$nom = $_REQUEST['nom'];
$telephone = $_REQUEST['telephone'];
$adresse = $_REQUEST['adresse'];
$email = $_REQUEST['email'];
$service = $_REQUEST['service'];

$conn = mysqli_connect('localhost','marius','passer','callcenter');
$req = "insert into client (prenom,nom,telephone,adresse,email,service)values('$prenom','$nom','$telephone','$adresse','$email','$service')";
$resultat = mysqli_query($conn,$req);

if($resultat == TRUE){
echo "Insertion réussie";
}else{
echo "Erreur d'insertion";
}
?>
