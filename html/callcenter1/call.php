 <?php
  
  $telephone =$_REQUEST['telephone'];
  $conn=mysqli_connect('localhost','berenger','passer','callcenter1');
  $req="select * from client  where telephone=$telephone";
  $result=mysqli_query($conn,$req);
  if ( mysqli_num_rows($result) > 0)
{
  while ($row=mysqli_fetch_assoc( $result))

  {
   $prenon=$row['prenom'];$non=$row['nom'];$telephone=$row['telephone'];$email=$row['email'];
   $service=$row['service'];$adresse=$row['adresse'];
 
    $chaine="<form method='post' action='update.php'>
    prenom : <input type='text' name='prenom' value=$prenon > <br>
    nom : <input type='text' name='nom' value= $non> <br>
    telephone :<input type='text' name='telephone'  value= $telephone> <br>
    email : <input type='text' name='email' value= $email > <br>
    adresse : <input type='text' name='adresse'  value= $adresse> <br>
    service : <textarea type='text' name='service' cols='40' rows='10'> $service </textarea><br>
    <input type='submit' value='Valider'>";
    echo $chaine;

   }
 }
  else 
  {
   $chaine="<form method='post' action='create.php'>
    prenom : <input type='text' name='prenom'> <br>
    nom : <input type='text' name='nom'> <br>
    telephone :<input type='text' name='telephone'> <br>
    email : <input type='text' name='email'> <br>
    adresse : <input type='text' name='adresse'> <br>
    service : <textarea type='text' name='service' cols='40' rows='10'> </textarea><br>
    <input type='submit' value='Valider'>";
    echo $chaine;
  }


 ?>


