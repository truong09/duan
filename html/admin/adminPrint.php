<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../../css/admin/adminPrint.css">
  <link rel="stylesheet" href="../../css/topNavBar.css">
  <link rel="stylesheet" href="../../css/sideNavBar.css">
  <title>Xuất danh sách thí sinh</title>
</head>
<body>
<div id="main" class="main">

  <div class="container">
    <table id="infoTable" style="display: none;">
      <tr>
        <th rowspan="3">STT</th>
        <th rowspan="3">ID</th>
        <th rowspan="3">Tên</th>
        <th rowspan="3">Ngày sinh</th>
        <th rowspan="3">Giới tính</th>
        <th rowspan="3">Dân tộc</th>
        <th rowspan="3">Chứng minh nhân dân</th>
        <th rowspan="3">Hộ khẩu</th>
        <th rowspan="3">Nơi sinh</th>
        <th rowspan="3">Email</th>
        <th rowspan="3">Số điện thoại</th>
        <th rowspan="3">Địa chỉ liên lạc</th>
        <th rowspan="3">Đối tượng ưu tiên</th>
        <th rowspan="3">Khu vực</th>
        <th colspan="9">Trung bình học tập</th>
        <th rowspan="3">Năm tốt nghiệp</th>
        <th colspan="9">Kết quả tốt nghiệp</th>
      </tr>
      <tr>
        <th colspan="3">Lớp 10</th>
        <th colspan="3">Lớp 11</th>
        <th colspan="3">Lớp 12</th>
        <th rowspan="2">Toán</th>
        <th rowspan="2">Văn</th>
        <th rowspan="2">Anh</th>
        <th rowspan="2">Lý</th>
        <th rowspan="2">Hóa</th>
        <th rowspan="2">Sinh</th>
        <th rowspan="2">Sử</th>
        <th rowspan="2">Địa</th>
        <th rowspan="2">GDCD</th>
      </tr>
      <tr>
        <th>HKI</th>
        <th>HKII</th>
        <th>Cả năm</th>
        <th>HKI</th>
        <th>HKII</th>
        <th>Cả năm</th>
        <th>HKI</th>
        <th>HKII</th>
        <th>Cả năm</th>
      </tr>
    </table>
    <div class="alert" id="alert">
      Danh sách thí sinh sẽ được tự động tải xuống sau giây lát. <br>
      Nếu không được thì nhấn vào <a onclick="exportTableToExcel('infoTable', 'Danh sách thí sinh')">đây</a>
    </div>
  </div>
</div>
</body>
<script src="../../js/parseURLParams.js"></script>
<script src="../../js/dateSolution.js"></script>
<script src="../../js/admin/adminPrint.js"></script>
<script src="../../js/sideNavBar.js"></script>
</html>