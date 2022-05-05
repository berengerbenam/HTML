<?php
session_start();

// lorsque le boutton valider a été cliqué
if (isset($_POST['ok'])) {
	$email = $_POST["nom"];
	$password = $_POST["password"];	

	// on verifie si ça correspond avec un utilisateur dans la bd	
	if ($result == false) {
		header('location:index.php');
		//echo "<span style='color:red'>incorrect</span>";
		 echo "Votre email: ".  $email . " ou mot de passe: " . $password .  " est INVALIDE";
			
	}else{
		// recupère les infos de l'utilisateur connecté
		$_SESSION["user"] = $result;

		if ($result->typecompte == "abonne") {
			header('location:menu/abonne.php');
		}
		if ($result->typecompte == "client") {
			header('location:client.php');
		}
	}
}
?>
