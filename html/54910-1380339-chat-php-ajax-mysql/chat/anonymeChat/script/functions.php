<?php
function bdd_connect() {
$dsn = 'mysql:dbname=chat;host=localhost';
$user = 'root';
$password = '';
try {
    $bdd = new PDO($dsn, $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
return $bdd;
    }
function psw_verif() {
  $password = htmlspecialchars($_POST['password']);
  $password_confirm = htmlspecialchars($_POST['password_confirm']);
    if ($password == $password_confirm) {
        $psw_verif = true;
        }
          else {
            $psw_verif = false;
            }
            return $psw_verif;
            }

function crypt_mdp ($mdp_a_crypte) {
$mdp = $mdp_a_crypte;
for ($i=0;$i<65535;$i++) { 
$mdp = sha1($mdp);
$mdp = md5($mdp);
}
return $mdp;
}
function inscription() {
 $verif_mail = verif_mail();
 if ($verif_mail == true) {
 $psw_verif = psw_verif();
  if ($psw_verif == true) {
      $bdd = bdd_connect();
   
 
    $query = $bdd->prepare("SELECT * FROM chat_accountsA WHERE account_login = :login");
    $query->execute(array(
        'login' => htmlspecialchars($_POST['pseudo'])
          ));
          $count=$query->rowCount();
            if($count == 0)
              {
                $insert = $bdd->prepare('
                  INSERT INTO chat_accountsA (account_login, account_pass, mail, prenom, nom)
                  VALUES(:account_login, :account_pass, :mail, :prenom, :nom)
                  ');
                  $insert->execute(array(
                    'account_login' => htmlspecialchars($_POST['pseudo']),
                    'account_pass' => crypt_mdp(htmlspecialchars($_POST['password'])),
                    'mail' => htmlspecialchars($_POST['email']),
                    'prenom' => htmlspecialchars($_POST['prenom']),
                    'nom' => htmlspecialchars($_POST['nom']),
                    ));
                    echo "Inscription terminée ! <a href='./../index.php'>Accueil</a>";
                    }
                      else {
                        echo 'Ce pseudo existe déjà !';
                        }
      
        }
        else {
        echo 'Mot de passe et mot de passe de confirmation différents !';
        }
   
  }
               else {
                  echo 'Adresse mail déjà utilisée !';
                  }
                  
                  }
                  
                  
function delete_msg() {
  $bdd = bdd_connect();
  $time_out = time()-900;
  $recup_message = $bdd->prepare('SELECT * FROM chat_messages WHERE timestamp < :time');
  $recup_message->execute(array(
  'time' => $time_out
  ));
  while ($message = $recup_message->fetch()) {
      $query_1 = $bdd->prepare('INSERT INTO ancien_message (message, pseudo) VALUES (:message, :pseudo)');
      $query_1->execute(array(
      'message' => $message['message_text'],
      'pseudo' => $message['pseudo'],
      ));
      }
  $query = $bdd->prepare("DELETE FROM chat_messages WHERE timestamp < :time");
  $query->execute(array(
      'time' => $time_out
      ));
   
      }
function user_connect($ip, $pseudo) {
  
  $bdd = bdd_connect();
    $query = $bdd->prepare("
        INSERT INTO chat_onlineA (online_ip, online_user, online_time)
        VALUES(:online_ip, :online_user, :online_time)
        ");
        $query->execute(array(
        'online_ip' => $ip,
        'online_user' => $pseudo,
        'online_time' => time(),
        ));
        }
  function is_user_connect($pseudo) {
      $bdd = bdd_connect();
      
      $ip = $_SERVER["REMOTE_ADDR"];
      $query = $bdd->prepare('
      SELECT * FROM chat_onlineA WHERE online_user = :pseudo 
      ');
      $query->execute(array(
      'pseudo' => $pseudo,
    
      ));
      $count = $query->rowCount();
          if ($count == 0) {
              $is_user_connect = false;
              }
              else {
                $is_user_connect = true;
                }
                return $is_user_connect;
                }
 function delete_user() {
    $bdd = bdd_connect();
    $time_out = time()-600;
      $query = $bdd->prepare('
      DELETE FROM chat_onlineA WHERE online_time < :ip 
      '); 
      $query->execute(array(
      'ip' => $time_out,
      ));
      }
 function maj_connect() {
    $bdd = bdd_connect();
    $ip = $_SERVER["REMOTE_ADDR"];
    $pseudo = $_SESSION['pseudo'];
    $time = time();
    $query = $bdd->prepare('
    SELECT * FROM chat_onlineA WHERE online_user = :pseudo
    ');
    $query->execute(array(
    'pseudo' => $pseudo,
    ));
    $count = $query->rowCount();
      if ($count == 0) {
          $maj = $bdd->prepare("
            INSERT INTO chat_onlineA (online_ip, online_user, online_time)
        VALUES(:online_ip, :online_user, :online_time)
        ");
        $maj->execute(array(
        'online_ip' => $ip,
        'online_user' => $pseudo,
        'online_time' => time(),
        ));
            }
            else {}
            }
function hello() {
  $heure = date("H");
  $bdd = bdd_connect();
  $query = $bdd->prepare("
    SELECT prenom, nom FROM chat_accountsA WHERE account_login = :pseudo
    ");
    $query->execute(array(
    'pseudo' => $_SESSION['pseudo'],
    ));
    $reponse = $query->fetch();
      $prenom = $reponse['prenom'];
      $nom = $reponse['nom'];
      if ($heure >= 0 && $heure <= 18) {
      echo 'Salut '. $prenom . ' ' . $nom ;
      }
      elseif($heure > 18 && $heure <= 23) {
      echo'Bonsoir '. $prenom . ' ' . $nom ;
      }
          else {
                echo 'C\'est l\'heure de se coucher !';
                }
      }
function verif_mail() {
$bdd = bdd_connect();
$mail = htmlspecialchars($_POST['email']);
$query = $bdd->prepare('
  SELECT * FROM chat_accountsA WHERE mail = :mail
  ');
  $query->execute(array(
  'mail' => $mail,
  ));
$count = $query->rowCount();
    if ($count == 0)
     {
        $verif_mail = true;
        }
      else
      {
          $verif_mail = false;
          }
     return $verif_mail;
  }
function deconnexion() {
  $bdd = bdd_connect();
  $query = $bdd->prepare('
  DELETE FROM chat_onlineA WHERE online_user = :pseudo
  ');
  $query->execute(array('pseudo' => $_SESSION['pseudo']));
  
  session_destroy();
  
  }
function smiley($texte) {
  $texte = str_replace(' :) ', '<img src="./image/sourire.png" />', $texte);
  $texte = str_replace(':) ', '<img src="./image/sourire.png" />', $texte);
$texte = str_replace(':)', '<img src="./image/sourire.png"  />', $texte);
$texte = str_replace(' :)', '<img src="./image/sourire.png" />', $texte);
$texte = str_replace(' ;) ', '<img src="./image/clin.png" />', $texte);
$texte = str_replace(';) ', '<img src="./image/clin.png" />', $texte);
$texte = str_replace(';)', '<img src="./image/clin.png" />', $texte);
$texte = str_replace(' ;)', '<img src="./image/clin.png" />', $texte);
$texte = str_replace(' :p ', '<img src="./image/langue.png" />', $texte);
$texte = str_replace(':p ', '<img src="./image/langue.png" />', $texte);
$texte = str_replace(' :p', '<img src="./image/langue.png" />', $texte);
$texte = str_replace(':p', '<img src="./image/langue.png" />', $texte);
$texte = str_replace(' :d ', '<img src="./image/rigole.png" />', $texte);
$texte = str_replace(':d ', '<img src="./image/rigole.png" />', $texte);
$texte = str_replace(' :d', '<img src="./image/rigole.png" />', $texte);
$texte = str_replace(':d', '<img src="./image/rigole.png" />', $texte);
$texte = str_replace(' :D ', '<img src="./image/rigole.png" />', $texte);
$texte = str_replace(':D ', '<img src="./image/rigole.png" />', $texte);
$texte = str_replace(' :D', '<img src="./image/rigole.png" />', $texte);
$texte = str_replace(':D', '<img src="./image/rigole.png" />', $texte);
$texte = str_replace(' <3 ', '<img src="./image/coeur.png" />', $texte);
$texte = str_replace('<3 ', '<img src="./image/coeur.png" />', $texte);
$texte = str_replace(' <3', '<img src="./image/coeur.png" />', $texte);
$texte = str_replace('<3', '<img src="./image/coeur.png" />', $texte);
$texte = str_replace('^^', '<img src="./image/hihi.png" />', $texte);
$texte = str_replace(' ^^', '<img src="./image/hihi.png" />', $texte);
$texte = str_replace('^^ ', '<img src="./image/hihi.png" />', $texte);
$texte = str_replace(' ^^ ', '<img src="./image/hihi.png" />', $texte);


return $texte;
}

function user_connecte() {
  $bdd = bdd_connect();
  $reponse = $bdd->query('SELECT * FROM chat_onlineA');
  while ($donnees = $reponse->fetch()) {
      
      $user_status = $donnees['online_status'];
      
      if ($user_status == 0) {
          echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="/image/vert.png" alt="En ligne"/><br />';
          }
              elseif ($user_status == 1) {
                echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="/image/orange.png" alt="Occupé"/><br />';
                }
                    elseif ($user_status == 2) {
                      echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="/image/rouge.png" alt="Absent"/><br />';
                      }
                     else {
                      echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].' />"'.$donnees['online_user'].'</a>'.'    <img src="/image/vert.png" /><br />';
                      }
      
      
      
      }
      }
      

    function get_message() {
      $bdd = bdd_connect();
        $reponse = $bdd->query('SELECT pseudo, message_text FROM chat_messagesA ORDER BY message_id DESC LIMIT 0, 50');


while ($donnees = $reponse->fetch())
{
    $pseudo = $donnees['pseudo'];
    $texte = htmlspecialchars($donnees['message_text']);
    $message = char(smiley($texte));
	echo '<p><strong>' . $pseudo . '</strong> : ' . $message . '</p>';
}

$reponse->closeCursor();
    }
    ?>
