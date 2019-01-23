<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

session_start();
if(isset($_SESSION['username']) && $_SESSION['limoncon'] == TRUE && isset($_POST['view_permission']) && strlen($_POST['text'])>3 && ($_SESSION['location'] == "index.php" || $_SESSION['location'] == "profile.php")){
    include("../assets/php/database_functions.php");
	include("../assets/php/user_functions.php");

    $database = new database_functions;
	$user = new user_functions;
	$doc = new DOMDocument();

	$allowed_tags = "<p><a><b><i><u><img><br><br/><table><span><user><tr><th><td>";

    $title = $user->close_tags($_POST['title']);
    $title = strip_tags($title, $allowed_tags);

    $tag_list = $user->close_tags($_POST['tag_list']);
    $tag_list = strip_tags($tag_list, $allowed_tags);

    $text = $user->close_tags($_POST['text']);
    $text = strip_tags($text, $allowed_tags);

    if ($_POST['view_permission'] == "public") {
    	$view_permission = 2;
    }
    elseif ($_POST['view_permission'] == "friends") {
    	$view_permission = 1;
    }
    elseif ($_POST['view_permission'] == "private") {
    	$view_permission = 0;
    }
    else {
    	echo "Do not try to hack the system, you will be banned.";
    	die();
    }
	
	$userID = $user -> lookup_credential($database, "username", $_SESSION["username"]);

	$conn = $database -> database_connect();

	$array_of_rows = array("id_poster", "post_title", "post_text", "view_permission");
	$array_of_values = array($userID, $title, $text, $view_permission);

	if($database->insert_to_database($conn, "lsm_user_posts", "issi", $array_of_rows, $array_of_values)) {
		//find post id
		$select_query = "SELECT id FROM lsm_user_posts WHERE id_poster = $userID ORDER BY id DESC LIMIT 1";
		$select_obj = $conn->query($select_query);
		$res = $select_obj->fetch_assoc();
		$postID = (int)$res['id']; 
		//insert tags
		$username_tag = explode("@", $tag_list);
		foreach($username_tag as $user_target) {
			$user_target = trim($user_target);
			$user_target = trim($user_target, ",");
			$user_target = trim($user_target);
			$targetID = $user->lookup_credential($database, "username", $user_target);
			if($targetID) {
				if($user->check_friend_status($database, $_SESSION["username"], $user_target) == 1) {
					$array_of_rows = array("id_post", "username_tag");
					$array_of_values = array($postID, $user_target); var_dump($postID);var_dump($user_target);
					$database->insert_to_database($conn, "lsm_user_post_tags", "is", $array_of_rows, $array_of_values);
				}
			}
		}
		header('Location:../../'.$_SESSION['location']);
		exit(0);
	}

}
else {
    echo "Do not try to hack the system, you will be banned.";
    die();
}
?>