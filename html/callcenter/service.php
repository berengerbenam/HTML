 <?php
  
  $prenom =$_GET['prenom'];
  $nom =$_GET['nom'];
  $adresse =$_GET['adresse'];
  $service =$_GET['service'];
  $telephone =$_GET['telephone'];
  $conn =mysqli_connect('127.0.0.1','bouki','passer','wassa');
$req ="INSERT INTO client(prenom,nom,adresse,telephone,service)
VALUES('$prenom','$nom','$adresse','$telephone','$service')";
$result =mysqli_query($conn,$req);
  echo " Info enregistree";

 ?>
