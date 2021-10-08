<?php
require("PasswordHash.php");
require("connect.php");
session_start();
// variable declaration
$username = "";
$email    = "";
$errors   = array();
$inclusions_version = 66;
// call the login() function if login_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

if (isset($_GET['logout'])) {
	$query_delete_session = mysqli_query($db, "UPDATE wp_users SET current_session = ''  WHERE user_login= '{$_SESSION['psi']['email']}'");
	$_SESSION = array();
	session_destroy();
	$days = 30;
	setcookie("rememberme", "", time() - ($days * 24 * 60 * 60 * 1000));
	setcookie("user_pass", "", time() - 3600);
    die(header("location: login"));
}

if (empty($_SESSION["psi"])) {
	$_SESSION = array();
	session_destroy();
	check_for_remember_me($db);
} else {
	$page_uri = explode("/", $_SERVER["REQUEST_URI"]);
	if (in_array(array_pop($page_uri), ["login", "login.php"]) && check_for_remember_me($db)) die(header("Location: dashboard"));
}

// LOGIN USER
function login() {
	global $db, $username, $errors;
	$msg = '';
	$time = time() - 60;
	$ip_address = getIpAddr();
	$total_count = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total_count FROM loginlogsnew WHERE TryTime > $time AND IpAddress = '$ip_address' "))['total_count'];
	if ($total_count == 5) {
		array_push($errors, "Too many failed login attempts. Please login after 60 sec");
	} else {
		$username = e($_POST['username']);
		$password = e($_POST['password']);
		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		$hasher = new PasswordHash(8, false);
		// attempt login if no errors on form
		if (count($errors) == 0) {
			$results = mysqli_query($db, "SELECT user_pass FROM wp_users WHERE user_login = '$username'");
			if (mysqli_num_rows($results) == 1) {
				$row =  mysqli_fetch_assoc($results);
				if ($hasher->CheckPassword($password, $row["user_pass"])) {
					$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT wp_users.* , wp_ea_staff.*  FROM `wp_users` INNER JOIN `wp_ea_staff` ON wp_users.user_email = wp_ea_staff.email  WHERE user_login='$username' "));
					// store username in cookie, to allow for session resumption by just entering password
					setcookie("user_login", $username, time() + (365 * 24 * 60 * 60));
					if (!empty($_POST["remember"])) {
						// save hashed password in a cookie for future authentication and login without needing entering of credentials manually
						$hashed_password = $row["user_pass"];
						setcookie("user_pass", $hashed_password, time() + (365 * 24 * 60 * 60));
					}
					mysqli_query($db, "DELETE FROM loginlogsnew WHERE IpAddress = '$ip_address'");
					// random request suthentication string
					if (empty($_SESSION['_auth'])) $_SESSION['_auth'] = bin2hex(random_bytes(32));
					header('Location: dashboard');
					$_SESSION['psi'] = $user;
					mysqli_query($db, "UPDATE wp_users SET current_session = '".session_id()."' WHERE user_login= '$username'");
				} else {
					$total_count++;
					$rem_attm = 5 - $total_count;
					if ($rem_attm == 0) {
						array_push($errors, "Too many failed login attempts. Please login after 60 sec.");
					} else {
						array_push($errors, "Please enter valid login details.<br/>$rem_attm attempts remaining.");
					}
					$try_time = time();
					mysqli_query($db, "INSERT INTO loginlogsnew (user_email, IpAddress,TryTime, attempt_date) VALUES('$username', '$ip_address','$try_time', NOW() )");
				}
			} else {
				$total_count++;
				$rem_attm = 5 - $total_count;
				if ($rem_attm == 0) {
					array_push($errors, "Too many failed login attempts. Please login after 60 sec.");
				} else {
					array_push($errors, "Please enter valid login details.<br/>$rem_attm attempts remaining.");
				}
				$try_time = time();
				mysqli_query($db, "INSERT INTO loginlogsnew (user_email, IpAddress,TryTime, attempt_date) VALUES('$username', '$ip_address','$try_time', NOW() )");
			}
		}
	}
}
// Getting IP Address
function getIpAddr() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ipAddr = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ipAddr = $_SERVER['REMOTE_ADDR'];
	}
	return $ipAddr;
}

function isLoggedIn() {
	if (isset($_SESSION['psi'])) {
		return true;
	} else {
		return false;
	}
}
// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error(){
	global $errors;
	if (count($errors) > 0) {
		echo '<div class="errorz">';
		foreach ($errors as $error) {
			echo $error . '<br>';
		}
		echo '</div>';
	}
}

function authenticate_request() {
	/**
	 * checks request headers and data to determine if it's a valid request. Valid requests should have a session set, a session authentication token, and an authentication token included with the request POST or GET data
	 * function can be extended to handle calls from external sources that will not have session set (if/when the day comes)
	 * 
	 * @return boolean
	 */

	global $db;

	if (
		session_status() !== PHP_SESSION_ACTIVE // session isn't active
		|| (empty($_SESSION["psi"]) && !check_for_remember_me($db)) // session variables not set, and persistent authentication not enabled
		|| empty($_SESSION["_auth"]) // session authentication token not set
		|| !(isset($_POST["token"]) || isset($_GET["token"])) // request authentication token not set
	) return false;

	$auth_token = isset($_POST["token"]) ? $_POST["token"] : $_GET["token"];
	if (!$auth_token == $_SESSION["_auth"]) return false; // request csrf token doesn't match session csrf token

	return true;
}

function check_for_remember_me(\mysqli $db){
	/**
	 * checks authentication cookies set when user clicks 'remember me'
	 * 	-> If they are present and valid, the user's data is stored in the session and they can continue to load pages.
	 * 	-> If they are absent or invalid, the user is redirected to login page
	 * 
	 * should ideally be ran when session has expired, i.e. $_SESSION['psi'] are empty, to check if the user's credentials are stored in the browser before logging them out
	 * 
	 * @return boolean whether the user can be allowed to log in without entering credentials
	 */
	$is_authenticated = false;

	if (!(empty($_COOKIE["user_login"]) || empty($_COOKIE["user_pass"]))) {
		$user_login = $_COOKIE["user_login"];
		$user_password = $_COOKIE["user_pass"];

		$user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM wp_users WHERE user_login = '$user_login'"));

		$password_match = $user_data["user_pass"] == $user_password;

		if ($password_match) {
			$_SESSION["psi"] = $user_data;
			createOMPSession($user_login, $db);
			$is_authenticated = true;
		}
	}

	return $is_authenticated;
}

function createOMPSession(string $user_login, \mysqli $db) {
	/**
	 * Creates session for user whose username is passed to function, and populates session variables.
	 * 
	 * @param string $user_login username for user whose session to create
	 * 
	 * @return void
	 */

	session_start();
	$session_id = session_id();
	$ip_address = getIpAddr();
	$doctor_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM wp_ea_staff WHERE email = '$user_login'"));
	mysqli_query($db, "DELETE FROM loginlogsnew WHERE IpAddress = '$ip_address'");
	mysqli_query($db, "UPDATE wp_users SET current_session = '$session_id' WHERE user_login = '$user_login'");

	if (empty($_SESSION["psi"])) {
		$_SESSION["psi"] = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM wp_users WHERE user_login = '$user_login'"));
	}
	$_SESSION["psi"] = $doctor_data;
	$_SESSION["_auth"] = bin2hex(random_bytes(32));
}