<?php
	$conn = new mysqli('localhost', 'limonthichera', 'Kayaba131', 'user');
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
?>