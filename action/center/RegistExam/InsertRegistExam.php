<?php 
  // insert đợi thi mới 
	session_start();
	include '../../../config.php';
	$unitRegist = $_POST["UnitRegist"];
	$createYear = $_POST["CreateYear"];
	$JDetail = $_POST["JDetail"];
	
	$registExamID= bin2hex(openssl_random_pseudo_bytes(16));
	// insert id vào bảng master 
    $sql = "INSERT INTO registexam(RegistExamID, IsRegistAll, CreateYear, UnitRegist) VALUES ('$registExamID', 1, $createYear, $unitRegist)";
    $query = mysqli_query($conn, $sql);

    // json table ra mảng
	$data = json_decode($JDetail, true);

	// duyệt mảng insert vào bảng detail
	foreach ($data as $row ) {
		$registExamDetailID = bin2hex(openssl_random_pseudo_bytes(16));

		$sql = "INSERT INTO registexamdetail(RegistExamDetailID, RegistExamID,  ExamDate, Examee, ExameeMax, Location,IsRegist, UnitExam, ExamTime) 
			VALUES(
			'$registExamDetailID',
			'$registExamID',
			'".$row["ExamDate"]."',
			0,
			'".$row["ExameeMax"]."',
			'".$row["Location"]."',
			0,
			'".$row["UnitExam"]."', 
			'".$row["ExamTime"]."'
			)";
		$query = mysqli_query($conn, $sql);
	}
	echo json_encode($query);

 ?>