<?php 
	// cập nhật thông tin ca thi

	session_start();
	include '../../../config.php';

	$JDetailUpdate = $_POST["JDetailUpdate"];
	$JDetailInsert= $_POST["JDetailInsert"];
	$JDetailDelete= $_POST["JDetailDelete"];
	if($JDetailUpdate!=""){
		$dataUpdate = json_decode($JDetailUpdate, true);
		foreach ($dataUpdate as $row1) {
			$sql = "UPDATE registexamdetail s SET s.ExamDate = '".$row1["ExamDate"]."',s.ExameeMax = '".$row1["ExameeMax"]."',s.Location ='".$row1["Location"]."', s.UnitExam = '".$row1["UnitExam"]."', s.ExamTime = '".$row1["ExamTime"]."' WHERE s.RegistExamDetailID = '".$row1["RegistExamDetailID"]."' ";
			$query = mysqli_query($conn, $sql);
			echo $query;
		}

	}

	if($JDetailInsert!=""){

		$dataInsert= json_decode($JDetailInsert, true);
		// duyệt mảng insert vào bảng detail
	foreach ($dataInsert as $row2 ) {
		$registExamDetailID = bin2hex(openssl_random_pseudo_bytes(16));

		$sql2 = "INSERT INTO registexamdetail(RegistExamDetailID, RegistExamID,  ExamDate, Examee, ExameeMax, Location,IsRegist, UnitExam, ExamTime) 
			VALUES(
			'$registExamDetailID',
			'".$row2["RegistExamID"]."',
			'".$row2["ExamDate"]."',
			0,
			'".$row2["ExameeMax"]."',
			'".$row2["Location"]."',
			0,
			'".$row2["UnitExam"]."', 
			'".$row2["ExamTime"]."'
			)";
		$query2 = mysqli_query($conn, $sql2);
		echo $query2;
	}

	}
	if($JDetailDelete!=""){

		$dataDelete= json_decode($JDetailDelete, true);

		foreach ($dataDelete as $row3 ) {
			$sqlDelete = "DELETE FROM registexamdetail WHERE RegistExamDetailID = '".$row3["RegistExamDetailID"]."'";
			$queryDelete = mysqli_query($conn, $sqlDelete);

			echo $queryDelete;

		}
	}
 ?>