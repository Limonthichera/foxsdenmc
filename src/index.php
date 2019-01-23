<?php 
error_reporting(E_ALL);
ini_set('display_errors','On');

session_start();
if(!isset($_SESSION['username'])){
	include('html/login.html.php');
}
else {
  
  include('html/index.html.php');
}