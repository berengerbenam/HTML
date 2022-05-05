function verifForm() {
  var msg = '';
  
  var psw1 = document.getElementById('pwd1').value;
  var psw2 = document.getElementById('pwd2').value;
  var prenom = document.getElementById('prenom').value;
  var nom = document.getElementById('nom').value;
  var email = document.getElementBYId('email').value;
  var pseudo = document.getElementById('pseudo').value;
  if (psw1 != psw2) {
    msg += 'Mot de passe et mot de passe de confirmation différents ! \n';
    }
  if (psw1.length <= 5) { msg += 'Mot de passe trop court ! (minimum = 5 caractères.) \n';}
      var rgxp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      if (rgxp.test(email) == false) {
      msg += 'adresse email invalide ! \n';
      }
    if (prenom.length <= 3) { msg += 'Prénom non-valide ! \n';}
    if (nom.length <= 3) { msg += 'Nom non-valide ! \n';}
    if (pseudo.length <= 4) { msg += 'Pseudo trop court ! (4 caractères minimum.) \n';}
   if (msg == '') { document.getElementById('form').submit();}
   else {
    var mdg = 'Donnée(s) manquante(s) : \n';
    alert(mdg+msg);
    return false;
    }
  }
   
    