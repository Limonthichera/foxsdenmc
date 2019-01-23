<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	session_start();

	session_destroy();

	session_start();

	$_SESSION['limoncon'] = TRUE;

	$mail_address = strtolower($_POST['mail_address']);
	$password = $_POST['password'];

	$error = array('mail_address' =>0, 'password' =>0, 'credentials' =>0, 'confirm' =>0);

	include("../assets/php/user_functions.php");
	include("../assets/php/database_functions.php");
	$database = new database_functions;
	$login = new user_functions;

	$conn = $database->database_connect();

	$error = $login->validate_login($database, $mail_address, $password, $error);

	if($error['mail_address']==0 && $error['password']==0 && $error['credentials']==0 && $error['confirm']==0) {
		$stmt = $database->select_from_database($conn, "lsm_user_list", array("username"), "s", array("mail_address="), array($mail_address));
		$stmt->bind_result($username);
		$stmt->fetch();
		$stmt->close();	

		$_SESSION['username'] = strtolower($username);

		$userID = $login->lookup_credential($database, "username", $username);

		//$_SESSION['first_name'] = $first_name;

		$stmt = $database->select_from_database($conn, "lsm_admin_code", array("adminCode"), "i", array("userID="), array($userID));
		$stmt->bind_result($foundCode);
		if ($stmt->fetch()) {
			$_SESSION["admin_code"] = $foundCode;
		} else {
			$_SESSION["admin_code"] = 0;
		}
		$stmt->close();
	}
	else {
		$_SESSION['error'] = $error;
		header('Location:../../login.php');
		exit(0);
	}
	header('Location:../../index.php');
	exit(0);

