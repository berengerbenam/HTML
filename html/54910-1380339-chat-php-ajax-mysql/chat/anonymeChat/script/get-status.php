<?php
header("Content-Type: text/plain");
require('functions.php');
$bdd = bdd_connect();
  $reponse = $bdd->query('SELECT * FROM chat_onlineA');
  while ($donnees = $reponse->fetch()) {
      
      $user_status = $donnees['online_status'];
      
      if ($user_status == 0) {
          echo $donnees['online_user'].'    <img src="./image/vert.png" alt="En ligne"/><br />';
          }
              elseif ($user_status == 1) {
                echo $donnees['online_user'].'    <img src="./image/orange.png" alt="Occupé"/><br />';
                }
                    elseif ($user_status == 2) {
                      echo $donnees['online_user'].'    <img src="./image/rouge.png" alt="Absent"/><br />';
                      }
                     else {
                      echo $donnees['online_user'].'    <img src="./image/vert.png" /><br />';
                      }
      
      
      
      }
      ?>