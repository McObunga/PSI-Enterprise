<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'include/DB_Functions.php';
$db = new DB_Functions();
// json response array
$response = array("error" => FALSE);
if (isset($_POST["user_id"])) {
    $userId = $_POST["user_id"];
    $user = $db->getAppointments($userId);
    if ($user != false) {
        echo json_encode($user);
    }
} else{
    $response["error"] = TRUE;
    $response["error_msg"] = "Problem getting appointments, please try again";
    echo json_encode($response);
}

?>