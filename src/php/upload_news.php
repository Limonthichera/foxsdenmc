<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

include("../assets/php/database_functions.php");
include("../assets/php/user_functions.php");

$database = new database_functions;
$news = new user_functions;

session_start();
if(isset($_SESSION['username']) && $_SESSION['limoncon'] == TRUE){
	if ($news->valid_admin_code($database, $_SESSION['username'], $_SESSION['admin_code'])) {

		$doc = new DOMDocument();

		$allowed_tags = "<p><a><b><i><u><img><br><br/><table><span><user><tr><th><td>";

	    $title = $news->close_tags($_POST['title']);
	    $title = strip_tags($title, $allowed_tags);

	    $text = $news->close_tags($_POST['text']);
	    $text = strip_tags($text, $allowed_tags);

		$conn = $database -> database_connect();

		$array_of_rows = array("author", "short_text", "long_text");
		$array_of_values = array($_SESSION['username'], $title, $text);

		var_dump($array_of_rows); echo"<br/><br/>";
		var_dump($array_of_values); echo"<br/><br/>";

		$database->insert_to_database($conn, "lsm_news", "sss", $array_of_rows, $array_of_values);

		header('Location:../../news.php');
		exit(0);
	}
	else {
	    echo "Do not try to hack the system, you WILL. be banned.";
	    die();
	}
}
else {
    echo "Do not try to hack the system, you WILL. be banned.";
    die();
}
?>