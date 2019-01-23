WORK IN PROGRESS, WILL BE FUNCTIONAL BY TOMORROW NIGHT<br/><br/><br/><br/>
<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors','On');

	if(!isset($_SESSION['username'])){
		$ticket_var = "no_session";
	} elseif($_SESSION['username'] == "limonthichera") {
		$ticket_var = "admin_session";
		$username = $_SESSION['username'];
	} else {
		$ticket_var = "user_session";
		$username = $_SESSION['username'];
	}

	include("src/assets/php/user_functions.php");
	include("src/assets/php/database_functions.php");
	$database = new database_functions;
	$ticket = new user_functions;

	$ticket_list = $ticket->create_ticket_list($database, $username, $ticket_var);
	var_dump($ticket_list);

	include('html/contact.html.php');
	
?>