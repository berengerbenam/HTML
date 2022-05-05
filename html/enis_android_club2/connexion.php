<?php

class CONNEXION_DB {

  function __construct() { 

        $this->connection(); // connexion à la base

    }

   function __destruct() {

        $this->fermer(); // fermer la connexion


   }

 function connection() {

        // connexion à la base , ici : "zied" = mon mot de passe

        $connexion = mysql_connect("localhost", "berenger", "bg236") or die(mysql_error());

         // selection de la base

        $db = mysql_select_db("BaseExemple") or die(mysql_error()) or die(mysql_error());

        return $connexion;

    }

  function fermer() {

       mysql_close(); //Fermer la connexion

    }

}

?>

