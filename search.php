<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	session_start();
	$edit_button = FALSE;

	$search_text = "";
	if(isset($_POST['search_text']) && isset($_SESSION['username']) && isset($_SESSION['limoncon'])) {
		if($_SESSION['limoncon'] == TRUE) {
			$search_text = $_POST['search_text'];
			$_SESSION['location'] = "search.php";
		}
		else {
			header ("http://foxsdenmc.com/src/php/logout.php");
			exit(0);
		}
		
	}
	else {
		header ("http://foxsdenmc.com/src/php/logout.php");
		exit(0);
	}
	

	include("src/assets/php/database_functions.php");
	include("src/assets/php/user_functions.php");

	$database = new database_functions;
	$search = new user_functions;

	$search_result_array = $search->search_user($database, $search_text);

	//var_dump($search_result_array);

	include("html/modules/head.html.php");

	include("html/search.html.php");
	
	include("src/js/chatbox_script.php");
	
	include("src/js/element_script.php");

	include("html/modules/footer.html.php");