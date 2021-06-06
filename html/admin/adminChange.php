<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/adminChange.css">
    <link rel="stylesheet" href="../../css/w3.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <link rel="stylesheet" href="../../css/sideNavBar.css">
    <title>Chỉnh sửa lịch thi</title>
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

    <div class="container w3-global-font" id="container">
    </div>

    <div class="container">
      <div class="add-wrapper" id="add-wrapper">
        <button type="button" id="addExam" class="w3-button w3-dark-gray w3-ripple addbtn">+</button>
      </div>
    </div>
</body>
<script src="../../js/dateSolution.js"></script>
<script src="../../js/sideNavBar.js"></script>
<script src="../../js/admin/adminChange.js"></script>
</html>
