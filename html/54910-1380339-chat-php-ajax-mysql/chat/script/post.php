<?php
session_start();
require('functions.php');

$bdd = bdd_connect();
delete_msg();
$req = $bdd->prepare('INSERT INTO chat_messages (pseudo, message_text, timestamp) VALUES(:pseudo, :message_text, :timestamp)');
$req->execute(array(
  'pseudo' => $_SESSION['pseudo'],
  'message_text' => $_GET['message'],
  'timestamp' => time()
  ));
header('Location: chat.php');
?>
