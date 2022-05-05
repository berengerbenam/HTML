<?php
 
/*
 * Following code will update a row information
 * A row is identified by  id (col1)
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['col1']) && isset($_POST['col2']) && isset($_POST['col3']) && isset($_POST['col4'])) {
 
    $value_col1 = $_POST['col1'];
    $value_col2 = $_POST['col2'];
    $value_col3 = $_POST['col3'];
    $value_col4 = $_POST['col4'];
 
    // include db connect class
    require_once __DIR__ . '/connexion.php';
 
    // connecting to db
    $db = new CONNEXION_DB();
 
    // mysql update row with matched pid
    $result = mysql_query("UPDATE TableExemple SET col2 = '$value_col2', col3 = '$value_col3', col4 = '$value_col4' WHERE col1 = $value_col1");
 
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Row successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
