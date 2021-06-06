<?php 
// hàm này để lấy danh sách các thí sinh trong 1 ca thi nào đó

   	session_start();
	include '../../../config.php';

	// lấy id của ca thi truyền lên từ client
	$registExamDetailID = $_POST["RegistExamDetailID"];

	// truy vấn lấy ra danh sách sinh viên

	$sql = "SELECT *  from accountdetail ac INNER JOIN registexaminfor r on ac.AccountID = r.AccountID WHERE r.RegistExamDetailID = '$registExamDetailID'";

	$query = mysqli_query($conn, $sql);
	$listRegistExamInfor = [];
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query)) {
			array_push($listRegistExamInfor, $row);
		}
		echo json_encode($listRegistExamInfor);
	}
	// muốn lấy thông tin sv thì gọi hàm GetRegistAccountDetail.php
 ?>