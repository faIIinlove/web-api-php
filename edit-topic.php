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

    $query = "UPDATE topics SET name = ?, description = ? WHERE id = ?";
    $stmt = $dbConn->prepare($query);
    
    if ($stmt->execute([$name, $description, $id])) {
        echo json_encode(
            array(
                "status" => http_response_code(200),
                "data" => "Cập nhật chủ đề thành công"
            )
        );
    } else {
        echo json_encode(
            array(
                "status" => http_response_code(400),
                "data" => "Cập nhật chủ đề thất bại"
            )
        );
    }
} catch (PDOException $th) {
    echo json_encode(
        array(
            "status" => http_response_code(500),
            "data" => "Cập nhật chủ đề thất bại " . $th->getMessage()
        )
    );
}
?>
