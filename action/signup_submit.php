<?php
    session_start();
    include '../config.php';
    $accountID = bin2hex(openssl_random_pseudo_bytes(16));
    $accountDate = date("Y-m-d H:i:s");
    $groupDate =  date('m/Y');
    $fullName = $_POST["fullName"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $cmnd = $_POST["cmnd"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $enterpassword = $_POST["enterpassword"];
    $stringDate = $_POST['day'].'/'.$_POST['month'].'/'.$_POST['year'];
    $dateofBirth = date('Y-m-d',strtotime(str_replace('/', '-', $stringDate)));

    //mã hóa
    $password = md5($password);
    $enterpassword = md5($enterpassword);
 
    if(isset($_POST["sbmbtn"])){
        
        if ( $password != $enterpassword){
             $_SESSION["notice"] = "Mật khẩu xác thực không chính xác";
             header("location: ../html/signup.php");
        }else{

        $sql = "SELECT * FROM account WHERE username = '$username'";
        $user = mysqli_query($conn, $sql);

        if (mysqli_num_rows($user)>0){
            $_SESSION["notice"] = "Tài khoản đã tồn tại";
            header("location: ../html/signup.php");
        } else {

            // insert vào bảng account
               $accountData = "INSERT INTO account(
                  AccountID, 
                  Username,
                  Password,
                  AccountType,
                  AccountDate,
                  GroupDate
                  ) 
               VALUES (
                  '$accountID',
                  '$username',
                  '$password',
                   2, 
                  '$accountDate',
                  '$groupDate'
              )";

               $addMember = mysqli_query($conn, $accountData);
                 // insert vào bảng accountdetail
                $data = "INSERT INTO accountdetail(
                   AccountID, 
                   Email,
                   FullName,
                   DateOfBirth,
                   Gender,
                   PhoneNumber,
                   Identification,
                   Address,
                   AccountDate) 
               VALUES ('$accountID',
                    '$email',
                    '$fullName',
                    '$dateofBirth',
                    '$gender',
                    '$phone',
                    '$cmnd',
                    '$address',
                    '$accountDate')";
             
                $addAccount = mysqli_query($conn, $data);
                
                if ($addMember&&$addAccount){
                     $_SESSION["notice"] = "Bạn đã đăng ký thành công";
                     header("location: ../html/signupSuccess.php");
                } else {
                     $_SESSION["notice"] =  "Có lỗi trong quá trình đăng ký. Vui lòng thử lại sau";
                     header("location: ../html/signup.php");
                }
            }
        }
    }
?>