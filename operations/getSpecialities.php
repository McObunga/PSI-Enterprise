<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
// json response array
$response = array("error" => FALSE);
$user = $db->getSpecialityDropDown();
if ($user != false) {
    echo json_encode($user);
} else {
    $response = "Problem getting doctors";
    echo json_encode($response);
}

?>