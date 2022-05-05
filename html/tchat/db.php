<?php
$host="localhost:3306";
$user="root";
$pass="180238";
$db="z_new_database";

$conn=mysqli_connect($host,$user,$pass,$db);

function formatDate($date){
  return date('g:i a',strtotime($date));
}

 ?>
