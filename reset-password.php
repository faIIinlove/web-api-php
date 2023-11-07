<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); // You're handling a POST request, not GET
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';

// reset password to default password is tomheo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];
    $hashedPassword = password_hash('tomheo', PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = $hashedPassword WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo json_encode(array("message" => "Reset password successfully"));
    } else {
        echo json_encode(array("message" => "Reset password failed"));
    }
}
?>