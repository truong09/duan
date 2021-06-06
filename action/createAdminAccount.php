<?php
    session_start();
    include '../config.php';
    $i = 1;
    $username = "";
    $accountID = bin2hex(openssl_random_pseudo_bytes(16));
    $accountDate = date("Y-m-d H:i:s");
    $groupDate =  date('m/y');
    $password = "12345";
    $password = md5($password);

    if(isset($_POST["create"])){

        while(true) {
            $username = 'admin0' . (string)$i;
            if(check($username, $conn)){
                $i++;
                continue;  
            }else{
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
                    1, 
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
                    header("location: ../html/signupSuccess.php");
                } else {
                    header("location: ../html/adminSignUp.php");
                }
                break;
            }    
        }
    }
    
    function check($username, $conn){
        $sql = "SELECT * FROM account WHERE username = '$username'";
        $user = mysqli_query($conn, $sql);
        return mysqli_num_rows($user)>0;
    }          
?>