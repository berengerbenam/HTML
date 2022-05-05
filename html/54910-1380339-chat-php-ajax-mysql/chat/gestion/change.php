<?php
session_start();
require ('./../script/functions.php');
$bdd = bdd_connect();
delete_msg();
if ($_SESSION['pseudo'] == NULL) {
    header('Location: ./../index.php');
    }
  if(isset($_GET['action']) && $_GET['action'] == 1) {
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
              <head>
              <meta charset="utf-8" />
              <title>Changer de mot de passe</title>
              <meta language="FR" />
              </head>
              <body>
              <form method="POST" action="change.php?action=5"><center>
              <table>
              <tr><td><label for="ancmdp">Ancien mot de passe :</label><input type="password" name="ancmdp" /></td></tr>
              <tr><td><label for="newmdp">Nouveau mot de passe :</label><input type="password" name="newmdp" /></td></tr>
              <tr><td><label for="newmdpconfirm">Confirmation :</label><input type="password" name="newmdpconfirm" /></td></tr>
              <tr><td><input type="submit" value="Valider !" /></td></tr>
              </table></center></form>
              </body>
              </html>';
        }
      elseif (isset($_GET['action']) && $_GET['action'] == 2) {
      
           echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
              <head>
              <meta charset="utf-8" />
              <title>Effacer mes messages</title>
              <meta language="FR" />
              </head>
              <body>
              <form method="POST" action="change.php?action=6"><center>
              <table>
              <h3>Cette action supprimera tout les messages que vous avez envoyés.</h3>
              <tr><td><input type="radio" name="delete" value="oui"/>Effacer les messages</td></tr>
              <tr><td><a href="./../chat.php">Retour</a></td></tr>
              <tr><td><input type="submit" value="Valider !" /></td></tr>
              </table></center></form>
              </body>
              </html>';
        }
        elseif(isset($_GET['action']) && $_GET['action'] == 3) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
              <head>
              <meta charset="utf-8" />
              <title>Supprimer mon compte</title>
              <meta language="FR" />
              </head>
              <body>
              <form method="POST" action="change.php?action=7"><center>
              <table>
              <h3>Cette action est irréversible</h3>
              <tr><td><label for="mdp">Mot de passe :</label><input type="password" name="mdp" /></td></tr>
              <tr><td><a href="./../chat.php">Retour</a></td></tr>
              <tr><td><input type="submit" value="Supprimer le compte" /></td></tr>
              </table></center></form>
              </body>
              </html>';
        }
        elseif(isset($_GET['action']) && $_GET['action'] == 4) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
              <head>
              <meta charset="utf-8" />
              <title>Changer de pseudo</title>
              <meta language="FR" />
              </head>
              <body>
              <form method="POST" action="change.php?action=8"><center>
              <table>
              <tr><td><label for="mdp">Mot de passe :</label><input type="password" name="mdp" /></td></tr>
              <tr><td><label for="newpseudo">Nouveau pseudo :</label><input type="text" name="newpseudo" /></td></tr>
              <tr><td><input type="submit" value="Valider !" /></td></tr>
              </table></center></form>
              </body>
              </html>';
        }
        elseif(isset($_GET['action']) && $_GET['action'] == 5) {
        $ancienmdp = htmlspecialchars($_POST['ancmdp']);
        $newmdp = htmlspecialchars($_POST['newmdp']);
        $confirm = htmlspecialchars($_POST['newmdpconfirm']);
        $bdd = bdd_connect();
        $query = $bdd->prepare('SELECT account_pass FROM chat_accounts WHERE account_login = :pseudo');
        $query->execute(array('pseudo' => $_SESSION['pseudo']));
        $mdp = $query->fetchColumn();
        if ($mdp == crypt_mdp($ancienmdp)) {
          if ($newmdp == $confirm) {
            $query = $bdd->prepare('
            UPDATE chat_accounts SET account_pass = :mdp WHERE account_login = :pseudo
            ');
            $query->execute(array(
            'mdp' => crypt_mdp($newmdp),
            'pseudo' => $_SESSION['pseudo']
            ));
            echo 'Votre nouveau mot de passe est "'.$newmdp.'"<br /><a href="./../chat.php">Retour</a>';
            }
            else {
              echo 'Mot de passe et mot de passe de confirmation différents !';
              }
              }
                else {
                  echo 'Mot de passe incorrect';
                  }
                  }
          elseif(isset($_GET['action']) && $_GET['action'] == 6) {
          $bdd = bdd_connect();
          $query = $bdd->prepare('DELETE FROM chat_messages WHERE pseudo = :pseudo');
          $query->execute(array('pseudo' => $_SESSION['pseudo']));
          $query_1 = $bdd->prepare('DELETE FROM ancien_message WHERE pseudo = :pseudo');
          $query_1->execute(array('pseudo' => $_SESSION['pseudo']));
          echo 'Vos messages ont bien été supprimés. <br /><a href="./../chat.php">Retour</a>';
          }
          elseif(isset($_GET['action']) && $_GET['action'] == 7) {
          $mdp = htmlspecialchars($_POST['mdp']);
          $mdp = crypt_mdp($mdp);
          $query = $bdd->prepare('SELECT account_pass FROM chat_accounts WHERE account_login = :pseudo');
          $query->execute(array('pseudo' => $_SESSION['pseudo']));
          $mdp2 = $query->fetchColumn();
          if ($mdp == $mdp2) {
           $bbd = bdd_connect();
            $query_1 = $bdd->prepare('DELETE FROM chat_accounts WHERE account_login = :pseudo');
            $query_1->execute(array('pseudo' => $_SESSION['pseudo']));
            $query_2 = $bdd->prepare('DELETE FROM chat_online WHERE online_user = :pseudo');
            $query_2->execute(array('pseudo' => $_SESSION['pseudo']));
            deconnexion();
            }
            else { echo 'Votre mot de passe est incorrect !';}
          }
          elseif(isset($_GET['action']) && $_GET['action'] == 8) {
          $mdp = crypt_mdp(htmlspecialchars($_POST['mdp']));
          $bdd = bdd_connect();
          $pseudo = $_SESSION['pseudo'];
          $query = $bdd->prepare('SELECT account_pass FROM chat_accounts WHERE account_login = :pseudo');
          $query->execute(array('pseudo' => $_SESSION['pseudo']));
          $mdp2 = $query->fetchColumn();
          if ($mdp == $mdp2) {
           $query_1 = $bdd->prepare('UPDATE chat_accounts SET account_login = :newlogin WHERE account_login = :pseudo');
           $query_1->execute(array(
           'newlogin' => htmlspecialchars($_POST['newpseudo']),
           'pseudo' => $_SESSION['pseudo']
           ));
           $_SESSION['pseudo'] = htmlspecialchars($_POST['newpseudo']);
           $query_2 = $bdd->prepare('UPDATE chat_online SET online_user = :newpseudo WHERE online_user = :pseudo');
           $query_2->execute(array(
           'newpseudo' => $_SESSION['pseudo'],
           'pseudo' => $pseudo
           ));
           echo 'Votre nouveau pseudo est : '.$_SESSION['pseudo'];
           echo '<br /><a href="./../chat.php">Retour</a>';
           }
           else {
            echo 'Votre mot de passe est incorrect !';
            echo '<br /><a href="./../chat.php">Retour</a>';
            }
            }
           
          
        