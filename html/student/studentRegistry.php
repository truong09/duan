<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../../css/w3.css">
  <link rel="stylesheet" href="../../css/student/studentRegistry.css">
  <link rel="stylesheet" href="../../css/topNavBar.css">
	<title>Trang chủ</title>
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

  <div class="container w3-global-font" id="container">
  </div>
</body>
<script src="../../js/student/studentRegistry.js"></script>
<script src="../../js/dateSolution.js"></script>
</html>