<?php
 
class CONNEXION_DB {
 
   
    function __construct() {
        // connexion à la base
        $this->connection();
    }
 
    
    function __destruct() {
        // fermer la connexion
        $this->fermer();
    }
 
    
    function connection() {
        
 
        // connexion à la base
        $connexion = mysql_connect("localhost", "berenger", "bg236") or die(mysql_error());
 
        // selection de la base
        $db = mysql_select_db("BaseExemple") or die(mysql_error()) or die(mysql_error());
 
        return $connexion;
    }
 
  
    function fermer() {
        // closing db connection
        mysql_close();
    }
 
}
 
?>
