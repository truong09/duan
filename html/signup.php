<?php 
session_start();
 ?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/signup.css">
	<link rel="stylesheet" href="../css/topNavBar.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="sign_up">
	<ul class="navbar">
      <li><a class="logo-container" href="student/studentHomepage.php"><img class="logo" src="../images/common/Logo-VNU-1995.jpg" /></a></li>
      <li><div class="web-name">Đăng ký thi đánh giá năng lực</div></li>
    </ul>
	<div class="container">
		<div class="form-container">
			<form action="../action/signup_submit.php" method="POST">
				<h1>Đăng ký tài khoản dự thi</h1>
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
					<label>Tên đăng nhập(*):</label>
					<input required type="text" name="username" id="username">
				</div>
				<div class="form-element">
					<label>Họ và tên(*):</label>
					<input required type="text" name="fullName" id="name">
				</div>
				<div class="form-element">
					<label>Ngày sinh:</label>
					<select type="text" name="year" id="year">
	                </select>Năm
	                <select type="text" name="month" id="month" style="margin-left: 1vw">
	                </select>Tháng
	                <select type="text" name="day" id="day" style="margin-left: 1vw">
	                </select>Ngày
				</div>
				<div class="form-element">
					<label>Giới tính:</label>
					<input name="gender" id="male" type="radio" checked value="Nam" />Nam
				    <input name="gender" id="frmale" type="radio" value="Nữ" />Nữ
				</div>
				<div class="form-element">
					<label>Số điện thoại:</label>
					<input type="text" name="phone" id="phone">
				</div>
				<div class="form-element">
					<label>CMND/CCCD:</label>
					<input type="text" name="cmnd" id="cmnd">
				</div>
				<div class="form-element">
					<label>Địa chỉ:</label>
					<input type="text" name="address" id="address">
				</div>
				<div class="form-element">
					<label>Email:</label>
					<input type="text" name="email" id="email">
				</div>
				<div class="form-element">
					<label>Mật khẩu(*):</label>
					<input required type="password" name="password" id="password">
				</div>
				<div class="form-element">
					<label>Nhập lại mật khẩu(*):</label>
					<input required type="password" name="enterpassword" id="enterpassword">
					<p style="color: red; font-style: italic;">(*) Không được bỏ trống</p>
				</div>
				<div class="form-element">
					<button type="reset" name="exitbtn" id="exitbtn" class="exit-btn">Hủy</button>
					<button type="submit" name="sbmbtn" id="sbmbtn" class="submit-btn" onclick="return validate()">Đăng ký</button>
				</div>
			</form>
		</div>
	</div>
</body>
<script src="../js/daySelectorControl.js"></script>
<script src="../js/signup.js"></script>
</html>