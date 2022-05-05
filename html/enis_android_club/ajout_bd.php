<?php
 
/*
 Requete HTTP Post 
 */
 
// tableau de reponse JSON
$reponse = array();
 
// tester si les champs sont valides
if (isset($_POST['col2']) && isset($_POST['col3']) && isset($_POST['col4'])) {
 
    $valeur_col2 = $_POST['col2'];
    $valeur_col3 = $_POST['col3'];
    $valeur_col4 = $_POST['col4'];
 
    // inclure la classe de connexion
    require_once __DIR__ . '/connexion.php';
 
    // connxion à la base
    $db = new CONNEXION_DB ();
 
    // requéte pour insérer les données
    $resultat = mysql_query("INSERT INTO TableExemple(col2, col3, col4) VALUES('$valeur_col2', '$valeur_col3', '$valeur_col4')");
 
    // tester si les données sont bien insérées
    if ($resultat) {
        // Données bien insérées
        $reponse["success"] = 1;
        $reponse["message"] = "Données bien insérées";
 
       // afficher  la reponse JSON
        echo json_encode($reponse);
    } else {
        // failed to insert row
        $reponse["success"] = 0;
        $reponse["message"] = "Oops! Erreur d'insrtion.";
 
      // afficher  la reponse JSON
        echo json_encode($reponse);
    }
} else {
    // Champ(s) manquant(s)
    $reponse["success"] = 0;
    $reponse["message"] = "Champ(s) manquant(s)";
 
    // afficher  la reponse JSON
    echo json_encode($reponse);
}
?>
