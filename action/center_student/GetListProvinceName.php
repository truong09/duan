<?php 
// lấy danh sách tỉnh binding lên combo
	include '../../config.php';

	$sql = "SELECT ProvinceName FROM province ORDER BY province.ProvinceID";

	$result = mysqli_query($conn, $sql);

	$dataRegist = array();

	if(mysqli_num_rows($result)>0){
		while ($data = mysqli_fetch_array($result)) {
			array_push($dataRegist, $data);
		}
		echo json_encode($dataRegist);
	}


 ?>