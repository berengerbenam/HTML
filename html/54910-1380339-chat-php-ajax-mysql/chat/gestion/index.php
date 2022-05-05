<?php
session_start();
require ('./../script/functions.php');
$bdd = bdd_connect();
delete_msg();
if ($_SESSION['pseudo'] == NULL) {
    header('Location: ./../index.php');
    }
      else {}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <link rel="stylesheet" href="./style_gest.css" />
    <title>Gestion : <?php echo $_SESSION['pseudo']; ?></title>
    <meta charset="utf-8" />
    <meta language="FR" />
   </head>
  <body>
    <center>
     <h3><a href="change.php?action=1">Changer de mot de passe</a></h3>
     <h3><a href="change.php?action=4">Changer de pseudo</a></h3>
     <h3><a href="change.php?action=2">Effacer mes messages</a></h3>
     <h3><a href="change.php?action=3">Supprimer mon compte</a></h3>
    </center>
    