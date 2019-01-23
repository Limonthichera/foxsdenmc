<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	session_start();

	session_destroy();

	session_start();

	$_SESSION['limoncon'] = TRUE;

	//extract credentials from POST 
    $username = $_POST['username'];
	$mail_address = $_POST['mail_address'];

	$in_game_name = $_POST['in_game_name'];

	$b_day = $_POST['b_day'];
	$b_month = $_POST['b_month'];
	$b_year = $_POST['b_year'];
	
    $password = $_POST['password'];
	$re_password = $_POST['re_password'];

	//start register object with connection to database
	include("../assets/php/user_functions.php");
	include("../assets/php/database_functions.php");
	$database = new database_functions;
	$register = new user_functions;

	//set errors
    $error=[
		'username' => 0,
		'mail' => 0,
		'password' => 0,
		'in_game_name' => 0,
		'in_game_name_register' => 0,
		're_password' => 0,
		'username_register' => 0,
		'mail_register' => 0
	];

	$conf_code = rand(10000, 99999);
	$error = $register->register_user($database, $username, $mail_address, $in_game_name, $password, $re_password, $b_day, $b_month, $b_year, $conf_code, $error);
	
	if ($error['username']==true || $error['mail']==true || $error['password']==true || $error['in_game_name']==true || $error['in_game_name_register']==true || $error['re_password']==true || $error['username_register']==true || $error['mail_register']==true) {
		$_SESSION['error'] = $error;
	}

	else {
		$register->send_confirmation_mail($mail_address, $username, $in_game_name, $conf_code);
		$_SESSION['success']=1;
		header('Location:../../index.php');
		exit(0);
	}

	header('Location:../../register.php');
	exit(0);