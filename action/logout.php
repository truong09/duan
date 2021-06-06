<?php 
	session_start();
	unset($_SESSION["AccountID"]);
	unset($_SESSION["Username"]);
	unset($_SESSION["AccountType"]);
	header("location: ../html/signin.php");

 ?>