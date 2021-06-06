<?php 
	session_start();
	include '../../config.php';
	$accountID = $_SESSION["AccountID"];
	$accountType = $_SESSION["AccountType"];
	if(isset($_POST["cfBtn"])){
	    $fullName = $_POST["fullName"];
	    $gender = $_POST["gender"];
        $Nation = $_POST["Nation"];
	    $phoneNumber = $_POST["phone"];
	    $identification = $_POST["cmnd"];
	    $address = $_POST["address"];
	    $email = $_POST["email"];
	    $stringDate = $_POST['day'].'/'.$_POST['month'].'/'.$_POST['year'];

    	$dateofBirth = date('Y-m-d',strtotime(str_replace('/', '-', $stringDate)));
        $PermanentResidence = $_POST["PermanentResidence"];
        $ProvinceName = $_POST["ProvinceName"];
        $IsPrioritize =$_POST["IsPrioritize"];
        $Area = $_POST["Area"];
        $GraduatingYear = $_POST["GraduatingYear"];
        $HKIGrade10 = $_POST["HKIGrade10"];
        $HKIIGrade10 = $_POST["HKIIGrade10"];
        $TBGrade10 = $_POST["TBGrade10"];
        $HKIGrade11 = $_POST["HKIGrade11"];
        $HKIIGrade11 = $_POST["HKIIGrade11"];
        $TBGrade11 = $_POST["TBGrade11"];
        $HKIGrade12 = $_POST["HKIGrade12"];
        $HKIIGrade12 = $_POST["HKIIGrade12"];
        $TBGrade12 = $_POST["TBGrade12"];
        $Math = $_POST["Math"];
        $Literature = $_POST["Literature"];
        $English = $_POST["English"];
        $Physics = $_POST["Physics"];
        $Chemistry =$_POST["Chemistry"];
        $Biology = $_POST["Biology"];
        $History = $_POST["History"];
        $Geography = $_POST["Geography"];
        $GDCD = $_POST["GDCD"];
        echo         $GDCD;
    	$sql = "UPDATE accountdetail ac SET Address = '$address', DateOfBirth = '$dateofBirth', FullName = '$fullName', Gender = '$gender', PhoneNumber = '$phoneNumber',Nation = '$Nation' ,Identification = '$identification', Email = '$email', PermanentResidence = '$PermanentResidence', ProvinceName = '$ProvinceName', IsPrioritize = '$IsPrioritize', Area = '$Area', GraduatingYear = '$GraduatingYear', HKIGrade10 = '$HKIGrade10', HKIIGrade10 = '$HKIIGrade10', TBGrade10 = '$TBGrade10', HKIGrade11 = '$HKIGrade11', HKIIGrade11='$HKIIGrade11', TBGrade11 = '$TBGrade11', HKIGrade12 = '$HKIGrade12', HKIIGrade12 = '$HKIIGrade12', TBGrade12 = '$TBGrade12', Math = '$Math', Literature = '$Literature', English = '$English', Physics = '$Physics', Chemistry = '$Chemistry', Biology = '$Biology', History = '$History', Geography = '$Geography', GDCD= '$GDCD' WHERE AccountID = '$accountID'";
    	$query = mysqli_query($conn,$sql );
    	if($query){
    		 $_SESSION["notice"] = "Cập nhật thành công";
    	}
    	else{
    		$_SESSION["notice"] = "Cập nhật thất bại";
    	}

    	if($accountType == 1){
			header("location: ../../html/admin/admin.php");
    	}
    	else{
    		header("location: ../../html/student/studentChangeProfile.php");
    	}
    	
	}
	
 ?>