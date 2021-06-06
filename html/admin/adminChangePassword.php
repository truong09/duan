<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/student/studentChangePassword.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <link rel="stylesheet" href="../../css/sideNavBar.css">
    <title>Đổi mật khẩu</title>
  </head>
  <body>
  <?php 
    if(isset($_SESSION["AccountID"])){
      if($_SESSION["AccountType"]!=1) header("location: ../student/studentHomepage.php");
    }else{
      header("location: ../signin.php");
    }
  ?>
  <?php 
    if(isset($_SESSION["notice"])){
      echo '<script>  alert("'.$_SESSION["notice"].'");</script>';
      unset($_SESSION["notice"]);	
    }  
    include '../sideNavBar.php'
	?>

    <div id="main" class="main">
    <?php include './topNavBarAdmin.php' ?>

      <div class="container"> 
        <div class="form-container">
          <form id="pwform" name="pwform" action="../../action/center_student/ChangePassword.php" method="POST">
            <div class="form-element">
              <label for="oldpw">Mật khẩu cũ:</label>
              <input type="password" name="passwordOld" id="oldpw">
            </div>
            <div class="form-element">
                <label for="newpw">Mật khẩu mới:</label>  
                <input type="password" name="passwordNew" id="newpw">
            </div>
            <div class="form-element">
                <label for="renewpw">Nhập lại mật khẩu mới:</label>
                <input type="password" name="rePassword" id="renewpw">
            </div>
            <div class="form-element">
                <button type="reset" name="rsbtn" id="rsbtn" class="rsbtn">Hủy</button>
                <button type="submit" name="submit" id="savebtn" class="savebtn" onclick="return validateForm()">Lưu</button> 
            </div>        
          </form>
        </div>
      </div>
    </div>
</body>
  <script src="../../js/student/studentChangePassword.js"></script>
  <script src="../../js/sideNavBar.js"></script>
</html>