<?php 
// hàm này để lấy dữ liệu thông tin thí sinh cho cục khảo thí
	include '../../config.php';

		if(isset($_POST['accountID'])){	

		$accountID = $_POST['accountID'];

		$sql = "SELECT * FROM accountdetail WHERE AccountID = '$accountID'";
		$query = mysqli_query($conn, $sql);

		if(mysqli_num_rows($query) > 0){

			$dataAccountDetail = mysqli_fetch_array($query);
			echo json_encode($dataAccountDetail);
		}
	}

 ?>