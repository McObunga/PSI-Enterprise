<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'myhealth_database');
	
	// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
?>