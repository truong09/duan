<?php 
	session_start();
 ?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="../css/signin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	
	<div class="login-partial">
		<div class="logo">
			<img src="../images/common/Logo-VNU-1995.jpg" style="max-width:390px;height:auto;">
			<p class="web-name">Đăng ký thi đánh giá năng lực</p>
			<p class="web-name">Đại học Quốc gia Hà Nội</p> 
			<h1>VNU<small>test center</small></h1>
		</div>
		<?php 
			 if(isset($_SESSION["AccountID"])){
				if($_SESSION["AccountType"]==1){
					header("location: ../html/admin/admin.php");
				}else{
					header("location: ../html/student/studentHomePage.php");
				}
			} 
		?>

		<div class="sign-in-form">
			<form action="../action/signin_submit.php" method="POST">
			<h1>Đăng nhập</h1>
				<?php 	
					if(isset($_SESSION["notice"])){
						if($_SESSION["notice"]=="Bạn đã đăng ký thành công"){
							unset($_SESSION['notice']);
						}else if($_SESSION["notice"]=="Đổi mật khẩu thành công!"){
							echo '<script> alert("'.$_SESSION["notice"].'"); </script>';
							unset($_SESSION['notice']);	
						} else {
							echo '<div class="alert">
								<span class="closebtn">&times;</span>' 
								.$_SESSION["notice"].
								'</div>';
							unset($_SESSION['notice']);	
						}	
					}
				 ?>
			
			<div class="form-element">
				<label for="username">Tài khoản:</label>
			<input type="text" id="username" name="username">
			</div>
			<div class="form-element">
				<label for="password">Mật khẩu:</label>
				<input type="password" id="password" name="password">
				<a href="../html/resetpassword.php">Quên mật khẩu?</a>
			</div>
			<div class="form-element">
				<button class="btn-login" type="submit" name="submit">Đăng nhập</button>
			</div>
			<div class="sign-up-suggest">
				Chưa có tài khoản? Đăng ký ngay <a href="../html/signup.php">tại đây</a>
			</div>
		</form>  
		</div>
	</div>


</body>
<script type="text/javascript" src="../js/signin.js"></script>
</html>