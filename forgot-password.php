<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); // You're handling a POST request, not GET
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';
include_once 'function/send-otp.php';

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];
$query = "SELECT * FROM users WHERE email = '$email'";
$stmt = $dbConn->prepare($query);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user) {
    $otp = sendOTP($email);
    $otpHashed = password_hash($otp, PASSWORD_DEFAULT);
    $query = "INSERT INTO otp_expiry (otp, user_id, otp_expiry_time) VALUES ('$otpHashed', '$user[id]', now()+INTERVAL 60 MINUTE)";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    echo json_encode(
        array(
            "message" => "Mã OTP đã được gửi tới email của bạn"
        )
    );
} else {
    echo json_encode(
        array(
            "message" => "Email không tồn tại"
        )
    );
}
?>
