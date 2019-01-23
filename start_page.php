<?php
	if(!isset($_SESSION['limoncon']) || !isset($_SESSION['username'])) {
		$logged = FALSE;
	}
	else {
		$logged = TRUE;
	}

	include("src/assets/php/database_functions.php");
	include("src/assets/php/user_functions.php");

	$database = new database_functions;

	$conn = $database->database_connect();

	$select_query = "SELECT short_text, author FROM lsm_news ORDER BY id DESC LIMIT 1";

	$res1 = $conn->query($select_query);

	$myrow1 = $res1->fetch_assoc();

	$short_text = $myrow1["short_text"];
	$author = $myrow1["author"];

	$conn->close();
			


	include("html/modules/head.html.php");

	include("html/start_page.html.php");
	
	//include("src/js/chatbox_script.php");
	
	include("src/js/element_script.php");

	include("html/modules/footer.html.php");