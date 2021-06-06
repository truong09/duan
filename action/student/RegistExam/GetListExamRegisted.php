<?php 
	// lấy danh sách các ca thi mà sinh viên đó đã đăng ký
	session_start();
	include '../../../config.php';

	$accountID = $_SESSION["AccountID"];

	$sql = "SELECT * FROM  registexamdetail r INNER JOIN registexaminfor r1 on r.RegistExamDetailID = r1.RegistExamDetailID WHERE r1.AccountID ='$accountID'";
	$query = mysqli_query($conn, $sql);
	$listRegisted = [];
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query)) {
			array_push($listRegisted, $row);
		}
		echo json_encode($listRegisted);
	}
 ?>