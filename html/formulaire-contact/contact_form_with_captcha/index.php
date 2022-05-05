<!DOCTYPE>
<html>
 <head>
  <title>captcha</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script src="jquery.js"></script>
 </head>
<?php
	$nom = '';
	$email = '';
	$objet = '';
	$message = '';
	$corps = '';
	$rand = '';
	$chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	for($i=0; $i<5; $i++) { // on genere les 5 caracteres 
		$carac = strlen($chaine);
		$carac = rand(0,($carac-1));
		$rand .= $chaine[$carac];
	}
	if(isset($_POST['submit'])){
		$nom = $_POST['nom']; 
		$email = $_POST['email']; 
		$objet = $_POST['objet']; 
		$message = $_POST['message'];
		$titre = "".$objet."\n";
		$tete = "From:".$email;
		$corps.= "Nom : ".$nom."\n";
		$corps.= "Email : ".$email."\n";
		$corps.= "Objet : ".$objet."\n";
		$corps.= "Message : ".$message."\n";
		if(mail("xxxxxxxxxx@yyyyyy.zz", $titre, stripslashes($corps), $tete)) {
			?>
			<script>
			$(document).ready(function(){ 
				$("#contact_form").slideUp(1000);
				$('.result').slideDown('slow', function() {
					$("p").append("Message envoyé avec succes ! <br /> <a href=\"index.php\">Retour au Formulaire");
				  });
			 });
			</script>
			<?php
		}else {
			?>
			<script>
			$(document).ready(function(){ 
				$("#contact_form").slideUp(1000);
				$('.result').slideDown('slow', function() {
					$("p").append("Echec de l'envoi <br /> <a href=\"index.php\">Reessayez SVP! ");
					$("p").css('color','#FF0000');
				  });
			 });
			</script>
			<?php
		} 
	}
?>
 <body>
	<div id="conteneur">
		<div id="formulaire_contact">
			<div class="result"><p></p></div>
			<form id="contact_form" method="POST" action="index.php">
			<center>
				<h2>Formulaire de contact</h2>
				<table id="tab_form">
					<tr>
						<td>
							<label for="nom">Nom :</label></td><td><input type="text" name="nom" id="nom" size="38" value='<?php echo stripslashes($nom);?>' />
							<br /><span id="msg_nom" class="msg_erreur"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">Email :</label></td><td><input type="text" name="email" id="email" size="38" value='<?php echo stripslashes($email);?>'/>
							<br /><span id="msg_email" class="msg_erreur"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="objet">Objet :</label></td><td><input type="text" name="objet" id="objet" size="38" value='<?php echo stripslashes($objet);?>'/>
							<br /><span id="msg_objet" class="msg_erreur"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="message">Message :</label></td><td><textarea type="text" name="message" id="message" cols="32" rows="8" value='<?php echo stripslashes($message);?>'></textarea>
							<br /><span id="msg_message" class="msg_erreur"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="captcha">Saisissez ce code :</label></td><td><input type="text" name="captcha" id="captcha" size="10"/>
							<span class="code_captcha">
								<img src="image.php?mot=<?php echo $rand;?>" alt="image captcha"/>
							</span>
							<br /><span id="msg_captcha" class="msg_erreur"></span>
						</td>
					</tr>
					<tr><td colspan=2><center><input type="submit" value="Valider" name="submit"/></center></td></tr>
				</table><br />
			</center>
			</form>
		</div>
	</div>
	<script>
		function validateEmail(Email) { 
			var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if (filter.test(Email)) {
				return true;
			}
			else {
				return false;
			}
		}
		
		$(document).ready(function(){
			$('form').submit(function(){
				var nom = $('#nom').val();
				var email = $('#email').val();
				var objet = $('#objet').val();
				var message = $('#message').val();
				var captcha = $('#captcha').val();
				if(nom.length == 0){
					$('#nom').css('border-color','#FF0000');
					$("#msg_nom").fadeIn().text(" Veuillez saisir votre nom !");
					return false;
				}else{
					$('#nom').css('border-color','');
					$("#msg_nom").fadeOut();
				}
				if(email.length == 0){
					$('#email').css('border-color','#FF0000');
					$("#msg_email").fadeIn().text(" Veuillez saisir votre email !");
					return false;
				}else if(!validateEmail(email)){
					$("#msg_email").fadeIn().text(" Veuillez saisir un email valide !");
					return false;
				}else{
					$('#email').css('border-color','');
					$("#msg_email").fadeOut();
				}
				if(objet.length == 0){
					$('#objet').css('border-color','#FF0000');
					$("#msg_objet").fadeIn().text(" Veuillez saisir l'objet de votre message !");
					return false;
				}else{
					$('#objet').css('border-color','');
					$("#msg_objet").fadeOut();
				}
				if(message.length == 0){
					$('#message').css('border-color','#FF0000');
					$("#msg_message").fadeIn().text(" Veuillez saisir votre message !");
					return false;
				}else{
					$('#message').css('border-color','');
					$("#msg_message").fadeOut();
				}
				if(captcha.length == 0){
					$('#captcha').css('border-color','#FF0000');
					$("#msg_captcha").fadeIn().text(" Veuillez saisir ce code !");
					return false;
				}else{
					var saisi = $('#captcha').val(); 
					if(saisi != '<?php echo $rand;?>' ) {
						$('#msg_captcha').fadeIn().text(" Captcha incorrect ! Reesayez");
						return false;
					}else{
						return true;
					}
				}
			});
		});
	</script>
</body>
</html>