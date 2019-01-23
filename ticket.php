<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors','On');

	if(!isset($_SESSION['limoncon']) || !isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit(0);
	}
	else {
		$_SESSION['location'] = "statistics.php";
	}

	$username = $_SESSION['username'];

	$ticketID=$_GET['id'];

	include("src/assets/php/database_functions.php");
	include("src/assets/php/user_functions.php");

	$database = new database_functions;
	$ticket = new user_functions;

	$isAdmin = FALSE;
	if(isset($_SESSION["admin_code"])) {
		if($ticket->valid_admin_code($database, $_SESSION['username'], $_SESSION["admin_code"])) {
			$isAdmin = TRUE;
		}
	}
	

	$reply_array = $ticket->generate_ticket($database, $username, $isAdmin, $ticketID);

	var_dump($reply_array);
	include("html/modules/head.html.php");
	include('html/ticket.html.php');
	include("src/js/element_script.php");

	include("html/modules/footer.html.php");

?>