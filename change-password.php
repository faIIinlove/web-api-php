<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';


try {
    $data = json_decode(file_get_contents('php://input'));
    $email = $data->email;
    $oldPassword = $data->oldPassword;
    $newPassword = $data->newPassword;
    $confirmPassword = $data->confirmPassword;

    // change password
    $stmt = $dbConn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $hashedPassword = $stmt->fetchColumn();
    $stmt = $dbConn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user_id = $stmt->fetchColumn();
    if (password_verify($oldPassword, $hashedPassword)) {
        if ($newPassword === $confirmPassword) {
            $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $dbConn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$newPasswordHashed, $user_id]);
            echo json_encode(
                array(
                    "message" => "Mật khẩu đã được thay đổi"
                )
            );
        } else {
            echo json_encode(
                array(
                    "message" => "Mật khẩu không khớp"
                )
            );
        }
    } else {
        echo json_encode(
            array(
                "message" => "Mật khẩu cũ không đúng"
            )
        );
    }
} catch (Exception $th) {
    echo json_encode(
        array(
            "message" => "Có lỗi xảy ra"
        )
    );
}
?>