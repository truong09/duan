<?php 

	session_start();
	include '../../config.php';
	$accountID = $_SESSION["AccountID"];
	$accountType = $_SESSION["AccountType"];
	$sql = "SELECT * FROM account WHERE AccountID = '$accountID'";
	$query = mysqli_query($conn, $sql);
	$dataUser = mysqli_fetch_array($query);

	$password = $dataUser["Password"];
	
	$passwordOld = $_POST["passwordOld"];
	$passwordOld = md5($passwordOld);

	$passwordNew = $_POST["passwordNew"];
	$passwordNew = md5($passwordNew);

	$rePassword = $_POST["rePassword"];
	$rePassword = md5($rePassword);
	if(isset($_POST["submit"])){
		if($passwordOld == $password ){
			if($passwordNew == $rePassword ){
				$sql = "UPDATE account SET Password = '$passwordNew' WHERE AccountID ='$accountID'";
				$query = mysqli_query($conn, $sql);
				if($query){
					$_SESSION["notice"] = "Đổi mật khẩu thành công!";
					unset($_SESSION["AccountID"]);
					unset($_SESSION["Username"]);
					unset($_SESSION["AccountType"]);
					header("location: ../../html/signin.php");
				}
				else{
					$_SESSION["notice"] = "Đổi mật khẩu Thất bại!";
					if($accountType==1){
						// về màn hình của admin
						header("location: ../../html/admin/adminChangePassword.php");
					}
					else{
						// về màn hình của sinh viên
						header("location: ../../html/student/studentChangePassword.php");
					}
				}
			}
			else{
				$_SESSION["notice"] = "Mật khẩu nhập lại không khớp!";
				if($accountType==1){
					// về màn hình của admin
					header("location: ../../html/admin/adminChangePassword.php");
				}
				else{
					// về màn hình của sinh viên
					header("location: ../../html/student/studentChangePassword.php");
				}
			}
		}
		else{
			 $_SESSION["notice"] = "Mật khẩu không chính xác!";
			 if($accountType==1){
				// về màn hình của admin
				header("location: ../../html/admin/adminChangePassword.php");
			}
			else{
				// về màn hình của sinh viên
				header("location: ../../html/student/studentChangePassword.php");
			}
		}
	}
 ?>