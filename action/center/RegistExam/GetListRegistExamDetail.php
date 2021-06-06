<?php 
	// Lấy danh sách các ca thi theo đợt thi gần nhất
	session_start();
	include '../../../config.php';
	// lấy những thằng có IsRegistAll = 1
	$sql = "SELECT r.*,r1.* FROM registexamdetail r INNER JOIN registexam r1 on r.RegistExamID = r1.RegistExamID WHERE r1.IsRegistAll = 1 ORDER BY r1.UnitRegist DESC, r.UnitExam";
	/*$sql = "SELECT r.*,r1.* FROM registexamdetail r INNER JOIN registexam r1 on r.RegistExamID = r1.RegistExamID inner join (SELECT if( max(r.ExamDate)< CURRENT_TIMESTAMP ,null, r.RegistExamID) as RegistExamID , max(r.ExamDate) from registexamdetail r GROUP BY r.RegistExamID) r2 on r1.RegistExamID = r2.RegistExamID  ORDER BY r.UnitExam";*/
	$query = mysqli_query($conn, $sql);

		$listRegistExam = [];
		if(mysqli_num_rows($query) > 0){
			while ($row = mysqli_fetch_array($query)) {
				array_push($listRegistExam, $row);
			}
			echo json_encode($listRegistExam);
		}
		

 ?>