<?php 
	// mở đăng ký thi
	session_start();
	include '../../../config.php';

	$registExamID = $_POST["RegistExamID"];

	$startedDate = $_POST["startedDate"];
	$finishDate = $_POST["finishDate"];

	$sqlRegist = "UPDATE registexam r SET r.StartedDate = '$startedDate', r.FinishDate = '$finishDate' WHERE r.RegistExamID = '$registExamID'";

	$queryRegist = mysqli_query($conn, $sqlRegist);

	$sql = "UPDATE registexamdetail r set r.StartedDate = '$startedDate', r.FinishDate = '$finishDate', r.IsRegist = 1 WHERE r.RegistExamID = '$registExamID'";
	$query = mysqli_query($conn, $sql);
	echo json_encode($query);
 ?>