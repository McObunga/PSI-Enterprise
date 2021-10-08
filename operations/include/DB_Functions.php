<?php

class DB_Functions {

    private $conn;
    public function __construct(){
        $this->conn = mysqli_connect('localhost', 'root', '', 'myhealth_database');
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
          }
    }
 
    /**
     * Getting appointments stats
     */
    public function getDashboardTotalAppointmentsStats($userId) {
        $db = $this->conn;
        $sql = " SELECT count(*) AS 'total_appointments', (SELECT count(*) FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE location = 130 AND wp_ea_staff.user_type NOT IN ('Demo')) AS 'telemedicine', 
                (SELECT count(*) FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE location != 130 AND wp_ea_staff.user_type NOT IN ('Demo')) AS 'in-person' FROM wp_ea_appointments INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE wp_ea_staff.user_type NOT IN ('Demo')";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $inperson = "In-Person";
            $telemedicine = "Telemedicine";
            $sub_array = array();
            $sub_array['total_appointments'] = number_format($row["total_appointments"]);
            $sub_array['in_person'] = $inperson.' - '.$row["in-person"];
            $sub_array['telemedicine'] = $telemedicine.' - '.$row["telemedicine"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Getting filtered appointments stats by dates
     */
    public function getDashboardFilteredApptsStatsByDates($start, $end) {
        $db = $this->conn;
        $sql = " SELECT count(*) AS 'total_appointments', (SELECT count(*) FROM `wp_ea_appointments` INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.location = 130 AND wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end') AS 'telemedicine', 
                (SELECT count(*) FROM `wp_ea_appointments` INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.location != 130 AND wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end') AS 'in-person' 
                FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $inperson = "In-Person";
            $telemedicine = "Telemedicine";
            $sub_array = array();
            $sub_array['total_appointments'] = number_format($row["total_appointments"]);
            $sub_array['in_person'] = $inperson.' - '.number_format($row["in-person"]);
            $sub_array['telemedicine'] = $telemedicine.' - '.number_format($row["telemedicine"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Getting filtered appointments stats by doctor and country
     */
    public function getDashboardFilteredApptsStatsByDoctorAndCountry($start, $end, $doctor, $country) {
        $db = $this->conn;
        $sql = " SELECT count(*) AS 'total_appointments', (SELECT count(*) FROM `wp_ea_appointments` INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.location = 130 AND wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_locations.location = '$country') AS 'telemedicine', 
                (SELECT count(*) FROM `wp_ea_appointments` INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.location != 130 AND wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_locations.location = '$country') AS 'in-person' 
                FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_locations.location = '$country' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $inperson = "In-Person";
            $telemedicine = "Telemedicine";
            $sub_array = array();
            $sub_array['total_appointments'] = number_format($row["total_appointments"]);
            $sub_array['in_person'] = $inperson.' - '.number_format($row["in-person"]);
            $sub_array['telemedicine'] = $telemedicine.' - '.number_format($row["telemedicine"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered appointments stats by country
     */
    public function getDashboardFilteredTotalAppointmentsStatsByCountry($start, $end, $country) {
        $db = $this->conn;
        $sql = " SELECT count(*) AS 'total_appointments', (SELECT count(*) FROM `wp_ea_appointments` INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.location = 130 AND wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_locations.location = '$country') AS 'telemedicine', 
                (SELECT count(*) FROM `wp_ea_appointments` INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.location != 130 AND wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_locations.location = '$country') AS 'in-person' 
                FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.facility_id = wp_ea_locations.facility_id WHERE wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_locations.location = '$country' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $inperson = "In-Person";
            $telemedicine = "Telemedicine";
            $sub_array = array();
            $sub_array['total_appointments'] = number_format($row["total_appointments"]);
            $sub_array['in_person'] = $inperson.' - '.number_format($row["in-person"]);
            $sub_array['telemedicine'] = $telemedicine.' - '.number_format($row["telemedicine"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered appointments stats by doctor
     */
    public function getDashboardFilteredTotalAppointmentsStatsByDoctor($start, $end, $doctor) {
        $db = $this->conn;
        $sql = " SELECT count(*) AS 'total_appointments', (SELECT count(*) FROM `wp_ea_appointments` WHERE wp_ea_appointments.location = 130 AND wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_appointments.facility_id = '$doctor') AS 'telemedicine', 
        (SELECT count(*) FROM `wp_ea_appointments` WHERE wp_ea_appointments.location != 130 AND wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_appointments.facility_id = '$doctor') AS 'in-person' 
        FROM wp_ea_appointments WHERE wp_ea_appointments.date >= '$start' AND wp_ea_appointments.date <= '$end' AND wp_ea_appointments.facility_id = '$doctor' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $inperson = "In-Person";
            $telemedicine = "Telemedicine";
            $sub_array = array();
            $sub_array['total_appointments'] = number_format($row["total_appointments"]);
            $sub_array['in_person'] = $inperson.' - '.number_format($row["in-person"]);
            $sub_array['telemedicine'] = $telemedicine.' - '.number_format($row["telemedicine"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting all users
     */
    public function getDashboardTotalUsersStats($userId) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_users' FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email OR wp_ea_staff.email = wp_users.user_login WHERE wp_ea_staff.user_type NOT IN('Demo') ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_users'] = number_format($row["total_users"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered users stats dates
     */
    public function getDashboardFilteredTotalUsersStatsByDates($start, $end) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_users' FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND wp_ea_staff.id = '$doctor' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array['total_users'] = number_format($row["total_users"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered users stats by country and doctor
     */
    public function getDashboardFilteredTotalUsersStatsByDoctorAndCountry($start, $end, $doctor, $country) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_users' FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND wp_ea_staff.id = '$doctor' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array['total_users'] = number_format($row["total_users"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered users stats by country
     */
    public function getDashboardFilteredTotalUsersStatsByCountry($start, $end, $country) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_users' FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND wp_ea_staff.user_type NOT IN('Demo')";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array['total_users'] = number_format($row["total_users"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered users stats by doctor
     */
    public function getDashboardFilteredTotalUsersStatsByDoctor($start, $end, $doctor) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_users' FROM wp_ea_staff WHERE id = '$doctor' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array['total_users'] = number_format($row["total_users"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting networks stats
     */
    public function getDashboardTotalNetworksStats($userId) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
        (SELECT COUNT(*) FROM `doctors_network` WHERE status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` WHERE accepted = 'Accepted' AND status = '' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $gruops = "Groups";
            $networks = "Networks";
            $sub_array = array();
            $sub_array['total_networks'] = number_format($row["total_networks"]);
            $sub_array['total_groups'] = $gruops.' - '.number_format($row["groups"]);
            $sub_array['total_individual'] = $networks.' - '.number_format($row["individual"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered networks by country and doctor
     */
    public function getDashboardFilteredTotalNetworksStatsByDoctorAndCountry($start, $end, $doctor, $country) {
        $db = $this->conn;
        $query = "SELECT wp_ea_staff.dr_post_id FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_staff.id = '$doctor' AND wp_ea_locations.location = '$country' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];

        $sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$doctorPostId' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
        (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$doctorPostId' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
        WHERE accepted = 'Accepted' AND status = '' AND network_id = '$doctorPostId' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $gruops = "Groups";
            $networks = "Networks";
            $sub_array = array();
            $sub_array['total_networks'] = number_format($row["total_networks"]);
            $sub_array['total_groups'] = $gruops.' - '.number_format($row["groups"]);
            $sub_array['total_individual'] = $networks.' - '.number_format($row["individual"]);
            $data[] = $sub_array;        
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered networks by country
     */
    public function getDashboardFilteredTotalNetworksStatsByCountry($start, $end, $country) {
        $db = $this->conn;
        $query = "SELECT wp_ea_staff.dr_post_id FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];

        $sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$doctorPostId' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
        (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$doctorPostId' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
        WHERE accepted = 'Accepted' AND status = '' AND network_id = '$doctorPostId' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $gruops = "Groups";
            $networks = "Networks";
            $sub_array = array();
            $sub_array['total_networks'] = number_format($row["total_networks"]);
            $sub_array['total_groups'] = $gruops.' - '.number_format($row["groups"]);
            $sub_array['total_individual'] = $networks.' - '.number_format($row["individual"]);
            $data[] = $sub_array;        
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered networks by doctor
     */
    public function getDashboardFilteredTotalNetworksStatsByDoctor($start, $end, $doctor) {
        $db = $this->conn;
        $query = "SELECT dr_post_id FROM wp_ea_staff WHERE id = '$doctor' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];

        $sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$doctorPostId' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
        (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$doctorPostId' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
        WHERE accepted = 'Accepted' AND status = '' AND network_id = '$doctorPostId' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $gruops = "Groups";
            $networks = "Networks";
            $sub_array = array();
            $sub_array['total_networks'] = number_format($row["total_networks"]);
            $sub_array['total_groups'] = $gruops.' - '.number_format($row["groups"]);
            $sub_array['total_individual'] = $networks.' - '.number_format($row["individual"]);
            $data[] = $sub_array;        
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    
    /**
     * Getting all e-prescription stats
     */
    public function getDashboardEprescriptionStats($userId) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS eprescriptions FROM case_prescription INNER JOIN wp_ea_staff ON case_prescription.doctor_id = wp_ea_staff.dr_post_id WHERE wp_ea_staff.user_type NOT IN ('Demo') AND iv != '' AND enc_key != '' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['e_prescriptions'] = number_format($row["eprescriptions"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Getting filtered e-prescription stats by dates
     */
    public function getDashboardFilteredEprescriptionStatsByDates($start, $end) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS eprescriptions FROM case_prescription WHERE DATE(date_added) >= '$start' AND DATE(date_added) <= '$end' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['e_prescriptions'] = number_format($row["eprescriptions"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Getting filtered e-prescription stats by country and doctor
     */
    public function getDashboardFilteredEprescriptionStatsByDoctorAndCountry($start, $end, $doctor, $country) {
        $db = $this->conn;
        $query = "SELECT wp_ea_staff.dr_post_id FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_staff.id = '$doctor' AND wp_ea_locations.location = '$country' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];

        $sql = " SELECT COUNT(*) AS eprescriptions FROM case_prescription WHERE doctor_id = '$doctorPostId' AND DATE(date_added) >= '$start' AND DATE(date_added) <= '$end' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['e_prescriptions'] = number_format($row["eprescriptions"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered e-prescription stats by country
     */
    public function getDashboardFilteredEprescriptionStatsByCountry($start, $end, $country) {
        $db = $this->conn;
        $query = "SELECT wp_ea_staff.dr_post_id FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];

        $sql = " SELECT COUNT(*) AS eprescriptions FROM case_prescription WHERE doctor_id = '$doctorPostId' AND DATE(date_added) >= '$start' AND DATE(date_added) <= '$end' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['e_prescriptions'] = number_format($row["eprescriptions"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    
    /**
     * Getting filtered e-prescription stats by doctor
     */
    public function getDashboardFilteredEprescriptionStatsByDoctor($start, $end, $doctor) {
        $db = $this->conn;
        $query = "SELECT dr_post_id FROM wp_ea_staff WHERE id = '$doctor' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];

        $sql = " SELECT COUNT(*) AS eprescriptions FROM case_prescription WHERE doctor_id = '$doctorPostId' AND DATE(date_added) >= '$start' AND DATE(date_added) <= '$end' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['e_prescriptions'] = number_format($row["eprescriptions"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting referrals stats
     */
    public function getDashboardTotalReferralStats($userId) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_referrals', (SELECT COUNT(*) FROM referrals WHERE (referee != '' AND recipient != '' AND status = 'Rejected')) AS failed_referrals,
        (SELECT COUNT(*) FROM referrals WHERE (referee != '' AND recipient != '' AND status = 'Accepted')) AS successful_referrals FROM referrals WHERE (referee != '' AND recipient != '')";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $accepted = 'Accepted';
            $rejected = 'Rejected';
            $sub_array = array();
            $sub_array['total_referrals'] = number_format($row["total_referrals"]);
            $sub_array['accepted'] = $accepted.' - '.number_format($row["successful_referrals"]);
            $sub_array['rejected'] = $rejected.' - '.number_format($row["failed_referrals"]);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Getting filtered referrals stats by dates
     */
    public function getDashboardFilteredTotalReferralStatsByDates($start, $end) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_referrals', (SELECT COUNT(*) FROM referrals WHERE (referee != '' AND recipient != '' AND status = 'Rejected' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')) AS failed_referrals,
        (SELECT COUNT(*) FROM referrals WHERE (referee != '' AND recipient != '' AND status = 'Accepted' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')) AS successful_referrals FROM referrals WHERE (referee != '' AND recipient != '' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $accepted = 'Accepted';
            $rejected = 'Rejected';
            $sub_array = array();
            $sub_array['total_referrals'] = number_format($row["total_referrals"]);
            $sub_array['accepted'] = $accepted.' - '.number_format($row["successful_referrals"]);
            $sub_array['rejected'] = $rejected.' - '.number_format($row["failed_referrals"]);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Getting filtered referrals stats by country and doctor
     */
    public function getDashboardFilteredTotalReferralStatsByDoctorAndCountry($start, $end, $doctor, $country) {
        $db = $this->conn;
        $query = "SELECT wp_ea_staff.dr_post_id FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_staff.id = '$doctor' AND wp_ea_locations.location = '$country' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];
        
        $sql = " SELECT COUNT(*) AS 'total_referrals', (SELECT COUNT(*) FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND status = 'Rejected' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')) AS failed_referrals,
        (SELECT COUNT(*) FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND status = 'Accepted' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')) AS successful_referrals FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $accepted = 'Accepted';
            $rejected = 'Rejected';
            $sub_array = array();
            $sub_array['total_referrals'] = number_format($row["total_referrals"]);
            $sub_array['accepted'] = $accepted.' - '.number_format($row["successful_referrals"]);
            $sub_array['rejected'] = $rejected.' - '.number_format($row["failed_referrals"]);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Getting filtered referrals stats by country
     */
    public function getDashboardFilteredTotalReferralStatsByCountry($start, $end, $country) {
        $db = $this->conn;
        $query = "SELECT wp_ea_staff.dr_post_id FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];
        
        $sql = " SELECT COUNT(*) AS 'total_referrals', (SELECT COUNT(*) FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND status = 'Rejected' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')) AS failed_referrals,
        (SELECT COUNT(*) FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND status = 'Accepted' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')) AS successful_referrals FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $accepted = 'Accepted';
            $rejected = 'Rejected';
            $sub_array = array();
            $sub_array['total_referrals'] = number_format($row["total_referrals"]);
            $sub_array['accepted'] = $accepted.' - '.number_format($row["successful_referrals"]);
            $sub_array['rejected'] = $rejected.' - '.number_format($row["failed_referrals"]);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Getting filtered referrals stats by doctor
     */
    public function getDashboardFilteredTotalReferralStatsByDoctor($start, $end, $doctor) {
        $db = $this->conn;
        $query = "SELECT dr_post_id FROM wp_ea_staff WHERE id = '$doctor' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        $post_id = mysqli_fetch_assoc($query_result);
        $doctorPostId = $post_id["dr_post_id"];
        
        $sql = " SELECT COUNT(*) AS 'total_referrals', (SELECT COUNT(*) FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND status = 'Rejected' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')) AS failed_referrals,
        (SELECT COUNT(*) FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND status = 'Accepted' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')) AS successful_referrals FROM referrals WHERE (referee = '$doctorPostId' AND referee != '' AND recipient != '' AND DATE(date_added) >= '$start' AND DATE(date_added) >= '$end')";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $accepted = 'Accepted';
            $rejected = 'Rejected';
            $sub_array = array();
            $sub_array['total_referrals'] = number_format($row["total_referrals"]);
            $sub_array['accepted'] = $accepted.' - '.number_format($row["successful_referrals"]);
            $sub_array['rejected'] = $rejected.' - '.number_format($row["failed_referrals"]);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting goodlife orders stats
     */
    public function getDashboardTotalGoodlifeOrders() {
        $db = $this->conn;
        $sql_goodlife = " SELECT COUNT(*) AS 'total_goodlife_orders' FROM goodlife_orders INNER JOIN case_prescription ON goodlife_orders.prescription_no = case_prescription.prescription_no GROUP BY case_prescription.prescription_no ";
        $goodlife_result = mysqli_query($db,$sql_goodlife)or die(mysqli_error());
        $goodlife_orders = mysqli_fetch_assoc($goodlife_result);
        $total_goodlife_orders = $goodlife_orders["total_goodlife_orders"];
        
        $sub_array = array();
        $sub_array['total_goodlife'] = number_format($total_goodlife_orders);
        $data[] = $sub_array;
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting goodlife orders by dates
     */
    public function getDashboardFilteredTotalGoodlifeOrdersByDates($start, $end) {
        $db = $this->conn;
        $query = "SELECT dr_post_id FROM wp_ea_staff WHERE dr_post_id != '' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        while($row = mysqli_fetch_array($query_result)) {
            $doctorPostId = $row["dr_post_id"];
            $sql = " SELECT prescription_no FROM case_prescription WHERE doctor_id = '$doctorPostId' AND DATE(date_added) >= '$start' AND DATE(date_added) <= '$end' GROUP BY prescription_no";
            $statement = mysqli_query($db,$sql) or die(mysqli_error());
            $result = mysqli_fetch_array($statement);
            $prescription_no = $result["prescription_no"];

            $sql_goodlife = " SELECT COUNT(*) AS 'total_goodlife_orders' FROM goodlife_orders WHERE prescription_no = '$prescription_no' ";
            $goodlife_result = mysqli_query($db,$sql_goodlife)or die(mysqli_error());
            $goodlife_orders = mysqli_fetch_assoc($goodlife_result);
            $total_goodlife_orders = $goodlife_orders["total_goodlife_orders"];
            
            $sub_array = array();
            $sub_array['total_goodlife'] = number_format($total_goodlife_orders);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting goodlife orders by country and doctor
     */
    public function getDashboardFilteredTotalGoodlifeOrdersByDoctorAndCountry($start, $end, $doctor, $country) {
        $db = $this->conn;
        $query = "SELECT wp_ea_staff.dr_post_id FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND wp_ea_staff.id = '$doctor' AND wp_ea_staff.dr_post_id != '' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        while($row = mysqli_fetch_array($query_result)) {
            $doctorPostId = $row["dr_post_id"];
            $sql = " SELECT prescription_no FROM case_prescription WHERE doctor_id = '$doctorPostId' GROUP BY prescription_no";
            $statement = mysqli_query($db,$sql) or die(mysqli_error());
            $result = mysqli_fetch_array($statement);
            $prescription_no = $result["prescription_no"];

            $sql_goodlife = " SELECT COUNT(*) AS 'total_goodlife_orders' FROM goodlife_orders WHERE prescription_no = '$prescription_no' ";
            $goodlife_result = mysqli_query($db,$sql_goodlife)or die(mysqli_error());
            $goodlife_orders = mysqli_fetch_assoc($goodlife_result);
            $total_goodlife_orders = $goodlife_orders["total_goodlife_orders"];
            
            $sub_array = array();
            $sub_array['total_goodlife'] = number_format($total_goodlife_orders);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

        /**
     * Getting filtered goodlife orders stats by country
     */
    public function getDashboardFilteredTotalGoodlifeOrdersByCountry($start, $end, $country) {
        $db = $this->conn;
        $query = "SELECT wp_ea_staff.dr_post_id FROM wp_ea_staff INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND wp_ea_staff.dr_post_id != '' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        while($row = mysqli_fetch_array($query_result)) {
            $doctorPostId = $row["dr_post_id"];
            $sql = " SELECT prescription_no FROM case_prescription WHERE doctor_id = '$doctorPostId' GROUP BY prescription_no";
            $statement = mysqli_query($db,$sql) or die(mysqli_error());
            $result = mysqli_fetch_array($statement);
            $prescription_no = $result["prescription_no"];

            $sql_goodlife = " SELECT COUNT(*) AS 'total_goodlife_orders' FROM goodlife_orders WHERE prescription_no = '$prescription_no' ";
            $goodlife_result = mysqli_query($db,$sql_goodlife)or die(mysqli_error());
            $goodlife_orders = mysqli_fetch_assoc($goodlife_result);
            $total_goodlife_orders = $goodlife_orders["total_goodlife_orders"];
            
            $sub_array = array();
            $sub_array['total_goodlife'] = number_format($total_goodlife_orders);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting filtered goodlife orders stats by doctor
     */
    public function getDashboardFilteredTotalGoodlifeOrdersByDoctor($start, $end, $doctor) {
        $db = $this->conn;
        $query = "SELECT dr_post_id FROM wp_ea_staff WHERE id = '$doctor' " ;
        $query_result = mysqli_query($db,$query)or die(mysqli_error());
        while($row = mysqli_fetch_array($query_result)) {
            $doctorPostId = $row["dr_post_id"];
            $sql = " SELECT prescription_no FROM case_prescription WHERE doctor_id = '$doctorPostId' GROUP BY prescription_no";
            $statement = mysqli_query($db,$sql) or die(mysqli_error());
            $result = mysqli_fetch_array($statement);
            $prescription_no = $result["prescription_no"];

            $sql_goodlife = " SELECT COUNT(*) AS 'total_goodlife_orders' FROM goodlife_orders WHERE prescription_no = '$prescription_no' ";
            $goodlife_result = mysqli_query($db,$sql_goodlife)or die(mysqli_error());
            $goodlife_orders = mysqli_fetch_assoc($goodlife_result);
            $total_goodlife_orders = $goodlife_orders["total_goodlife_orders"];
            
            $sub_array = array();
            $sub_array['total_goodlife'] = number_format($total_goodlife_orders);
            $data[] = $sub_array;       
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    
    /**
     * Getting all patient chats
     */
    public function getDashboardTotalPatientChats($userId) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting all patient chats by dates
     */
    public function getDashboardFilteredTotalPatientChatsByDates($start, $end) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat INNER JOIN wp_ea_staff ON chat.doctor_id = wp_ea_staff.id WHERE DATE(chat.date_added) >= '$start' AND DATE(chat.date_added) <= '$end' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting all patient chats by country and doctor
     */
    public function getDashboardFilteredTotalPatientChatsByDoctorAndCountry($start, $end, $doctor, $country) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat INNER JOIN wp_ea_staff ON chat.doctor_id = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id 
        WHERE chat.doctor_id = '$doctor' AND wp_ea_locations.location = '$country' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting all patient chats by country
     */
    public function getDashboardFilteredTotalPatientChatsByCountry($start, $end, $country) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat INNER JOIN wp_ea_staff ON chat.doctor_id = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id 
        WHERE wp_ea_locations.location = '$country' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting all patient chats by doctor
     */
    public function getDashboardFilteredTotalPatientChatsByDoctor($start, $end, $doctor) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat INNER JOIN wp_ea_staff ON chat.doctor_id = wp_ea_staff.id  
        WHERE chat.doctor_id = '$doctor' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    
    /**
     * Getting all referral chats
     */
    public function getDashboardTotalReferralChats($userId) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral WHERE chat_type = 'refaral' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting all referral chats by country and doctor
     */
    public function getDashboardTotalReferralChatsByDoctorAndCountry($start, $end, $doctor, $country) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
        INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id  WHERE wp_ea_locations.location = '$country' 
        AND wp_ea_staff.id = '$doctor' AND chat_type = 'refaral' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting all referral chats by country
     */
    public function getDashboardTotalReferralChatsByCountry($start, $end, $country) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
        INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id  WHERE wp_ea_locations.location = '$country' 
        AND chat_type = 'refaral' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting all referral chats by doctor
     */
    public function getDashboardTotalReferralChatsByDoctor($start, $end, $doctor) {
        $db = $this->conn;
        $sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
        WHERE  wp_ea_staff.id = '$doctor' AND chat_type = 'refaral' ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['total_chats'] = number_format($row["total_chats"]);
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Getting Clinics in select drop down
     */
    public function getClinicsDropDown() {
        $db = $this->conn;
        $result = mysqli_query($db, "SELECT * FROM psi_clinics ORDER BY psi_clinics.name ASC")or die(mysqli_error($db));
        $data = array();
        while($row = mysqli_fetch_array($result)) {
            $data[] = $row;
        }
        if (!empty($data)) {
            return $data;
        } else {
            $response = 404;
            return $response; 
        }
        mysqli_close($db);
    }
    
    /**
     * Getting Clinic Locations in select drop down
     */
    public function getClinicsLocationsDropDown() {
        $db = $this->conn;
        $result = mysqli_query($db, "SELECT * FROM psi_locations INNER JOIN psi_clinics ON psi_locations.id = psi_clinics.location ORDER BY psi_locations.name ASC")or die(mysqli_error($db));
        $data = array();
        while($row = mysqli_fetch_array($result)) {
            $data[] = $row;
        }
        if (!empty($data)) {
            return $data;
        } else {
            $response = 404;
            return $response; 
        }
        mysqli_close($db);
    }
    
    /**
     * Getting subscribed facilities
     */
    public function getSubscribedFacilities() {
        $db = $this->conn;
        $sql = " SELECT wp_ea_staff.id, wp_ea_staff.name FROM wp_ea_staff INNER JOIN patient_engagement_subscriptions ON wp_ea_staff.facility_id = patient_engagement_subscriptions.omp_facility_id WHERE wp_ea_staff.user_type NOT IN('Demo') GROUP BY wp_ea_staff.facility_id ";
        $result = mysqli_query($db,$sql)or die(mysqli_error());
        $emparray = array();
        while($row = mysqli_fetch_array($result)) {
            $emparray[] = $row;
        }
        if (!empty($emparray)) {
            return $emparray;
        } else {
            $response = 404;
            return $response; 
        }
        mysqli_close($db);
    }
    
    /**
     * Getting doctors
     */
    public function getSpecialityDropDown() {
        $db = $this->conn;
        $sql = " SELECT dr_post_id FROM `wp_ea_staff` ";
        $statement = mysqli_query($db, $sql)or die(mysqli_error());
        $emparray = array();
        while($row = mysqli_fetch_array($statement)) {
            $doctorPostId = $row["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $emparray[] = $speciality;
        }
        if (!empty($emparray)) {
            return $emparray;
        } else {
            $response = 404;
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Getting doctor upcoming appointments in dashboard
     */
    public function getDashboardUpcomingAppointmentsMaxTen($doctorId) {
        $db = $this->conn;
        $timezone = date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $statement = " SELECT wp_ea_appointments.id, wp_ea_appointments.date, wp_ea_appointments.location, wp_ea_appointments.start, wp_ea_appointments.status FROM wp_ea_appointments WHERE worker = '$doctorId' AND wp_ea_appointments.date >= '$currentDate' AND status NOT IN('confirmed','abandoned') LIMIT 10";
        $result = mysqli_query($db,$statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {

            $appointment_id = $row["id"];
            $firstName = " SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id = '$appointment_id' AND wp_ea_fields.field_id = 2 ";
            $lastName = " SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id = '$appointment_id' AND wp_ea_fields.field_id = 7 ";
            $firstNameResult = mysqli_query($db, $firstName)or die(mysqli_error());
            $lastNameResult = mysqli_query($db, $lastName)or die(mysqli_error());
            $first_name = mysqli_fetch_array($firstNameResult);
            $last_name = mysqli_fetch_array($lastNameResult);

            $telemedicine_location = 'Telemedicine';
            $in_person_location = 'In-Person';
            if ($row['location'] == 130) {
                $service_type = $telemedicine_location;
            }  else $service_type = $in_person_location;
            $time = date ('h:i A', strtotime ($row["start"]));

            $sub_array = array();
            $sub_array[] = $first_name["value"]. ' ' .$last_name["value"];
            $sub_array[] = date("d-m-Y", strtotime($row["date"])).' '.$time;
            $sub_array[] = $service_type;
            $sub_array[] = 'Confirmed';
            $sub_array[] = '<span class="view_appointment label label-sm label-info" id="'.$row["id"].'" >
                            <i class="fa fa-eye"></i> View</span>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Getting all user to do notes
     */
    public function getUserToDoNotes($userId) {
        $db = $this->conn;
        $statement = "SELECT * FROM bd_todo_list WHERE user_id = '$userId' ";
        $result = mysqli_query($db,$statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $encryptedText = base64_decode($row["todo_note"]);
            $iv = base64_decode($row["note_enc"]);
            $key = base64_decode($row["enc_key"]);
            $decryptedNote = openssl_decrypt($encryptedText, 'AES-256-CBC', $key, 0, $iv);
            $docNote = $this->pkcs7_unpad($decryptedNote);
            
            $sub_array = array();
            $sub_array[] = $docNote;
            $sub_array[] = '<button type="button" class="remove-note btn btn-delnote btn-xs" id="'.$row["id"].'" >
            <i class="fa fa-trash-o"></i></button>';
            $data[] = $sub_array;
            
        } 
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No to do list available";
            return $response; 
        }
        mysqli_close($db);
 
    }

    /**
     * Getting all user to do notes
     */
    public function getLoginAttempts($userId) {
        $db = $this->conn;
        $statement = "SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(loginlogsnew.user_email) AS user_email, ANY_VALUE(loginlogsnew.attempt_date) AS attempt_date, ANY_VALUE(wp_ea_staff.name) AS name FROM loginlogsnew INNER JOIN wp_ea_staff ON loginlogsnew.user_email = wp_ea_staff.email GROUP BY loginlogsnew.user_email";
        $result = mysqli_query($db,$statement)or die(mysqli_error($db));
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $user = $row["user_email"];
            $attempt_sql = " SELECT COUNT(*) AS attempts FROM loginlogsnew WHERE user_email = '$user' ";
            $attempt_statement = mysqli_query($db, $attempt_sql)or die(mysqli_error());
            $attempts_result = mysqli_fetch_assoc($attempt_statement);
            $attempts = $attempts_result["attempts"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $row["user_email"];
            $sub_array[] = $attempts;
            $sub_array[] = $row["attempt_date"];
            $data[] = $sub_array;
            
        } 
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No to do list available";
            return $response; 
        }
        mysqli_close($db);
 
    }
    
    /**
     *  Sending user to do note to database
     */
    public function storeUserToDoNote($user_id, $userNote) {
        $db = $this->conn;
        $timezone = date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $created = $currentDate.' '.$currentTime;
        $key_size = 32; 
        $encryption_key = openssl_random_pseudo_bytes($key_size, $strong);
        $iv_size = 16;
        $iv = openssl_random_pseudo_bytes($iv_size, $strong);
        $iv64 = base64_encode($iv);
        $key64 = base64_encode($encryption_key);
        $encryptedText = openssl_encrypt($this->pkcs7_pad($userNote, 16), 'AES-256-CBC', $encryption_key, 0, $iv);
        $encryptedDoctorNote = base64_encode($encryptedText);

        $sql = "INSERT INTO bd_todo_list (user_id, todo_note, note_enc, enc_key, created_at) VALUES ('$user_id', '$encryptedDoctorNote', '$iv64', '$key64', '$created' )";
        $statement = mysqli_query($db,$sql)or die(mysqli_error());

        if(!empty($statement)){
            //stored successfully
            $response = 200;
            echo $response;
        } else {
            // failed to store
            $response  = 500;
            echo $response;
        }
        mysqli_close($db);
 
    }

     /**
     * Encrypting doctor notes
     */
    public function pkcs7_pad($data, $size){
        $length = $size - strlen($data) % $size;
        return $data . str_repeat(chr($length), $length);
    }

    public function pkcs7_unpad($data){
        return substr($data, 0, -ord($data[strlen($data) - 1]));
    }

    public function hashSSHA($doctorNote) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($doctorNote . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     *  Delete user to do note from database
     */
    public function deleteUserToDoNote($noteId) {
        $db = $this->conn;
        $sql = "DELETE FROM bd_todo_list WHERE id = '$noteId' ";
        $statement = mysqli_query($db,$sql)or die(mysqli_error());

        if(!empty($statement)){
             //deleted successfully
             $response = 200;
             echo $response;
         } else {
             // failed to delete
             $response  = 500;
             echo $response;
         }
         mysqli_close($db);
 
    }

    /**
     * Getting all users
     */
    public function getUsers($userId){
        $db = $this->conn;
        $statement = " SELECT wp_ea_staff.id AS staff, wp_ea_staff.name, wp_ea_staff.email, wp_ea_staff.phone, wp_ea_staff.role, wp_ea_staff.facility_id, wp_users.last_login 
        FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email  OR wp_ea_staff.email = wp_users.user_login WHERE wp_ea_staff.user_type NOT IN('Demo') ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $facility_id = $row["facility_id"];
            $doctor_id = $row["staff"];
            if ($row["role"] == 'Sec') {
                $role = 'Front Office';
            } else if ($row["role"] == 'S.Admin') {
                $role = 'Super Admin';
            } else if ($row["role"] == 'Admin') {
                $role = 'Admin';
            } else {
                $role = $row["role"];
            }
            $query_facility = " SELECT wp_ea_staff.name AS facility FROM wp_ea_staff WHERE id = '$facility_id' ";
            $facility_result = mysqli_query($db, $query_facility)or die(mysqli_error());
            $facility = mysqli_fetch_assoc($facility_result);
            $user_facility = $facility["facility"];

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $row["email"];
            $sub_array[] = '<div class="actions">'.$row["phone"].'</div>';
            $sub_array[] = '<div class="actions">'.$role.'</div>';
            $sub_array[] = '<div class="actions"></div>';
            $sub_array[] = $user_facility;
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
 
    }

    /**
     * Getting all user accounts
     */
    public function getUserAccounts($userId){
        $db = $this->conn;
        $statement = " SELECT wp_ea_staff.id AS staff, wp_ea_staff.name, wp_ea_staff.email, wp_ea_staff.phone, wp_ea_staff.facility_id
        FROM wp_ea_staff WHERE wp_ea_staff.id = wp_ea_staff.facility_id AND wp_ea_staff.user_type NOT IN('Demo') ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $facility_id = $row["facility_id"];
            $doctor_id = $row["staff"];
            
            $query_facility = " SELECT wp_ea_staff.name AS facility FROM wp_ea_staff WHERE id = '$facility_id' ";
            $facility_result = mysqli_query($db, $query_facility)or die(mysqli_error());
            $facility = mysqli_fetch_assoc($facility_result);
            $user_facility = $facility["facility"];
            
            $query_facility_users = " SELECT COUNT(*) AS facility_users FROM wp_ea_staff WHERE facility_id = '$facility_id' ";
            $users_result = mysqli_query($db, $query_facility_users)or die(mysqli_error());
            $facility_users = mysqli_fetch_assoc($users_result);
            $users_num = $facility_users["facility_users"];

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
            
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $row["email"];
            $sub_array[] = '<div class="actions">'.$row["phone"].'</div>';
            $sub_array[] = '<div class="actions">'.preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $doctorSpeciality).'</div>';
            $sub_array[] = '<div class="actions">'.preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $user_facility).'</div>';
            $sub_array[] = '<div class="actions">'.$users_num.'</div>';
            $sub_array[] = '<div class="actions"><span style="cursor:pointer;" class="view_users label label-sm gray-bgcolor" id="'.$doctor_id.'" ><i class="fa fa-eye"></i> View Users</span></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
 
    }

    /**
     * Getting all facility users
     */
    public function getFacilityUsers($userId){
        $db = $this->conn;
        $statement = " SELECT wp_ea_staff.name, wp_ea_staff.role FROM wp_ea_staff WHERE wp_ea_staff.facility_id = '$userId' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            if ($row["role"] == 'Sec') {
                $role = 'Front Office';
            } else if ($row["role"] == 'S.Admin') {
                $role = 'Super Admin';
            } else if ($row["role"] == 'Admin') {
                $role = 'Admin';
            } else {
                $role = $row["role"];
            }
            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $role;
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
 
    }

    /**
     * Getting Count users
     */
    public function countUsers() {
        $db = $this->conn;
        $telemed_sql = " SELECT COUNT(*) AS users FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email OR wp_ea_staff.email = wp_users.user_login WHERE wp_ea_staff.user_type NOT IN ('Demo') ";
        $telemed_statement = mysqli_query($db, $telemed_sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($telemed_statement)) {
            $sub_array = array();
            $sub_array['users'] = $row["users"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Count user accounts
     */
    public function countUserAccount() {
        $db = $this->conn;
        $telemed_sql = " SELECT COUNT(*) AS users FROM wp_ea_staff WHERE wp_ea_staff.id = wp_ea_staff.facility_id AND wp_ea_staff.user_type NOT IN ('Demo') ";
        $telemed_statement = mysqli_query($db, $telemed_sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($telemed_statement)) {
            $sub_array = array();
            $sub_array['users'] = $row["users"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * count filtered users
     */
    public function countFilteredUsers($userId, $speciality, $selected_doctor, $selected_country, $doctor, $super_admin, $admin, $marketing, $pharmacy, $front_office, $diagnostics){
        $db = $this->conn;
        $statement = " SELECT COUNT(*) AS users FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE (wp_ea_locations.location = '$selected_country' OR wp_ea_staff.id = '$selected_doctor' OR wp_ea_staff.role = '$super_admin' OR wp_ea_staff.role = '$admin' OR wp_ea_staff.role = '$doctor' OR wp_ea_staff.role = '$pharmacy' OR wp_ea_staff.role = '$marketing' OR wp_ea_staff.role = '$diagnostics' OR wp_ea_staff.role = '$front_office') ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['users'] = $row["users"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
 
    }

    /**
     * count filtered user accounts
     */
    public function getFilteredUserAccountsCount($userId, $active, $inactive, $demo, $doctor, $super_admin, $admin, $marketing, $pharmacy, $front_office, $diagnostics){
        $db = $this->conn;
        $statement = " SELECT COUNT(*) AS users FROM wp_ea_staff WHERE wp_ea_staff.role = '$super_admin' 
                OR wp_ea_staff.role = '$admin' OR wp_ea_staff.role = '$doctor' OR wp_ea_staff.role = '$pharmacy' OR wp_ea_staff.role = '$marketing' OR wp_ea_staff.role = '$diagnostics' OR wp_ea_staff.role = '$front_office' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['users'] = $row["users"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
 
    }
    
    /**
     * Getting filtered users
     */
    public function getFilteredUsers($userId, $speciality, $selected_doctor, $selected_country, $doctor, $super_admin, $admin, $marketing, $pharmacy, $front_office, $diagnostics){
        $db = $this->conn;
        $statement = " SELECT wp_ea_staff.id, wp_ea_staff.name, wp_ea_staff.email, wp_ea_staff.phone, wp_ea_staff.role, wp_ea_staff.facility_id, wp_users.last_login 
        FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE (wp_ea_locations.location = '$selected_country' OR wp_ea_staff.id = '$selected_doctor' OR wp_ea_staff.role = '$super_admin' OR wp_ea_staff.role = '$admin' OR wp_ea_staff.role = '$doctor' OR wp_ea_staff.role = '$pharmacy' OR wp_ea_staff.role = '$marketing' OR wp_ea_staff.role = '$diagnostics' OR wp_ea_staff.role = '$front_office') ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $facility_id = $row["facility_id"];
            $doctor_id = $row["id"];
            if ($row["role"] == 'Sec') {
                $role = 'Front Office';
            } else if ($row["role"] == 'S.Admin') {
                $role = 'Super Admin';
            } else if ($row["role"] == 'Admin') {
                $role = 'Admin';
            } else {
                $role = $row["role"];
            }
            $query_facility = " SELECT wp_ea_staff.name AS facility FROM wp_ea_staff WHERE id = '$facility_id' ";
            $facility_result = mysqli_query($db, $query_facility)or die(mysqli_error());
            $facility = mysqli_fetch_assoc($facility_result);
            $user_facility = $facility["facility"];

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $row["email"];
            $sub_array[] = '<div class="actions">'.$row["phone"].'</div>';
            $sub_array[] = '<div class="actions">'.$role.'</div>';
            $sub_array[] = '<div class="actions">'.$doctorSpeciality.'</div>';
            $sub_array[] = $user_facility;
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
 
    }

    /**
     * Getting filtered user accounts
     */
    public function getFilteredUserAccounts($userId, $active, $inactive, $demo, $doctor, $super_admin, $admin, $marketing, $pharmacy, $front_office, $diagnostics){
        $db = $this->conn;
        $statement = " SELECT wp_ea_staff.id, wp_ea_staff.name, wp_ea_staff.email, wp_ea_staff.phone, wp_ea_staff.facility_id
                    FROM wp_ea_staff WHERE wp_ea_staff.role = '$super_admin' OR wp_ea_staff.role = '$admin' OR wp_ea_staff.role = '$doctor' OR wp_ea_staff.role = '$pharmacy' 
                    OR wp_ea_staff.role = '$marketing' OR wp_ea_staff.role = '$diagnostics' OR wp_ea_staff.role = '$front_office' OR wp_ea_staff.user_type = '$active' OR wp_ea_staff.user_type = '$inactive' OR wp_ea_staff.user_type = '$demo' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $facility_id = $row["facility_id"];
            $doctor_id = $row["id"];
            $query_facility = " SELECT wp_ea_staff.name AS facility FROM wp_ea_staff WHERE id = '$facility_id' ";
            $facility_result = mysqli_query($db, $query_facility)or die(mysqli_error());
            $facility = mysqli_fetch_assoc($facility_result);
            $user_facility = $facility["facility"];

            $query_facility_users = " SELECT COUNT(*) AS facility_users FROM wp_ea_staff WHERE facility_id = '$facility_id' ";
            $users_result = mysqli_query($db, $query_facility_users)or die(mysqli_error());
            $facility_users = mysqli_fetch_assoc($users_result);
            $users_num = $facility_users["facility_users"];

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $row["email"];
            $sub_array[] = '<div class="actions">'.$row["phone"].'</div>';
            $sub_array[] = '<div class="actions">'.preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $doctorSpeciality).'</div>';
            $sub_array[] = '<div class="actions">'.preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $user_facility).'</div>';
            $sub_array[] = '<div class="actions">'.$users_num.'</div>';
            $sub_array[] = '<div class="actions"><span style="cursor:pointer;" class="view_users label label-sm gray-bgcolor" id="'.$doctor_id.'" ><i class="fa fa-eye"></i> View Users</span></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
 
    }

    /**
     * Getting features
     */
    public function getFeatures($userId){
        $db = $this->conn;
        $statement = " SELECT  ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_users.last_login) AS last_login, ANY_VALUE(activity_log.action_flag) AS action_flag, ANY_VALUE(activity_log.module_feature) AS module_feature, ANY_VALUE(activity_log.action) AS action FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id WHERE activity_log.category = 'Feature' GROUP BY wp_ea_staff.id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $user_id = $row["id"];
            $flag = $row["module_feature"];
            $action = $row["action"];
            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$user_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $query_times = " SELECT COUNT(*) AS no_of_times FROM activity_log WHERE user_id = '$user_id' AND activity_log.category = 'Feature' AND activity_log.module_feature = '$flag' AND activity_log.action = '$action'";
            $no_of_times_result = mysqli_query($db, $query_times)or die(mysqli_error());
            $times = mysqli_fetch_assoc($no_of_times_result);
            $no_of_times = $times["no_of_times"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = '<div class="actions">'.$row["module_feature"].'</div>';
            $sub_array[] = '<div class="actions">'.$row["action"].'</div>';
            $sub_array[] = '<div class="actions">'.$no_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Getting filytered features by date range features
     */
    public function getFilteredFeaturesByDateRange($start_dateval, $end_dateval){
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_users.last_login) AS last_login, ANY_VALUE(activity_log.action_flag) AS action_flag, ANY_VALUE(activity_log.action) AS action FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id WHERE activity_log.category = 'Feature' AND action_date >= '$start_dateval' AND action_date <= '$end_dateval' GROUP BY  activity_log.action ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $user_id = $row["id"];
            $flag = $row["action_flag"];
            $action = $row["action"];
            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$user_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $query_times = " SELECT COUNT(*) AS no_of_times FROM activity_log WHERE user_id = '$user_id' AND activity_log.category = 'Feature' AND activity_log.action_flag = '$flag' AND activity_log.action = '$action'";
            $no_of_times_result = mysqli_query($db, $query_times)or die(mysqli_error());
            $times = mysqli_fetch_assoc($no_of_times_result);
            $no_of_times = $times["no_of_times"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $row["action_flag"];
            $sub_array[] = '<div class="actions">'.$row["action"].'</div>';
            $sub_array[] = '<div class="actions">'.$no_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
    * Getting filtered features
    */
    public function getFilteredFeatures($userId, $start_date, $end_date, $doctor, $country, $feature){
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_users.last_login) AS last_login, ANY_VALUE(activity_log.action_flag) AS action_flag, ANY_VALUE(activity_log.action) AS action FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE activity_log.category = 'Feature' AND DATE(activity_log.action_date) >= '$start_date' AND DATE(activity_log.action_date) <= '$end_date' AND (activity_log.action_flag = '$feature' OR activity_log.user_id = '$doctor' OR wp_ea_locations.location = '$country')
        GROUP BY activity_log.action ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $user_id = $row["id"];
            $flag = $row["action_flag"];
            $action = $row["action"];
            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$user_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $query_times = " SELECT COUNT(*) AS no_of_times FROM activity_log WHERE user_id = '$user_id' AND activity_log.category = 'Feature' AND activity_log.action_flag = '$flag' AND activity_log.action = '$action' ";
            $no_of_times_result = mysqli_query($db, $query_times)or die(mysqli_error());
            $times = mysqli_fetch_assoc($no_of_times_result);
            $no_of_times = $times["no_of_times"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $row["action_flag"];
            $sub_array[] = '<div class="actions">'.$row["action"].'</div>';
            $sub_array[] = '<div class="actions">'.$no_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Getting module stats
     */
    public function getModules(){
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.dr_post_id) AS dr_post_id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_users.last_login) AS last_login FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id GROUP BY wp_ea_staff.id ORDER BY wp_ea_staff.id ASC";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["id"];
            $dr_post_id = $row["dr_post_id"];
            $module_query = " SELECT action_flag FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Module' ";
            $module_statement = mysqli_query($db, $module_query)or die(mysqli_error());
            $module_action_flag = mysqli_fetch_assoc($module_statement);
            $module_action_f = $module_action_flag["action_flag"];

            if ($module_action_f != '' && $module_action_f == 'Appointments') {
                $appts_query = " SELECT COUNT(*) AS 'total_appts', (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location = 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS telemed, 
                (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location != 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS inperson
                FROM wp_ea_appointments WHERE facility_id = '$doctor_id' ";
                $appts_statement = mysqli_query($db,$appts_query)or die(mysqli_error());
                $appts_result = mysqli_fetch_array($appts_statement);
                $appts = ' - '.$appts_result["total_appts"].' appointments';
                $telemed_appts = $appts_result["telemed"].' telemedicine';
                $inperson_appts = $appts_result["inperson"].' in-person';
                $status = '<span style="font-weight:400 !important;">'.$appts.'</span>';
                $telemed_status = '<span style="font-weight:700 !important;">'.$telemed_appts.'</span>';
                $inperson_status = '<span style="font-weight:700 !important;">'.$inperson_appts.'</span>';
                $bd_module = $module_action_f;
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$inperson_status.' / '.$telemed_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$inperson_status.'</p>
                                    <p class="module-info-box-text">'.$telemed_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Chat') {
                $chat_query = " SELECT COUNT(*) AS 'total_chats' FROM chat WHERE doctor_id = '$doctor_id' ";
                $chat_statement = mysqli_query($db,$chat_query)or die(mysqli_error());
                $chat_result = mysqli_fetch_array($chat_statement);
                $chats = $chat_result["total_chats"].' chats';
                $status = '<span style="font-weight:700 !important;">'.$chats.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Records') {
                $patinets_query = " SELECT COUNT(*) AS 'total_patients' FROM wp_ea_fields INNER JOIN wp_ea_appointments ON wp_ea_fields.app_id = wp_ea_appointments.id 
                WHERE wp_ea_appointments.facility_id = '$doctor_id' AND wp_ea_fields.field_id = 1 GROUP BY wp_ea_fields.value ";
                $patients_statement = mysqli_query($db,$patinets_query)or die(mysqli_error());
                $patients_result = mysqli_fetch_array($patients_statement);
                $patients = $patients_result["total_patients"].' patients';
                $patients_status = '<span style="font-weight:700 !important;">'.$patients.'</span>';

                $presc_query = " SELECT COUNT(*) AS 'total_presc' FROM case_prescription 
                WHERE case_prescription.doctor_id = '$dr_post_id' GROUP BY case_prescription.prescription_no ";
                $presc_statement = mysqli_query($db,$presc_query)or die(mysqli_error());
                $presc_result = mysqli_fetch_array($presc_statement);
                $prescs = $presc_result["total_presc"].' e-prescriptions';
                $presc_status = '<span style="font-weight:700 !important;">'.$prescs.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$patients_status.' / '.$presc_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$patients_status.'</p>
                                    <p class="module-info-box-text">'.$presc_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Referral Network') {
                $network_sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
                (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
                WHERE accepted = 'Accepted' AND status = '' AND network_id = '$dr_post_id' ";
                $network_statement = mysqli_query($db,$network_sql)or die(mysqli_error());
                $network_result = mysqli_fetch_array($network_statement);
                $total_networks = number_format($network_result["total_networks"]).' total networks';
                $total_groups = number_format($network_result["groups"]).' groups';
                $total_individual = number_format($network_result["individual"]).' networks';

                $chats_sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
                WHERE  wp_ea_staff.id = '$doctor_id' AND chat_type = 'refaral' ";
                $chats_statement = mysqli_query($db,$chats_sql)or die(mysqli_error());
                $chats_result = mysqli_fetch_array($chats_statement);
                $chats = number_format($chats_result["total_chats"]).' referral chats';
                $networks_status = '<span style="font-weight:700 !important;">'.$total_networks.'</span>';
                $groups_status = '<span style="font-weight:700 !important;">'.$total_groups.'</span>';
                $individual_status = '<span style="font-weight:700 !important;">'.$total_individual.'</span>';
                $chats_status = '<span style="font-weight:700 !important;">'.$chats.'</span>';

                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$networks_status.' /'.$groups_status. '/'.$individual_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$groups_status.'</p>
                                    <p class="module-info-box-text">'.$individual_status.'</p>
                                    <p class="module-info-box-text">'.$chats_status.'</p>
                            </div></div>';

            } else $bd_module = $module_action_f;

            $query_modules = " SELECT COUNT(*) AS module_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $moduleno_of_times_result = mysqli_query($db, $query_modules)or die(mysqli_error());
            $module_times = mysqli_fetch_assoc($moduleno_of_times_result);
            if ($module_times["module_no_of_times"] != 0) {
                $moduleno_of_times = $module_times["module_no_of_times"];
            } else $moduleno_of_times = '';
            
            $query_m_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $module_action_statement = mysqli_query($db, $query_m_action)or die(mysqli_error());
            $module_action_result = mysqli_fetch_assoc($module_action_statement);
            $module_action = $module_action_result["action"];

            $feature_query = " SELECT module_feature FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Feature' ";
            $feature_statement = mysqli_query($db, $feature_query)or die(mysqli_error());
            $feature_action_flag = mysqli_fetch_assoc($feature_statement);
            $feature_action_f = $feature_action_flag["module_feature"];

            $query_feature = " SELECT COUNT(*) AS feature_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $featureno_of_times_result = mysqli_query($db, $query_feature)or die(mysqli_error());
            $feature_times = mysqli_fetch_assoc($featureno_of_times_result);
            if ($feature_times["feature_no_of_times"] != 0) {
                $featureno_of_times = $feature_times["feature_no_of_times"];
            } else $featureno_of_times = '';

            $query_f_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $feature_action_statement = mysqli_query($db, $query_f_action)or die(mysqli_error());
            $feature_action_result = mysqli_fetch_assoc($feature_action_statement);
            $feature_action = $feature_action_result["action"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$dr_post_id' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $bd_module;
            $sub_array[] = '<div class="actions">'.$moduleno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$module_action.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action_f.'</div>';
            $sub_array[] = '<div class="actions">'.$featureno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
    * Getting filtered modules by country, doctor and module
    */
    public function getFilteredModulesByDoctorModuleAndCountry($start_date, $end_date, $doctor, $country, $module) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_staff.dr_post_id) AS dr_post_id, ANY_VALUE(wp_users.last_login) AS last_login FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND activity_log.action_flag = '$module' AND activity_log.user_id = '$doctor' AND DATE(activity_log.action_date) >= '$start_date' AND DATE(activity_log.action_date) <= '$end_date'
        GROUP BY  activity_log.action_flag ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["id"];
            $dr_post_id = $row["dr_post_id"];
            $module_query = " SELECT action_flag FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Module' ";
            $module_statement = mysqli_query($db, $module_query)or die(mysqli_error());
            $module_action_flag = mysqli_fetch_assoc($module_statement);
            $module_action_f = $module_action_flag["action_flag"];

            if ($module_action_f != '' && $module_action_f == 'Appointments') {
                $appts_query = " SELECT COUNT(*) AS 'total_appts', (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location = 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS telemed, 
                (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location != 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS inperson
                FROM wp_ea_appointments WHERE facility_id = '$doctor_id' ";
                $appts_statement = mysqli_query($db,$appts_query)or die(mysqli_error());
                $appts_result = mysqli_fetch_array($appts_statement);
                $appts = ' - '.$appts_result["total_appts"].' appointments';
                $telemed_appts = $appts_result["telemed"].' telemedicine';
                $inperson_appts = $appts_result["inperson"].' in-person';
                $status = '<span style="font-weight:400 !important;">'.$appts.'</span>';
                $telemed_status = '<span style="font-weight:700 !important;">'.$telemed_appts.'</span>';
                $inperson_status = '<span style="font-weight:700 !important;">'.$inperson_appts.'</span>';
                $bd_module = $module_action_f;
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$inperson_status.' / '.$telemed_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$inperson_status.'</p>
                                    <p class="module-info-box-text">'.$telemed_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Chat') {
                $chat_query = " SELECT COUNT(*) AS 'total_chats' FROM chat WHERE doctor_id = '$doctor_id' ";
                $chat_statement = mysqli_query($db,$chat_query)or die(mysqli_error());
                $chat_result = mysqli_fetch_array($chat_statement);
                $chats = $chat_result["total_chats"].' chats';
                $status = '<span style="font-weight:700 !important;">'.$chats.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Records') {
                $patinets_query = " SELECT COUNT(*) AS 'total_patients' FROM wp_ea_fields INNER JOIN wp_ea_appointments ON wp_ea_fields.app_id = wp_ea_appointments.id 
                WHERE wp_ea_appointments.facility_id = '$doctor_id' AND wp_ea_fields.field_id = 1 GROUP BY wp_ea_fields.value ";
                $patients_statement = mysqli_query($db,$patinets_query)or die(mysqli_error());
                $patients_result = mysqli_fetch_array($patients_statement);
                $patients = $patients_result["total_patients"].' patients';
                $patients_status = '<span style="font-weight:700 !important;">'.$patients.'</span>';

                $presc_query = " SELECT COUNT(*) AS 'total_presc' FROM case_prescription 
                WHERE case_prescription.doctor_id = '$dr_post_id' GROUP BY case_prescription.prescription_no ";
                $presc_statement = mysqli_query($db,$presc_query)or die(mysqli_error());
                $presc_result = mysqli_fetch_array($presc_statement);
                $prescs = $presc_result["total_presc"].' e-prescriptions';
                $presc_status = '<span style="font-weight:700 !important;">'.$prescs.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$patients_status.' / '.$presc_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$patients_status.'</p>
                                    <p class="module-info-box-text">'.$presc_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Referral Network') {
                $network_sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
                (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
                WHERE accepted = 'Accepted' AND status = '' AND network_id = '$dr_post_id' ";
                $network_statement = mysqli_query($db,$network_sql)or die(mysqli_error());
                $network_result = mysqli_fetch_array($network_statement);
                $total_networks = number_format($network_result["total_networks"]).' total networks';
                $total_groups = number_format($network_result["groups"]).' groups';
                $total_individual = number_format($network_result["individual"]).' networks';

                $chats_sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
                WHERE  wp_ea_staff.id = '$doctor_id' AND chat_type = 'refaral' ";
                $chats_statement = mysqli_query($db,$chats_sql)or die(mysqli_error());
                $chats_result = mysqli_fetch_array($chats_statement);
                $chats = number_format($chats_result["total_chats"]).' referral chats';
                $networks_status = '<span style="font-weight:700 !important;">'.$total_networks.'</span>';
                $groups_status = '<span style="font-weight:700 !important;">'.$total_groups.'</span>';
                $individual_status = '<span style="font-weight:700 !important;">'.$total_individual.'</span>';
                $chats_status = '<span style="font-weight:700 !important;">'.$chats.'</span>';

                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$networks_status.' /'.$groups_status. '/'.$individual_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$groups_status.'</p>
                                    <p class="module-info-box-text">'.$individual_status.'</p>
                                    <p class="module-info-box-text">'.$chats_status.'</p>
                            </div></div>';

            } else $bd_module = $module_action_f;

            $query_modules = " SELECT COUNT(*) AS module_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $moduleno_of_times_result = mysqli_query($db, $query_modules)or die(mysqli_error());
            $module_times = mysqli_fetch_assoc($moduleno_of_times_result);
            if ($module_times["module_no_of_times"] != 0) {
                $moduleno_of_times = $module_times["module_no_of_times"];
            } else $moduleno_of_times = '';
            
            $query_m_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $module_action_statement = mysqli_query($db, $query_m_action)or die(mysqli_error());
            $module_action_result = mysqli_fetch_assoc($module_action_statement);
            $module_action = $module_action_result["action"];

            $feature_query = " SELECT module_feature FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Feature' ";
            $feature_statement = mysqli_query($db, $feature_query)or die(mysqli_error());
            $feature_action_flag = mysqli_fetch_assoc($feature_statement);
            $feature_action_f = $feature_action_flag["module_feature"];

            $query_feature = " SELECT COUNT(*) AS feature_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $featureno_of_times_result = mysqli_query($db, $query_feature)or die(mysqli_error());
            $feature_times = mysqli_fetch_assoc($featureno_of_times_result);
            if ($feature_times["feature_no_of_times"] != 0) {
                $featureno_of_times = $feature_times["feature_no_of_times"];
            } else $featureno_of_times = '';

            $query_f_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $feature_action_statement = mysqli_query($db, $query_f_action)or die(mysqli_error());
            $feature_action_result = mysqli_fetch_assoc($feature_action_statement);
            $feature_action = $feature_action_result["action"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$dr_post_id' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $bd_module;
            $sub_array[] = '<div class="actions">'.$moduleno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$module_action.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action_f.'</div>';
            $sub_array[] = '<div class="actions">'.$featureno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

        /**
    * Getting filtered modules by country
    */
    public function getFilteredModulesByCountry($start_date, $end_date, $country) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_staff.dr_post_id) AS dr_post_id, ANY_VALUE(wp_users.last_login) AS last_login FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND DATE(activity_log.action_date) >= '$start_date' AND DATE(activity_log.action_date) <= '$end_date'
        GROUP BY  activity_log.action ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["id"];
            $dr_post_id = $row["dr_post_id"];
            $module_query = " SELECT action_flag FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Module' ";
            $module_statement = mysqli_query($db, $module_query)or die(mysqli_error());
            $module_action_flag = mysqli_fetch_assoc($module_statement);
            $module_action_f = $module_action_flag["action_flag"];

            if ($module_action_f != '' && $module_action_f == 'Appointments') {
                $appts_query = " SELECT COUNT(*) AS 'total_appts', (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location = 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS telemed, 
                (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location != 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS inperson
                FROM wp_ea_appointments WHERE facility_id = '$doctor_id' ";
                $appts_statement = mysqli_query($db,$appts_query)or die(mysqli_error());
                $appts_result = mysqli_fetch_array($appts_statement);
                $appts = ' - '.$appts_result["total_appts"].' appointments';
                $telemed_appts = $appts_result["telemed"].' telemedicine';
                $inperson_appts = $appts_result["inperson"].' in-person';
                $status = '<span style="font-weight:400 !important;">'.$appts.'</span>';
                $telemed_status = '<span style="font-weight:700 !important;">'.$telemed_appts.'</span>';
                $inperson_status = '<span style="font-weight:700 !important;">'.$inperson_appts.'</span>';
                $bd_module = $module_action_f;
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$inperson_status.' / '.$telemed_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$inperson_status.'</p>
                                    <p class="module-info-box-text">'.$telemed_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Chat') {
                $chat_query = " SELECT COUNT(*) AS 'total_chats' FROM chat WHERE doctor_id = '$doctor_id' ";
                $chat_statement = mysqli_query($db,$chat_query)or die(mysqli_error());
                $chat_result = mysqli_fetch_array($chat_statement);
                $chats = $chat_result["total_chats"].' chats';
                $status = '<span style="font-weight:700 !important;">'.$chats.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Records') {
                $patinets_query = " SELECT COUNT(*) AS 'total_patients' FROM wp_ea_fields INNER JOIN wp_ea_appointments ON wp_ea_fields.app_id = wp_ea_appointments.id 
                WHERE wp_ea_appointments.facility_id = '$doctor_id' AND wp_ea_fields.field_id = 1 GROUP BY wp_ea_fields.value ";
                $patients_statement = mysqli_query($db,$patinets_query)or die(mysqli_error());
                $patients_result = mysqli_fetch_array($patients_statement);
                $patients = $patients_result["total_patients"].' patients';
                $patients_status = '<span style="font-weight:700 !important;">'.$patients.'</span>';

                $presc_query = " SELECT COUNT(*) AS 'total_presc' FROM case_prescription 
                WHERE case_prescription.doctor_id = '$dr_post_id' GROUP BY case_prescription.prescription_no ";
                $presc_statement = mysqli_query($db,$presc_query)or die(mysqli_error());
                $presc_result = mysqli_fetch_array($presc_statement);
                $prescs = $presc_result["total_presc"].' e-prescriptions';
                $presc_status = '<span style="font-weight:700 !important;">'.$prescs.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$patients_status.' / '.$presc_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$patients_status.'</p>
                                    <p class="module-info-box-text">'.$presc_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Referral Network') {
                $network_sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
                (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
                WHERE accepted = 'Accepted' AND status = '' AND network_id = '$dr_post_id' ";
                $network_statement = mysqli_query($db,$network_sql)or die(mysqli_error());
                $network_result = mysqli_fetch_array($network_statement);
                $total_networks = number_format($network_result["total_networks"]).' total networks';
                $total_groups = number_format($network_result["groups"]).' groups';
                $total_individual = number_format($network_result["individual"]).' networks';

                $chats_sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
                WHERE  wp_ea_staff.id = '$doctor_id' AND chat_type = 'refaral' ";
                $chats_statement = mysqli_query($db,$chats_sql)or die(mysqli_error());
                $chats_result = mysqli_fetch_array($chats_statement);
                $chats = number_format($chats_result["total_chats"]).' referral chats';
                $networks_status = '<span style="font-weight:700 !important;">'.$total_networks.'</span>';
                $groups_status = '<span style="font-weight:700 !important;">'.$total_groups.'</span>';
                $individual_status = '<span style="font-weight:700 !important;">'.$total_individual.'</span>';
                $chats_status = '<span style="font-weight:700 !important;">'.$chats.'</span>';

                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$networks_status.' /'.$groups_status. '/'.$individual_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$groups_status.'</p>
                                    <p class="module-info-box-text">'.$individual_status.'</p>
                                    <p class="module-info-box-text">'.$chats_status.'</p>
                            </div></div>';

            } else $bd_module = $module_action_f;

            $query_modules = " SELECT COUNT(*) AS module_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $moduleno_of_times_result = mysqli_query($db, $query_modules)or die(mysqli_error());
            $module_times = mysqli_fetch_assoc($moduleno_of_times_result);
            if ($module_times["module_no_of_times"] != 0) {
                $moduleno_of_times = $module_times["module_no_of_times"];
            } else $moduleno_of_times = '';
            
            $query_m_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $module_action_statement = mysqli_query($db, $query_m_action)or die(mysqli_error());
            $module_action_result = mysqli_fetch_assoc($module_action_statement);
            $module_action = $module_action_result["action"];

            $feature_query = " SELECT module_feature FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Feature' ";
            $feature_statement = mysqli_query($db, $feature_query)or die(mysqli_error());
            $feature_action_flag = mysqli_fetch_assoc($feature_statement);
            $feature_action_f = $feature_action_flag["module_feature"];

            $query_feature = " SELECT COUNT(*) AS feature_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $featureno_of_times_result = mysqli_query($db, $query_feature)or die(mysqli_error());
            $feature_times = mysqli_fetch_assoc($featureno_of_times_result);
            if ($feature_times["feature_no_of_times"] != 0) {
                $featureno_of_times = $feature_times["feature_no_of_times"];
            } else $featureno_of_times = '';

            $query_f_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $feature_action_statement = mysqli_query($db, $query_f_action)or die(mysqli_error());
            $feature_action_result = mysqli_fetch_assoc($feature_action_statement);
            $feature_action = $feature_action_result["action"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$dr_post_id' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $bd_module;
            $sub_array[] = '<div class="actions">'.$moduleno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$module_action.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action_f.'</div>';
            $sub_array[] = '<div class="actions">'.$featureno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    /**
    * Getting filtered modules by doctor
    */
    public function getFilteredModulesByDoctor($start_date, $end_date, $doctor) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_staff.dr_post_id) AS dr_post_id, ANY_VALUE(wp_users.last_login) AS last_login FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE activity_log.user_id = '$doctor' AND DATE(activity_log.action_date) >= '$start_date' AND DATE(activity_log.action_date) <= '$end_date'
        GROUP BY activity_log.action_flag ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["id"];
            $dr_post_id = $row["dr_post_id"];
            $module_query = " SELECT action_flag FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Module' ";
            $module_statement = mysqli_query($db, $module_query)or die(mysqli_error());
            $module_action_flag = mysqli_fetch_assoc($module_statement);
            $module_action_f = $module_action_flag["action_flag"];

            if ($module_action_f != '' && $module_action_f == 'Appointments') {
                $appts_query = " SELECT COUNT(*) AS 'total_appts', (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location = 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS telemed, 
                (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location != 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS inperson
                FROM wp_ea_appointments WHERE facility_id = '$doctor_id' ";
                $appts_statement = mysqli_query($db,$appts_query)or die(mysqli_error());
                $appts_result = mysqli_fetch_array($appts_statement);
                $appts = ' - '.$appts_result["total_appts"].' appointments';
                $telemed_appts = $appts_result["telemed"].' telemedicine';
                $inperson_appts = $appts_result["inperson"].' in-person';
                $status = '<span style="font-weight:400 !important;">'.$appts.'</span>';
                $telemed_status = '<span style="font-weight:700 !important;">'.$telemed_appts.'</span>';
                $inperson_status = '<span style="font-weight:700 !important;">'.$inperson_appts.'</span>';
                $bd_module = $module_action_f;
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$inperson_status.' / '.$telemed_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$inperson_status.'</p>
                                    <p class="module-info-box-text">'.$telemed_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Chat') {
                $chat_query = " SELECT COUNT(*) AS 'total_chats' FROM chat WHERE doctor_id = '$doctor_id' ";
                $chat_statement = mysqli_query($db,$chat_query)or die(mysqli_error());
                $chat_result = mysqli_fetch_array($chat_statement);
                $chats = $chat_result["total_chats"].' chats';
                $status = '<span style="font-weight:700 !important;">'.$chats.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Records') {
                $patinets_query = " SELECT COUNT(*) AS 'total_patients' FROM wp_ea_fields INNER JOIN wp_ea_appointments ON wp_ea_fields.app_id = wp_ea_appointments.id 
                WHERE wp_ea_appointments.facility_id = '$doctor_id' AND wp_ea_fields.field_id = 1 GROUP BY wp_ea_fields.value ";
                $patients_statement = mysqli_query($db,$patinets_query)or die(mysqli_error());
                $patients_result = mysqli_fetch_array($patients_statement);
                $patients = $patients_result["total_patients"].' patients';
                $patients_status = '<span style="font-weight:700 !important;">'.$patients.'</span>';

                $presc_query = " SELECT COUNT(*) AS 'total_presc' FROM case_prescription 
                WHERE case_prescription.doctor_id = '$dr_post_id' GROUP BY case_prescription.prescription_no ";
                $presc_statement = mysqli_query($db,$presc_query)or die(mysqli_error());
                $presc_result = mysqli_fetch_array($presc_statement);
                $prescs = $presc_result["total_presc"].' e-prescriptions';
                $presc_status = '<span style="font-weight:700 !important;">'.$prescs.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$patients_status.' / '.$presc_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$patients_status.'</p>
                                    <p class="module-info-box-text">'.$presc_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Referral Network') {
                $network_sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
                (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
                WHERE accepted = 'Accepted' AND status = '' AND network_id = '$dr_post_id' ";
                $network_statement = mysqli_query($db,$network_sql)or die(mysqli_error());
                $network_result = mysqli_fetch_array($network_statement);
                $total_networks = number_format($network_result["total_networks"]).' total networks';
                $total_groups = number_format($network_result["groups"]).' groups';
                $total_individual = number_format($network_result["individual"]).' networks';

                $chats_sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
                WHERE  wp_ea_staff.id = '$doctor_id' AND chat_type = 'refaral' ";
                $chats_statement = mysqli_query($db,$chats_sql)or die(mysqli_error());
                $chats_result = mysqli_fetch_array($chats_statement);
                $chats = number_format($chats_result["total_chats"]).' referral chats';
                $networks_status = '<span style="font-weight:700 !important;">'.$total_networks.'</span>';
                $groups_status = '<span style="font-weight:700 !important;">'.$total_groups.'</span>';
                $individual_status = '<span style="font-weight:700 !important;">'.$total_individual.'</span>';
                $chats_status = '<span style="font-weight:700 !important;">'.$chats.'</span>';

                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$networks_status.' /'.$groups_status. '/'.$individual_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$groups_status.'</p>
                                    <p class="module-info-box-text">'.$individual_status.'</p>
                                    <p class="module-info-box-text">'.$chats_status.'</p>
                            </div></div>';

            } else $bd_module = $module_action_f;

            $query_modules = " SELECT COUNT(*) AS module_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $moduleno_of_times_result = mysqli_query($db, $query_modules)or die(mysqli_error());
            $module_times = mysqli_fetch_assoc($moduleno_of_times_result);
            if ($module_times["module_no_of_times"] != 0) {
                $moduleno_of_times = $module_times["module_no_of_times"];
            } else $moduleno_of_times = '';
            
            $query_m_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $module_action_statement = mysqli_query($db, $query_m_action)or die(mysqli_error());
            $module_action_result = mysqli_fetch_assoc($module_action_statement);
            $module_action = $module_action_result["action"];

            $feature_query = " SELECT module_feature FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Feature' ";
            $feature_statement = mysqli_query($db, $feature_query)or die(mysqli_error());
            $feature_action_flag = mysqli_fetch_assoc($feature_statement);
            $feature_action_f = $feature_action_flag["module_feature"];

            $query_feature = " SELECT COUNT(*) AS feature_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $featureno_of_times_result = mysqli_query($db, $query_feature)or die(mysqli_error());
            $feature_times = mysqli_fetch_assoc($featureno_of_times_result);
            if ($feature_times["feature_no_of_times"] != 0) {
                $featureno_of_times = $feature_times["feature_no_of_times"];
            } else $featureno_of_times = '';

            $query_f_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $feature_action_statement = mysqli_query($db, $query_f_action)or die(mysqli_error());
            $feature_action_result = mysqli_fetch_assoc($feature_action_statement);
            $feature_action = $feature_action_result["action"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$dr_post_id' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $bd_module;
            $sub_array[] = '<div class="actions">'.$moduleno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$module_action.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action_f.'</div>';
            $sub_array[] = '<div class="actions">'.$featureno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    /**
    * Getting filtered modules by doctor and country
    */
    public function getFilteredModulesByDoctorAndCountry($start_date, $end_date, $doctor, $country) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_staff.dr_post_id) AS dr_post_id, ANY_VALUE(wp_users.last_login) AS last_login FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND activity_log.user_id = '$doctor' AND DATE(activity_log.action_date) >= '$start_date' AND DATE(activity_log.action_date) <= '$end_date'
        GROUP BY  activity_log.action ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["id"];
            $dr_post_id = $row["dr_post_id"];
            $module_query = " SELECT action_flag FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Module' ";
            $module_statement = mysqli_query($db, $module_query)or die(mysqli_error());
            $module_action_flag = mysqli_fetch_assoc($module_statement);
            $module_action_f = $module_action_flag["action_flag"];

            if ($module_action_f != '' && $module_action_f == 'Appointments') {
                $appts_query = " SELECT COUNT(*) AS 'total_appts', (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location = 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS telemed, 
                (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location != 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS inperson
                FROM wp_ea_appointments WHERE facility_id = '$doctor_id' ";
                $appts_statement = mysqli_query($db,$appts_query)or die(mysqli_error());
                $appts_result = mysqli_fetch_array($appts_statement);
                $appts = ' - '.$appts_result["total_appts"].' appointments';
                $telemed_appts = $appts_result["telemed"].' telemedicine';
                $inperson_appts = $appts_result["inperson"].' in-person';
                $status = '<span style="font-weight:400 !important;">'.$appts.'</span>';
                $telemed_status = '<span style="font-weight:700 !important;">'.$telemed_appts.'</span>';
                $inperson_status = '<span style="font-weight:700 !important;">'.$inperson_appts.'</span>';
                $bd_module = $module_action_f;
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$inperson_status.' / '.$telemed_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$inperson_status.'</p>
                                    <p class="module-info-box-text">'.$telemed_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Chat') {
                $chat_query = " SELECT COUNT(*) AS 'total_chats' FROM chat WHERE doctor_id = '$doctor_id' ";
                $chat_statement = mysqli_query($db,$chat_query)or die(mysqli_error());
                $chat_result = mysqli_fetch_array($chat_statement);
                $chats = $chat_result["total_chats"].' chats';
                $status = '<span style="font-weight:700 !important;">'.$chats.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Records') {
                $patinets_query = " SELECT COUNT(*) AS 'total_patients' FROM wp_ea_fields INNER JOIN wp_ea_appointments ON wp_ea_fields.app_id = wp_ea_appointments.id 
                WHERE wp_ea_appointments.facility_id = '$doctor_id' AND wp_ea_fields.field_id = 1 GROUP BY wp_ea_fields.value ";
                $patients_statement = mysqli_query($db,$patinets_query)or die(mysqli_error());
                $patients_result = mysqli_fetch_array($patients_statement);
                $patients = $patients_result["total_patients"].' patients';
                $patients_status = '<span style="font-weight:700 !important;">'.$patients.'</span>';

                $presc_query = " SELECT COUNT(*) AS 'total_presc' FROM case_prescription 
                WHERE case_prescription.doctor_id = '$dr_post_id' GROUP BY case_prescription.prescription_no ";
                $presc_statement = mysqli_query($db,$presc_query)or die(mysqli_error());
                $presc_result = mysqli_fetch_array($presc_statement);
                $prescs = $presc_result["total_presc"].' e-prescriptions';
                $presc_status = '<span style="font-weight:700 !important;">'.$prescs.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$patients_status.' / '.$presc_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$patients_status.'</p>
                                    <p class="module-info-box-text">'.$presc_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Referral Network') {
                $network_sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
                (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
                WHERE accepted = 'Accepted' AND status = '' AND network_id = '$dr_post_id' ";
                $network_statement = mysqli_query($db,$network_sql)or die(mysqli_error());
                $network_result = mysqli_fetch_array($network_statement);
                $total_networks = number_format($network_result["total_networks"]).' total networks';
                $total_groups = number_format($network_result["groups"]).' groups';
                $total_individual = number_format($network_result["individual"]).' networks';

                $chats_sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
                WHERE  wp_ea_staff.id = '$doctor_id' AND chat_type = 'refaral' ";
                $chats_statement = mysqli_query($db,$chats_sql)or die(mysqli_error());
                $chats_result = mysqli_fetch_array($chats_statement);
                $chats = number_format($chats_result["total_chats"]).' referral chats';
                $networks_status = '<span style="font-weight:700 !important;">'.$total_networks.'</span>';
                $groups_status = '<span style="font-weight:700 !important;">'.$total_groups.'</span>';
                $individual_status = '<span style="font-weight:700 !important;">'.$total_individual.'</span>';
                $chats_status = '<span style="font-weight:700 !important;">'.$chats.'</span>';

                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$networks_status.' /'.$groups_status. '/'.$individual_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$groups_status.'</p>
                                    <p class="module-info-box-text">'.$individual_status.'</p>
                                    <p class="module-info-box-text">'.$chats_status.'</p>
                            </div></div>';

            } else $bd_module = $module_action_f;

            $query_modules = " SELECT COUNT(*) AS module_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $moduleno_of_times_result = mysqli_query($db, $query_modules)or die(mysqli_error());
            $module_times = mysqli_fetch_assoc($moduleno_of_times_result);
            if ($module_times["module_no_of_times"] != 0) {
                $moduleno_of_times = $module_times["module_no_of_times"];
            } else $moduleno_of_times = '';
            
            $query_m_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $module_action_statement = mysqli_query($db, $query_m_action)or die(mysqli_error());
            $module_action_result = mysqli_fetch_assoc($module_action_statement);
            $module_action = $module_action_result["action"];

            $feature_query = " SELECT module_feature FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Feature' ";
            $feature_statement = mysqli_query($db, $feature_query)or die(mysqli_error());
            $feature_action_flag = mysqli_fetch_assoc($feature_statement);
            $feature_action_f = $feature_action_flag["module_feature"];

            $query_feature = " SELECT COUNT(*) AS feature_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $featureno_of_times_result = mysqli_query($db, $query_feature)or die(mysqli_error());
            $feature_times = mysqli_fetch_assoc($featureno_of_times_result);
            if ($feature_times["feature_no_of_times"] != 0) {
                $featureno_of_times = $feature_times["feature_no_of_times"];
            } else $featureno_of_times = '';

            $query_f_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $feature_action_statement = mysqli_query($db, $query_f_action)or die(mysqli_error());
            $feature_action_result = mysqli_fetch_assoc($feature_action_statement);
            $feature_action = $feature_action_result["action"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$dr_post_id' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $bd_module;
            $sub_array[] = '<div class="actions">'.$moduleno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$module_action.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action_f.'</div>';
            $sub_array[] = '<div class="actions">'.$featureno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    /**
    * Getting filtered modules by doctor and module
    */
    public function getFilteredModulesByDoctorAndModule($start_date, $end_date, $doctor, $module) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_staff.dr_post_id) AS dr_post_id, ANY_VALUE(wp_users.last_login) AS last_login FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE activity_log.action_flag = '$module' AND activity_log.user_id = '$doctor' AND DATE(activity_log.action_date) >= '$start_date' AND DATE(activity_log.action_date) <= '$end_date'
        GROUP BY  activity_log.action ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["id"];
            $dr_post_id = $row["dr_post_id"];
            $module_query = " SELECT action_flag FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Module' ";
            $module_statement = mysqli_query($db, $module_query)or die(mysqli_error());
            $module_action_flag = mysqli_fetch_assoc($module_statement);
            $module_action_f = $module_action_flag["action_flag"];

            if ($module_action_f != '' && $module_action_f == 'Appointments') {
                $appts_query = " SELECT COUNT(*) AS 'total_appts', (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location = 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS telemed, 
                (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location != 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS inperson
                FROM wp_ea_appointments WHERE facility_id = '$doctor_id' ";
                $appts_statement = mysqli_query($db,$appts_query)or die(mysqli_error());
                $appts_result = mysqli_fetch_array($appts_statement);
                $appts = ' - '.$appts_result["total_appts"].' appointments';
                $telemed_appts = $appts_result["telemed"].' telemedicine';
                $inperson_appts = $appts_result["inperson"].' in-person';
                $status = '<span style="font-weight:400 !important;">'.$appts.'</span>';
                $telemed_status = '<span style="font-weight:700 !important;">'.$telemed_appts.'</span>';
                $inperson_status = '<span style="font-weight:700 !important;">'.$inperson_appts.'</span>';
                $bd_module = $module_action_f;
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$inperson_status.' / '.$telemed_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$inperson_status.'</p>
                                    <p class="module-info-box-text">'.$telemed_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Chat') {
                $chat_query = " SELECT COUNT(*) AS 'total_chats' FROM chat WHERE doctor_id = '$doctor_id' ";
                $chat_statement = mysqli_query($db,$chat_query)or die(mysqli_error());
                $chat_result = mysqli_fetch_array($chat_statement);
                $chats = $chat_result["total_chats"].' chats';
                $status = '<span style="font-weight:700 !important;">'.$chats.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Records') {
                $patinets_query = " SELECT COUNT(*) AS 'total_patients' FROM wp_ea_fields INNER JOIN wp_ea_appointments ON wp_ea_fields.app_id = wp_ea_appointments.id 
                WHERE wp_ea_appointments.facility_id = '$doctor_id' AND wp_ea_fields.field_id = 1 GROUP BY wp_ea_fields.value ";
                $patients_statement = mysqli_query($db,$patinets_query)or die(mysqli_error());
                $patients_result = mysqli_fetch_array($patients_statement);
                $patients = $patients_result["total_patients"].' patients';
                $patients_status = '<span style="font-weight:700 !important;">'.$patients.'</span>';

                $presc_query = " SELECT COUNT(*) AS 'total_presc' FROM case_prescription 
                WHERE case_prescription.doctor_id = '$dr_post_id' GROUP BY case_prescription.prescription_no ";
                $presc_statement = mysqli_query($db,$presc_query)or die(mysqli_error());
                $presc_result = mysqli_fetch_array($presc_statement);
                $prescs = $presc_result["total_presc"].' e-prescriptions';
                $presc_status = '<span style="font-weight:700 !important;">'.$prescs.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$patients_status.' / '.$presc_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$patients_status.'</p>
                                    <p class="module-info-box-text">'.$presc_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Referral Network') {
                $network_sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
                (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
                WHERE accepted = 'Accepted' AND status = '' AND network_id = '$dr_post_id' ";
                $network_statement = mysqli_query($db,$network_sql)or die(mysqli_error());
                $network_result = mysqli_fetch_array($network_statement);
                $total_networks = number_format($network_result["total_networks"]).' total networks';
                $total_groups = number_format($network_result["groups"]).' groups';
                $total_individual = number_format($network_result["individual"]).' networks';

                $chats_sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
                WHERE  wp_ea_staff.id = '$doctor_id' AND chat_type = 'refaral' ";
                $chats_statement = mysqli_query($db,$chats_sql)or die(mysqli_error());
                $chats_result = mysqli_fetch_array($chats_statement);
                $chats = number_format($chats_result["total_chats"]).' referral chats';
                $networks_status = '<span style="font-weight:700 !important;">'.$total_networks.'</span>';
                $groups_status = '<span style="font-weight:700 !important;">'.$total_groups.'</span>';
                $individual_status = '<span style="font-weight:700 !important;">'.$total_individual.'</span>';
                $chats_status = '<span style="font-weight:700 !important;">'.$chats.'</span>';

                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$networks_status.' /'.$groups_status. '/'.$individual_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$groups_status.'</p>
                                    <p class="module-info-box-text">'.$individual_status.'</p>
                                    <p class="module-info-box-text">'.$chats_status.'</p>
                            </div></div>';

            } else $bd_module = $module_action_f;

            $query_modules = " SELECT COUNT(*) AS module_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $moduleno_of_times_result = mysqli_query($db, $query_modules)or die(mysqli_error());
            $module_times = mysqli_fetch_assoc($moduleno_of_times_result);
            if ($module_times["module_no_of_times"] != 0) {
                $moduleno_of_times = $module_times["module_no_of_times"];
            } else $moduleno_of_times = '';
            
            $query_m_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $module_action_statement = mysqli_query($db, $query_m_action)or die(mysqli_error());
            $module_action_result = mysqli_fetch_assoc($module_action_statement);
            $module_action = $module_action_result["action"];

            $feature_query = " SELECT module_feature FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Feature' ";
            $feature_statement = mysqli_query($db, $feature_query)or die(mysqli_error());
            $feature_action_flag = mysqli_fetch_assoc($feature_statement);
            $feature_action_f = $feature_action_flag["module_feature"];

            $query_feature = " SELECT COUNT(*) AS feature_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $featureno_of_times_result = mysqli_query($db, $query_feature)or die(mysqli_error());
            $feature_times = mysqli_fetch_assoc($featureno_of_times_result);
            if ($feature_times["feature_no_of_times"] != 0) {
                $featureno_of_times = $feature_times["feature_no_of_times"];
            } else $featureno_of_times = '';

            $query_f_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $feature_action_statement = mysqli_query($db, $query_f_action)or die(mysqli_error());
            $feature_action_result = mysqli_fetch_assoc($feature_action_statement);
            $feature_action = $feature_action_result["action"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$dr_post_id' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $bd_module;
            $sub_array[] = '<div class="actions">'.$moduleno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$module_action.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action_f.'</div>';
            $sub_array[] = '<div class="actions">'.$featureno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    /**
    * Getting filtered modules by country and module
    */
    public function getFilteredModulesByCountryAndModule($start_date, $end_date, $country, $module) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_staff.dr_post_id) dr_post_id, ANY_VALUE(wp_users.last_login) AS last_login FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id INNER JOIN wp_ea_locations ON wp_ea_staff.facility_id = wp_ea_locations.facility_id WHERE wp_ea_locations.location = '$country' AND activity_log.action_flag = '$module' AND DATE(activity_log.action_date) >= '$start_date' AND DATE(activity_log.action_date) <= '$end_date'
        GROUP BY  activity_log.action ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["id"];
            $dr_post_id = $row["dr_post_id"];
            $module_query = " SELECT action_flag FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Module' ";
            $module_statement = mysqli_query($db, $module_query)or die(mysqli_error());
            $module_action_flag = mysqli_fetch_assoc($module_statement);
            $module_action_f = $module_action_flag["action_flag"];

            if ($module_action_f != '' && $module_action_f == 'Appointments') {
                $appts_query = " SELECT COUNT(*) AS 'total_appts', (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location = 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS telemed, 
                (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location != 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS inperson
                FROM wp_ea_appointments WHERE facility_id = '$doctor_id' ";
                $appts_statement = mysqli_query($db,$appts_query)or die(mysqli_error());
                $appts_result = mysqli_fetch_array($appts_statement);
                $appts = ' - '.$appts_result["total_appts"].' appointments';
                $telemed_appts = $appts_result["telemed"].' telemedicine';
                $inperson_appts = $appts_result["inperson"].' in-person';
                $status = '<span style="font-weight:400 !important;">'.$appts.'</span>';
                $telemed_status = '<span style="font-weight:700 !important;">'.$telemed_appts.'</span>';
                $inperson_status = '<span style="font-weight:700 !important;">'.$inperson_appts.'</span>';
                $bd_module = $module_action_f;
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$inperson_status.' / '.$telemed_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$inperson_status.'</p>
                                    <p class="module-info-box-text">'.$telemed_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Chat') {
                $chat_query = " SELECT COUNT(*) AS 'total_chats' FROM chat WHERE doctor_id = '$doctor_id' ";
                $chat_statement = mysqli_query($db,$chat_query)or die(mysqli_error());
                $chat_result = mysqli_fetch_array($chat_statement);
                $chats = $chat_result["total_chats"].' chats';
                $status = '<span style="font-weight:700 !important;">'.$chats.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Records') {
                $patinets_query = " SELECT COUNT(*) AS 'total_patients' FROM wp_ea_fields INNER JOIN wp_ea_appointments ON wp_ea_fields.app_id = wp_ea_appointments.id 
                WHERE wp_ea_appointments.facility_id = '$doctor_id' AND wp_ea_fields.field_id = 1 GROUP BY wp_ea_fields.value ";
                $patients_statement = mysqli_query($db,$patinets_query)or die(mysqli_error());
                $patients_result = mysqli_fetch_array($patients_statement);
                $patients = $patients_result["total_patients"].' patients';
                $patients_status = '<span style="font-weight:700 !important;">'.$patients.'</span>';

                $presc_query = " SELECT COUNT(*) AS 'total_presc' FROM case_prescription 
                WHERE case_prescription.doctor_id = '$dr_post_id' GROUP BY case_prescription.prescription_no ";
                $presc_statement = mysqli_query($db,$presc_query)or die(mysqli_error());
                $presc_result = mysqli_fetch_array($presc_statement);
                $prescs = $presc_result["total_presc"].' e-prescriptions';
                $presc_status = '<span style="font-weight:700 !important;">'.$prescs.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$patients_status.' / '.$presc_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$patients_status.'</p>
                                    <p class="module-info-box-text">'.$presc_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Referral Network') {
                $network_sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
                (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
                WHERE accepted = 'Accepted' AND status = '' AND network_id = '$dr_post_id' ";
                $network_statement = mysqli_query($db,$network_sql)or die(mysqli_error());
                $network_result = mysqli_fetch_array($network_statement);
                $total_networks = number_format($network_result["total_networks"]).' total networks';
                $total_groups = number_format($network_result["groups"]).' groups';
                $total_individual = number_format($network_result["individual"]).' networks';

                $chats_sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
                WHERE  wp_ea_staff.id = '$doctor_id' AND chat_type = 'refaral' ";
                $chats_statement = mysqli_query($db,$chats_sql)or die(mysqli_error());
                $chats_result = mysqli_fetch_array($chats_statement);
                $chats = number_format($chats_result["total_chats"]).' referral chats';
                $networks_status = '<span style="font-weight:700 !important;">'.$total_networks.'</span>';
                $groups_status = '<span style="font-weight:700 !important;">'.$total_groups.'</span>';
                $individual_status = '<span style="font-weight:700 !important;">'.$total_individual.'</span>';
                $chats_status = '<span style="font-weight:700 !important;">'.$chats.'</span>';

                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$networks_status.' /'.$groups_status. '/'.$individual_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$groups_status.'</p>
                                    <p class="module-info-box-text">'.$individual_status.'</p>
                                    <p class="module-info-box-text">'.$chats_status.'</p>
                            </div></div>';

            } else $bd_module = $module_action_f;

            $query_modules = " SELECT COUNT(*) AS module_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $moduleno_of_times_result = mysqli_query($db, $query_modules)or die(mysqli_error());
            $module_times = mysqli_fetch_assoc($moduleno_of_times_result);
            if ($module_times["module_no_of_times"] != 0) {
                $moduleno_of_times = $module_times["module_no_of_times"];
            } else $moduleno_of_times = '';
            
            $query_m_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $module_action_statement = mysqli_query($db, $query_m_action)or die(mysqli_error());
            $module_action_result = mysqli_fetch_assoc($module_action_statement);
            $module_action = $module_action_result["action"];

            $feature_query = " SELECT module_feature FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Feature' ";
            $feature_statement = mysqli_query($db, $feature_query)or die(mysqli_error());
            $feature_action_flag = mysqli_fetch_assoc($feature_statement);
            $feature_action_f = $feature_action_flag["module_feature"];

            $query_feature = " SELECT COUNT(*) AS feature_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $featureno_of_times_result = mysqli_query($db, $query_feature)or die(mysqli_error());
            $feature_times = mysqli_fetch_assoc($featureno_of_times_result);
            if ($feature_times["feature_no_of_times"] != 0) {
                $featureno_of_times = $feature_times["feature_no_of_times"];
            } else $featureno_of_times = '';

            $query_f_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $feature_action_statement = mysqli_query($db, $query_f_action)or die(mysqli_error());
            $feature_action_result = mysqli_fetch_assoc($feature_action_statement);
            $feature_action = $feature_action_result["action"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$dr_post_id' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $bd_module;
            $sub_array[] = '<div class="actions">'.$moduleno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$module_action.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action_f.'</div>';
            $sub_array[] = '<div class="actions">'.$featureno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
    * Getting filtered modules by date renge
    */
    public function getFilteredModulesByDateRange($start_dateval, $end_dateval){
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS id, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_staff.dr_post_id) AS dr_post_id, ANY_VALUE(wp_users.last_login) AS last_login FROM wp_ea_staff INNER JOIN wp_users ON wp_ea_staff.email = wp_users.user_email
        INNER JOIN activity_log ON wp_ea_staff.id = activity_log.user_id WHERE DATE(activity_log.action_date) >= '$start_dateval' AND DATE(activity_log.action_date) <= '$end_dateval' GROUP BY  activity_log.action ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["id"];
            $dr_post_id = $row["dr_post_id"];
            $module_query = " SELECT action_flag FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Module' ";
            $module_statement = mysqli_query($db, $module_query)or die(mysqli_error());
            $module_action_flag = mysqli_fetch_assoc($module_statement);
            $module_action_f = $module_action_flag["action_flag"];

            if ($module_action_f != '' && $module_action_f == 'Appointments') {
                $appts_query = " SELECT COUNT(*) AS 'total_appts', (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location = 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS telemed, 
                (SELECT COUNT(*) FROM wp_ea_appointments WHERE wp_ea_appointments.location != 130 AND facility_id = '$doctor_id' AND wp_ea_appointments.status NOT IN('canceled','abandoned')) AS inperson
                FROM wp_ea_appointments WHERE facility_id = '$doctor_id' ";
                $appts_statement = mysqli_query($db,$appts_query)or die(mysqli_error());
                $appts_result = mysqli_fetch_array($appts_statement);
                $appts = ' - '.$appts_result["total_appts"].' appointments';
                $telemed_appts = $appts_result["telemed"].' telemedicine';
                $inperson_appts = $appts_result["inperson"].' in-person';
                $status = '<span style="font-weight:400 !important;">'.$appts.'</span>';
                $telemed_status = '<span style="font-weight:700 !important;">'.$telemed_appts.'</span>';
                $inperson_status = '<span style="font-weight:700 !important;">'.$inperson_appts.'</span>';
                $bd_module = $module_action_f;
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$inperson_status.' / '.$telemed_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$inperson_status.'</p>
                                    <p class="module-info-box-text">'.$telemed_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Chat') {
                $chat_query = " SELECT COUNT(*) AS 'total_chats' FROM chat WHERE doctor_id = '$doctor_id' ";
                $chat_statement = mysqli_query($db,$chat_query)or die(mysqli_error());
                $chat_result = mysqli_fetch_array($chat_statement);
                $chats = $chat_result["total_chats"].' chats';
                $status = '<span style="font-weight:700 !important;">'.$chats.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Patient Records') {
                $patinets_query = " SELECT COUNT(*) AS 'total_patients' FROM wp_ea_fields INNER JOIN wp_ea_appointments ON wp_ea_fields.app_id = wp_ea_appointments.id 
                WHERE wp_ea_appointments.facility_id = '$doctor_id' AND wp_ea_fields.field_id = 1 GROUP BY wp_ea_fields.value ";
                $patients_statement = mysqli_query($db,$patinets_query)or die(mysqli_error());
                $patients_result = mysqli_fetch_array($patients_statement);
                $patients = $patients_result["total_patients"].' patients';
                $patients_status = '<span style="font-weight:700 !important;">'.$patients.'</span>';

                $presc_query = " SELECT COUNT(*) AS 'total_presc' FROM case_prescription 
                WHERE case_prescription.doctor_id = '$dr_post_id' GROUP BY case_prescription.prescription_no ";
                $presc_statement = mysqli_query($db,$presc_query)or die(mysqli_error());
                $presc_result = mysqli_fetch_array($presc_statement);
                $prescs = $presc_result["total_presc"].' e-prescriptions';
                $presc_status = '<span style="font-weight:700 !important;">'.$prescs.'</span>';
                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$patients_status.' / '.$presc_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$patients_status.'</p>
                                    <p class="module-info-box-text">'.$presc_status.'</p>
                            </div></div>';

            } else if($module_action_f != '' && $module_action_f == 'Referral Network') {
                $network_sql = " SELECT COUNT(*) AS total_networks, (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND category = 'Group' AND category != '' AND accepted = 'Accepted' AND status = '') AS groups, 
                (SELECT COUNT(*) FROM `doctors_network` WHERE network_id = '$dr_post_id' AND status = '' AND category != 'Group' AND category != '' AND accepted = 'Accepted') AS individual  FROM `doctors_network` 
                WHERE accepted = 'Accepted' AND status = '' AND network_id = '$dr_post_id' ";
                $network_statement = mysqli_query($db,$network_sql)or die(mysqli_error());
                $network_result = mysqli_fetch_array($network_statement);
                $total_networks = number_format($network_result["total_networks"]).' total networks';
                $total_groups = number_format($network_result["groups"]).' groups';
                $total_individual = number_format($network_result["individual"]).' networks';

                $chats_sql = " SELECT COUNT(*) AS 'total_chats' FROM chat_refaral INNER JOIN wp_ea_staff ON chat_refaral.msg_from = wp_ea_staff.dr_post_id 
                WHERE  wp_ea_staff.id = '$doctor_id' AND chat_type = 'refaral' ";
                $chats_statement = mysqli_query($db,$chats_sql)or die(mysqli_error());
                $chats_result = mysqli_fetch_array($chats_statement);
                $chats = number_format($chats_result["total_chats"]).' referral chats';
                $networks_status = '<span style="font-weight:700 !important;">'.$total_networks.'</span>';
                $groups_status = '<span style="font-weight:700 !important;">'.$total_groups.'</span>';
                $individual_status = '<span style="font-weight:700 !important;">'.$total_individual.'</span>';
                $chats_status = '<span style="font-weight:700 !important;">'.$chats.'</span>';

                $bd_module = '<div class="actions_popup">'.$module_action_f.' ('.$networks_status.' /'.$groups_status. '/'.$individual_status.')'.'
                                <div class="sub_appts">
                                    <p class="module-info-box-text">'.$groups_status.'</p>
                                    <p class="module-info-box-text">'.$individual_status.'</p>
                                    <p class="module-info-box-text">'.$chats_status.'</p>
                            </div></div>';

            } else $bd_module = $module_action_f;

            $query_modules = " SELECT COUNT(*) AS module_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $moduleno_of_times_result = mysqli_query($db, $query_modules)or die(mysqli_error());
            $module_times = mysqli_fetch_assoc($moduleno_of_times_result);
            if ($module_times["module_no_of_times"] != 0) {
                $moduleno_of_times = $module_times["module_no_of_times"];
            } else $moduleno_of_times = '';
            
            $query_m_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Module' AND action_flag = '$module_action_f' ";
            $module_action_statement = mysqli_query($db, $query_m_action)or die(mysqli_error());
            $module_action_result = mysqli_fetch_assoc($module_action_statement);
            $module_action = $module_action_result["action"];

            $feature_query = " SELECT module_feature FROM `activity_log` WHERE user_id = '$doctor_id' AND category = 'Feature' ";
            $feature_statement = mysqli_query($db, $feature_query)or die(mysqli_error());
            $feature_action_flag = mysqli_fetch_assoc($feature_statement);
            $feature_action_f = $feature_action_flag["module_feature"];

            $query_feature = " SELECT COUNT(*) AS feature_no_of_times FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $featureno_of_times_result = mysqli_query($db, $query_feature)or die(mysqli_error());
            $feature_times = mysqli_fetch_assoc($featureno_of_times_result);
            if ($feature_times["feature_no_of_times"] != 0) {
                $featureno_of_times = $feature_times["feature_no_of_times"];
            } else $featureno_of_times = '';

            $query_f_action = " SELECT activity_log.action FROM activity_log WHERE user_id = '$doctor_id' AND category = 'Feature' AND module_feature = '$feature_action_f' ";
            $feature_action_statement = mysqli_query($db, $query_f_action)or die(mysqli_error());
            $feature_action_result = mysqli_fetch_assoc($feature_action_statement);
            $feature_action = $feature_action_result["action"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$dr_post_id' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $bd_module;
            $sub_array[] = '<div class="actions">'.$moduleno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$module_action.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action_f.'</div>';
            $sub_array[] = '<div class="actions">'.$featureno_of_times.'</div>';
            $sub_array[] = '<div class="actions">'.$feature_action.'</div>';
            $sub_array[] = '<div class="actions">'.$row["last_login"].'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

   /**
    * Getting all appointments
    */
    public function getAppointments($userId){
        $db = $this->conn;
        date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $statement = " SELECT ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.facility_id) AS facility_id FROM wp_ea_appointments WHERE wp_ea_appointments.date >= '$currentDate'  AND YEAR(wp_ea_appointments.date) = YEAR('$currentDate') AND 
        MONTH(wp_ea_appointments.date) = MONTH('$currentDate') GROUP BY wp_ea_appointments.date ORDER BY wp_ea_appointments.date DESC ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $appt_date = $row["date"];
            $afacility_id = $row["facility_id"];

            $total_omp = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS reservation FROM wp_ea_appointments WHERE ip IS NULL AND session IS NULL AND wp_ea_appointments.date = '$appt_date' AND status NOT IN ('canceled', 'No Show', 'abandoned') "))["reservation"];
            $total_mha = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS mha_booking FROM wp_ea_appointments WHERE ip IS NOT NULL AND session IS NOT NULL AND status NOT IN ('pending_payment','abandoned') AND wp_ea_appointments.date = '$appt_date' "))["mha_booking"];
            // $total_complete = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS complete FROM wp_ea_appointments WHERE status = 'confirmed' AND wp_ea_appointments.date = '$appt_date' "))["complete"];
            $total_telemed = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS telemed FROM wp_ea_appointments WHERE location = 130 AND payment_status = 'Paid' AND wp_ea_appointments.date = '$appt_date' "))["telemed"];
            $total_inperson = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS inperson FROM wp_ea_appointments WHERE location != 130 AND status = 'pending' AND wp_ea_appointments.date = '$appt_date' "))["inperson"];
            $total_canceled = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS canceled FROM wp_ea_appointments WHERE status = 'canceled' AND wp_ea_appointments.date = '$appt_date' "))["canceled"];
            $total_noshow = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS noshow FROM wp_ea_appointments WHERE status = 'no show' AND wp_ea_appointments.date = '$appt_date' "))["noshow"];
            $totals_perday = $total_omp+$total_mha;

            $sub_array = array();
            $sub_array[] = date("Y-m-d", strtotime($row["date"]));
            $sub_array[] = '<div class="actions" style="font-weight:800;"><b>'.$total_omp.'</b></div>';
            $sub_array[] = '<div class="actions">'. '' .'</div>';
            $sub_array[] = '<div class="actions">'.$total_mha.'</div>';
            // $sub_array[] = '<div class="actions">'.$total_complete.'</div>';
            $sub_array[] = '<div class="actions">'.$total_inperson.'</div>';
            $sub_array[] = '<div class="actions">'.$total_telemed.'</div>';
            $sub_array[] = '<div class="actions">'.$total_canceled.'</div>';
            $sub_array[] = '<div class="actions">'.$total_noshow.'</div>';
            $sub_array[] = '<div class="actions" style="font-weight:600;"><b>'.$totals_perday.'</b></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Count appointments
     */
    public function countAppointments() {
        $db = $this->conn;
        $timezone = date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $telemed_sql = " SELECT COUNT(*) AS appointments FROM wp_ea_appointments WHERE wp_ea_appointments.date >= '$currentDate'  AND YEAR(wp_ea_appointments.date) = YEAR('$currentDate') AND 
                 MONTH(wp_ea_appointments.date) = MONTH('$currentDate') ";
        $telemed_statement = mysqli_query($db, $telemed_sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($telemed_statement)) {
            $sub_array = array();
            $sub_array['appointments'] = $row["appointments"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
    * Getting filtered appointments by country and doctor
    */
    public function getFilteredAppointmentsByDoctorAndCountry($start_date, $end_date, $doctor, $country, $successful, $pending, $abandoned, $no_show, $canceled, $in_person, $telemedicine){
        $db = $this->conn;

        $statement = " SELECT ANY_VALUE(wp_ea_appointments.date) AS date FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' 
                    AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' AND (wp_ea_appointments.status = '$successful' 
                    OR wp_ea_appointments.status = '$pending' OR wp_ea_appointments.status = '$abandoned' OR wp_ea_appointments.status = '$canceled'  OR wp_ea_appointments.status = '$no_show' 
                    OR wp_ea_appointments.location = '$telemedicine' OR wp_ea_appointments.location != '$in_person') GROUP BY wp_ea_appointments.date ORDER BY wp_ea_appointments.date DESC ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $appt_date = $row["date"];
            
            $total_omp = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS reservation FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.ip IS NULL AND wp_ea_appointments.session IS NULL AND wp_ea_appointments.date = '$appt_date'  AND status NOT IN ('canceled', 'No Show', 'abandoned') "))["reservation"];
            $total_mha = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS mha_booking FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.ip IS NOT NULL AND wp_ea_appointments.session IS NOT NULL AND wp_ea_appointments.status NOT IN ('pending_payment','abandoned') AND wp_ea_appointments.date = '$appt_date' "))["mha_booking"];
            $total_telemed = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS telemed FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.location = 130 AND wp_ea_appointments.payment_status = 'Paid' AND wp_ea_appointments.date = '$appt_date' "))["telemed"];
            $total_inperson = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS inperson FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.location != 130 AND wp_ea_appointments.status = 'pending' AND wp_ea_appointments.date = '$appt_date' "))["inperson"];
            $total_canceled = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS canceled FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.status = 'canceled' AND wp_ea_appointments.date = '$appt_date' "))["canceled"];
            $total_noshow = mysqli_fetch_assoc(mysqli_query($db, " SELECT COUNT(*) AS noshow FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.status = 'No Show' AND wp_ea_appointments.date = '$appt_date' "))["noshow"];
            $totals_perday = $total_omp+$total_mha;

            $sub_array = array();
            $sub_array[] = date("Y-m-d", strtotime($row["date"]));
            $sub_array[] = '<div class="actions" style="font-weight:800;"><b>'.$total_omp.'</b></div>';
            $sub_array[] = '<div class="actions">'. '' .'</div>';
            $sub_array[] = '<div class="actions">'.$total_mha.'</div>';
            // $sub_array[] = '<div class="actions">'.$total_complete.'</div>';
            $sub_array[] = '<div class="actions">'.$total_inperson.'</div>';
            $sub_array[] = '<div class="actions">'.$total_telemed.'</div>';
            $sub_array[] = '<div class="actions">'.$total_canceled.'</div>';
            $sub_array[] = '<div class="actions">'.$total_noshow.'</div>';
            $sub_array[] = '<div class="actions" style="font-weight:600;"><b>'.$totals_perday.'</b></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

        /**
    * Getting filtered appointments by country
    */
    public function getFilteredAppointmentsByCountry($start_date, $end_date, $country, $successful, $pending, $abandoned, $no_show, $canceled, $in_person, $telemedicine){
        $db = $this->conn;

        $statement = " SELECT ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.location) AS location FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' 
                    AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' AND (wp_ea_appointments.status = '$successful' OR wp_ea_appointments.status = '$pending' 
                    OR wp_ea_appointments.status = '$abandoned' OR wp_ea_appointments.status = '$canceled'  OR wp_ea_appointments.status = '$no_show' OR wp_ea_appointments.location = '$telemedicine' 
                    OR wp_ea_appointments.location != '$in_person')  GROUP BY wp_ea_appointments.date ORDER BY wp_ea_appointments.date DESC ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $appt_date = $row["date"];
            $location = $row["location"];

            $total_omp = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS reservation FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.ip IS NULL AND wp_ea_appointments.session IS NULL AND wp_ea_appointments.date = '$appt_date'  AND status NOT IN ('canceled', 'No Show', 'abandoned')"))["reservation"];
            $total_mha = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS mha_booking FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.status IN ('pending_payment','abandoned') AND wp_ea_appointments.date = '$appt_date' "))["mha_booking"];
            $total_telemed = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS telemed FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.location = 130 AND payment_status = 'Paid' AND wp_ea_appointments.date = '$appt_date' "))["telemed"];
            $total_inperson = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS inperson FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.location != 130 AND wp_ea_appointments.status = 'pending' AND wp_ea_appointments.date = '$appt_date' "))["inperson"];
            $total_canceled = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS canceled FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.status = 'canceled' AND wp_ea_appointments.date = '$appt_date'"))["canceled"];
            $total_noshow = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS noshow FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.status = 'no show' AND wp_ea_appointments.date = '$appt_date' "))["noshow"];
            $totals_perday = $total_omp+$total_mha;

            $sub_array = array();
            $sub_array[] = date("Y-m-d", strtotime($row["date"]));
            $sub_array[] = '<div class="actions" style="font-weight:800;"><b>'.$total_omp.'</b></div>';
            $sub_array[] = '<div class="actions">'. '' .'</div>';
            $sub_array[] = '<div class="actions">'.$total_mha.'</div>';
            // $sub_array[] = '<div class="actions">'.$total_complete.'</div>';
            $sub_array[] = '<div class="actions">'.$total_inperson.'</div>';
            $sub_array[] = '<div class="actions">'.$total_telemed.'</div>';
            $sub_array[] = '<div class="actions">'.$total_canceled.'</div>';
            $sub_array[] = '<div class="actions">'.$total_noshow.'</div>';
            $sub_array[] = '<div class="actions" style="font-weight:600;"><b>'.$totals_perday.'</b></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
    * Getting filtered appointments by doctor
    */
    public function getFilteredAppointmentsByDoctor($start_date, $end_date, $doctor, $successful, $pending, $abandoned, $no_show, $canceled, $in_person, $telemedicine){
        $db = $this->conn;

        $statement = " SELECT ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.location) AS location FROM wp_ea_appointments WHERE wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.date >= '$start_date' 
                    AND wp_ea_appointments.date <= '$end_date' AND ( wp_ea_appointments.status = '$successful' OR wp_ea_appointments.status = '$pending' OR wp_ea_appointments.status = '$abandoned' 
                    OR wp_ea_appointments.status = '$canceled'  OR wp_ea_appointments.status = '$no_show' OR wp_ea_appointments.location = '$telemedicine' OR wp_ea_appointments.location != '$in_person') 
                    GROUP BY wp_ea_appointments.date ORDER BY wp_ea_appointments.date DESC ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $appt_date = $row["date"];
            $location = $row["location"];
            
            $total_omp = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS reservation FROM wp_ea_appointments WHERE ip IS NULL AND session IS NULL AND wp_ea_appointments.date = '$appt_date' AND wp_ea_appointments.facility_id = '$doctor' AND status NOT IN ('canceled', 'No Show', 'abandoned')"))["reservation"];
            $total_mha = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS mha_booking FROM wp_ea_appointments WHERE status IN ('pending_payment','abandoned') AND wp_ea_appointments.date = '$appt_date' AND wp_ea_appointments.facility_id = '$doctor'"))["mha_booking"];
            $total_telemed = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS telemed FROM wp_ea_appointments WHERE location = 130 AND payment_status = 'Paid' AND wp_ea_appointments.date = '$appt_date' AND wp_ea_appointments.facility_id = '$doctor' "))["telemed"];
            $total_inperson = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS inperson FROM wp_ea_appointments WHERE location != 130 AND status = 'pending' AND wp_ea_appointments.date = '$appt_date' AND wp_ea_appointments.facility_id = '$doctor' "))["inperson"];
            $total_canceled = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS canceled FROM wp_ea_appointments WHERE status = 'canceled' AND wp_ea_appointments.date = '$appt_date' AND wp_ea_appointments.facility_id = '$doctor' "))["canceled"];
            $total_noshow = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS noshow FROM wp_ea_appointments WHERE status = 'no show' AND wp_ea_appointments.date = '$appt_date' AND wp_ea_appointments.facility_id = '$doctor' "))["noshow"];
            $totals_perday = $total_omp+$total_mha;

            $sub_array = array();
            $sub_array[] = date("Y-m-d", strtotime($row["date"]));
            $sub_array[] = '<div class="actions" style="font-weight:800;"><b>'.$total_omp.'</b></div>';
            $sub_array[] = '<div class="actions">'. '' .'</div>';
            $sub_array[] = '<div class="actions">'.$total_mha.'</div>';
            // $sub_array[] = '<div class="actions">'.$total_complete.'</div>';
            $sub_array[] = '<div class="actions">'.$total_inperson.'</div>';
            $sub_array[] = '<div class="actions">'.$total_telemed.'</div>';
            $sub_array[] = '<div class="actions">'.$total_canceled.'</div>';
            $sub_array[] = '<div class="actions">'.$total_noshow.'</div>';
            $sub_array[] = '<div class="actions" style="font-weight:600;"><b>'.$totals_perday.'</b></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
    * Getting filtered appointments by date range
    */
    public function getFilteredAppointmentsByDate($start_dateval, $end_dateval){
        $db = $this->conn;

        $statement = " SELECT ANY_VALUE(wp_ea_appointments.date) AS date FROM wp_ea_appointments WHERE wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' GROUP BY wp_ea_appointments.facility_id ORDER BY wp_ea_appointments.date DESC ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $appt_date = $row["date"];

            $total_omp = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS reservation FROM wp_ea_appointments WHERE ip IS NULL AND wp_ea_appointments.date = '$appt_date' AND status NOT IN ('canceled', 'No Show', 'abandoned')"))["reservation"];
            $total_mha = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS mha_booking FROM wp_ea_appointments WHERE status IN ('pending_payment','abandoned') AND wp_ea_appointments.date = '$appt_date' "))["mha_booking"];
            $total_telemed = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS telemed FROM wp_ea_appointments WHERE location = 130 AND payment_status = 'Paid' AND wp_ea_appointments.date = '$appt_date' "))["telemed"];
            $total_inperson = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS inperson FROM wp_ea_appointments WHERE location != 130 AND status = 'pending' AND wp_ea_appointments.date = '$appt_date' "))["inperson"];
            $total_canceled = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS canceled FROM wp_ea_appointments WHERE status = 'canceled' AND wp_ea_appointments.date = '$appt_date' "))["canceled"];
            $total_noshow = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS noshow FROM wp_ea_appointments WHERE status = 'no show' AND wp_ea_appointments.date = '$appt_date' "))["noshow"];
            $totals_perday = $total_omp+$total_mha;

            $sub_array = array();
            $sub_array[] = date("Y-m-d", strtotime($row["date"]));
            $sub_array[] = '<div class="actions" style="font-weight:800;"><b>'.$total_omp.'</b></div>';
            $sub_array[] = '<div class="actions">'. '' .'</div>';
            $sub_array[] = '<div class="actions">'.$total_mha.'</div>';
            // $sub_array[] = '<div class="actions">'.$total_complete.'</div>';
            $sub_array[] = '<div class="actions">'.$total_inperson.'</div>';
            $sub_array[] = '<div class="actions">'.$total_telemed.'</div>';
            $sub_array[] = '<div class="actions">'.$total_canceled.'</div>';
            $sub_array[] = '<div class="actions">'.$total_noshow.'</div>';
            $sub_array[] = '<div class="actions" style="font-weight:600;"><b>'.$totals_perday.'</b></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Fetch Upcoming Telemedicine Appointments
     */
    public function getUpcomingTelemedAppointments() {
        $db = $this->conn;
        $timezone = date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id 
            WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') AND wp_ea_appointments.payment_status = 'Paid' AND wp_ea_appointments.date >= '$currentDate'  AND YEAR(wp_ea_appointments.date) = YEAR('$currentDate') AND 
        MONTH(wp_ea_appointments.date) = MONTH('$currentDate') GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $telemed_total = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';

            $doctorPostId = mysqli_fetch_assoc(mysqli_query($db, "SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id'"))["dr_post_id"];
            $key = mysqli_fetch_assoc(mysqli_query($db, " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' "))["meta_value"];
            $doctorSpeciality = mysqli_fetch_assoc(mysqli_query($db, " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' "))["name"];
            $fname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 "))['value'];
            $sname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 "))['value'];
            $phone_result = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 "));
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
            } else {
                $phone = $phone_result['value'];
            }
            
            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Fetch filtered upcoming Telemedicine Appointments by country and doctor
     */
    public function getFilteredUpcomingTelemedByDoctorAndCountry($start_date, $end_date, $doctor, $country) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' AND wp_ea_appointments.facility_id ='$doctor' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';
            
            $doctorPostId = mysqli_fetch_assoc(mysqli_query($db, "SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' "))["dr_post_id"];
            $key = mysqli_fetch_assoc(mysqli_query($db, " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' "))["meta_value"];
            $doctorSpeciality = mysqli_fetch_assoc(mysqli_query($db, " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' "))["name"];
            $fname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 "))['value'];
            $sname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 "))['value'];
            $phone_result = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 "));
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
        /**
     * Fetch filtered upcoming Telemedicine Appointments by country
     */
    public function getFilteredUpcomingTelemedByCountry($start_date, $end_date, $country) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' 
            AND wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';
            
            $doctorPostId = mysqli_fetch_assoc(mysqli_query($db, "SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' "))["dr_post_id"];
            $key = mysqli_fetch_assoc(mysqli_query($db, " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' "))["meta_value"];
            $doctorSpeciality = mysqli_fetch_assoc(mysqli_query($db, " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' "))["name"];
            $fname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 "))['value'];
            $sname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 "))['value'];
            $phone_result = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 "));
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
        /**
     * Fetch filtered upcoming Telemedicine Appointments by doctor
     */
    public function getFilteredUpcomingTelemedByDoctor($start_date, $end_date, $doctor) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' AND wp_ea_appointments.facility_id ='$doctor' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';
            
            $doctorPostId = mysqli_fetch_assoc(mysqli_query($db, "SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' "))["dr_post_id"];
            $key = mysqli_fetch_assoc(mysqli_query($db, " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' "))["meta_value"];
            $doctorSpeciality = mysqli_fetch_assoc(mysqli_query($db, " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' "))["name"];
            $fname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 "))['value'];
            $sname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 "))['value'];
            $phone_result = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 "));
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Fetch filtered upcoming Telemedicine Appointments by date
     */
    public function getFilteredUpcomingTelemedByDate($start_dateval, $end_dateval) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id 
            WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';
            
            $doctorPostId = mysqli_fetch_assoc(mysqli_query($db, "SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' "))["dr_post_id"];
            $key = mysqli_fetch_assoc(mysqli_query($db, " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' "))["meta_value"];
            $doctorSpeciality = mysqli_fetch_assoc(mysqli_query($db, " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' "))["name"];
            $fname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 "))['value'];
            $sname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 "))['value'];
            $phone_result = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 "));
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Count upcoming telemed appointments
     */
    public function countUpcomingTelemed() {
        $db = $this->conn;
        $timezone = date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $telemed_sql = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') AND wp_ea_appointments.payment_status = 'Paid' AND wp_ea_appointments.date >= '$currentDate'  AND YEAR(wp_ea_appointments.date) = YEAR('$currentDate') AND 
        MONTH(wp_ea_appointments.date) = MONTH('$currentDate') ";
        $telemed_statement = mysqli_query($db, $telemed_sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($telemed_statement)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Count upcoming telemed filtered appointments by country and doctor
     */
    public function countUpcomingTelemedFilterByDoctorAndCountry($start_dateval, $end_dateval, $doctor, $country) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

        /**
     * Count upcoming telemed filtered appointments by country
     */
    public function countUpcomingTelemedFilterByCountry($start_dateval, $end_dateval, $country) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id 
            WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Count upcoming telemed filtered appointments by doctor
     */
    public function countUpcomingTelemedFilterByDoctor($start_dateval, $end_dateval, $doctor) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' AND wp_ea_appointments.facility_id = '$doctor' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Fetch Past Telemedicine Appointments
     */
    public function getPastTelemedAppointments() {
        $db = $this->conn;
        $today=date("Y-m-d");
        $period = date('Y-m-d',strtotime($today . "-30 days"));
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id 
            WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') AND wp_ea_appointments.payment_status = 'Paid' AND wp_ea_appointments.date >= '$period' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $telemed_total = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];
             
            $pat1="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 ";
            $pat1 = mysqli_query($db,$pat1)or die(mysqli_error());
            $row1 = mysqli_fetch_array($pat1);
            $fname = $row1['value'];
             
            $pat4="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 ";
            $pat4 = mysqli_query($db,$pat4)or die(mysqli_error());
            $row4 = mysqli_fetch_array($pat4);
            $sname = $row4['value'];

            $phone_sql="SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 ";
            $phone_statement = mysqli_query($db,$phone_sql)or die(mysqli_error());
            $phone_result = mysqli_fetch_array($phone_statement);
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
                
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Fetch filtered Telemedicine Appointments by country and doctor
     */
    public function getFilteredPastTelemedByDoctorAndCountry($start_date, $end_date, $doctor, $country) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' 
            AND wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];
             
            $pat1="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 ";
            $pat1 = mysqli_query($db,$pat1)or die(mysqli_error());
            $row1 = mysqli_fetch_array($pat1);
            $fname = $row1['value'];
             
            $pat4="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 ";
            $pat4 = mysqli_query($db,$pat4)or die(mysqli_error());
            $row4 = mysqli_fetch_array($pat4);
            $sname = $row4['value'];

            $phone_sql="SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 ";
            $phone_statement = mysqli_query($db,$phone_sql)or die(mysqli_error());
            $phone_result = mysqli_fetch_array($phone_statement);
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
                
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

        /**
     * Fetch filtered Telemedicine Appointments by country
     */
    public function getFilteredPastTelemedByCountry($start_date, $end_date, $country) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];
             
            $pat1="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 ";
            $pat1 = mysqli_query($db,$pat1)or die(mysqli_error());
            $row1 = mysqli_fetch_array($pat1);
            $fname = $row1['value'];
             
            $pat4="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 ";
            $pat4 = mysqli_query($db,$pat4)or die(mysqli_error());
            $row4 = mysqli_fetch_array($pat4);
            $sname = $row4['value'];

            $phone_sql="SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 ";
            $phone_statement = mysqli_query($db,$phone_sql)or die(mysqli_error());
            $phone_result = mysqli_fetch_array($phone_statement);
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
                
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Fetch filtered Telemedicine Appointments by doctor
     */
    public function getFilteredPastTelemedByDoctor($start_date, $end_date, $doctor) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' AND wp_ea_appointments.facility_id = '$doctor' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];
             
            $pat1="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 ";
            $pat1 = mysqli_query($db,$pat1)or die(mysqli_error());
            $row1 = mysqli_fetch_array($pat1);
            $fname = $row1['value'];
             
            $pat4="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 ";
            $pat4 = mysqli_query($db,$pat4)or die(mysqli_error());
            $row4 = mysqli_fetch_array($pat4);
            $sname = $row4['value'];

            $phone_sql="SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 ";
            $phone_statement = mysqli_query($db,$phone_sql)or die(mysqli_error());
            $phone_result = mysqli_fetch_array($phone_statement);
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
                
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Fetch filtered Past Telemedicine Appointments by date
     */
    public function getFilteredPastTelemedByDate($start_dateval, $end_dateval) {
        $db = $this->conn;
        $statement = " SELECT ANY_VALUE(wp_ea_staff.id) AS staff, ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_appointments.id) AS appt_id, ANY_VALUE(wp_ea_appointments.status) AS status, ANY_VALUE(wp_ea_appointments.telemed_status) AS telemed_status, ANY_VALUE(wp_ea_appointments.date) AS date, ANY_VALUE(wp_ea_appointments.start) AS start, ANY_VALUE(wp_ea_appointments.payment_status) AS payment_status
            FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id 
            WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' GROUP BY wp_ea_appointments.facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            if ($row["telemed_status"] == 'Ongoing' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Complete</span>';
            } else if ($row["telemed_status"] == 'Paid' && $row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-primary">Confirmed</span>';
            } else $status = '<span class="label label-sm label-default">'.$row["telemed_status"].'</span>';

            $sql1 = " SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id' ";
            $statement1 = mysqli_query($db, $sql1)or die(mysqli_error());
            $post_id = mysqli_fetch_assoc($statement1);
            $doctorPostId = $post_id["dr_post_id"];
    
            $key_query = " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' ";
            $key_statement = mysqli_query($db, $key_query)or die(mysqli_error());
            $meta_key = mysqli_fetch_assoc($key_statement);
            $key = $meta_key["meta_value"];
    
            $speciality_query = " SELECT wp_terms.name FROM `wp_terms` WHERE term_id = '$key' ";
            $speciality_statement = mysqli_query($db, $speciality_query)or die(mysqli_error());
            $speciality = mysqli_fetch_assoc($speciality_statement);
            $doctorSpeciality = $speciality["name"];

            $pat1="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 ";
            $pat1 = mysqli_query($db,$pat1)or die(mysqli_error());
            $row1 = mysqli_fetch_array($pat1);
            $fname = $row1['value'];
             
            $pat4="SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 ";
            $pat4 = mysqli_query($db,$pat4)or die(mysqli_error());
            $row4 = mysqli_fetch_array($pat4);
            $sname = $row4['value'];

            $phone_sql="SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 ";
            $phone_statement = mysqli_query($db,$phone_sql)or die(mysqli_error());
            $phone_result = mysqli_fetch_array($phone_statement);
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
                
            } else {
                $phone = $phone_result['value'];
            }

            $time = date('h:i A', strtotime($row["start"]));

            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $doctorSpeciality;
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $phone;
            $sub_array[] = $row["date"].' '.$time;
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }

    /**
     * Count telemed appointments
     */
    public function countPastTelemed() {
        $db = $this->conn;
        $today=date("Y-m-d");
        $period = date('Y-m-d',strtotime($today . "-30 days"));
        $telemed_sql = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') AND wp_ea_appointments.date >= '$period' ";
        $telemed_statement = mysqli_query($db, $telemed_sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($telemed_statement)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Count telemed filtered appointments
     */
    public function countPastTelemedFilter($start_dateval, $end_dateval) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Count past telemed filtered appointments by country and doctor
     */
    public function countPastTelemedFilterByDoctorAndCountry($start_date, $end_date, $doctor, $country) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id 
            WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
        /**
     * Count past telemed filtered appointments by country
     */
    public function countPastTelemedFilterByCountry($start_date, $end_date, $country) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id 
            WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Count past telemed filtered appointments by doctor
     */
    public function countPastTelemedFilterByDoctor($start_date, $end_date, $doctor) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS telemed FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id WHERE wp_ea_appointments.status NOT IN('abandoned','pending_payment') AND wp_ea_appointments.telemed_status IN('Paid','Ongoing') 
            AND wp_ea_appointments.date >= '$start_date' AND wp_ea_appointments.date <= '$end_date' AND wp_ea_appointments.facility_id = '$doctor' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['telemed_total'] = $row["telemed"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Count filtered appointments by country and doctor
     */
    public function countAppointmentsFilterByDoctorAndCountry($start_dateval, $end_dateval, $doctor, $country, $successful, $pending, $abandoned, $no_show, $canceled, $in_person, $telemedicine) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS appointments FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' 
                    AND (wp_ea_appointments.status = '$successful' OR wp_ea_appointments.status = '$pending' OR wp_ea_appointments.status = '$abandoned' OR wp_ea_appointments.status = '$canceled'  OR wp_ea_appointments.status = '$no_show' OR wp_ea_appointments.location = '$telemedicine' OR wp_ea_appointments.location != '$in_person') ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['appointments'] = $row["appointments"];
            $data[] = $sub_array;
        }
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Count filtered appointments by country
     */
    public function countAppointmentsFilterByCountry($start_dateval, $end_dateval, $country, $successful, $pending, $abandoned, $no_show, $canceled, $in_person, $telemedicine) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS appointments FROM wp_ea_appointments INNER JOIN wp_ea_locations ON wp_ea_appointments.location = wp_ea_locations.id WHERE wp_ea_locations.location = '$country' AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' 
                        AND (wp_ea_appointments.status = '$successful' OR wp_ea_appointments.status = '$pending' OR wp_ea_appointments.status = '$abandoned' OR wp_ea_appointments.status = '$canceled'  OR wp_ea_appointments.status = '$no_show' OR wp_ea_appointments.location = '$telemedicine' OR wp_ea_appointments.location != '$in_person') ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['appointments'] = $row["appointments"];
            $data[] = $sub_array;
        }
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }
    /**
     * Count filtered appointments by doctor
     */
    public function countAppointmentsFilterByDoctor($start_dateval, $end_dateval, $doctor, $successful, $pending, $abandoned, $no_show, $canceled, $in_person, $telemedicine) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS appointments FROM wp_ea_appointments WHERE wp_ea_appointments.facility_id = '$doctor' AND wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' 
                        AND (wp_ea_appointments.status = '$successful' OR wp_ea_appointments.status = '$pending' OR wp_ea_appointments.status = '$abandoned' OR wp_ea_appointments.status = '$canceled'  OR wp_ea_appointments.status = '$no_show' OR wp_ea_appointments.location = '$telemedicine' OR wp_ea_appointments.location != '$in_person') ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['appointments'] = $row["appointments"];
            $data[] = $sub_array;
        }
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    /**
     * Count filtered appointments by date range
     */
    public function countAppointmentsFilterByDateRange($start_dateval, $end_dateval) {
        $db = $this->conn;
        $statement = "SELECT COUNT(*) AS appointments FROM wp_ea_appointments WHERE wp_ea_appointments.date >= '$start_dateval' AND wp_ea_appointments.date <= '$end_dateval' ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array['appointments'] = $row["appointments"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

    
   /**
    * Getting patient engagement data
    */
    public function getPatientEngagement($userId){
        $db = $this->conn;
        date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $statement = " SELECT ANY_VALUE(patient_engagement_subscriptions.omp_facility_id) AS omp_facility_id, ANY_VALUE(patient_engagement_subscriptions.active) AS active, ANY_VALUE(patient_engagement_subscriptions.last_subscription_date) AS last_subscription_date, ANY_VALUE(DATE(patient_engagement_subscriptions.subscription_expiry_date)) AS subscription_expiry_date,
                        ANY_VALUE(wp_ea_staff.name) AS name, ANY_VALUE(wp_ea_staff.email) AS email, ANY_VALUE(wp_ea_staff.phone) AS phone, ANY_VALUE(wp_ea_staff.patient_experience) AS patient_experience FROM patient_engagement_subscriptions INNER JOIN wp_ea_staff ON patient_engagement_subscriptions.omp_facility_id = wp_ea_staff.facility_id GROUP BY patient_engagement_subscriptions.omp_facility_id ";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $facility_id = $row["omp_facility_id"];
            $last_subscription = $row["last_subscription_date"];
            $expiry_date = $row["subscription_expiry_date"];
            $facility_name = $row["name"];
            $facility_email = $row["email"];
            $facility_phone = $row["phone"];
            if($row["patient_experience"] == 'patient_experience'){
                 $category = 'Patient Experience';
            } else if($row["patient_experience"] == 'both'){
                 $category = 'OneMed Pro & PE';
            } else if($row["patient_experience"] == 'onemedpro'){
                 $category = 'OneMed Pro';
            }
            if ($row["active"] == 1) {
                $status = '<span class="label label-sm btn-success">Active</span>';
            } else $status = '<span class="label label-sm btn-default">Inactive</span>';

            $survey_sql = " SELECT COUNT(*) AS sent_count FROM patient_survey_response WHERE doctor_id = '$facility_id' AND YEAR(date_added) = YEAR('$currentDate') AND 
            MONTH(date_added) = MONTH('$currentDate')";
            $survey_result = mysqli_query($db,$survey_sql)or die(mysqli_error($db));
            $survey = mysqli_fetch_assoc($survey_result);
            $survey_sent = $survey["sent_count"];

            $email_sql = " SELECT COUNT(*) AS sent_count FROM email_queue INNER JOIN email_message ON email_queue.message_id = email_message.message_id WHERE email_message.subscription_id = '$facility_id' 
                AND YEAR(time_queued) = YEAR('$currentDate') AND MONTH(time_queued) = MONTH('$currentDate') ";
            $email_result = mysqli_query($db,$email_sql)or die(mysqli_error($db));
            $email = mysqli_fetch_assoc($email_result);
            $email_sent = $email["sent_count"];

            $sms_sql = " SELECT COUNT(*) AS sent_count FROM scheduled_sms WHERE status = 'sent' AND facility_id = '$facility_id' AND YEAR(date_added) = YEAR('$currentDate') AND MONTH(date_added) = MONTH('$currentDate') ";
            $sms_result = mysqli_query($db,$sms_sql)or die(mysqli_error($db));
            $sms = mysqli_fetch_assoc($sms_result);
            $sms_sent = $sms["sent_count"];

            $feedback_sql = " SELECT COUNT(*) AS sent_count FROM my_rating_form WHERE my_rating_form.doctor_id = '$facility_id' AND YEAR(date_shared) = YEAR('$currentDate') AND MONTH(date_shared) = MONTH('$currentDate') ";
            $feedback_result = mysqli_query($db,$feedback_sql)or die(mysqli_error($db));
            $feedback = mysqli_fetch_assoc($feedback_result);
            $sentiment_sent = $feedback["sent_count"];

            $sub_array = array();
            $sub_array[] = $facility_name;
            $sub_array[] = $facility_email;
            $sub_array[] = $facility_phone;
            $sub_array[] = '<div class="actions">'.$expiry_date.'</div>';
            $sub_array[] = '<div class="actions">'.$sms_sent.'</div>';
            $sub_array[] = '<div class="actions">'.$email_sent.'</div>';
            $sub_array[] = '<div class="actions">'.$survey_sent.'</div>';
            $sub_array[] = '<div class="actions">'.$sentiment_sent.'</div>';
            $sub_array[] = '<div class="actions">'.$category.'</div>';
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    
    /**
    * Getting filtered patient engagement data
    */
    public function getFilteredPatientEngagement($start_date, $end_date, $facility) {
        $db = $this->conn;
        date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        if(!empty($facility)){
            $statement = " SELECT ANY_VALUE(omp_facility_id) AS omp_facility_id, ANY_VALUE(active) AS active, ANY_VALUE(last_subscription_date) AS last_subscription_date, ANY_VALUE(DATE(subscription_expiry_date)) AS subscription_expiry_date FROM patient_engagement_subscriptions WHERE omp_facility_id = '$facility' GROUP BY omp_facility_id ";
        } else {
            $statement = " SELECT ANY_VALUE(omp_facility_id) AS omp_facility_id, ANY_VALUE(active) AS active, ANY_VALUE(last_subscription_date) AS last_subscription_date, ANY_VALUE(DATE(subscription_expiry_date)) AS subscription_expiry_date FROM patient_engagement_subscriptions GROUP BY omp_facility_id ";
        }
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $facility_id = $row["omp_facility_id"];
            $last_subscription = $row["last_subscription_date"];
            $expiry_date = $row["subscription_expiry_date"];
            if ($row["active"] == 1) {
                $status = '<span class="label label-sm btn-success">Active</span>';
            } else $status = '<span class="label label-sm btn-default">Inactive</span>';

            $query_facility = " SELECT name, email, phone, patient_experience FROM wp_ea_staff WHERE id = '$facility_id' ";
            $facility_result = mysqli_query($db, $query_facility)or die(mysqli_error());
            $facility = mysqli_fetch_assoc($facility_result);
            $facility_name = $facility["name"];
            $facility_email = $facility["email"];
            $facility_phone = $facility["phone"];
            $category = $facility["patient_experience"];

            $survey_sql = " SELECT COUNT(*) AS sent_count FROM patient_survey_response WHERE doctor_id = '$facility_id' AND date_added >= '$start_date' AND date_added <= '$end_date' ";
            $survey_result = mysqli_query($db,$survey_sql)or die(mysqli_error());
            $survey = mysqli_fetch_assoc($survey_result);
            $survey_sent = $survey["sent_count"];

            $email_sql = " SELECT COUNT(*) AS sent_count FROM email_queue INNER JOIN email_message ON email_queue.message_id = email_message.message_id WHERE email_message.subscription_id = '$facility_id' 
                AND time_queued >= '$start_date' AND time_queued <= '$end_date' ";
            $email_result = mysqli_query($db,$email_sql)or die(mysqli_error());
            $email = mysqli_fetch_assoc($email_result);
            $email_sent = $email["sent_count"];

            $sms_sql = " SELECT COUNT(*) AS sent_count FROM scheduled_sms WHERE status = 'sent' AND facility_id = '$facility_id' AND date_added >= '$start_date' AND date_added <= '$end_date' ";
            $sms_result = mysqli_query($db,$sms_sql)or die(mysqli_error());
            $sms = mysqli_fetch_assoc($sms_result);
            $sms_sent = $sms["sent_count"];

            $feedback_sql = " SELECT COUNT(*) AS sent_count FROM my_rating_form WHERE my_rating_form.doctor_id = '$facility_id' AND date_shared >= '$start_date' AND date_shared <= '$end_date' ";
            $feedback_result = mysqli_query($db,$feedback_sql)or die(mysqli_error());
            $feedback = mysqli_fetch_assoc($feedback_result);
            $sentiment_sent = $feedback["sent_count"];

            $sub_array = array();
            $sub_array[] = $facility_name;
            $sub_array[] = $facility_email;
            $sub_array[] = $facility_phone;
            $sub_array[] = '<div class="actions">'.$expiry_date.'</div>';
            $sub_array[] = '<div class="actions">'.$sms_sent.'</div>';
            $sub_array[] = '<div class="actions">'.$email_sent.'</div>';
            $sub_array[] = '<div class="actions">'.$survey_sent.'</div>';
            $sub_array[] = '<div class="actions">'.$sentiment_sent.'</div>';
            $sub_array[] = '<div class="actions">'.$category.'</div>';
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    

     /**
     * Count patient engagement stats
     */
     public function countEngagementStats() {
        $db = $this->conn;
        date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());

        $survey_sql = " SELECT COUNT(*) AS sent_count FROM patient_survey_response WHERE YEAR(date_added) = YEAR('$currentDate') AND 
            MONTH(date_added) = MONTH('$currentDate') AND doctor_id != '' ";
        $survey_result = mysqli_query($db,$survey_sql)or die(mysqli_error($db));
        $survey = mysqli_fetch_assoc($survey_result);
        $survey_sent = "Survey Sent: ".number_format($survey["sent_count"]);

        $email_sql = " SELECT COUNT(*) AS sent_count FROM email_queue INNER JOIN email_message ON email_queue.message_id = email_message.message_id WHERE  
            YEAR(time_queued) = YEAR('$currentDate') AND MONTH(time_queued) = MONTH('$currentDate') ";
        $email_result = mysqli_query($db,$email_sql)or die(mysqli_error($db));
        $email = mysqli_fetch_assoc($email_result);
        $email_sent = "Email Sent: ".number_format($email["sent_count"]);

        $sms_sql = " SELECT COUNT(*) AS sent_count FROM scheduled_sms WHERE status = 'sent' AND YEAR(date_added) = YEAR('$currentDate') AND MONTH(date_added) = MONTH('$currentDate') ";
        $sms_result = mysqli_query($db,$sms_sql)or die(mysqli_error($db));
        $sms = mysqli_fetch_assoc($sms_result);
        $sms_sent = "SMS Sent: ".number_format($sms["sent_count"]);

        $feedback_sql = " SELECT COUNT(*) AS sent_count FROM my_rating_form WHERE YEAR(date_shared) = YEAR('$currentDate') AND MONTH(date_shared) = MONTH('$currentDate') ";
        $feedback_result = mysqli_query($db,$feedback_sql)or die(mysqli_error($db));
        $feedback = mysqli_fetch_assoc($feedback_result);
        $sentiment_sent = "Sentiment Sent: ".number_format($feedback["sent_count"]);
        $output = array();
        $output["sms"] = $sms_sent;
        $output["email"] = $email_sent;
        $output["survey"] = $survey_sent;
        $output["sentiment"] = $sentiment_sent;
        $data[] = $output;
        if (!empty($data)) {
            mysqli_close($db);
            return $data;
        } else {
            mysqli_close($db);
            $response = 404;
            return $response; 
        }
    }

    
     /**
     * Count filtered patient engagement stats
     */
    public function countFilteredEngagementStats($start_date, $end_date, $facility) {
        $db = $this->conn;
        date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());

        $survey_sql = " SELECT COUNT(*) AS sent_count FROM patient_survey_response WHERE date_added >= '$start_date' AND date_added <= '$end_date' AND doctor_id = '$facility' ";
        $survey_result = mysqli_query($db,$survey_sql)or die(mysqli_error($db));
        $survey = mysqli_fetch_assoc($survey_result);
        $survey_sent = "Survey Sent: ".number_format($survey["sent_count"]);

        $email_sql = " SELECT COUNT(*) AS sent_count FROM email_queue INNER JOIN email_message ON email_queue.message_id = email_message.message_id WHERE email_message.subscription_id = '$facility' 
                        AND time_queued >= '$start_date' AND time_queued <= '$end_date' ";
        $email_result = mysqli_query($db,$email_sql)or die(mysqli_error($db));
        $email = mysqli_fetch_assoc($email_result);
        $email_sent = "Email Sent: ".number_format($email["sent_count"]);

        $sms_sql = " SELECT COUNT(*) AS sent_count FROM scheduled_sms WHERE facility_id = '$facility' AND status = 'sent' AND date_added >= '$start_date' AND date_added <= '$end_date' ";
        $sms_result = mysqli_query($db,$sms_sql)or die(mysqli_error($db));
        $sms = mysqli_fetch_assoc($sms_result);
        $sms_sent = "SMS Sent: ".number_format($sms["sent_count"]);

        $feedback_sql = " SELECT COUNT(*) AS sent_count FROM my_rating_form WHERE doctor_id = '$facility' AND date_shared >= '$start_date' AND date_shared <= '$end_date' ";
        $feedback_result = mysqli_query($db,$feedback_sql)or die(mysqli_error($db));
        $feedback = mysqli_fetch_assoc($feedback_result);
        $sentiment_sent = "Sentiment Sent: ".number_format($feedback["sent_count"]);
        $output = array();
        $output["sms"] = $sms_sent;
        $output["email"] = $email_sent;
        $output["survey"] = $survey_sent;
        $output["sentiment"] = $sentiment_sent;
        $data[] = $output;
        if (!empty($data)) {
            mysqli_close($db);
            return $data;
        } else {
            mysqli_close($db);
            $response = 404;
            return $response; 
        }
    }
    
    
    /*********************** OMP Subscriptions  **********************/
    
    
     /**
    * Getting filtered OMP by date range selected
    */
    public function getSubscriptions() {
        $db = $this->conn;
        date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $output = array();
        $data = array();
        
        $result = mysqli_query($db, " SELECT * FROM onemedpro_subscriptions ")or die(mysqli_error($db));
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $expiry = date("Y-m-d",strtotime($row["subscription_start_date"]));
            if ($row["subscription_status"] == 1) {
                $status = '<span class="label label-sm btn-success">Active</span>';
            } else $status = '<span class="label label-sm btn-default">Inactive</span>';
            if ($row["payment_status"] == 'paid' || $row["payment_status"] == 'pe-paid') {
                $payment_status = '<span class="label label-sm btn-success">paid</span>';
            } else if($row["package"] == 'Free'){
                $expiry = 'Always free';
                $payment_status = '<span class="label label-sm btn-success">free</span>';
            } else $payment_status = '<span class="label label-sm btn-default">unpaid</span>';

            $sub_array = array();
            $sub_array[] = $row["fullname"];
            $sub_array[] = $row["email"];
            $sub_array[] = $row["phone_number"];
            $sub_array[] = $row["subscribing_as"];
            $sub_array[] = '<div class="actions">'.$row["package"].'</div>';
            $sub_array[] = '<div class="actions">'.$row["plan"].'</div>';
            $sub_array[] = '<div class="actions">'.date("Y-m-d",strtotime($row["subscription_start_date"])).'</div>';
            $sub_array[] = '<div class="actions">'.$expiry.'</div>';
            $sub_array[] = '<div class="actions">'.$payment_status.'</div>';
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data,
            "count"		=> 	$filtered_rows,
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    
    /**
    * Getting filtered OMP by date range selected
    */
    public function getFilteredSubscriptionsByDateRange($start_dateval, $end_dateval) {
        $db = $this->conn;
        date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $output = array();
        $data = array();
        $result = mysqli_query($db, " SELECT * FROM onemedpro_subscriptions WHERE created_at >= '$start_dateval' AND created_at <= '$end_dateval' ")or die(mysqli_error($db));
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $expiry = date("Y-m-d",strtotime($row["subscription_start_date"]));
            if ($row["subscription_status"] == 1) {
                $status = '<span class="label label-sm btn-success">Active</span>';
            } else $status = '<span class="label label-sm btn-default">Inactive</span>';
            if ($row["payment_status"] == 'paid' || $row["payment_status"] == 'pe-paid') {
                $payment_status = '<span class="label label-sm btn-success">paid</span>';
            } else if($row["package"] == 'Free'){
                $expiry = 'Always free';
                $payment_status = '<span class="label label-sm btn-default">free</span>';
            } else $payment_status = '<span class="label label-sm btn-default">unpaid</span>';

            $sub_array = array();
            $sub_array[] = $row["fullname"];
            $sub_array[] = $row["email"];
            $sub_array[] = $row["phone_number"];
            $sub_array[] = $row["subscribing_as"];
            $sub_array[] = '<div class="actions">'.$row["package"].'</div>';
            $sub_array[] = '<div class="actions">'.$row["plan"].'</div>';
            $sub_array[] = '<div class="actions">'.date("Y-m-d",strtotime($row["subscription_start_date"])).'</div>';
            $sub_array[] = '<div class="actions">'.$expiry.'</div>';
            $sub_array[] = '<div class="actions">'.$payment_status.'</div>';
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"		=> 	$filtered_rows,
            "data"				=>	$data,
            "count"		=> 	$filtered_rows,
        );
        
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    
    /**
     * Fetch paid PSI telemedicine appointments
     */
    public function getPaymentAppointments() {
        $db = $this->conn;
        $timezone = date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $statement = " SELECT wp_ea_staff.id AS staff, wp_ea_staff.name,wp_ea_staff.facility_id, wp_ea_appointments.id AS appt_id, wp_ea_appointments.date,wp_ea_appointments.start,wp_ea_appointments.status, wp_ea_appointments.price, wp_ea_appointments.telemed_status, wp_ea_appointments.date, wp_ea_appointments.start, 
        wp_ea_appointments.payment_status, wp_ea_appointments.id FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN white_labling_facilities ON wp_ea_appointments.facility_id = white_labling_facilities.facility_id  WHERE wp_ea_appointments.telemed_status IN('Paid','Ongoing') AND wp_ea_appointments.date >= '$currentDate'   GROUP BY wp_ea_appointments.id ORDER BY CONCAT_WS(' ', wp_ea_appointments.date, wp_ea_appointments.start) ASC";
        $result = mysqli_query($db, $statement)or die(mysqli_error());
        $output = array();
        $data = array();
        $telemed_total = array();
        $filtered_rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)) {
            $doctor_id = $row["staff"];
            $appt_id = $row["appt_id"];
            $facility_id = $row["facility_id"];
            if ($row["payment_status"] == 'Paid') {
                $status = '<span class="label label-sm btn-success">Paid</span>';
            }  else $status = '<span class="label label-sm label-primary">Unpaid</span>';
            $facility = mysqli_fetch_assoc(mysqli_query($db, "SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id'"))["dr_post_id"];
            $doctorPostId = mysqli_fetch_assoc(mysqli_query($db, "SELECT dr_post_id FROM `wp_ea_staff` WHERE id = '$doctor_id'"))["dr_post_id"];
            $key = mysqli_fetch_assoc(mysqli_query($db, " SELECT meta_value FROM `wp_postmeta` WHERE post_id = '$doctorPostId' AND meta_key = '_yoast_wpseo_primary_medclinic_doctor_speciality' "))["meta_value"];
            $fname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 2 "))['value'];
            $sname = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 7 "))['value'];
            $email = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 1 "))['value'];
            $gender = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 15 "))['value'];
            $dob = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 16 "));
            $phone_result = mysqli_fetch_array(mysqli_query($db,"SELECT wp_ea_fields.value, iv, enc_key FROM wp_ea_fields WHERE app_id='$appt_id' AND field_id = 8 "));
            if(!empty($phone_result['iv']) && !empty($phone_result['enc_key'])){
                $enc_phone = base64_decode($phone_result['value']);
                $iv = base64_decode($phone_result['iv']);
                $encryption_key = base64_decode($phone_result['enc_key']);
                $decrypted_phone = openssl_decrypt($enc_phone, 'AES-256-CBC', $encryption_key, 0, $iv);
                $phone = $this->pkcs7_unpad($decrypted_phone);
            } else {
                $phone = "N/A";
            }
               if(!empty($dob['iv']) && !empty($dob['enc_key'])){
                $enc_dob = base64_decode($dob['value']);
                $iv = base64_decode($dob['iv']);
                $encryption_key = base64_decode($dob['enc_key']);
                $decrypted_dob = openssl_decrypt($enc_dob, 'AES-256-CBC', $encryption_key, 0, $iv);
                $birth_date = $this->pkcs7_unpad($decrypted_dob);
            } else {
                $birth_date = "N/A";
            }
            $date = date("d-m-Y g:i A", strtotime("{$row['date']} {$row['start']}"));
            $birth = date('d-m-Y', strtotime($birth_date));
            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $fname.' '.$sname;
            $sub_array[] = $gender;
            // $sub_array[] = $birth;
            $sub_array[] = $phone;
            $sub_array[] = $email;
            $sub_array[] = $date;
            $sub_array[] = $row["id"];
            // $sub_array[] = $row["status"];
            $sub_array[] = '<div class="actions">'.$status.'</div>';
            $data[] = $sub_array;
        }
        $output = array(
            "recordsTotal"      =>  $filtered_rows,
            "data"              =>  $data
        );
        if (!empty($output)) {
            return $output;
        } else {
            $response = "No data available";
            return $response; 
        }
        mysqli_close($db);
    }
    
    /**
     * Count payment for PSI clinics only
     */
    public function countPaymentAppointments() {
        $db = $this->conn;
        $timezone = date_default_timezone_set('Africa/Nairobi');
        $currentDate = date('Y-m-d', time());
        $currentTime = date('G:i:s', time());
        $telemed_sql = "SELECT COUNT(*) AS appointments, SUM(price) AS total_price FROM `wp_ea_appointments` INNER JOIN wp_ea_staff ON wp_ea_appointments.worker = wp_ea_staff.id INNER JOIN white_labling_facilities ON wp_ea_appointments.facility_id = white_labling_facilities.facility_id WHERE wp_ea_appointments.telemed_status IN('Paid','Ongoing') AND wp_ea_appointments.date >= '$currentDate'";
        $telemed_statement = mysqli_query($db, $telemed_sql)or die(mysqli_error());
        while($row = mysqli_fetch_array($telemed_statement)) {
            $sub_array = array();
            $sub_array['app_total'] = $row["appointments"];
            $sub_array['app_sum'] = $row["total_price"];
            $data[] = $sub_array;
        } 
        if (!empty($data)) {
            return $data;
        } else {
            $response = 0;
            return $response;
        }
        mysqli_close($db);
    }

}
 
?>