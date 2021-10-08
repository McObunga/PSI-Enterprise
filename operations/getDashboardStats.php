<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();
// json response array
$response = array("error" => FALSE);
if (isset($_POST["user_id"])) {
    $userId = $_POST["user_id"];
    $user = $db->getDashboardTotalAppointmentsStats($userId);
    if ($user != false) {
        echo json_encode($user);
    } else{
        $response = 404;
        echo json_encode($response);
    }
} else if (isset($_POST["start_date"]) && isset($_POST["end_date"]) && isset($_POST["doctor"]) && isset($_POST["country"])) {
    $start = $_POST["start_date"];
    $end = $_POST["end_date"];
    if ($_POST["start_date"] != '' && $_POST["end_date"] != '' && $_POST["doctor"] == '' && $_POST["country"] == '') {
        $doctor = $_POST["doctor"];
        $country = $_POST["country"];
        $user = $db->getDashboardFilteredApptsStatsByDates($start, $end);
        if ($user != false) {
            echo json_encode($user);
        } else{
            $response = 404;
            echo json_encode($response);
        }
    } else if ($_POST["doctor"] != '' && $_POST["country"] != '') {
        $doctor = $_POST["doctor"];
        $country = $_POST["country"];
        $user = $db->getDashboardFilteredApptsStatsByDoctorAndCountry($start, $end, $doctor, $country);
        if ($user != false) {
            echo json_encode($user);
        } else{
            $response = 404;
            echo json_encode($response);
        }
    } else if ($_POST["doctor"] == '' && $_POST["country"] != '') {
        $doctor = '';
        $country = $_POST["country"];
        $user = $db->getDashboardFilteredTotalAppointmentsStatsByCountry($start, $end, $country);
        if ($user != false) {
            echo json_encode($user);
        } else{
            $response = 404;
            echo json_encode($response);
        }
    } else if ($_POST["doctor"] != '' && $_POST["country"] == '') {
        $doctor = $_POST["doctor"];
        $country = '';
        $user = $db->getDashboardFilteredTotalAppointmentsStatsByDoctor($start, $end, $doctor);
        if ($user != false) {
            echo json_encode($user);
        } else{
            $response = 404;
            echo json_encode($response);
        }
    }
}

?>