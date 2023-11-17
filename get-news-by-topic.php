<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once 'connection.php';

try {
    $topic_id = $_GET["topic_id"];
    $query = "SELECT * FROM news WHERE topic_id = $topic_id";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(
        array(
            "data" => $news
        )
    );
} catch (Exception $e) {
    echo json_encode(
        array(
            http_response_code(500),
            "message" => "No news found."
        )
    );
}


?>