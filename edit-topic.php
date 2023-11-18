<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';

try {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id"];
    $name = $data["name"];
    $description = $data["description"];
    $query = "UPDATE topics SET name = '$name', description = '$description' WHERE id = $id";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    echo json_encode(
        array(
            "data" => "Cập nhật chủ đề thành công"
        )
    );
} catch (Exception $th) {
    echo json_encode(
        array(
            http_response_code(500),
            "message" => "Có lỗi xảy ra"
        )
    );
}
?>