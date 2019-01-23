<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

session_start();
if(isset($_SESSION['username'])){
    $target_username = $_POST['target'];

    include ("../assets/php/database_functions.php");
    $database = new database_functions;
    include ("../assets/php/user_functions.php");
    $findID = new user_functions;

    $userID = $findID->lookup_credential($database, "username", $_SESSION['username']);
    $targetID = $findID->lookup_credential($database, "username", $target_username);

    if($userID && $targetID) {
	    $conn = $database->database_connect();

	    $check_query = "SELECT id FROM lsm_friend_list
	    	WHERE (id1 = $targetID AND id2 = $userID) OR (id2 = $targetID AND id1 = $userID)";
	    $check_result = $conn->query($check_query);
	    $result = $check_result->fetch_assoc();

	    if(!$result){
	    	$insert_query = "INSERT INTO lsm_friend_list (id1, id2) 
				VALUES ($userID, $targetID)";
			$conn->query($insert_query);

	    }
	    $conn->close();
	}
    
}
?>