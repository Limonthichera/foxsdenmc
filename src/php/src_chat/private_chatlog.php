<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
//include('database_connect.php');
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['limoncon']) || $_SESSION['limoncon'] != TRUE) {
	header('Location: ../../../index.php');
	exit(0);
}
include ("../../assets/php/database_functions.php");
include ("../../assets/php/user_functions.php");
$user = new user_functions;
$database = new database_functions;
$conn = $database->database_connect();

$userID = $user->lookup_credential($database, "username", $_SESSION['username']);
$targetID = $user->lookup_credential($database, "username", $_POST['target']);

$select_query = "SELECT sender_username, send_date, message, seen 
	FROM lsm_private_chatbox
	WHERE (senderID = ".$userID." AND recieverID = ".$targetID.") 
		OR (senderID = ".$targetID." AND recieverID = ".$userID.")
	ORDER BY id DESC LIMIT 15";

$chat_obj = $conn->query($select_query);
//$chat_list = array();
$content = "<table class='table table-striped'><tbody>";
while($row = $chat_obj->fetch_assoc()){
	//$chat_list[] = $row;
	$content .= "<tr><td title='".$row['send_date']."'><h5>";
	if($row['seen'] == 1 && strtolower($row['sender_username']) == strtolower($_SESSION['username'])) {
		$content .= "<span class='glyphicon glyphicon-ok' aria-hidden='true' title='Seen'></span>&nbsp;";
	}
	if(strtolower($row['sender_username']) != strtolower($_SESSION['username'])) {
		$content .= "<b><a href='profile.php?user=".
			$row['sender_username']."'>".$row['sender_username']."</a></b></h5>&nbsp;&nbsp;".$row['message']."</td></tr>";
	}
	else {
		$content .= "<b>Me</b></h5>&nbsp;&nbsp;".$row['message']."</td></tr>";
	}
}
$content.= "</tbody></table>";

//update the seen status

$update_query = "UPDATE lsm_private_chatbox
	SET seen = 1
	WHERE senderID = $targetID AND recieverID = $userID AND seen = 0";

$conn->query($update_query);

$conn->close();

echo json_encode($content);
?>
