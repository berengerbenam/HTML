<?php
require('functions.php');
$bdd = bdd_connect();
$query = $bdd->prepare('
DELETE FROM chat_online WHERE online_ip = :ip
');
$query->execute(array(
'ip' => $_SERVER['REMOTE_ADDR']
));
?>
