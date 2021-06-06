<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js" charset="utf-8"></script>
    <link rel="stylesheet" href="../../css/admin/adminWriteNotice.css">
    <link rel="stylesheet" href="../../css/w3.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <link rel="stylesheet" href="../../css/sideNavBar.css">
    <title>Viết thông báo</title>
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
  <?php include './topNavBarAdmin.php' ?>

    <div class="w3-global-font">

      <div class="container">
        <div class="form-container">
          <h1 class="w3-text-deep-purple">Thông báo</h1>
          <form action="">
            <div class="form-element">
              <label for="title">Tiêu đề</label>
              <input type="text" id="title">
            </div>
            <div class="form-element">
              <textarea name="content" id="content"></textarea>
            </div> 
            <div class="form-element">
              <button type="reset" class="w3-button w3-red w3-right w3-ripple">Hủy</button>
              <button type="button" class="w3-button w3-green w3-right w3-ripple" onclick="noticeSubmitHandler()">Đăng tải</button>
            </div> 
          </form>
        </div>
      </div>

    </div>
  </div>
</body>
<script src="../../js/admin/adminWriteNotice.js"></script>
<script src="../../js/sideNavBar.js"></script>
</html>