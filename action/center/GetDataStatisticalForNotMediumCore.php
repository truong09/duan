<?php 
  	session_start();
	include '../../config.php';

	$Grade = $_POST["Grade"];
	$MediumCore = $_POST["MediumCore"];
	// lấy dữ liệu thống kê theo điểm trung bình những học sinh không đạt điều kiện
	$sql = "";
	switch ($Grade) {
		case 10: 
			# code...
			$sql = "SELECT YEAR(accountdetail.AccountDate) as 'Year', COUNT(accountdetail.AccountID) as 'Number' FROM accountdetail WHERE accountdetail.TBGrade10 = 0 OR accountdetail.TBGrade10 < $MediumCore GROUP BY YEAR(accountdetail.AccountDate) ORDER BY YEAR(accountdetail.AccountDate) DESC";
			break;
		case 11: 
		$sql = "SELECT YEAR(accountdetail.AccountDate) as 'Year', COUNT(accountdetail.AccountID) as 'Number'FROM accountdetail WHERE accountdetail.TBGrade11 = 0 OR accountdetail.TBGrade11 < $MediumCore GROUP BY YEAR(accountdetail.AccountDate) ORDER BY YEAR(accountdetail.AccountDate) DESC";
			break;
		case 12:
		$sql = "SELECT YEAR(accountdetail.AccountDate) as 'Year', COUNT(accountdetail.AccountID) as 'Number'FROM accountdetail WHERE accountdetail.TBGrade12 = 0 OR accountdetail.TBGrade12 < $MediumCore GROUP BY YEAR(accountdetail.AccountDate) ORDER BY YEAR(accountdetail.AccountDate) DESC";
			break;
		default:
			# code...
		$sql = "";
			break;
	}

	$query = mysqli_query($conn, $sql);
	$listGroupAccount = array();
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query)) {
			array_push($listGroupAccount, $row);
		}
		echo json_encode($listGroupAccount);
	}


 ?>