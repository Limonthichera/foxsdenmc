<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
session_start();
if(isset($_SESSION['username']) && $_SESSION['limoncon'] == TRUE /*&& isset($_POST['post_id'])*/) {
	$postID = $_POST['post_id'];
	include("../assets/php/database_functions.php");
	$database = new database_functions;
	include("../assets/php/user_functions.php");
	$upvote = new user_functions;

	$userID = $upvote->lookup_credential($database, "username", $_SESSION['username']);

	$conn = $database->database_connect();
	$table = "lsm_user_post_upvotes";

	$stmt = $database->select_from_database($conn, $table, array("postID"), "ii", array("userID=", "postID="), array($userID, $postID));
	$stmt->bind_result($rowID1);
	$stmt->fetch();
	$stmt->close();	

	if($rowID1) {
		if(!$database->delete_from_database($conn, $table, "ii", array("userID=", "postID="), array($userID, $postID))) {
			echo "Unable to remove upvote, will not continue.<br/>";
			$continue = FALSE;
		}
		else {
			//select number of upvotes...
			$table = "lsm_user_posts";

			$stmt = $database->select_from_database($conn, $table, array("number_of_upvotes"), "i", array("id="), array($postID));
			$stmt->bind_result($number_of_upvotes);
			$stmt->fetch();
			$stmt->close();	

			$number_of_upvotes --;
			//...and decrease it by one
			$database->update_in_database($conn, $table, "ii", array("number_of_upvotes"), array($number_of_upvotes), array("id="), array($postID));
			$continue = TRUE;
			echo "Removed upvote successfully, will procceed to downvoting.<br/>";
		}
	}
	else {
		$continue = TRUE;
		echo "No upvote to remove, will procceed to downvoting<br/>";
	}

	if($continue == TRUE) {
		$table = "lsm_user_post_downvotes";

		$stmt = $database->select_from_database($conn, $table, array("postID"), "ii", array("userID=", "postID="), array($userID, $postID));
		//var_dump($stmt);
		$stmt->bind_result($rowID2);
		$stmt->fetch();
		$stmt->close();	

		//if there already is an downvote, remove it
		if($rowID2) {
			echo "Detected already existent downvote. Removing downvote...<br/>";
			if($database->delete_from_database($conn, $table, "ii", array("userID=", "postID="), array($userID, $postID))) {
				echo "Removed downvote successfully<br/>";
				//select number of downvotes...
				$table = "lsm_user_posts";

				$stmt = $database->select_from_database($conn, $table, array("number_of_downvotes"), "i", array("id="), array($postID));
				$stmt->bind_result($number_of_downvotes);
				$stmt->fetch();
				$stmt->close();	

				$number_of_downvotes --;
				//...and decrease it by one
				$database->update_in_database($conn, $table, "ii", array("number_of_downvotes"), array($number_of_downvotes), array("id="), array($postID));
			}
		}
		//else add a downvote
		else {
			echo "Adding downvote...<br/>";
			$table = "lsm_user_post_downvotes";
			$posterID = $upvote->get_poster_id($database, $postID);
			if($database->insert_to_database($conn, $table, "iii", array("userID", "postID", "posterID"), array($userID, $postID, $posterID))) {
				//select number of downvotes...
				$table = "lsm_user_posts";

				$stmt = $database->select_from_database($conn, $table, array("number_of_downvotes"), "i", array("id="), array($postID));
				$stmt->bind_result($number_of_downvotes);
				$stmt->fetch();
				$stmt->close();	

				$number_of_downvotes ++;
				//...and increase it by one
				if($database->update_in_database($conn, $table, "ii", array("number_of_downvotes"), array($number_of_downvotes), array("id="), array($postID))) {
					echo "Added downvote successfully.<br/>";
				}
			}
		}
	}

} 
else {
	echo "Do not try to hack the system, you will be banned.<br/>";
}