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
    <link rel="stylesheet" href="../../css/admin/adminListStudent.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <link rel="stylesheet" href="../../css/sideNavBar.css">
    <title>Danh sách thí sinh đăng ký</title>
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

    <div id="main" class="main w3-light-grey">
    <?php include './topNavBarAdmin.php' ?>

      <!-- Folder Bar -->
      <div id="folder" class="w3-sidebar w3-bar-block w3-light-grey w3-card w3-global-font" style="width:15vw; box-shadow:none">
        <h3 class="w3-bar-item">Mục lục</h3>
      </div>

      <!-- Card Area -->
      <div class="w3-container w3-global-font w3-white" style="margin-left:15vw">
        <div id="participantList"></div>
      </div>
    </div>
</body>

<script src="../../js/sideNavBar.js"></script>
<script src="../../js/admin/adminListStudent.js"></script>
</html>