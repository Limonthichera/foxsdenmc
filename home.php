<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	session_start();

	if(!isset($_SESSION['limoncon']) || !isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit(0);
	}
	else {
		$_SESSION['location'] = "home.php";
	}

	include("src/assets/php/database_functions.php");
	include("src/assets/php/user_functions.php");

	$database = new database_functions();
	$homepg = new user_functions();
	//session_destroy();
	//var_dump($_SESSION); die();

	$post_array = $homepg->create_home_news_list($database, $_SESSION['username'], 0, 10);
	//var_dump($post_array);

	include("html/modules/head.html.php");
	include("html/home.html.php");

	//include("html/modules/chatbox.html.php");
	include("src/js/chatbox_script.php");

	include("src/js/element_script.php");

	include("html/modules/footer.html.php");
?>