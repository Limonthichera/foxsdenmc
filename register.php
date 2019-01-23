<?php
	session_start();

	if(isset($_SESSION['error'])){
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}
	else {
		$error=[
			'username' => 0,
			'mail' => 0,
			'password' => 0,
			'in_game_name' => 0,
			're_password' => 0,
			'username_register' => 0,
			'mail_register' => 0
		];
	}

	if(!isset($_SESSION['limoncon']) || $_SESSION['limoncon']==FALSE || isset($_SESSION['username'])) {
		session_destroy();
		session_start();
	}
	include("html/modules/head.html.php");
	include("html/register.html.php");
	include("html/modules/footer.html.php");
	
	