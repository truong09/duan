<?php 
	session_start();
	include '../../config.php';
	$accountType = $_SESSION["AccountType"];

	$groupDate = $_POST['GroupDate'];
	// lấy tên, ngày sinh, ngày đăng ký tài khoản

	// chỉ có cục khảo thí mới có quyền xem danh sách tài khoản
	if($accountType == 1){
		$sql = "SELECT acd.AccountID, acd.FullName, acd.DateOfBirth, ac.AccountDate FROM accountdetail acd INNER JOIN account ac ON acd.AccountID = ac.AccountID WHERE ac.AccountType = 2 and ac.GroupDate ='$groupDate' ORDER BY ac.AccountDate DESC";

		$query = mysqli_query($conn, $sql);
		$listRegistAccount = [];
		if(mysqli_num_rows($query) > 0){
			while ($row = mysqli_fetch_array($query)) {
				array_push($listRegistAccount, $row);
			}
			echo json_encode($listRegistAccount);
		}
		

	}


 ?>