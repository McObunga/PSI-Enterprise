<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
// json response array
$response = array("error" => FALSE);
if (isset($_POST["user_id"])) {
    $userId = $_POST["user_id"];
    $user = $db->getDashboardEprescriptionStats($userId);
    if ($user != false) {
        echo json_encode($user);
    } else{
        $response = 404;
        echo json_encode($response);

    }
} else if (isset($_POST["start_date"]) && isset($_POST["end_date"]) && isset($_POST["doctor"]) && isset($_POST["country"])) {
    $start = $_POST["start_date"];
    $end = $_POST["end_date"];
    if ($_POST["doctor"] != '' && $_POST["country"] != '') {
        $doctor = $_POST["doctor"];
        $country = $_POST["country"];
        $user = $db->getDashboardFilteredEprescriptionStatsByDoctorAndCountry($start, $end, $doctor, $country);
        if ($user != false) {
            echo json_encode($user);
        } else{
            $response = 404;
            echo json_encode($response);
        }
    } else if ($_POST["doctor"] == '' && $_POST["country"] != '') {
        $doctor = '';
        $country = $_POST["country"];
        $user = $db->getDashboardFilteredEprescriptionStatsByCountry($start, $end, $country);
        if ($user != false) {
            echo json_encode($user);
        } else{
            $response = 404;
            echo json_encode($response);
        }
    } else if ($_POST["doctor"] != '' && $_POST["country"] == '') {
        $doctor = $_POST["doctor"];
        $country = '';
        $user = $db->getDashboardFilteredEprescriptionStatsByDoctor($start, $end, $doctor);
        if ($user != false) {
            echo json_encode($user);
        } else{
            $response = 404;
            echo json_encode($response);
        }
    }
}

?>