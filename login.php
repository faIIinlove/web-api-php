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
    echo json_encode(['error' => 'Invalid email or password ddijkasbdjsbadijsad.']);
    exit;
}
try {
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(['success' => 'Welcome back, ' . $user['name'] . '!']);
        exit;
    } else {
        echo json_encode(['error' => 'Invalid email or password.']);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

?>