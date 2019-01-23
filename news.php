<?php
	session_start();
	$_SESSION['location'] = "news.php";

	include("src/assets/php/database_functions.php");
	include("src/assets/php/user_functions.php");

	$database = new database_functions;
	$news = new user_functions;

	if(!isset($_SESSION['limoncon']) || !isset($_SESSION['username'])) {
		$username = "guest";
		$logged = FALSE;
	}
	else {
		$username = $_SESSION['username'];
		$logged = TRUE;
		$admin = $news->valid_admin_code($database, $username, $_SESSION["admin_code"]);
	}

	$last_10_updates_array = $news->get_n_announcements($database, $username, 1, 10);

	include("html/modules/head.html.php");
	include("html/news.html.php");

	//include("html/modules/chatbox.html.php");
	include("src/js/chatbox_script.php");

	include("src/js/element_script.php");

	include("html/modules/footer.html.php");