<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	session_start();

	if(!isset($_SESSION['limoncon']) || !isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit(0);
	}
	else {
		$_SESSION['location'] = "profile.php";
	}

	$username = $_SESSION['username'];
	$user_profile = $_GET['user'];

	include("src/assets/php/user_functions.php");
	include("src/assets/php/database_functions.php");
	$database = new database_functions;
	$profile = new user_functions;

	$profileID = $profile->lookup_credential($database, "username", $user_profile);

	if(!$profileID) {
		header('Location: profile.php?user='.$username);
		exit(0);
	}

	if(strtolower($username) == strtolower($user_profile)) {
		$edit_button = TRUE;
	}
	else {
		$edit_button = FALSE;
		$friend_status = $profile->check_friend_status($database, $username, $user_profile);
		//var_dump($friend_status);
	}

	/*
	*Friend status:
	* 1 - are friends
	* 2 - friend request sent
	* 3 - friend request recieved
	* 4 - not friends
	*In the lsm_user_view_permissions table:
	* 0 - only me
	* 1 - friends
	* 2 - everyone
	*/


	$conn = $database->database_connect();
	$table_name = "lsm_user_details";
	$array_of_selected_rows = array("profile_picture", "motd", "skype", "birthday", "number_of_friends", "rank");

	$item_types = "i";
	$array_of_rows = array("id=");
	$array_of_values = array($profileID);

	$stmt = $database->select_from_database($conn, $table_name, $array_of_selected_rows, $item_types, $array_of_rows, $array_of_values);
	$stmt->bind_result($profile_picture, $mood, $skype, $birthday, $number_of_friends, $rank_number);
	$stmt->fetch();
	$stmt->close();


	switch ($rank_number) {
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
		case 1:
			$rank_name = "Builder";
			$rank_color = "#2a2a2a";
			$rank_complement_color = "#151515";
			break;
	}



	$array_of_selected_rows = array("in_game_name");

	$item_types = "i";
	$array_of_rows = array("id=");
	$array_of_values = array($profileID);

	$stmt = $database->select_from_database($conn, "lsm_user_list", $array_of_selected_rows, $item_types, $array_of_rows, $array_of_values);
	$stmt->bind_result($in_game_name);
	$stmt->fetch();
	$stmt->close();



	$table_name = "lsm_user_view_permissions";
	$array_of_selected_rows = array("profile_picture", "motd", "skype", "birthday");

	$item_types = "i";
	$array_of_rows = array("id=");
	$array_of_values = array($profileID);

	$stmt = $database->select_from_database($conn, $table_name, $array_of_selected_rows, $item_types, $array_of_rows, $array_of_values);
	$stmt->bind_result($perm_profile_picture, $perm_mood, $perm_skype, $perm_birthday);
	$stmt->fetch();
	$stmt->close();

	$friend_array = $profile->create_friend_list($database, $user_profile);

	if($edit_button == TRUE) {
		$post_array = $profile->create_personal_news_list($database, $username, $user_profile, 0, 0, 10);
	}
	else {
		$post_array = $profile->create_personal_news_list($database, $username, $user_profile, $friend_status, 0, 10);
	}
	//if its 0 then it's personal profile, if it's 1 then it's friend profile, otherwise it's public profile
	//$post_array = $profile->create_personal_news_list($database, $username, $user_profile, $friend_status, 0, 10);

	//var_dump($post_array);

	include("html/modules/head.html.php");
	include("html/profile.html.php");
	//include("html/modules/chatbox.html.php");
	if($edit_button == TRUE) include("src/js/chatbox_script.php");
	else include("src/js/private_chatbox_script.php");
	include("src/js/profile_script.php");
	include("src/js/element_script.php");

	include("html/modules/footer.html.php");
