<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="../../css/admin/statistics.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <link rel="stylesheet" href="../../css/sideNavBar.css">
    <link rel="stylesheet" href="../../css/scrollToTopBtn.css">
    <title>Thống kê</title>
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

    <!-- Scroll to top button -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    
    <div id="main" class="main">
    <?php include './topNavBarAdmin.php' ?>

      <!-- Menubar -->
      <ul class="menu-bar">
        <li><p>Danh mục</p></li>
        <li>
          <div>
              <label for="from">Từ:</label>
                <select name="from" id="from">
                </select>
                <label style="margin-left: 10px;" for="to">Đến:</label>
                <select name="to" id="to">
                </select>
            </div>  
        </li>
        
        <li><a id="fetchForProvince">Tỉnh/Thành phố</a></li>
        <li><a id="fetchForArea">Khu vực</a></li>
        <li><a id="fetchForPriority">Đối tượng ưu tiên</a></li>
        <li><a id="fetchForGraduating">Tình trạng học tập</a></li>
        <li><a class="myBtn_multi">Tổ hợp điểm</a></li>
        <li><a class="myBtn_multi">Trung bình học tập</a></li>
<!--         <li><a id="fetchForFill">Trạng thái hồ sơ</a></li> -->
      </ul>

      <!-- ContentPage -->
      <div class="container">
        <div class="chart-container">
          <div id="curve_chart" style="height: 500px; display: none"></div>
        </div>
        <div class="option-container" id="optionContainer">
          <label for="groupBy">Nhóm theo:</label>
          <button id="groupBy" class="groupbtn">Năm</button>
<!--           <div class="vl"></div>
          <button id="filterZero" class="filterbtn">Lọc giá trị 0</button> -->
        </div>
        <div class="table-container" id="tableContainer">
          <h1 style="text-align: center; font-family:Verdana, Geneva, Tahoma, sans-serif">Chọn một danh mục để bắt đầu</h1>
        </div>
      </div>
    </div>

<!-- The Modal -->
<div class="modal modal_multi">

<!-- Modal content -->
<div class="modal-content">
    <span class="close close_multi">&times;</span>
    <h2>Tham số bổ sung</h2>
    <form id="combiForm">
        <label class="inputLabel" for="combi">Tổng điểm:</label>
        <input type="number" name="combi" id="combi" step=0.01>
        <table>
            <tr>
              <td>
                <label  class="box">Toán
                <input type="checkbox" name="Math" class="check">
                <span class="checkmark"></span>
                </label>
              </td>
              <td>
                <label  class="box">Văn
                <input type="checkbox" name="Literature" class="check">
                <span class="checkmark"></span>
              </label>
              </td>
              <td>
                <label  class="box">Ngoại ngữ
                <input type="checkbox" name="English" class="check">
                <span class="checkmark"></span>
              </label>
              </td>
            </tr>
            <tr>
              <td><label  class="box">Lý
                <input type="checkbox" name="Physics" class="check">
                <span class="checkmark"></span>
              </label></td>
              <td><label  class="box">Hóa
                <input type="checkbox" name="Chemistry" class="check">
                <span class="checkmark"></span>
              </label></td>
              <td><label  class="box">Sinh
                <input type="checkbox" name="Biology" class="check">
                <span class="checkmark"></span>
              </label></td>
            </tr>
            <tr>
              <td><label  class="box">Sử
                <input type="checkbox" name="History" class="check"> 
                <span class="checkmark"></span>
              </label></td>
              <td><label  class="box">Địa
                <input type="checkbox" name="Geography" class="check">
                <span class="checkmark"></span>
              </label></td>
              <td><label  class="box">GDCD
                <input type="checkbox" name="GDCD" class="check">
                <span class="checkmark"></span>
              </label></td>
            </tr>
          </table>
          <button class="cancel-btn" id="cancelBtn01">Hủy</button>
          <button class="query-btn" id="queryBtn01">Truy vấn</button>
    </form>
</div>

</div>

<!-- The Modal -->
<div  class="modal modal_multi">

<!-- Modal content -->
<div class="modal-content">
    <span class="close close_multi">&times;</span>
    <h2>Tham số bổ sung</h2>
    <form id="averForm">
      <label for="grade" class="inputLabel">Lớp:</label>
        <select name="Grade" id="grade">
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
      <br>
      <label class="inputLabel" for="average">Tổng điểm:</label>
      <input type="number" name="MediumCore" id="average" step=0.01>
      <br>
      <br>
      <button class="cancel-btn" id="cancelBtn02">Hủy</button>
      <button class="query-btn" id="queryBtn02">Truy vấn</button>
    </form>
</div>
  </body>
  <script src="../../js/sideNavBar.js"></script>
  <script src="../../js/admin/statistics.js"></script>
  <script src="../../js/scrollToTopBtn.js"></script>
</html>