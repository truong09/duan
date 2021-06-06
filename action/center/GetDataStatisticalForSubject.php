<?php 
// lấy dữ liệu theo tổ hợp môn học

	session_start();
	include '../../config.php';

	$Subject1 = $_POST["Subject1"];

	$Subject2 = $_POST["Subject2"];
	$Subject3 = $_POST["Subject3"];

	$SumSubject = $_POST["SumSubject"];

	$sql = "SELECT YEAR(accountdetail.AccountDate) as 'Year', COUNT(accountdetail.AccountID) as 'Number' FROM accountdetail WHERE $Subject1 + $Subject2 + $Subject3 >= $SumSubject GROUP BY YEAR(accountdetail.AccountDate) ORDER BY YEAR(accountdetail.AccountDate) DESC";
	
	$query = mysqli_query($conn, $sql);
	$listGroupAccount = array();
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query)) {
			array_push($listGroupAccount, $row);
		}
		echo json_encode($listGroupAccount);
	}
 ?>