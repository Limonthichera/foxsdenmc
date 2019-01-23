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

	    $check_query = "SELECT id, confirmed FROM lsm_friend_list
	    	WHERE id1 = ".$targetID." AND id2 = ".$userID;
	    $check_result = $conn->query($check_query);
	    
	    if($check_result){
	    	$result = $check_result->fetch_assoc();
	    	if($result['confirmed']==0) {
	    		$insert_query = "INSERT INTO lsm_friend_list (id1, id2, confirmed) 
					VALUES (".$userID.", ".$targetID.", 1)";
				if($conn->query($insert_query)) {
					$update_query = "UPDATE lsm_friend_list
						SET confirmed = 1
						WHERE id1 = ".$targetID." AND id2 = ".$userID;
					$conn->query($update_query);

					$select_user_1_query = "SELECT number_of_friends FROM lsm_user_details WHERE id=".$userID;
					$select_user_1_result = $conn->query($select_user_1_query);

					$select_user_2_query = "SELECT number_of_friends FROM lsm_user_details WHERE id=".$targetID;
					$select_user_2_result = $conn->query($select_user_2_query);

					$user_1_result = $select_user_1_result->fetch_assoc();
					$user_2_result = $select_user_2_result->fetch_assoc();

					$number_of_friends_1 = $user_1_result['number_of_friends'];
					$number_of_friends_2 = $user_2_result['number_of_friends'];

					$number_of_friends_1 ++;
					$number_of_friends_2 ++;

					$update_query_1 = "UPDATE lsm_user_details SET number_of_friends = $number_of_friends_1 WHERE id=".$userID;
					$update_query_2 = "UPDATE lsm_user_details SET number_of_friends = $number_of_friends_2 WHERE id=".$targetID;

					$conn->query($update_query_1);
					$conn->query($update_query_2);
				}
	    	}
	    }
	    $conn->close();
	}
    
}
?>