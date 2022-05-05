<?php
session_start();
require ('./script/functions.php');
?>
<!DOCTYPE html>
  <html>
    <head>
    <title><?php
      echo $_GET['user'];
      ?>
      </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/style_info.css" />
    </head>
    <body>
    <div id="user_name">
    <center><h2>
    <?php
    echo $_GET['user'];
    ?>
    </h2></center>
    </div>
    <div id="user_info"><center>
    <?php
    $bdd = bdd_connect();
    $reponse_status = $bdd->prepare('SELECT online_status FROM chat_online WHERE online_user = :pseudo');
    $reponse_status->execute(array('pseudo' => $_GET['user']));
    
    $reponse = $bdd->prepare('SELECT * FROM chat_accounts WHERE account_login = :pseudo');
    $reponse->execute(array('pseudo' => $_GET['user']));
    $count = $reponse->rowCount();
    if ($count = 1) {
    while ($donnees = $reponse->fetch()) {
      echo "<h4>".$donnees['prenom'].' '.$donnees['nom'].' '."</h4>";
      }
        }
       else {
        echo '<h2>Ce pseudo n\'existe pas</h2>';
        }
    ?>
    </center>
    </div>
    <span id="lien_chat"><a href="chat.php">Retour chat</a></span>
    </body>
    </html>
    
    