<?php
session_start();
require ('functions.php');

$is_user_connect = is_user_connect($_POST['pseudo']);
if ($is_user_connect == false) {

$bdd = bdd_connect();
    
$user_mdp = crypt_mdp($_POST['password']);
  $user_pseudo = htmlspecialchars($_POST['pseudo']);
  
  $time = time();
    $reponse_mdp = $bdd->query('SELECT account_pass FROM chat_accounts WHERE account_login = ' . $bdd->quote($_POST['pseudo']));
  $mdp = $reponse_mdp->fetchColumn();
  if (isset($_POST['password']) && $user_mdp == $mdp) {
      user_connect($_SERVER['REMOTE_ADDR'], $_POST['pseudo']);    
      $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
      maj_connect();
      $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
      header('Location: cnx.php');
      
      }
      
      else {
        echo ('Mot de passe incorrect !');
        }
        }
            else {
              echo 'Erreur : vous êtez déjà connectés !';
      }
      
                
        
        ?>
