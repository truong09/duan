<?php 
// lấy nội dung thông báo cho sinh viên
	include '../../config.php';
	session_start();
	$sql = "SELECT * FROM newfeed r ORDER BY r.NewFeedID DESC";
	$query = mysqli_query($conn, $sql);
	$listNewFeed = [];
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query)) {
			array_push($listNewFeed, $row);
		}
		echo json_encode($listNewFeed);
	}

 ?>