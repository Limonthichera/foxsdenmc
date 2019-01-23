<?php
	//2250 linii cod la 15:06 pe 03.08.2016
	//2600 linii cod la 14:04 pe 05.08.2016
	//3560 linii cod la 17:20 pe 17.08.2016
	//4140 linii cod la 12:10 pe 24.08.2016
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	//echo phpversion();
	session_start();//var_dump($_SESSION);

	if(!isset($_SESSION['limoncon']) || $_SESSION['limoncon']==FALSE) {
		session_destroy();
		session_start();
		$_SESSION['limoncon'] = TRUE;
		include("start_page.php");
	}
	else {
		$_SESSION['location'] = "index.php";
		include("start_page.php");
	}