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

	    $database->delete_from_database($conn, "lsm_friend_list", "ii", array("id1", "id2"), array($userID, $targetID));
	    $database->delete_from_database($conn, "lsm_friend_list", "ii", array("id1", "id2"), array($targetID, $userID));
	    
	    $conn->close();
	}
    
}
?>