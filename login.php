<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];
$password = $data['password'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
    echo json_encode(['error' => 'Invalid email or password.']);
    exit;
}
try {
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    if (!$user) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid email or password.']);
        exit;
    }

    if ($user && password_verify($password, $user['password'])) {
        $response = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ];
        $data = ['data' => $response];
        echo json_encode($data);
        exit;
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid email or password.']);
        exit;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>