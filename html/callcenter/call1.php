<?php
$telephone=$_GET['telephone'];
$conn=mysqli_connect("localhost","bouki1","passer","wassa");
$req="select * from client where telephone=$telephone";
$result = mysqli_query($conn,$req);
if (mysqli_num_rows($result)>0)

 {
$prog="update.php";
while ($row = mysqli_fetch_assoc($result)) {
$prenom =$row['prenom'];$nom =$row['nom'];$adresse =$row['adresse'];$service=$row['service'];
$chaine0="<head><link href='style.css' rel='stylesheet' media='all' type='text/css'><head>";
$chaine=$chaine0."<form method='post' action='$prog'>";
$chaine1="<label for='firstname'>Prenom </label><input type='text' name='prenom' value ='$prenom'>
<label for='name'>Nom</label> <input type='text' name='nom'  value ='$nom'>
<label for='adresse'>Adresse </label><input type='text' name='adresse'  value ='$adresse'>
<label for='telephone'>Telephone</label> <input type='text' name='telephone'  value ='$telephone'>
<label for='service'>Service</label> <textarea type='text' rows='10' cols='80' name='service' >$service</textarea>
";
$chaine2="<input type='submit' value='Valider'><br></form>";
$chaine=$chaine.$chaine1.$chaine2;
echo "$chaine";

};

}
else 
{
$prog="create.php";
$chaine0="<head><link href='style.css' rel='stylesheet' media='all' type='text/css'><head>";
$chaine=$chaine0."<form method='post' action='$prog'>";
$chaine1="<label for='firstname'>Prenom </label><input type='text' name='prenom'>
<label for='name'>Nom</label><input type='text' name='nom'>
<label for='adresse'>Adresse </label><input type='text' name='adresse'>
<label for='telephone'>Telephone</label><input type='text' name='telephone'>
<label for='service'>Service</label><textarea type='text' rows='10' cols='80' name='service'></textarea>
";
$chaine2="<input type='submit' value='Valider'><br></form>";
$chaine=$chaine.$chaine1.$chaine2;
echo "$chaine";
}
?>
