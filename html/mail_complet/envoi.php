<?php
// Information qui apparaittra si les champs obligatoires ne sont pas remplis
$msg_erreur = "Erreur. Les champs suivants doivent être obligatoirement remplis :<br/><br/>";

// Information qui apparaittra si les 2 messages ont bien été envoyé
$msg_ok = "Votre demande a bien été prise en compte. Elle sera traitée dans les meilleurs délais.\nUn mail de confirmation vous a été envoyé.";
$message = $msg_erreur;
define('MAIL_DESTINATAIRE','votremail@votredomaine.com'); // remplacer par votre email
define('MAIL_SUJET','Objet du mail'); // remplacer l'objet du mail qui sera envoyé

// vérification des champs obligatoires (doublon avec le script si des champs obligatoires incorporés dans le formulaire)
if (empty($_POST['nom'])) 
$message .= "Votre nom<br/>";
if (empty($_POST['prenom'])) 
$message .= "Votre prenom<br/>";
if (strlen($message) > strlen($msg_erreur)) {
  echo $message;
// sinon c'est ok 
} else {
foreach($_POST as $index => $valeur) {
$$index = stripslashes(trim($valeur));
}

//Préparation de l'entête du mail:
$mail_entete = "MIME-Version: 1.0\r\n";
$mail_entete .= "From: {$_POST['nom']} "
             ."<{$_POST['mail']}>\r\n";
$mail_entete .= 'Reply-To: '.$_POST['mail']."\r\n";
$mail_entete .= 'Content-Type: text/plain; charset="iso-8859-1"';
$mail_entete .= "\r\nContent-Transfer-Encoding: 8bit\r\n";
$mail_entete .= 'X-Mailer:PHP/' . phpversion()."\r\n";

// Préparation du corps du mail 

// Remplacer le nom des variables suivantes par les noms de vos variables (name ou id) du formulaire
// Utiliser \n pour aller à la ligne 
$mail_corps = "Demande de : $civil $nom $prenom\n";
$mail_corps .= "Date de naissance : $jour_naissance/$mois_naissance/$annee_naissance\n";
$mail_corps .= "Ville de naissance : $ville_naissance\n";
$mail_corps .= "Département de naissance : $departement_naissance\n";
$mail_corps .= "Pays de naissance : $pays_naissance\n\n";

$mail_corps .= "Renseigements sur l'adresse de $nom $prenom : \n";
$mail_corps .= "Adresse : $numero $voie $adresse $code_postal $ville_actuelle\n";
$mail_corps .= "Téléphone Fixe : $fixe\n";
$mail_corps .= "Téléphone Portable : $portable\n";
$mail_corps .= "Mail : $mail\n\n";

$mail_corps .= "Renseigements sur la scolarité : \n";
// Ligne suivante, besoin de mettre le nom de "id" et du "name" pour afficher correctement les "value" des boutons radio 
$mail_corps .= "Scolarité effectuée : $scolarite $classe_actuelle $scolarite_actuelle $totalite $arret $derniere_annee\n"; 
$mail_corps .= "Origine scolaire : $origine_scolaire $autres\n\n";

$mail_corps .= "Renseigements sur la ou les formation(s) souhaitée(s) au CFA :\n";
$mail_corps .= "Demande faite pour l'année scolaire : $annee_scolaire\n";
$mail_corps .= "1er souhait de formation : $choix_un\n";
$mail_corps .= "2eme souhait de formation : $choix_deux\n";
$mail_corps .= "3eme souhait de formation : $choix_trois\n";

$mail_corps .= "Documentation(s) souhaitée(s) : $documentation  $documentation_deux\n\n";

$mail_corps .= "Observation : $observations\n\n";

// envoi du mail
if (mail(MAIL_DESTINATAIRE,MAIL_SUJET,$mail_corps,$mail_entete)) {
  //Le mail est bien expédié
  echo $msg_ok;
} else {
  //Le mail n'a pas été expédié
  echo 'Une erreur est survenue lors de l\'envoi du formulaire par email';
}

}
// Message de confirmation de reception de demande
// ---------------------------
 
/* Objet */ // Mettre votre nom de domaine
$subject = "Confirmation de votre demande sur www.domaine.com";
 
/* additional header pieces for errors, From cc's, bcc's, etc */
// Adresse mail (variable du formulaire contact)
$headers = "From: $mail <$mail>\n";

// Remplacer le mail suivant par votre mail
$headers .= "X-Sender: <votremail@votredomaine.com>\n";
$headers .= "X-Mailer: PHP\n"; // mailer
$headers .= "X-Priority: 1\n"; // Urgent message!

// Remplacer le mail suivant par votre mail
$headers .= "Return-Path: Sales <votremail@votredomaine.com>\n";  // Return errors
 
/* recipients */
$recipient = $mail;
 
/* message */
// Remplacer le contenu du message suivant par celui qui vous convient
// Vous pouvez à l'intérieur de celui-ci rappeller les variables en mettant $nom etc...
$message = "Bonjour $prenom $nom

Merci pour votre message.
Nous traiterons votre demande dans les plus bref delais.
Cordialement.
 
Rappel de vos informations personnelles:
------------------------------
Votre nom: $nom
Votre addresse: $prenom
Votre ville de residence : $ville
votre Email: $mail
Votre message: $observations
 
Si vous recevez ce mail par erreur, merci de nous contactez au plus vite
par email : votremail@votredomaine.com

A tres bientot http://www.votredomaine.com
-------------------------------
"; 


mail($recipient, $subject, $message, $headers);
?>