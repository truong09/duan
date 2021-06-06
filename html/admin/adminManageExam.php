<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/w3.css">
    <link rel="stylesheet" href="../../css/admin/adminManageExam.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <link rel="stylesheet" href="../../css/sideNavBar.css">
    <title>Quản lý lịch thi</title>
  </head>
  <body>
  <?php 
    if(isset($_SESSION["AccountID"])){
      if($_SESSION["AccountType"]!=1) header("location: ../student/studentHomepage.php");
    }else{
      header("location: ../signin.php");
    }
    include '../sideNavBar.php'
  ?>

    <div id="main" class="main">
    <?php include './topNavBarAdmin.php' ?>

    <div id="tableList" class="container w3-global-font">
    </div> 
</div>
</body>
<script src="../../js/admin/adminManageExam.js"></script>
<script src="../../js/sideNavBar.js"></script>
<script src="../../js/dateSolution.js"></script>
</html>