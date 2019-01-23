<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

session_start();
if(isset($_SESSION['username'])){
    $text = $_POST['text'];

    include ("../../assets/php/database_functions.php");
    $database = new database_functions;
    include ("../../assets/php/user_functions.php");
    $findID = new user_functions;

    $userID = $findID->lookup_credential($database, "username", $_SESSION['username']);

    $conn = $database->database_connect();

    $usernick = $_SESSION['username'];

    $insrt_query = "INSERT INTO chatbox (username, message) 
	VALUES (?, ?)";
	//include('database_connect.php');

	$in_stmt = $conn->stmt_init();
	if($in_stmt->prepare($insrt_query))
	{
		$in_stmt -> bind_param('ss', $usernick, $text);
		echo "Preparing parameters successful<br/>";
		if($in_stmt -> execute())
		{
			echo"Inserting was successful";
		}else{
			echo"Inserting was not successful";
		}
	}else{
		echo"Reset was not succesful";
	} 
    $in_stmt->close();

    //delete old messages
    //die();
    $conn->close();
}
?>