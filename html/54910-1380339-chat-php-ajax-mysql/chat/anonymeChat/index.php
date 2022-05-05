<?php
session_start(); 
header('Location: ./script/login.php');
?>
<!DOCTYPE html>
  <html>
    <head>
    <link rel="stylesheet" type="text/css" href="./css/style_login.css" />
    <meta charset="UTF-8" />
    </head>
    
    <body>
    <noscript>
<meta http-equiv="refresh" content="0;URL=./script/no-js.htm">
</noscript>
    <script type="text/javascript">
    </script>
    <div id="login_form">
    <form method="post" action="./script/login.php">
    <center>
    <table>
    <tr><td>Pseudo :<input type="text" name="pseudo" required /></td></tr>
    <tr><td><input type="submit" value="Se Connecter !" /></td></tr>
    </table>
    </center>
    </form>
    </div>
    
  