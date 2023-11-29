<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); // You're handling a POST request, not GET
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';


try {
    $data = json_decode(file_get_contents('php://input'));

    $email = $data->email;
    $otp = $data->otp;
    $newPassword = $data->newPassword;
    $confirmPassword = $data->confirmPassword;

    //get user id
    $stmt = $dbConn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user_id = $stmt->fetchColumn();

    // Get hashed OTP from database
    $stmt = $dbConn->prepare("SELECT otp FROM otp_expiry WHERE user_id = ? AND otp_expiry_time > NOW()");
    $stmt->execute([$user_id]);
    $hashedOtp = $stmt->fetchColumn();

    if (password_verify($otp, $hashedOtp)) {
        if ($newPassword === $confirmPassword) {
            $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $dbConn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$newPasswordHashed, $user_id]);
            echo json_encode(
                array(
                    http_response_code(200),
                    "data" => "success"
                )
            );
            $stmt = $dbConn->prepare("DELETE FROM otp_expiry WHERE user_id = ?");
            $stmt->execute([$user_id]);
        } else {
            echo json_encode(
                array(
                    http_response_code(400),
                    "data" => "Mật khẩu không khớp"
                )
            );
        }
    } else {
        echo json_encode(
            array(
                http_response_code(400),
                "data" => "Mã OTP không hợp lệ hoặc đã hết hạn"
            )
        );
    }
} catch (Exception $th) {
    echo json_encode(
        array(
            http_response_code(500),
            "data" => "Có lỗi xảy ra"
        )
    );
}
?>