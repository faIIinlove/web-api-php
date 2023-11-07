<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); // You're handling a POST request, not GET
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'vendor/autoload.php';
include_once 'connection.php';
require 'send-otp.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $newPassword = $_POST['newPassword'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($newPassword)) {
        echo json_encode(['error' => 'Invalid email or password.']);
        exit;
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    if ($stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            $user_id = $row['id'];
            $otp = generateOTP();
            $otp_expiry_time = date("Y-m-d H:i:s", strtotime("+1 hour"));

            if ($insert_stmt = $mysqli->prepare("INSERT INTO otp_expiry(otp, user_id, otp_expiry_time) VALUES(?, ?, ?)")) {
                $insert_stmt->bind_param("sis", $otp, $user_id, $otp_expiry_time);
                $insert_stmt->execute();
                if ($insert_stmt->affected_rows > 0) {
                    echo json_encode(['success' => 'OTP generated and sent.']);
                } else {
                    echo json_encode(['error' => 'Failed to insert OTP.']);
                }
            } else {
                echo json_encode(['error' => 'Database error.']);
            }
        } else {
            echo json_encode(['error' => 'This email does not exist in our database.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Database error.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}

?>
