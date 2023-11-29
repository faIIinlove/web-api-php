<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';
function registerUser($email, $password, $name, $phone, $address, $role) {
    global $dbConn;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["message" => "Invalid email format"]);
        return;
    }
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $dbConn->prepare($checkQuery);
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        http_response_code(400);
        echo json_encode(["message" => "User already exists"]);
        return;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, password, name, phone, address, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $dbConn->prepare($query);

    try {
        $stmt->execute([$email, $hashedPassword, $name, $phone, $address, $role]);
        http_response_code(200);
        echo json_encode(["message" => "User registered successfully"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
}

$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['email'], $data['password'], $data['name'], $data['phone'], $data['address'], $data['role'])) {
    $email = $data['email'];
    $password = $data['password'];
    $name = $data['name'];
    $phone = $data['phone'];
    $address = $data['address'];
    $role = $data['role'];
    registerUser($email, $password, $name, $phone, $address, $role);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Incomplete data for registration"]);
}
?>
