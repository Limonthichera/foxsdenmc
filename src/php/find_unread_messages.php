<?php
	session_start();

	include ("../assets/php/database_functions.php");
	include ("../assets/php/user_functions.php");

	$findID = new user_functions;
	$database = new database_functions;

	if(!isset($_SESSION['username']) || !isset($_SESSION['limoncon']) || $_SESSION['limoncon'] != TRUE) {
		header('Location: ../../index.php');
		exit(0);
	}

	$userID = $findID->lookup_credential($database, "username", $_SESSION['username']);

	$conn = $database->database_connect();

	//select_unread_messages_query
	$select_u_m_query = "SELECT send_date, sender_username 
		FROM lsm_private_chatbox
		WHERE recieverID = $userID AND seen = 0
		ORDER BY id DESC";

	$result_object = $conn->query($select_u_m_query);

	$user_array = array();

	$count = 0;

	while($result = $result_object->fetch_assoc()) {
		$date = $result['send_date'];
		$username = $result['sender_username'];
		$name = $result['sender_username'];

		if(isset($user_array[$username])) {
			$user_array[$username]['number_of_entries']++;
			$user_array[$username]['date'] = $date;
		}
		else {
			$user_array[$username] = array('number_of_entries'=>1, 'name'=>$name, 'username'=>$username);
			$count++;
		}
	}
	$messages = "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>".
		"<span class='glyphicon glyphicon-comment hidden-xs' aria-hidden='true'></span>".
		"<span class='hidden-sm hidden-md hidden-lg'>New Messages&nbsp;</span><span class='badge'>";
	if($count>0) $messages.=$count;
	$messages.= "</span><span class='caret hidden-sm hidden-md hidden-lg'></span></a><ul class='dropdown-menu'>";
	
	foreach($user_array as $user) {
		$messages .= "<li role='separator' class='divider'></li>".
			"<li><a href='http://limonthichera.com/limoncon/profile.php?user=".$user['username'].
			"'><span class='badge'>".$user['number_of_entries']."</span>&nbsp;".$user['name']."</a></li>";
	}

	if($count>0) $messages .="<li role='separator' class='divider'></li>";
	else $messages .= "<li role='separator' class='divider'></li><li><a href=#>No new messages</a></li><li role='separator' class='divider'></li>";

	$messages .= "</ul>";
	                
	echo json_encode($messages);

