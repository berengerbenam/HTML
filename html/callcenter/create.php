 <?php
  $prenom =$_REQUEST['prenom'];
  $nom =$_REQUEST['nom'];
  $adresse =$_REQUEST['adresse'];
  $service =$_REQUEST['service'];
  $telephone =$_REQUEST['telephone'];
  $conn1 =mysqli_connect('127.0.0.1','bouki','passer','wassa');
$req ="INSERT INTO client(prenom,nom,adresse,telephone,service)
VALUES('$prenom','$nom','$adresse','$telephone','$service')";
$result1 =mysqli_query($conn1,$req);
  echo " Info enregistree";

 ?>
