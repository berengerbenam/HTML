<?php
header("Content-Type: text/plain");
require('functions.php');
$bdd = bdd_connect();
  $reponse = $bdd->query('SELECT * FROM chat_online');
  while ($donnees = $reponse->fetch()) {
      
      $user_status = $donnees['online_status'];
      
      if ($user_status == 0) {
          echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="./image/vert.png" alt="En ligne"/><br />';
          }
              elseif ($user_status == 1) {
                echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="./image/orange.png" alt="Occupé"/><br />';
                }
                    elseif ($user_status == 2) {
                      echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="./image/rouge.png" alt="Absent"/><br />';
                      }
                     else {
                      echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].' />"'.$donnees['online_user'].'</a>'.'    <img src="./image/vert.png" /><br />';
                      }
      
      
      
      }
      ?>