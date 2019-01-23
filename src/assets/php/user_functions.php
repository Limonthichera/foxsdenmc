<?php
	class user_functions {
		function valid_admin_code($database, $username, $adminCode) {
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);
			$stmt = $database->select_from_database($conn,"lsm_admin_code",array("id"),"ii",array("userID=", "adminCode="),array($userID, $adminCode));
			//var_dump($stmt);
			$stmt->bind_result($foundID);
			if ($stmt->fetch()) {
				return TRUE;
			}
			else {
				return FALSE;
			}
		}

		function validate_login($database, $mail_address, $password, $error) {
			if(!filter_var($mail_address, FILTER_VALIDATE_EMAIL)){
				$error['mail_address'] = 1;
			}

			if(strlen($password)<6 || strlen($password)>36){
				$error['password'] = 1;
			}

			$conn = $database->database_connect();

			$array_of_selected_rows = array("password");
			$array_of_rows = array("mail_address=");
			$array_of_values = array($mail_address);

			$stmt = $database->select_from_database($conn,"lsm_user_list",$array_of_selected_rows,"s",$array_of_rows,$array_of_values);
			//var_dump($stmt);
			$stmt->bind_result($foundID);
			$stmt->fetch();
			$stmt->close();	

			if(!$foundID || !password_verify($password, $foundID)) {
				$error['credentials'] = 1;
			}
			else {
				$array_of_selected_rows = array("confCode");
				$array_of_rows = array("mail_address=");
				$array_of_values = array($mail_address);

				$stmt = $database->select_from_database($conn,"lsm_user_list",$array_of_selected_rows,"s",$array_of_rows,$array_of_values);
				//var_dump($stmt);
				$stmt->bind_result($foundID);
				$stmt->fetch();
				$stmt->close();	

				/*if($foundID!=0) {
					$error['confirm'] = 1;
				}*/
			}
			$conn->close();
			return $error;
		}

		function lookup_credential($database, $credential_name, $credential) {
			$conn = $database->database_connect();

			$array_of_selected_rows = array("id");
			$array_of_rows = array($credential_name."=");
			$array_of_values = array($credential);

			$stmt = $database->select_from_database($conn,"lsm_user_list",$array_of_selected_rows,"s",$array_of_rows,$array_of_values);
			$stmt->bind_result($foundID);
			$stmt->fetch();
			$stmt->close();	
			if($foundID) return $foundID;
			return false;
		}

		function register_user($database, $username, $mail_address, $in_game_name, $password, $re_password, $b_day, $b_month, $b_year, $conf_code, $error) {
			$conn = $database->database_connect();

			$username = strtolower($username);
			
			if($this->lookup_credential($database, "username", $username)) {
				$error['username_register'] = 1;
			}
			if($this->lookup_credential($database, "mail_address", $mail_address)) {
				$error['mail_register'] = 1;
			}
			if($this->lookup_credential($database, "in_game_name", $in_game_name)) {
				$error['in_game_name_register'] = 1;
			}

			if(strlen($username)<6 || strlen($username)>36) {
				$error['username'] = TRUE;
			}

			if(strlen($in_game_name)<3 || strlen($in_game_name)>16) {
				$error['in_game_name'] = TRUE;
			}

			if (!filter_var($mail_address, FILTER_VALIDATE_EMAIL)) {
			  	$error['mail'] = TRUE;
			}

			if(strlen($password)<6 || strlen($password)>36) {
				$error['password'] = TRUE;
			}

			if($password != $re_password) {
				$error['re_password'] = TRUE;
			}

			if ($error['username']==true || $error['mail']==true || $error['password']==true || $error['in_game_name']==true || $error['in_game_name_register']==true || $error['re_password']==true || $error['username_register']==true || $error['mail_register']==true) {
				return $error;
			}

			//insert in lsm_user_list
			$array_of_rows = array("username", "mail_address", "in_game_name", "password", "confCode");
			$array_of_values = array($username, $mail_address, $in_game_name, password_hash($password, PASSWORD_BCRYPT), $conf_code);
			$database->insert_to_database($conn, "lsm_user_list", "ssssi", $array_of_rows, $array_of_values);

			//find user id
			$userID = $this->lookup_credential($database, "username", $username);

			//format date
			if($b_day < 10) {
				$b_day = "0".$b_day;
			}
			
			switch($b_month) {
				case "January":
					$b_month = 1;
					break;
				case "Februray":
					$b_month = 2;
					break;
				case "March":
					$b_month = 3;
					break;
				case "April":
					$b_month = 4;
					break;
				case "May":
					$b_month = 5;
					break;
				case "June":
					$b_month = 6;
					break;
				case "July":
					$b_month = 7;
					break;
				case "August":
					$b_month = 8;
					break;
				case "September":
					$b_month = 9;
					break;
				case "October":
					$b_month = 10;
					break;
				case "November":
					$b_month = 11;
					break;
				case "December":
					$b_month = 12;
					break;
			}
			$birthday = $b_year."-".$b_month."-".$b_day;

			//insert in lsm_user_details
			$array_of_rows = array("id", "birthday");
			$array_of_values = array($userID, $birthday);
			$database->insert_to_database($conn, "lsm_user_details", "is", $array_of_rows, $array_of_values);
			$database->insert_to_database($conn, "lsm_user_view_permissions", "i", array("id"), array($userID));
		}

		function send_confirmation_mail($mail_address, $username, $in_game_name, $conf_code) {

			$message = "Welcome to the Fox's Den, ".$username."!\r\nIn-Game Name: ".$in_game_name."\r\nConfirm your e-mail here:\r\nhttp://foxsdenmc.com/confirm_mail.php?username=".$username."&confCode=".$conf_code;

			$headers = "From: contact@foxsdenmc.com";
			$msg = wordwrap($message ,70);
			
			mail($mail_address, "Confirm e-mail address", $msg, $headers);
		}

		function check_friend_status($database, $username, $target_username) {
			$conn = $database->database_connect();
			$userID_1 = $this->lookup_credential($database, "username", $username);
			$userID_2 = $this->lookup_credential($database, "username", $target_username);

			$array_of_selected_rows = array("confirmed");
			$item_types = "ii";
			$array_of_rows = array("id1=", "id2=");
			$array_of_values = array($userID_1, $userID_2);

			$stmt = $database->select_from_database($conn, "lsm_friend_list", $array_of_selected_rows, $item_types, $array_of_rows, $array_of_values);
			$stmt->bind_result($confirmed);
			$exists_in_database = $stmt->fetch(); 
			$stmt->close();	

			if($exists_in_database) {
				if($confirmed == 1) return 1; //are friends
				if($confirmed == 0) return 2; //friend request sent
			}
			else { //let's check if there is a pending friend request from the other user
				$array_of_selected_rows = array("confirmed");
				$item_types = "ii";
				$array_of_rows = array("id1=", "id2=");
				$array_of_values = array($userID_2, $userID_1);

				$stmt = $database->select_from_database($conn, "lsm_friend_list", $array_of_selected_rows, $item_types, $array_of_rows, $array_of_values);
				$stmt->bind_result($confirmed);
				$exists_in_database = $stmt->fetch(); 
				$stmt->close();	

				if($exists_in_database) return 3; //user has a friend request from this guy
				return 4; //not friends at all
			}
		}

		function create_friend_list($database, $username) {
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);
			$select_friend_id_query = "SELECT id2 FROM lsm_friend_list WHERE id1 = $userID AND confirmed = 1";
			$select_friend_id_result = $conn->query($select_friend_id_query);

			$friend_array = array();

			while($result = $select_friend_id_result->fetch_assoc()) {
				$select_username_query = "SELECT username FROM lsm_user_list WHERE id =".$result['id2'];
				$select_name_pic_query = "SELECT profile_picture, number_of_friends FROM lsm_user_details WHERE id =".$result['id2'];

				$sel_res = $conn->query($select_username_query);
				$username = $sel_res->fetch_assoc();
				$username = $username['username'];

				$sel_res = $conn->query($select_name_pic_query);
				$name = $sel_res->fetch_assoc();
				$profile_pic = $name['profile_picture'];
				$number_of_friends = $name['number_of_friends'];

				$friend_array[$username] = array('username'=>$username, 'profile_pic'=>$profile_pic, 'name'=>$username, 'number_of_friends'=>$number_of_friends);
			}

			return $friend_array;
		}

		function create_friend_id_list($database, $username) {
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);
			$select_friend_id_query = "SELECT id2 FROM lsm_friend_list WHERE id1 = $userID AND confirmed = 1";
			$select_friend_id_result = $conn->query($select_friend_id_query);

			$friend_array = array(); $i=0;

			while($result = $select_friend_id_result->fetch_assoc()) {
				$friend_array[$i] = $result['id2']; 
				$i++;
			}

			return $friend_array;
		}

		function create_personal_news_list($database, $username, $user_profile, $friend_status, $s_point, $e_point) {
			//$s_point for starting point; $e_point for ending point
			$userID = $this->lookup_credential($database, "username", $user_profile);

			$myID = $this->lookup_credential($database, "username", $username);
			$limit = $e_point - $s_point + 1;
			$conn = $database->database_connect();
			$news_list = array();
			$news_list['news'] = array();
			$counter = 0;

			$profile_picture_query = "SELECT profile_picture  FROM lsm_user_details WHERE id = $userID";
			$select_obj = $conn->query($profile_picture_query);
			$profile_picture = $select_obj->fetch_assoc();
			$profile_picture = $profile_picture['profile_picture'];
			//if $friend_status is 0 then it's personal profile, if it's 1 then it's friend profile, otherwise it's public profile
			if($friend_status ==0) {
				$select_query = "SELECT *  FROM lsm_user_posts
					WHERE id_poster = $userID
					ORDER BY id DESC
					LIMIT $limit OFFSET $s_point";
				$select_obj = $conn->query($select_query);
				while($res = $select_obj->fetch_assoc()) {
					$counter++;
					if($counter == 11) {
						break;
					}

					$select_like_query = "SELECT * FROM lsm_user_post_upvotes WHERE userID = $myID AND postID = ".$res['id'];
					$select_like_obj = $conn->query($select_like_query);
					if($select_like_obj->fetch_assoc()) {
						$like = TRUE;
					}
					else {
						$like = FALSE;
					}

					$select_dislike_query = "SELECT * FROM lsm_user_post_downvotes WHERE userID = $myID AND postID = ".$res['id'];
					$select_dislike_obj = $conn->query($select_dislike_query);
					if($select_dislike_obj->fetch_assoc()) {
						$dislike = TRUE;
					}
					else {
						$dislike = FALSE;
					}

					$news_list['news'][$res['id']] = array(
						"id" => $res['id'],
						"like" => $like,
						"dislike" => $dislike,
						"username" => $user_profile,
						"profile_picture" => $profile_picture,
						"title" => $res['post_title'],
						"date" => $res['post_date'],
						"text" => $res['post_text'],
						"n_o_upvotes" => $res['number_of_upvotes'],
						"n_o_downvotes" => $res['number_of_downvotes'],
						"n_o_comments" => $res['number_of_comments']
						);
					
				}
				if($counter == 11) {
					$news_list['can_load'] = TRUE;
				}
				else {
					$news_list['can_load'] = FALSE;
				}
			}
			elseif($friend_status ==1) {
				$select_query = "SELECT *  FROM lsm_user_posts
					WHERE id_poster = $userID AND view_permission = 2
					ORDER BY id DESC
					LIMIT $limit OFFSET $s_point";
				$select_obj = $conn->query($select_query);
				while($res = $select_obj->fetch_assoc()) {
					$counter++;
					if($counter == 11) {
						break;
					}

					$select_like_query = "SELECT * FROM lsm_user_post_upvotes WHERE userID = $myID AND postID = ".$res['id'];
					$select_like_obj = $conn->query($select_like_query);
					if($select_like_obj->fetch_assoc()) {
						$like = TRUE;
					}
					else {
						$like = FALSE;
					}

					$select_dislike_query = "SELECT * FROM lsm_user_post_downvotes WHERE userID = $myID AND postID = ".$res['id'];
					$select_dislike_obj = $conn->query($select_dislike_query);
					if($select_dislike_obj->fetch_assoc()) {
						$dislike = TRUE;
					}
					else {
						$dislike = FALSE;
					}

					$news_list['news'][$res['id']] = array(
						"id" => $res['id'],
						"like" => $like,
						"dislike" => $dislike,
						"username" => $user_profile,
						"profile_picture" => $profile_picture,
						"title" => $res['post_title'],
						"date" => $res['post_date'],
						"text" => $res['post_text'],
						"n_o_upvotes" => $res['number_of_upvotes'],
						"n_o_downvotes" => $res['number_of_downvotes'],
						"n_o_comments" => $res['number_of_comments']
						);
					
				}
				if($counter == 11) {
					$news_list['can_load'] = TRUE;
				}
				else {
					$news_list['can_load'] = FALSE;
				}
			}
			else {
				$select_query = "SELECT *  FROM lsm_user_posts
					WHERE id_poster = $userID AND (view_permission = 2 OR view_permission = 1) 
					ORDER BY id DESC
					LIMIT $limit OFFSET $s_point";
				$select_obj = $conn->query($select_query);
				while($res = $select_obj->fetch_assoc()) {
					$counter++;
					if($counter == 11) {
						break;
					}

					$select_like_query = "SELECT * FROM lsm_user_post_upvotes WHERE userID = $myID AND postID = ".$res['id'];
					$select_like_obj = $conn->query($select_like_query);
					if($select_like_obj->fetch_assoc()) {
						$like = TRUE;
					}
					else {
						$like = FALSE;
					}

					$select_dislike_query = "SELECT * FROM lsm_user_post_downvotes WHERE userID = $myID AND postID = ".$res['id'];
					$select_dislike_obj = $conn->query($select_dislike_query);
					if($select_dislike_obj->fetch_assoc()) {
						$dislike = TRUE;
					}
					else {
						$dislike = FALSE;
					}

					$news_list['news'][$res['id']] = array(
						"id" => $res['id'],
						"like" => $like,
						"dislike" => $dislike,
						"username" => $user_profile,
						"profile_picture" => $profile_picture,
						"title" => $res['post_title'],
						"date" => $res['post_date'],
						"text" => $res['post_text'],
						"n_o_upvotes" => $res['number_of_upvotes'],
						"n_o_downvotes" => $res['number_of_downvotes'],
						"n_o_comments" => $res['number_of_comments']
						);
					
				}
				if($counter == 11) {
					$news_list['can_load'] = TRUE;
				}
				else {
					$news_list['can_load'] = FALSE;
				}
			}
			return $news_list;
		}

		function create_home_news_list($database, $username, $s_point, $e_point) {
			
			$limit = $e_point - $s_point + 1;
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);

			$myID = $this->lookup_credential($database, "username", $username);

			$select_query = "SELECT *  FROM lsm_user_posts
					WHERE id_poster = $userID";
			
			$friend_id_list = $this->create_friend_id_list($database, $username);
			if(!empty($friend_id_list)) {
				$select_query .= " OR ((view_permission = 1 OR view_permission = 2) AND id_poster IN (";
				foreach ($friend_id_list as $friend_id) {
					$select_query .= $friend_id . ",";
				}
				$select_query = rtrim($select_query, ",");
				$select_query .= "))";
			}
			
			
			$select_query .= " OR view_permission = 2 ORDER BY id DESC
					LIMIT $limit OFFSET $s_point";
			$select_obj = $conn->query($select_query);

			//var_dump($select_query);

			$counter = 0;
			$news_list = array();
			$news_list['news'] = array();

			while($res = $select_obj->fetch_assoc()) {
				$counter++;
				if($counter == 11) {
					break;
				}

				$select_like_query = "SELECT * FROM lsm_user_post_upvotes WHERE userID = $myID AND postID = ".$res['id'];
				$select_like_obj = $conn->query($select_like_query);
				if($select_like_obj->fetch_assoc()) {
					$like = TRUE;
				}
				else {
					$like = FALSE;
				}

				$select_dislike_query = "SELECT * FROM lsm_user_post_downvotes WHERE userID = $myID AND postID = ".$res['id'];
				$select_dislike_obj = $conn->query($select_dislike_query);
				if($select_dislike_obj->fetch_assoc()) {
					$dislike = TRUE;
				}
				else {
					$dislike = FALSE;
				}

				$query_username = "SELECT username FROM lsm_user_list WHERE id = ".$res['id_poster'];
				$query_name = "SELECT profile_picture FROM lsm_user_details WHERE id = ".$res['id_poster'];

				$sel_obj_username = $conn->query($query_username);
				$sel_obj_name = $conn->query($query_name);

				$post_result_username = $sel_obj_username -> fetch_assoc();
				$post_result_name = $sel_obj_name -> fetch_assoc();

				$news_list['news'][$res['id']] = array(
					"id" => $res['id'],
					"like" => $like,
					"dislike" => $dislike,
					"username" => $post_result_username['username'],
					"profile_picture" => $post_result_name['profile_picture'],
					"title" => $res['post_title'],
					"date" => $res['post_date'],
					"text" => $res['post_text'],
					"n_o_upvotes" => $res['number_of_upvotes'],
					"n_o_downvotes" => $res['number_of_downvotes'],
					"n_o_comments" => $res['number_of_comments']
				);
				
			}
			if($counter == 11) {
				$news_list['can_load'] = TRUE;
			}
			else {
				$news_list['can_load'] = FALSE;
			}

			return $news_list;
		}

		function build_friendly_date_time($rowdate){
			//--------------------------------------------------USES TIMESTAMP
			$temp_date = str_replace("-", "", $rowdate);
			$return_str = "";

   			if(substr($temp_date, 0, 8) == date("Ymd")) {
				$return_str .= "Today at ".substr($rowdate, -8, 5); //echo date("Y-m-d H:m:s");
	  		}//yyyy-mm-dd hh:mm:ss

			elseif(substr($rowdate, 0, 4) == date("Y")) {
				$return_str .= substr($rowdate, 8, 2)." ";
				$post_month = substr($rowdate, 5, 2);
				switch($post_month) {
					case "01":
						$return_str .= "January";
						break;
					case "02":
						$return_str .= "Februray";
						break;
					case "03":
						$return_str .= "March";
						break;
					case "04":
						$return_str .= "April";
						break;
					case "05":
						$return_str .= "April";
						break;
					case "06":
						$return_str .= "June";
						break;
					case "07":
						$return_str .= "July";
						break;
					case "08":
						$return_str .= "August";
						break;
					case "09":
						$return_str .= "September";
						break;
					case "10":
						$return_str .= "October";
						break;
					case "11":
						$return_str .= "November";
						break;
					case "12":
						$return_str .= "December";
						break;
				}
				$return_str .= " at ".substr($rowdate, -8, 5);
			}

			else {
				$return_str .= substr($rowdate, 8, 2)." ";
				$post_month = substr($rowdate, 5, 2);
				switch($post_month) {
					case "01":
						$return_str .= "January";
						break;
					case "02":
						$return_str .= "Februray";
						break;
					case "03":
						$return_str .= "March";
						break;
					case "04":
						$return_str .= "April";
						break;
					case "05":
						$return_str .= "April";
						break;
					case "06":
						$return_str .= "June";
						break;
					case "07":
						$return_str .= "July";
						break;
					case "08":
						$return_str .= "August";
						break;
					case "09":
						$return_str .= "September";
						break;
					case "10":
						$return_str .= "October";
						break;
					case "11":
						$return_str .= "November";
						break;
					case "12":
						$return_str .= "December";
						break;
				}
				$return_str .= substr($rowdate, 0, 4);
				$return_str .= " at ".substr($rowdate, -8, 5);
			}
			return $return_str;
		}

		function get_poster_id($database, $postID) {
			$conn = $database->database_connect();
			$table_name = "lsm_user_posts";

			$array_of_selected_rows = array("id_poster");
			$item_types = "i";

			$array_of_rows = array("id=");
			$array_of_values = array($postID);

			$stmt = $database->select_from_database($conn, $table_name, $array_of_selected_rows, $item_types, $array_of_rows, $array_of_values);
			$stmt->bind_result($posterID);
			$stmt->fetch();
				
			
			return $posterID;
		}

		function close_tags($html) {
		  	#put all opened tags into an array
		  	preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
		  	$openedtags = $result[1];
			 
		  	#put all closed tags into an array
		  	preg_match_all('#</([a-z]+)>#iU', $html, $result);
		  	$closedtags = $result[1];
		  	$len_opened = count($openedtags);
		  	# all tags are closed
		  	if (count($closedtags) == $len_opened) {
			    return $html;
		  	}
		  	$openedtags = array_reverse($openedtags);
		  	# close tags
		  	for ($i=0; $i < $len_opened; $i++) {
			    if (!in_array($openedtags[$i], $closedtags)){
		      		$html .= '</'.$openedtags[$i].'>';
		    	} 
		    	else {
		      		unset($closedtags[array_search($openedtags[$i], $closedtags)]);
		    	}
		  	}
		  	return $html;
		}

		function search_user($database, $search_text, $limit=FALSE) {
			$search_text = trim($search_text);
			$search_array = explode(" ", $search_text);
			$result_array = array();
		
			//select where 2 words match
			$array_of_where_values = array();
			$value_count = -1;
			$item_types = "";

			$select_by_name_query = "SELECT id FROM lsm_user_list WHERE ";
			for($current = 0 ; $current <= count($search_array) - 1 ; $current ++) {			//take all values and match them like 1-1 1-2 1-3 2-2 2-3 3-3
				for($sub_current = $current ; $sub_current <= count($search_array) - 1 ; $sub_current++) {
					//add a module
					$select_by_name_query .= "(username LIKE ? AND in_game_name LIKE ?)";
					//number of "?"-s
					$value_count ++; 
					$array_of_where_values[$value_count] = "%".$search_array[$current]."%"; //add the value for the respective (first) "?" in the array
					$item_types .= "s";

					$value_count ++;
					$array_of_where_values[$value_count] = "%".$search_array[$sub_current]."%"; //add the value for the respective (second) "?" in the array
					$item_types .= "s";

					if($sub_current < count($search_array) - 1) { //add the "OR"-s only when they will not be last in the string to avoid removing them later
						$select_by_name_query .= " OR ";
					}
				}
				if($current < count($search_array) - 1) { //add the "OR"-s only when they will not be last in the string to avoid removing them later
					$select_by_name_query .= " OR ";
				}
			}

			if($limit) {
				$select_by_name_query .= " LIMIT $limit";
			}

			$conn = $database->database_connect();

			$stmt = $database->select_from_database_query_given($conn, $select_by_name_query, $item_types, $array_of_where_values); //die();
			$stmt->bind_result($foundID);

			$card = -1;
			$foundID_array = array();
			while($stmt->fetch()) {
				$card++;
				$foundID_array[$card] = $foundID;
			}

			unset($foundID); 				
			$stmt->close();	

			//select where only a word matches

			$select_by_name_query = "SELECT id FROM lsm_user_list WHERE ";
			$item_types = "";
			$array_of_where_values = array();
			$value_count = -1;

			for($current = 0 ; $current <= count($search_array) - 1 ; $current ++) {
				$select_by_name_query .= "username LIKE ? OR in_game_name LIKE ?";
				$value_count ++; 
				$array_of_where_values[$value_count] = "%".$search_array[$current]."%"; //add the value for the respective (first) "?" in the array
				$item_types .= "s";

				$value_count ++; 
				$array_of_where_values[$value_count] = "%".$search_array[$current]."%"; //add the value for the respective (second) "?" in the array
				$item_types .= "s";

				if($current < count($search_array) - 1) { //add the "OR"-s only when they will not be last in the string to avoid removing them later
					$select_by_name_query .= " OR ";
				}
			}

			if($limit) {
				$limit = $limit - count($foundID_array);
				$select_by_name_query .= " LIMIT $limit";
			}
			$stmt = $database->select_from_database_query_given($conn, $select_by_name_query, $item_types, $array_of_where_values); //die();
			$stmt->bind_result($foundID);

			while($stmt->fetch()) {
				$doExecute = TRUE;
				foreach($foundID_array as $foundROW) {
					if($foundROW == $foundID) {
						$doExecute = FALSE;
					}
				}
				if($doExecute == TRUE) {
					$card++;
					$foundID_array[$card] = $foundID;
				}
			}

			unset($foundID);			
			$stmt->close();	

			//finish selectind ID-s

		    foreach($foundID_array as $foundID) {
		    	//var_dump($foundID);
		    	$select_username_query = "SELECT username, in_game_name FROM lsm_user_list WHERE id = $foundID";
		    	$select_profile_query = "SELECT profile_picture, number_of_friends FROM lsm_user_details WHERE id = $foundID";

				$select_username_obj = $conn->query($select_username_query);
				$username_array = $select_username_obj->fetch_assoc();

		    	$select_profile_obj = $conn->query($select_profile_query);
		    	$profile_array = $select_profile_obj->fetch_assoc();

		    	$in_game_name = $username_array["in_game_name"];

		    	$result_array[$username_array["username"]] = array("username"=>$username_array["username"], "name"=>$in_game_name, "profile_picture"=>$profile_array["profile_picture"], "number_of_friends"=>$profile_array["number_of_friends"]);
		    }
		    return $result_array;
		
		}

		function create_ticket_list($database, $username, $ticket_var) {
			$conn = $database->database_connect();
			$ticket_array = array();
			$ticket_array["tickets"] = array(); var_dump($ticket_array);echo"<br/><br/>";

			if($ticket_var == "no_session") {
				$ticket_array["session"] = "no_session";
			} 
			elseif($ticket_var == "user_session") {
				$ticket_array["session"] = "user_session";

				$array_of_selected_rows = array("id", "title_text", "number_of_replies", "last_reply", "closed");

				$stmt = $database->select_from_database($conn, "lsm_user_tickets", $array_of_selected_rows, "s", array("author="), array($username), " ORDER BY id DESC");
				$stmt->bind_result($id, $title_text, $number_of_replies, $last_reply, $closed);
				while($stmt->fetch())
					$ticket_array["tickets"][$id] = array("id"=>$id, "title_text"=>$title_text, "number_of_replies"=>$number_of_replies, "last_reply"=>$last_reply, "closed"=>$closed);
				$stmt->close();	
			}
			elseif($ticket_var == "admin_session") {
				$ticket_array["session"] = "admin_session";

				$array_of_selected_rows = array("id", "author", "title_text", "number_of_replies", "last_reply", "closed");

				$stmt = $database->select_from_database($conn, "lsm_user_tickets", $array_of_selected_rows, "i", array("closed="), array(0), " ORDER BY id DESC");
				$stmt->bind_result($id, $author, $title_text, $number_of_replies, $last_reply, $closed);
				while($stmt->fetch())
					$ticket_array["tickets"][$id] = array("id"=>$id, "author"=>$author, "title_text"=>$title_text, "number_of_replies"=>$number_of_replies, "last_reply"=>$last_reply, "closed"=>$closed);
				$stmt->close();	
			}
			var_dump($ticket_array);echo"<br/><br/>";
			return $ticket_array;
		}

		function generate_ticket($database, $username, $isAdmin=FALSE, $ticketID) {
			$conn = $database->database_connect();
			//select data for displaying the ticket
			$sel_stmt = $database->select_from_database($conn, "lsm_user_tickets", array("title_text", "long_text", "author", "closed"), "i", array("id="), array($ticketID));

			$sel_stmt->bind_result($ticket_title, $ticket_text, $ticket_author, $ticket_closed);
			$sel_stmt->fetch();

			$sel_stmt->close();


			//kick from page if credentials mismatch
			if($ticket_author!=$username && $isAdmin!=TRUE){
				header('Location:index.php');
				exit(0);
			}

			//select replies to display
			$select_all_replies_query = "SELECT author, long_text
				FROM tickets_no_slim_reply
				WHERE mother_ticket=?";

			$sel_stmt = $database->select_from_database($conn, "lsm_user_tickets_reply", array("author", "long_text"), "i", array("ticketID="), array($ticketID));

			$sel_stmt->bind_result($reply_author, $reply_text);

			$reply_array = array();

			$i = -1;

			while($sel_stmt->fetch()) {
				$i++;
				$reply_array[$i] = array("author"=>$reply_author, "text"=>$reply_text);
			}
			$sel_stmt->close();

			$result_array = array(array("ticket_title"=>$ticket_title, "ticket_text"=>$ticket_text, "ticket_author"=>$ticket_author, "ticket_closed"=>$ticket_closed), $reply_array);
			return $result_array;
			//var_dump($author_array);echo"<br/>";var_dump($long_text_array);
		}

		function get_public_messages_last_n_days_array($database, $username, $days) {
			$return_array = array();
			$conn = $database->database_connect();
			while($days > 0) {
				$current_date = date('Y-m-d');
				$date = new DateTime($current_date);
				$date->sub(new DateInterval('P'.$days.'D'));
				//var_dump($date->format('Y-m-d'));
				//$days = 0;
				$select_query = "SELECT COUNT(*) FROM chatbox WHERE username = ? AND send_date LIKE '".$date->format('Y-m-d')."%'"; //echo"<br/>";var_dump($select_query);
				unset($date);// echo "<br/>"; //var_dump($date); echo "<br/><br/>";

				$stmt = $database->select_from_database_query_given($conn, $select_query, $item_types = "s", array($username));
				$stmt->bind_result($number_of_entries);
				$stmt->fetch();
				$return_array[$days] = array("n_o_days_ago"=>$days, "n_o_posts"=>$number_of_entries);
				$stmt->close();
				$days--;
			}
			return $return_array;
		}

		function get_private_messages_sent_last_n_days_array($database, $username, $days) {
			$return_array = array();
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);
			while($days > 0) {
				$current_date = date('Y-m-d');
				$date = new DateTime($current_date);
				$date->sub(new DateInterval('P'.$days.'D'));
				//var_dump($date->format('Y-m-d'));
				//$days = 0;
				$select_query = "SELECT COUNT(*) FROM lsm_private_chatbox WHERE senderID = $userID AND send_date LIKE '".$date->format('Y-m-d')."%'"; //echo"<br/>";var_dump($select_query);
				unset($date);// echo "<br/>"; //var_dump($date); echo "<br/><br/>";

				$select_obj = $conn->query($select_query);
				$select_array = $select_obj->fetch_assoc();
				
				$return_array[$days] = array("n_o_days_ago"=>$days, "n_o_posts"=>$select_array["COUNT(*)"]);
				
				$days--;
			}
			return $return_array;
		}

		function get_private_messages_recieved_last_n_days_array($database, $username, $days) {
			$return_array = array();
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);
			while($days > 0) {
				$current_date = date('Y-m-d');
				$date = new DateTime($current_date);
				$date->sub(new DateInterval('P'.$days.'D'));
				//var_dump($date->format('Y-m-d'));
				//$days = 0;
				$select_query = "SELECT COUNT(*) FROM lsm_private_chatbox WHERE recieverID = $userID AND send_date LIKE '".$date->format('Y-m-d')."%'"; //echo"<br/>";var_dump($select_query);
				unset($date);// echo "<br/>"; //var_dump($date); echo "<br/><br/>";

				$select_obj = $conn->query($select_query);
				$select_array = $select_obj->fetch_assoc();
				
				$return_array[$days] = array("n_o_days_ago"=>$days, "n_o_posts"=>$select_array["COUNT(*)"]);
				
				$days--;
			}
			return $return_array;
		}

		function get_upvotes_recieved_last_n_weeks_array($database, $username, $weeks) {
			$return_array = array();
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);
			$days = $weeks * 7;
			while($weeks > 0) {
				$weekly_count = 0;
				for($days = 1; $days <= 7; $days++) {
					$current_date = date('Y-m-d');
					$date = new DateTime($current_date);
					$days_to_substract = $weeks * 7 - $days;
					$date->sub(new DateInterval('P'.$days_to_substract.'D'));
					
					$select_query = "SELECT COUNT(*) FROM lsm_user_post_upvotes WHERE posterID = $userID AND upvote_date LIKE '".$date->format('Y-m-d')."%'"; //echo"<br/>";var_dump($select_query);
					unset($date);// echo "<br/>"; //var_dump($date); echo "<br/><br/>";

					$select_obj = $conn->query($select_query);
					$select_array = $select_obj->fetch_assoc();

					$weekly_count += $select_array["COUNT(*)"];
				}
				
				
				$return_array[$weeks] = array("n_o_weeks_ago"=>$weeks-1, "n_o_upvotes"=>$weekly_count);
				
				$weeks--;
			}
			return $return_array;			
		}

		function get_downvotes_recieved_last_n_weeks_array($database, $username, $weeks) {
			$return_array = array();
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);
			$days = $weeks * 7;
			while($weeks > 0) {
				$weekly_count = 0;
				for($days = 1; $days <= 7; $days++) {
					$current_date = date('Y-m-d');
					$date = new DateTime($current_date);
					$days_to_substract = $weeks * 7 - $days;
					$date->sub(new DateInterval('P'.$days_to_substract.'D'));
					
					$select_query = "SELECT COUNT(*) FROM lsm_user_post_downvotes WHERE posterID = $userID AND downvote_date LIKE '".$date->format('Y-m-d')."%'"; //echo"<br/>";var_dump($select_query);
					unset($date);// echo "<br/>"; //var_dump($date); echo "<br/><br/>";

					$select_obj = $conn->query($select_query);
					$select_array = $select_obj->fetch_assoc();

					$weekly_count += $select_array["COUNT(*)"];
				}
				
				
				$return_array[$weeks] = array("n_o_weeks_ago"=>$weeks-1, "n_o_downvotes"=>$weekly_count);
				
				$weeks--;
			}
			return $return_array;			
		}

		function count_upvotes_and_downvotes($database, $username) {
			$return_array = array();
			$conn = $database->database_connect();
			$userID = $this->lookup_credential($database, "username", $username);

			//count downvotes		
			$select_query = "SELECT COUNT(*) FROM lsm_user_post_downvotes WHERE posterID = $userID"; //echo"<br/>";var_dump($select_query);

			$select_obj = $conn->query($select_query);
			$select_array = $select_obj->fetch_assoc();

			$return_array['downvotes'] = $select_array["COUNT(*)"];

			//count upvotes
			$select_query = "SELECT COUNT(*) FROM lsm_user_post_upvotes WHERE posterID = $userID"; //echo"<br/>";var_dump($select_query);

			$select_obj = $conn->query($select_query);
			$select_array = $select_obj->fetch_assoc();

			$return_array['upvotes'] = $select_array["COUNT(*)"];
				
			
			return $return_array;
		}

		function get_friend_requests($database, $username) {
			$return_array = array();
			$conn = $database->database_connect;
			$userID = $this->lookup_credential($database, "username", $username);

			$stmt = $database->select_from_database($conn, "lsm_friend_list", array("id1"), "1", array("id2"), array($userID));
			$stmt->bind_result($senderID);
			while($stmt->fetch()) {
				$return_array[$senderID] = $senderID;
			}
				
			$stmt->close();	

		}

		function get_n_announcements($database, $username, $start_point, $number_of_entries) {
			$return_array = array();
			$conn = $database->database_connect();

			$start_point -= 1;

			$select_query = "SELECT *  FROM lsm_news ORDER BY id DESC LIMIT $number_of_entries OFFSET $start_point";
			
			$select_object = $conn->query($select_query);

			$counter = -1;

			while($res = $select_object->fetch_assoc()) {
				$counter++;
				$return_array[$counter] = array("id" => $res["id"], "content" => $res["long_text"], "content_short" => $res["short_text"], "author" => $res["author"], "date" => $res["date"]);
			}

			return $return_array;

		}
	}