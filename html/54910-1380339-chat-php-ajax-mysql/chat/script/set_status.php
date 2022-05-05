<?php
session_start();
require ('functions.php');
$bdd = bdd_connect();
if ($_SESSION['pseudo'] == NULL) {
    header('Location: index.php');
    }
else {
  $new_status = $_GET['status'];
  $set_status = $bdd->prepare('UPDATE chat_online SET online_status = :status WHERE online_user = :pseudo');
  $set_status->execute(array(
      'status' => $new_status,
      'pseudo' => $_SESSION['pseudo'],
      ));
      header('Location: chat.php');
      }
      
    ?>