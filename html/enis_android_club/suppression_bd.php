<?php
 
/*
 Requete HTTP Post 
 */
 
// tableau de reponse JSON (array)
$reponse = array();
 
// tester s'il y a une donnée récue
if (isset($_POST['col1'])) {
    $valeur_col1 = $_POST['col1'];
    // inclure la classe de connexion
    require_once __DIR__ . '/connexion.php';
 
    // connexion à la base
    $db = new CONNEXION_DB ();
 
    // supprimer la ligne
    $resultat = mysql_query("DELETE FROM TableExemple WHERE col1 = $valeur_col1");
 
    // tester si la ligne est supprimée ou non 
    if (mysql_affected_rows() > 0) {
        // ligne supprimée
        $reponse["success"] = 1;
        $reponse["message"] = "ligne supprimée";
 
        // afficher  la reponse JSON
        echo json_encode($reponse);
    } else {
        // ligne n'existe pas avec col1 =col1(récue)
        $reponse["success"] = 0;
        $reponse["message"] = "Erreur de suppression";
 
       // afficher  la reponse JSON
        echo json_encode($reponse);
    }
} else {
    // Champ manquant col1
    $reponse["success"] = 0;
    $reponse["message"] = "Champ manquant";
 
    // afficher  la reponse JSON
    echo json_encode($reponse);
}
?>
