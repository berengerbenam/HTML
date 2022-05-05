<?php


   $prenom=$_post["prenom"];
   $nom=_poste["nom"];
   $telephone=$_request["telephone"];
   $adresse=$_request["adresse"];
   $email=$_request["email"];
   $service=$_resquet["sevice"];
   $conn=mysqli_connect("localhost","marius","callcenter");

   $req="update client set adresse=$adresse,service=$service where telephone=$telephone";
   $result=mysqli_query($conn,$rep);
   echo"bonjour $prenom $nom";
?>
