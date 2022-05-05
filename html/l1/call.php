<?php


   $telephone=$_request["telephone"];
   $conn=mysqli_connecte('localhost','marius','passer','callcenter');
   $req="select * from client where telephone=$telephone";
   $resul=mysqli_query($conn,$req);
   if ( mysqli_num_row($result) > 0)
   $email=$_request["email"];
   $service=$_resquet["sevice"];
   $conn=mysqli_connect("localhost","boukiec2lt","callcenter");
   $lues="insert into client (prenom,nom,adresse,email,telephone,service)";
  $result=mysqli_query($conn,$rep);
if ( mysqli_num_rows($result))
while ($row=mysqli_fetch_assoc($result))

{
   $prenom=$row['prenom'];
   $nom=$row['nom'];
   $telephone=$row['telephone'];
   $email=$row['email'];
   $adresse=$row['adresse'];
   $service=$row['service'];
  
 $chaine=<form method="post" action="create.php">
   prenom:<input type="test" name="prenom"> <br>
   nom:<input type="test" name="nom"> <br>
   telephone:<input type="test" name="telephone"> <br>
   email:<input type="test" name="email"> <br>
   adresse: <input type="test" name="adresse"> <br>
   service: <input type="test""name="service"> <br>
   <input type="submit" value="valider">";
   echo $chaine;
   </form>
}
?>
