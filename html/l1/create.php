<?php
   $prenom=$_post["prenom"];
   $nom=$_poste["nom"];
   $telephone=$_request["telephone"];
   $adresse=$_request["adresse"];
   $email=$_request["email"];
   $service=$_resquet["sevice"];
   $conn=mysqli_connect("localhost","boukiec2lt","callcenter");
   $lues="insert into client (prenom,nom,telephone,adresse,email,service)";
   $result=mysqli_query($conn,$rep);

?>
