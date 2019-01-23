<?php
//error_reporting(E_ALL);
//ini_set('display_errors','On');
//include('database_connect.php');
include ("../../assets/php/database_functions.php");
$database = new database_functions;
$conn = $database->database_connect();
session_start();

$select_query = "SELECT username, send_date, message FROM chatbox
	ORDER BY id DESC LIMIT 15";

$chat_obj = $conn->query($select_query);

//$chat_list = array();
$content = "<table class='table table-striped'><tbody>";
while($row = $chat_obj->fetch_assoc()){
	//$chat_list[] = $row;
	$content .= "<tr><td title='".$row['send_date']."'><h5>";
	if(strtolower($row['username']) != strtolower($_SESSION['username'])) {
		$content .= "<b><a href='profile.php?user=".
			$row['username']."'>".$row['username']."</a></b></h5>&nbsp;&nbsp;".$row['message']."</td></tr>";
	}
	else {
		$content .= "<b>Me</b></h5>&nbsp;&nbsp;".$row['message']."</td></tr>";
	}

}
$content.= "</tbody></table>";

$conn->close();
echo json_encode($content);
?>
