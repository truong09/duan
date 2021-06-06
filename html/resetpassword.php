<?php 
session_start();
 ?>
<!DOCTYPE html> 
<html> 
	<head> 
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="../css/resetpassword.css">
		<title>Đặt lại mật khẩu</title>
	</head>
<body class="reset_password">
	<div class="logo">
		<img src="../images/common/Logo-VNU-1995.jpg" style="max-width:390px;height:auto;">
		<p class="web-name">Đăng ký thi đánh giá năng lực</p>
		<p class="web-name">Đại học Quốc gia Hà Nội</p> 
		<h1>VNU<small>test center</small></h1>
	</div>
	<div class="rspw-form">
			<form action="../action/repassword_submit.php" method="POST">
			<h1>Đặt lại mật khẩu</h1>
			<?php 	
						if(isset($_SESSION["notice"])){
							echo '<div class="alert">
								<span class="closebtn">&times;</span>' 
								.$_SESSION["notice"].
								'</div>';
							unset($_SESSION['notice']);
						}
			?>	
			<div class="form-element">
				<label for="email">Email:</label>
				<input type="text" id="email" name="email">
				<p>Nhập email bạn đã đăng ký</p>
			</div>
			<div class="form-element">
				<button type="submit" name="submit" id="submit">Gửi</button>
			</div>
			<div class="back-link">
				<a href="../html/signin.php"><< Quay lại</a>
			</div>
		</form>  
		</div>
	</div>
</body>
<script>
$("#submit").click(function () { 
	if(validateEmail($("#email").val())) return true;
	else{
		alert("Sai định dạng email");
		return false;
	}
});

validateEmail = email => {
	var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}	
</script>
</html>