<?php

   $email1=$_RESQUEST['email'];
   $id1=$_REQUEST['id'];
   $conn=mysqli_connect('localhost','marius','passer','callcenter');

   $req="UPDATE client SET email='$email1' WHERE id=$id1";
   $result=mysqli_query($conn,$rep);
  // echo"bonjour $prenom $nom";
?>
