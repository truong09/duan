<?php 
	session_start();
?>
<!DOCTYPE html> 
<html lang="vi"> 
	<head> 
		<meta charset="utf-8">
		<link rel="stylesheet" href="../../css/student/studentChangeProfile.css">
		<link rel="stylesheet" href="../../css/topNavBar.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<title>Hồ sơ</title>
	</head>
	<body>
	<?php 
		if(isset($_SESSION["AccountID"])){
			if($_SESSION["AccountType"]==1) header("location: ../admin/admin.php");
		}else{
			header("location: ../signin.php");
		}
	?>
	<?php 
		if(isset($_SESSION["notice"])){
			echo '<script>  alert("'.$_SESSION["notice"].'");</script>';
			unset($_SESSION["notice"]);	
		}
		include './topNavBarStudent.php';  
	?>

		<div class="information">
			<form name="profileForm" id="profileForm" action="../../action/student/UpdateAccountDetail.php" method="post">
				<fieldset>
				    <legend>A.THÔNG TIN CÁ NHÂN</legend>
				    <table>
				    	<tr>
				    		<td>1.Họ, chữ đệm và tên:</td>
				    		<td>
				    			<input type="text" id="fullname" name="fullName" style="width: 200px; height: 18px">
				    		</td>
				    		<td style="padding-left: 50px">2.Giới tính:</td>
				    		<td>
				    			<input id="Nam" name="gender" type="radio" value="Nam" />Nam
				    			<input id="Nữ" name="gender" type="radio" value="Nữ" />Nữ
				    		</td>
				    	</tr>
				    	<tr>
				    		<td>3.Ngày sinh:</td>
				    		<td>
				    			<select style="height: 20px; margin-right: 5px; margin-left: 5px" name="year" id="year">
			                    </select>Năm
			                    <select style="height: 20px; margin-right: 5px; margin-left: 10px" name="month" id="month">
			                    </select>Tháng
			                    <select style="height: 20px; margin-right: 5px; margin-left: 10px" name="day" id="day">
			                    </select>Ngày
				    		</td>
				    		<td style="padding-left: 50px">4.Dân tộc:</td>
				    		<td>
				    			<input type="text" id="race" name="Nation" style="width: 100px; height: 18px">
				    		</td>
				    	</tr>
				    	<tr>
				    		<td>5.CMND/CCCD:</td>
				    		<td>
				    			<input type="text" id="cmnd" name="cmnd" style="width: 200px; height: 18px">
				    		</td>
				    	</tr>
				    	<tr>
				    		<td>6.Hộ khẩu thường trú (Huyện - Tỉnh):</td>
				    		<td>
				    			<input type="text" id="residence" name="PermanentResidence" style="width: 300px; height: 18px">
				    		</td>
				    		<td style="padding-left: 50px">7.Nơi sinh:</td>
				    		<td>
								<select name="ProvinceName" id="placeOfBirth">
									<option value="0"></option>
								</select>
				    		</td>
				    	</tr>
				    </table>
				</fieldset>
				<fieldset>
					<legend>B.THÔNG TIN LIÊN HỆ</legend>
					<table>
						<tr>
							<td>8.Địa chỉ Email:</td>
							<td>
								<input type="text" id="email" name="email" style="width: 250px; height: 18px">
							</td>
						</tr>
						<tr>
							<td>9.Số điện thoại:</td>
							<td>
								<input type="text" id="phone" name="phone" style="width: 150px; height: 18px">
							</td>
						</tr>
						<tr>
							<td>10.Địa chỉ (cụ thể):</td>
							<td>
								<input type="text" id="address" name="address" id="address" style="width: 400px; height: 18px">
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>C.THÔNG TIN PHỤC VỤ THI ĐGNL</legend>
					11.Đối tượng ưu tiên:
					<select style="margin-left: 20px; margin-right: 150px" name="IsPrioritize" id="priority">
						<option value="0"></option>
                        <option value="1">Không ưu tiên</option>
	                    <option value="2">Có ưu tiên</option>
	                </select>
					12.Khu vực:
					<select style="margin-left: 20px" name="Area" id="area">
						<option value="0"></option>
                        <option value="1">KV1</option>
	                    <option value="2">KV2-NT</option>
	                    <option value="3">KV2</option>
	                    <option value="4">KV3</option>
	                </select>
	                <br>
	                13.Trung bình chung học tập:
					<div>
	                <table class="score-table">
	                	<tr>
	                		<th colspan="3">Lớp 10</th>
	                		<th colspan="3">Lớp 11</th>
	                		<th colspan="3">Lớp 12</th>
	                	</tr>
	                	<tr>
	                		<td>
	                			<p>HKI<p>
	                			<input type="number" name="HKIGrade10" id="10hk1" step=0.01>
	                		</td>
	                		<td>
	                			<p>HKII<p>
	                			<input type="number" name="HKIIGrade10" id="10hk2" step=0.01>
	                		</td>
	                		<td>
	                			<p>Cả năm<p>
	                			<input type="number" name="TBGrade10" id="10all" step=0.01>
	                		</td>
	                		<td>
	                			<p>HKI<p>
	                			<input type="number" name="HKIGrade11" id="11hk1" step=0.01>
	                		</td>
	                		<td>
	                			<p>HKII<p>
	                			<input type="number" name="HKIIGrade11" id="11hk2" step=0.01>
	                		</td>
	                		<td>
	                			<p>Cả năm<p>
	                			<input type="number" name="TBGrade11" id="11all" step=0.01>
	                		</td>
	                		<td>
	                			<p>HKI<p>
	                			<input type="number" name="HKIGrade12" id="12hk1" step=0.01>
	                		</td>
	                		<td>
	                			<p>HKII(*)<p>
	                			<input type="number" name="HKIIGrade12" id="12hk2" step=0.01>
	                		</td>
	                		<td>
	                			<p>Cả năm(*)<p>
	                			<input type="number" name="TBGrade12" id="12all" step=0.01>
	                		</td>
	                	</tr>
	                </table>
					</div>
				</fieldset>
				<fieldset>
					<legend>D.THÔNG TIN TỐT NGHIỆP</legend>
					
					14.Năm tốt nghiệp THPT(*): 
					<input type="number" id="gradYear" name="GraduatingYear" min="0" style="width: 100px; height: 18px; margin-left: 25px">
					<br>
					15.Kết quả tốt nghiệp THPT(*):
					<br>
				<div>	
					<table class="score-table">
						<tr>
							<td>
								<p>Toán</p>
								<input type="number" name="Math" id="math" step=0.01>
							</td>
							<td>
								<p>Văn</p>
								<input type="number" name="Literature" id="literature" step=0.01>
							</td>
							<td>
								<p>Ngoại ngữ</p>
								<input type="number" name="English" id="foreignLan" step=0.01>
							</td>
							<td>
								<p>Lý</p>
								<input type="number" name="Physics" id="physic" step=0.01>
							</td>
							<td>
								<p>Hóa</p>
								<input type="number" name="Chemistry" id="chemistry" step=0.01>
							</td>
							<td>
								<p>Sinh</p>
								<input type="number" name="Biology" id="biology" step=0.01>
							</td>
							<td>
								<p>Sử</p>
								<input type="number" name="History" id="history" step=0.01>
							</td>
							<td>
								<p>Địa</p>
								<input type="number" name="Geography" id="geography" step=0.01>
							</td>
							<td>
								<p>GDCD</p>
								<input type="number" name="GDCD" id="morality" step=0.01>
							</td>
						</tr>
					</table>
				</div>
				</fieldset>
				<h4>Chú ý: Một số trường thông tin đánh dấu (*) là không bắt buộc nên có thể bỏ qua hoặc cập nhật sau</h4>

        		<button type="reset" class="cancel-btn" name="cancelBtn">Hủy</button>
				<button type="submit" class="cf-btn" name="cfBtn" onclick="return validateForm()">Lưu</button>		
			</form>
		</div>
	</body>
	<script src="../../js/student/studentChangeProfile.js"></script>
	<script src="../../js/daySelectorControl.js"></script>
</html>