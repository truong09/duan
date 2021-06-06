<?php 
// lấy thống kê theo khu vực
	session_start();
	include '../../config.php';
	
	$StartYear = $_POST["FindYear"]?$_POST["FindYear"]:1;
	$EndYear = $_POST["EndYear"]?$_POST["EndYear"]:1;
	// lấy dữ liệu thống kê theo tỉnh
	$sql = "CALL Pro_GetData_StatisticalForArea($StartYear,$EndYear)";

	$query = mysqli_query($conn, $sql);
	$listGroupAccount = array();
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query)) {
			array_push($listGroupAccount, $row);
		}
		
		echo json_encode($listGroupAccount);
	}

 ?>