<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['limoncon']) || $_SESSION['limoncon']!=TRUE) {
		header('Location: ../../index.php');
		exit(0);
	}
	include("../assets/php/database_functions.php");
	include("../assets/php/user_functions.php");

	$database = new database_functions;
	$update = new user_functions;

	$userID = $update->lookup_credential($database, "username", $_SESSION['username']);

	$motd = $_POST['mood'];
	$skype = $_POST['skype'];
	$birthday = $_POST['birthday'];
	$profile_pic = $_POST['profile_pic'];

	if(empty($profile_pic)) {
		$profile_pic = "img/profile/default.jpg";
	}

	$conn = $database->database_connect();
	$database->update_in_database($conn, "lsm_user_details", "ssssi", array("motd", "skype", "birthday", "profile_picture"), array($motd, $skype, $birthday, $profile_pic), array('id='), array($userID));