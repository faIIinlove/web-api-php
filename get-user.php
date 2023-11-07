<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Get all user 
include_once 'connection.php';
try {
    $query = "SELECT id, email, name, phone, address, role FROM users   ";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(
        array(
            "data" => $news
        )
    );
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

?>