<?php 
	// hàm post thông báo
	include '../../config.php';
	session_start();
	$accountID = $_SESSION["AccountID"];
	$title = $_POST['title'];

	$content = $_POST['content'];

	$createdDate = date('Y-m-d H:i:s');
	$sql = "INSERT INTO newfeed(Title,Content,CreatedDate ) VALUES('$title', '$content', '$createdDate')";
	$query = mysqli_query($conn, $sql);

	echo $query;

 ?>