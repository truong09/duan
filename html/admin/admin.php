<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/admin.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <link rel="stylesheet" href="../../css/sideNavBar.css">
    <title>Trang chủ</title>
  </head>
  <body>
  <?php 
    if(isset($_SESSION["AccountID"])){
      if($_SESSION["AccountType"]!=1) header("location: ../student/studentHomepage.php");
    }else{
      header("location: ../signin.php");
    }
    include '../sideNavBar.php';
  ?>

    <div id="main" class="main">
      <!-- Top Navigation Bar -->
      <?php include './topNavBarAdmin.php' ?>

      <div class="container">
        <div class="guide-row">
          <div class="button-container">
            <a href="adminManageExam.php" class="slideButton btn1"><span>Quản lý lịch thi</span></a>
          </div>
          <div class="button-container">
            <a href="adminChange.php" class="slideButton btn2"><span>Chỉnh sửa lịch thi</span></a>
          </div> 
        </div>
        <div class="guide-row">
          <div class="button-container">
            <a href="adminListStudent.php" class="slideButton btn3"><span>Xem danh sách thí sinh</span></a>
          </div>
          <div class="button-container">
            <a href="statistics.php" class="slideButton btn4"><span>Thống kê số lượng thí sinh</span></a>
          </div>
        </div>
      </div>
    </div>
</body>
<script src="../../js/admin/admin.js"></script>
<script src="../../js/sideNavBar.js"></script>
</html>