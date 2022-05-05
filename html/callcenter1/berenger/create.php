 <?php
  $prenom =$_REQUEST['prenom'];
  $nom =$_REQUEST['nom'];
  $adresse =$_REQUEST['adresse'];
  $email =$_REQUEST['email'];
  $telephone =$_REQUEST['telephone'];
  $service =$_REQUEST['service'];
  $conn=mysqli_connect('localhost','bouki2','passer','callcenter1');
  $req="insert into client(prenom,nom,adresse,email,telephone,service) values('$prenom','$nom','$adresse','$email','$telephone','$service')";
  $result=mysqli_query($conn,$req);
  echo " creation reussie";
 ?>


