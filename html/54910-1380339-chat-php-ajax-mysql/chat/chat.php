<?php
session_start();
require ('./script/functions.php');
$bdd = bdd_connect();

delete_msg();

if ($_SESSION['pseudo'] == NULL) {
    header('Location: index.php');
    }
      else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Chat : <?php echo $_SESSION['pseudo']; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <script href="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script href="getMessage.js" type="text/javascript"></script>
        <script src="oXHR.js" type="text/javascript" ></script>
        <script type="text/javascript" src="script.js"></script>
        <script src="script_ancMsg.js" type="text/javascript" ></script>
    </head>
    
  
    <style type="text/css">
    form
    {
        text-align:center;
    }
    </style>
    <body onLoad="request(readData), request_status(readData_status)">
    <noscript>
    <meta http-equiv="refresh" content="0;URL=./script/no-js.htm">
    </noscript>
    <script>alert('Pensez à bien vous déconnecter en quittant le chat \n sinon vous ne pourrez plus vous \n connectez !');</script>
    <span id="hello">
    <?php
    hello(); 
    ?>
    </span>
    <form action="#" method="post">
        <p>
        
        <label for="message"></label><textarea onKeyPress="if(event.keyCode==13){post(); clear();}" name="message" id="message"  rows="5" cols="25" placeholder="Message ..."></textarea><br />

        <input type="button" onClick="post(), clear()" value="Envoyer !" />
	</p>
    </form>
    <a id="agest" href="./gestion/">Gestion du compte</a>
    <script>
    function addSmileySmile(){document.getElementById('message').innerHTML += ':)';}function addSmileyClin(){document.getElementById('message').innerHTML += ';)';}function addSmileyLangue(){document.getElementById('message').innerHTML += ':p';}
    function addSmileyRigole(){document.getElementById('message').innerHTML += ':d';}function addSmileyHi(){document.getElementById('message').innerHTML += '^^';}function addSmileyCoeur(){document.getElementById('message').innerHTML += '<3';}
</script>
    <div id="ancMsg" style="visibility:hidden;" ></div>
    <div id="smiley">
    <a onClick="javascript:addSmileySmile()"><img src="./image/sourire.png" /></a>
    <a onClick="javascript:addSmileyClin()"><img src="./image/clin.png" /></a>
    <a onClick="javascript:addSmileyLangue()"><img src="./image/langue.png" /></a>
    <a onclick="javascript:addSmileyRigole()"><img src="./image/rigole.png" /></a>
    <a onClick="javascript:addSmileyHi()"><img src="./image/hihi.png" /></a>
    <a onclick="javascript:addSmileyCoeur()"><img src="./image/coeur.png" /></a>
    </div>
    <div id="change_status">
    <form action="#" method="post">
    <table><tr><td><select name="status" id="status">
    <option value="#" selected>------</option>
    <option value="0">En ligne</option>
    <option value="1">Occupé</option>
    <option value="2">Absent</option>
    </select></td></tr>
    <tr><td><input type="button" value="Ok" onClick="set_status()" /></td></tr></table>
    </form>
    </div>
    <span id="ad"><h3>Membres Connectés :</h3></span>
    <div id="membres_connectes">
    </div>
    <span id="download"><a href="http://www.phpcs.com/codes/CHAT-PHP-AJAX-MYSQL_54910.aspx">Télécharger ce chat</a></span>
<span id="deconnexion">
<a href="./script/deconnexion.php">Déconnexion</a>
     </span>
<div id="cadre_chat">

</div>
<a href="#" id="aMsg" onClick="javascript:ancien_msg(echoMsg)">Afficher les anciens messages</a>

    </body>
</html>
<?php
}
?>