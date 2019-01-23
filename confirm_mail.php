<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	include("src/assets/php/database_functions.php");
	$database = new database_functions;

	$username = $_GET['username'];
	$confCode = (int)$_GET['confCode'];

	$conn = $database->database_connect();
	$array_of_rows = array("confCode");
	$array_of_values = array(0);

	$array_of_where_rows = array("username=", "confCode=");
	$array_of_where_values = array($username, $confCode);

	$database->update_in_database($conn, "lsm_user_list", "isi", $array_of_rows, $array_of_values, $array_of_where_rows, $array_of_where_values);
	header('Location:index.php');

	exit(0);