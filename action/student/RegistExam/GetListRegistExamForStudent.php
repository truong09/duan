<?php 
	session_start();
	include '../../../config.php';
	$accountID = $_SESSION["AccountID"];
	$dateNow = date("Y-m-d H:i:s");
	// lấy ra danh sách đăng ký thi cho sinh viên
	// IsRegisted là trường đánh dấu ca nào sinh viên đã đăng ký rồi
	// IsEqual là trường đánh dấu nếu số lương sinh viên đăng ký bằng số lượng tối đa thì là false và sẽ hiện ra cảnh báo
	$sql = "SELECT r.*, r2.*, if(r1.AccountID = '$accountID', true, false) as IsRegisted , if(r.Examee = r.ExameeMax , true, false) IsEqual from registexamdetail r LEFT JOIN registexaminfor r1 on r.RegistExamDetailID = r1.RegistExamDetailID and r1.AccountID ='$accountID' INNER JOIN registexam r2 on r.RegistExamID = r2.RegistExamID WHERE r2.IsRegistAll = true and r2.FinishDate >CURRENT_TIMESTAMP ORDER BY r2.CreateYear DESC, r2.UnitRegist DESC, r.UnitExam" ;

	$query = mysqli_query($conn, $sql);
	
	$listRegistExam = [];
		if(mysqli_num_rows($query) > 0){
			while ($row = mysqli_fetch_array($query)) {
				array_push($listRegistExam, $row);
			}
			echo json_encode($listRegistExam);
		}

 ?>