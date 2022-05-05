<?php
session_start();
require ('functions.php');
$user_pseudo = 'anonymous'.mt_rand(0,2500);
$is_user_connect = is_user_connect($user_pseudo);
if ($is_user_connect == false) {

$bdd = bdd_connect();
    
  
  
  $time = time();
    
  
      user_connect($_SERVER['REMOTE_ADDR'], $user_pseudo);    
      $_SESSION['pseudo'] = $user_pseudo;
      
      $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
      header('Location: ./../chat.php');
      
      }
      
      
        
            else {
              echo 'Erreur : ce pseudo existe déjà !';
      }
      
                
        
        ?>
