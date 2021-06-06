<?php 
	// đóng đăng ký thi
	session_start();
	include '../../../config.php';

	$registExamID = $_POST["RegistExamID"];



	// Đóng bang MasterDATE

	
	$sql = "UPDATE registexam r SET r.IsRegistAll = 0 WHERE r.RegistExamID = '$registExamID' ";
	$query = mysqli_query($conn, $sql);

	// đóng tất cả các ca thi trong đợt thi đó
	/*
	$sql1 = "UPDATE registexamdetail r SET r.IsRegist = 0 WHERE r.RegistExamID = '$registExamID'";

	$query1 = mysqli_query($conn, $sql1);
	*/

	echo json_encode($query);
 ?>