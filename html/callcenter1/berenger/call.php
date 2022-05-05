 <?php
  
  $telephone =$_REQUEST['telephone'];
  $conn=mysqli_connect('localhost','bouki2','passer','callcenter1');
  $req="select * from client  where telephone=$telephone";
  $result=mysqli_query($conn,$req);
  if ( mysqli_num_rows($result) > 0)
{
  while ($row=mysqli_fetch_assoc( $result))

  {
   $prenon=$row['prenom'];$non=$row['nom'];$telephone=$row['telephone'];$email=$row['email'];
   $service=$row['service'];$adresse=$row['adresse'];
 
    $chaine="<form method='post' action='update.php'>
    Prenom : <input type='text' name='prenom' value=$prenon > <br>
    Nom : <input type='text' name='nom' value= $non> <br>
    Telephone :<input type='text' name='telephone'  value= $telephone> <br>
    Email : <input type='text' name='email' value= $email > <br>
    Adresse : <input type='text' name='adresse'  value= $adresse> <br>
    Service : <textarea type='text' name='service' cols='40' rows='10'> $service </textarea><br>
    <input type='submit' value='Valider'>";
    echo $chaine;

   }
 }
  else 
  {
   $chaine="<form method='post' action='create.php'>
    Prenom : <input type='text' name='prenom'> <br>
    Nom : <input type='text' name='nom'> <br>
    Telephone :<input type='text' name='telephone'> <br>
    Email : <input type='text' name='email'> <br>
    Adresse : <input type='text' name='adresse'> <br>
    Service : <textarea type='text' name='service' cols='40' rows='10'> </textarea><br>
    <input type='submit' value='Valider'>";
    echo $chaine;
  }


 ?>


