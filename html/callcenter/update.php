 <?php
  
  $prenom =$_REQUEST['prenom'];
  $nom =$_REQUEST['nom'];
  $adresse =$_REQUEST['adresse'];
  $service =$_REQUEST['service'];
  $telephone =$_REQUEST['telephone'];
  $conn =mysqli_connect('127.0.0.1','bouki','passer','wassa');
$req ="UPDATE  client set service='$service', adresse='$adresse' where telephone='$telephone' ";
$result =mysqli_query($conn,$req);
  echo " Mise à jour effectuée avec succes";

 ?>
