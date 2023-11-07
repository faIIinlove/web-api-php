<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);

function generateOTP()
{
    $otp = rand(100000, 999999);
    return $otp;
}

try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'phucnamvan@gmail.com';
    $mail->Password = 'ndxnwjjsbgflwjgs';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';
    

    $mail->setFrom('phucnamvan@gmail.com', 'Request Of Send OTP To forgot password');
    $mail->addAddress('phucnamvan123@gmail.com', 'Văn Nam Phúc');
    $mail->addReplyTo('phucnamvan@gmail.comm', 'Information');

    $otp = generateOTP();
    $otp_expiry_time = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $mail->isHTML(true);
    $mail->Subject = 'Mã OTP của bạn';
    $mail->Body    = "Your OTP is: $otp. This OTP will expire on $otp_expiry_time.";
    $mail->AltBody = "Your OTP is: $otp. This OTP will expire on $otp_expiry_time.";

    $mail->send();
    echo 'Your OTP has been sent';
} catch (Exception $e) {
    echo "Your email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>