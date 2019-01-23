<?php
	session_start();
	$error = array('mail_address' =>0, 'password' =>0, 'credentials' =>0, 'confirm' =>0);
	if(isset($_SESSION['error'])){
		$error = $_SESSION['error'];
		session_destroy();
		session_start();
	}
	include("html/modules/head.html.php");
	include("html/login.html.php");
	include("html/modules/footer.html.php");