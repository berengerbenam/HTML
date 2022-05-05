 <?php
  $adresse =$_REQUEST['adresse'];
  $telephone =$_REQUEST['telephone'];
  $service =$_REQUEST['service'];
  $conn=mysqli_connect('localhost','bouki2','passer','callcenter1');
  $req="update client set adresse='$adresse', service='$service' where telephone='$telephone' ";
  $result=mysqli_query($conn,$req);
 ?>


