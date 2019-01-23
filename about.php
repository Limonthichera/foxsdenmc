<?php
	session_start();

	if(!isset($_SESSION['limoncon']) || !isset($_SESSION['username'])) {
		$logged = FALSE;
	}
	else {
		$_SESSION['location'] = "about.php";
		$logged = TRUE;
	}


	include("html/modules/head.html.php");

	include("html/about.html.php");
	
	//include("src/js/chatbox_script.php");
	
	include("src/js/element_script.php");

	include("html/modules/footer.html.php");