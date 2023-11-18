<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';

try {
    $data = json_decode(file_get_contents("php://input"), true);
    $topic_id = $_GET["topic_id"];
    $query = "DELETE FROM topics WHERE id = $topic_id";
    $query2 = "DELETE FROM news WHERE topic_id = $topic_id";
    $stmt2 = $dbConn->prepare($query2);
    $stmt2->execute();
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    echo json_encode(
        array(
            http_response_code(200),
            "data" => "Xoá chủ đề thành công"
        )
    );
} catch (Exception $th) {
    echo json_encode(
        array(
            http_response_code(500),
            "data" => `Có lỗi xảy ra khi xoá chủ đề: ${$th->getMessage()}`,
        )
    );
}
?>