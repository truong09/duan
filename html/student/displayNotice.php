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
    <link rel="stylesheet" href="../../css/student/displayNotice.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <title>Thông báo</title>
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
    include './topNavBarStudent.php'  
	?>
    

    <div class="container w3-global-font"> 
      <div class="page">
        <div class="w3-indigo header">
          <h1 id="title"></h1>
          <p class="time" id="date"></p>
        </div>

        <div class="content" id="content"></div>
      </div>
      <div class="notice-list w3-indigo">
        <h3>Bài viết khác:</h3>
        <ul id="notice-list"></ul>
      </div>
      <div class="w3-bar pagination">
        <a id="prev" class="w3-button">&#10094; Trước</a>
        <a id="next" class="w3-button w3-right">Tiếp &#10095;</a>
      </div>
    </div>
  </body>
  <script src="../../js/parseURLParams.js"></script>
  <script src="../../js/student/displayNotice.js"></script>
  <script src="../../js/dateSolution.js"></script>
  <script src="../../js/titleSolution.js"></script>
</html>