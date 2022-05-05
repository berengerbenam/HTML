<?php
 
/*
 * Following code will list all the data in the db
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/connexion.php';
 
// connecting to db
$db = new CONNEXION_DB();
 
// get all products from products table
$result = mysql_query("SELECT * FROM TableExemple") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    $response["valeurs"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $ligne = array();
        $ligne["col1"] = $row["col1"];
        $ligne["col2"] = $row["col2"];
        $ligne["col3"] = $row["col3"];
        $ligne["col4"] = $row["col4"];
       
 
        // push single row into final response array
        array_push($response["valeurs"], $ligne);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No data found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
