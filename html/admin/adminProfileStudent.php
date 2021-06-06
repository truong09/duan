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
    <link rel="stylesheet" href="../../css/admin/adminProfileStudent.css">
    <link rel="stylesheet" href="../../css/topNavBar.css">
    <link rel="stylesheet" href="../../css/sideNavBar.css">
    <title>Thông tin người đăng ký</title>
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

  <div class="container clearfix button-font">
    <div class="wrapper">
      <div class="link_wrapper">
        <a href="adminListStudent.php" class="anibtn">Quay lại</a>
        <div class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
              <path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
            </svg>
        </div>
      </div>
    </div>
    <hr style="border-color: black">
    <div class="w3-row">
      <div class="w3-col m6 l5 avatar">

        <div class="avatar-container">
          <img src="../../images/common/avatardefault.png" alt="avatar">
        </div>
      </div>
      <div class="w3-col m6 l7 personInfo">
        <h3 class="header">THÔNG TIN CÁ NHÂN</h3>
        <div class="info-row">
          <label for="fullName"><strong>Tên</strong></label>:<p id="fullName"></p>
        </div>
        <div class="info-row">
          <label for="birthday"><strong>Ngày sinh</strong></label>:<p id="birthday"></p>
        </div>
        <div class="info-row">
          <label for="gender"><strong>Giới tính</strong></label>:<p id="gender"></p>
        </div>
        <div class="info-row">
          <label for="nation"><strong>Dân tộc</strong></label>:<p id="nation"></p>
        </div>
        <div class="info-row">
          <label for="CMND"><strong>CMND/CCCD</strong></label>:<p id="CMND"></p>
        </div>
        <div class="info-row">
          <label for="placeOfBirth"><strong>Nơi sinh</strong></label>:<p id="placeOfBirth"></p>
        </div>
        <div class="info-row">
          <label for="residence"><strong>Hộ khẩu</strong></label>:<p id="residence"></p>
        </div>
      </div>
    </div>


    <div class="contract">
      <h3 class="header">THÔNG TIN LIÊN HỆ</h3>
      <div class="info-row">
        <label for="email"><strong>Email</strong></label>:<p id="email"></p>
      </div>
      <div class="info-row">
        <label for="phone"><strong>Số điện thoại</strong></label>:<p id="phone"></p>
      </div>
      <div class="info-row">
        <label for="address"><strong>Địa chỉ</strong></label>:<p id="address"></p>
      </div>
    </div>

    <div class="exam">
      <h3 class="header">THÔNG TIN PHỤC VỤ THI ĐGNL</h3>
      <div class="info-row">
        <label for="priority"><strong>Đội tượng</strong></label>:<p id="priority"></p>
      </div>
      <div class="info-row">
        <label for="area"><strong>Khu vực</strong></label>:<p id="area"></p>
      </div>
    </div>
    
    <div class="study">
      <h4>Kết quả học tập</h4>
      <table class="final-score">        
        <tr>               
          <th colspan="3">Lớp 10</th>                
          <th colspan="3">Lớp 11</th>       
          <th colspan="3">Lớp 12</th>       
        </tr>    
        <tr>        
          <td>HKI</td>               
          <td>HKII</td>                
          <td>Cả năm</td>                
          <td>HKI</td>                
          <td>HKII</td>               
          <td>Cả năm</td>               
          <td>HKI</td>               
          <td>HKII</td>                
          <td>Cả năm</td>              
        </tr>    
        <tr>       
          <td><p id="hk1L10"></p></td>        
          <td><p id="hk2L10"></p></td>        
          <td><p id="l10"></p></td>        
          <td><p id="hk1L11"></p></td>        
          <td><p id="hk2L11"></p></td>        
          <td><p id="l11"></p></td>
          <td><p id="hk1L12"></p></td>        
          <td><p id="hk2L12"></p></td>        
          <td><p id="l12"></p></td>        
        </tr>
      </table>
    </div>
      
    <div class="graduate">
      <h3 class="header">THÔNG TIN TỐT NGHIỆP</h3>
      <div class="info-row">
        <label for="gradYear" style="width: 12vw;"><strong>Tốt nghiệp THPT năm</strong></label>:<p id="gradYear"></p>
      </div>
    </div>
     
    <div class="graduteResult">
      <h4>Kết quả tốt nghiệp THPT</h4>
      <table class="final-score">    
        <tr>    
          <td>Toán</td>    
          <td>Văn</td>    
          <td>Ngoại ngữ</td>    
          <td>Lý</td>    
          <td>Hóa</td>    
          <td>Sinh</td>    
          <td>Sử</td>    
          <td>Địa</td>    
          <td>GDCD</td>    
        </tr>  
        <tr>  
          <td><p id="math"></p></td>  
          <td><p id="liter"></p></td>  
          <td><p id="eng"></p></td>  
          <td><p id="physic"></p></td>   
          <td><p id="chem"></p></td>  
          <td><p id="bio"></p></td>  
          <td><p id="his"></p></td>  
          <td><p id="geo"></p></td>  
          <td><p id="GDCD"></p></td>  
        </tr>
      </table>
    </div>
            
  </div>    
</div>

</body>
<script src="../../js/parseURLParams.js"></script>
<script src="../../js/admin/adminProfileStudent.js"></script>
<script src="../../js/sideNavBar.js"></script>
</html>
