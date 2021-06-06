<?php 
// hàm lấy danh sách group đăng ký tài khoản
	include '../../config.php';

	$sql = "SELECT DISTINCT account.GroupDate from account WHERE account.AccountType = 2 ORDER BY account.AccountDate DESC";
	$query = mysqli_query($conn, $sql);
	$listGroupAccount = [];

	$listGroupAccount = array();
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query)) {
			array_push($listGroupAccount, $row);
		}
		echo json_encode($listGroupAccount);
	}

 ?>