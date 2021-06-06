<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <link rel="stylesheet" href="../../css/w3.css">
  <link rel="stylesheet" href="../../css/student/entranceExaminationPaper.css">
  <link rel="stylesheet" href="../../css/topNavBar.css">
	<title>Giấy báo dự thi</title>
</head>
<body>
<?php 
  if(isset($_SESSION["AccountID"])){
    if($_SESSION["AccountType"]==1) header("location: ../admin/admin.php");
  }else{
    header("location: ../signin.php");
  }
  include './topNavBarStudent.php';
?>

  <div class="container">
    <button class="sidebtn pdf-btn" id="export">PDF</button>
    <div class="warrning-container">
      <img src="../../images/alert.png" alt="warrning">
      <div>Giấy báo dự thi có thể không có hiệu lực nếu bạn chưa điền đủ thông tin cá nhân trong phần hồ sơ.</div> 
    </div>
    <div class="paper" id="paper-content">
      <div class="paperHeader">
        <div>ĐẠI HỌC QUỐC GIA THÀNH PHỐ HÀ NỘI</div>
        <div class="header3"><strong>TRUNG TÂM KHẢO THÍ VÀ ĐÁNH GIÁ CHẤT LƯỢNG ĐÀO TẠO</strong></div>
      </div>
      
      <div class="paperName">
        <div class="header3"><strong>GIẤY BÁO DỰ THI</strong></div>
        <div class="header3"><strong>KỲ THI ĐÁNH GIÁ NĂNG LỰC ĐHQGHN</strong></div>
      </div>

      <div class="info-block exam">
        <div class="header3"><strong>THÔNG TIN DỰ THI</strong></div>
        <div class="info-row">
          <label for="id">Số báo danh:</label><div id="id"></div>
        </div>
        <div class="info-row">
          <label for="examDate">Ngày giờ thi:</label><div id="examDate"></div>
        </div>
        <div class="info-row">
          <label for="examPlace">Địa điểm thi:</label><div id="examPlace"></div>
        </div>
        <div class="info-row">
          <label for="registryCode">Mã đăng ký:</label><div id="registryCode"></div>
        </div>
      </div>
      
      <p class="notice">Thí sinh phải có mặt trước giờ thi 30 phút. <br>
      Thí sinh phải mang theo giấy báo dự thi (bản in từ trang web đăng ký hoặc bản nhận được qua bưu điện) và Chứng mình nhân dân/Căn cước công dân/Hộ chiếu.
      </p>

      <div class="info-block personal">
        <div class="header3"><strong>THÔNG TIN CÁ NHÂN</strong></div>
        <div class="info-row">
          <label for="name">Họ và tên thí sinh:</label><div id="name"><strong></strong></div>
        </div>
        <div class="info-row">
          <label for="birthday">Ngày, tháng, năm sinh:</label><div id="birthday"></div>
          <label for="placeOfBirth" class="label2">Nơi sinh:</label><div id="placeOfBirth"></div>
        </div>
        <div class="info-row">
          <label for="gender">Giới tính:</label><div id="gender"></div>
        </div>
        <div class="info-row">
          <label for="cmnd">Số CMND/Căn cước công dân:</label><div id="cmnd"></div>
        </div>
      </div>

      <div class="info-block contract">
        <div class="header3"><strong>THÔNG TIN LIÊN LẠC</strong></div>
        <div class="info-row">
          <label for="name2">Họ và tên thí sinh:</label><div id="name2"><strong></strong></div>
        </div>
        <div class="info-row">
          <label for="address">Địa chỉ liên lạc:</label><div id="address"></div>
        </div>
        <div class="info-row">
          <label for="phone">Số điện thoại:</label><div id="phone"></div>
        </div>
        <div class="info-row">
          <label for="email">Email:</label><div id="email"></div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="../../js/student/entranceExaminationPaper.js"></script>
<script src="../../js/dateSolution.js"></script>
</html>