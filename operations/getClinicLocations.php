<?php
require_once '../functions.php';
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
// json response array
$response = array("error" => FALSE);
if (!(isset($_SESSION["psi"]) && isset($_SESSION["_auth"]) && $_SESSION["_auth"] == $_POST["token"])) die(json_encode(["error" => "Could not authenticate request. Please refresh the page and try again"]));
$user = $db->getClinicsLocationsDropDown();
if ($user != false) {
    echo json_encode($user);
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Problem getting users";
    echo json_encode($response);

}

?>