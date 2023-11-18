<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';


try {
    $topic_id = $_GET["topic_id"];
    $query = "SELECT * FROM topics WHERE id = $topic_id";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(
        array(
            "data" => $topics
        )
    );
} catch (Exception $th) {
    echo json_encode(
        array(
            "message" => "Có lỗi xảy ra"
        )
    );
}

?>