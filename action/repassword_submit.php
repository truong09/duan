<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'F:/project/duan2021/vendor/autoload.php';  

    session_start();
    include '../config.php';

    $email = $_POST['email'];
    if (isset($_POST['submit'])){
        if ($_POST['email']==''){
            echo "Vui lòng nhập email của bạn";
            exit;
        }

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $user = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($user)>0){
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;// Enable verbose debug output
                $mail->isSMTP();// gửi mail SMTP
                $mail->Host = 'smtp.gmail.com';// Set the SMTP server to send through
                $mail->SMTPAuth = true;// Enable SMTP authentication
                $mail->Username = 'lucky23r4@gmail.com';// SMTP username
                $mail->Password = 'satthu0501'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port = 587; // TCP port to connect to

                //Recipients
                $mail->setFrom('lucky23r4@gmail.com', 'Trung');
                $mail->addAddress($email, 'User'); // Add a recipient
                $mail->addReplyTo('lucky23r4@gamil.com', 'Information');

                // // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

                // Content
                $mail->isHTML(true);   // Set email format to HTML
                $mail->Subject = 'MA XAC THUC';
                $mail->Body = rand(000000,999999);
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                
                $_SESSION["notice"] = "Ma xac thuc da duoc gui";
                header("location: ../html/resetpassword.php");
            } catch (Exception $e) {
                $_SESSION["notice"] = "Co loi vui long thu lai";
                header("location: ../html/resetpassword.php");
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }   
        } else {
            $_SESSION["notice"] = "Email cua ban chua duoc dang ky";
            exit;
        }
    }
?>