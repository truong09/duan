<?php 
	// hàm cho thí sinh đăng ký thi 
 	session_start();
	include '../../../config.php';

	$accountID = $_SESSION["AccountID"];
	$JDetailRegist = $_POST["JDetailRegist"];
	$JDetailCancel = $_POST["JDetailCancel"];
	$dateNow = date('Y-m-d');
	if($JDetailRegist !=[]){
		$dataRegist = json_decode($JDetailRegist, true);
		foreach ($dataRegist as $row) {
			// tiến hành tăng số lượng thí sinh trong bảng registexamdetail
			
			if(date('Y-m-d', strtotime($row["FinishDate"]))<$dateNow){
				echo "Ngoài thời hạn đăng ký";
			}
			else{
				$updateRegist = "UPDATE registexamdetail r set r.Examee = r.Examee + 1 WHERE r.RegistExamDetailID = '".$row["RegistExamDetailID"]."'";
			$resultUpdate = mysqli_query($conn, $updateRegist);

			// insert thông tin vào bảng registExamInfor

			$insertRegist = "INSERT INTO registexaminfor(AccountID, RegistExamDetailID) VALUES('$accountID','".$row["RegistExamDetailID"]."')";
			$resultInsert = mysqli_query($conn, $insertRegist);
			}
			
		}
		
	}
	if($JDetailCancel!=[]){
		$dataCancel = json_decode($JDetailCancel, true);
	
		foreach ($dataCancel as $row) {
			// tiến hành giảm số lượng thí sinh trong bảng registexamdetail

			if(date('Y-m-d', strtotime($row["FinishDate"]))<$dateNow){
				echo "Ngoài thời hạn đăng ký";
			}else{
				$updateRegist = "UPDATE registexamdetail r set r.Examee = r.Examee - 1 WHERE r.RegistExamDetailID = '".$row["RegistExamDetailID"]."'";
				$resultUpdate = mysqli_query($conn, $updateRegist);

			// Xóa thông tin thí sinh ở bảng registexaminfor
			$deleteRegist = "DELETE FROM registexaminfor WHERE AccountID = '$accountID' and RegistExamDetailID = '".$row["RegistExamDetailID"]."'";
			
			$resultDelete = mysqli_query($conn, $deleteRegist);

			}
			
		}
	}
	

 ?>