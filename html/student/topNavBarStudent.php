<?php if(isset($_SESSION["notice"])){
	echo '<script>  alert("'.$_SESSION["notice"].'");</script>';
	unset($_SESSION["notice"]);	
    }  
?>
<ul class="navbar">
    <li><a class="logo-container" href="./studentHomepage.php"><img class="logo" src="../../images/common/Logo-VNU-1995.jpg" /></a></li>
    <li><div class="web-name">Đăng ký thi đánh giá năng lực</div></li>
    <li class="dropdown" style="float:right">
        <a href="javascript:void(0)" class="dropbtn">
            <?php 
            if(isset($_SESSION["Username"])) echo $_SESSION["Username"];
            else echo "Có lỗi xảy ra";
            ?>
        </a>
        <div class="dropdown-content">
            <a href="studentRegistry.php">Đăng ký thi</a>
            <a href="studentChangeProfile.php">Cập nhật thông tin</a>
            <a href="entranceExaminationPaper.php">Xem giấy báo dự thi</a>
            <a href="studentChangePassword.php">Đổi mật khẩu</a>
            <a href="../../action/logout.php">Đăng xuất</a>
        </div>
    </li>
</ul>