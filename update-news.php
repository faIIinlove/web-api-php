<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     http_response_code(405);
//     echo json_encode(array("message" => "Phương thức không được hỗ trợ."));
//     exit;
// }
include_once 'connection.php';
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$title = $data['title'];
$content = $data['content'];
$topic_id = $data['topic_id'];
$user_id = $data['user_id'];
$image = $data['image'];

$query = "UPDATE news SET title = ?, content = ?, image = ?, topic_id = ? , user_id = ? WHERE id = ?";
$stmt = $dbConn->prepare($query);

if ($stmt->execute([$title, $content,$image, $topic_id, $user_id, $id])) {
    echo json_encode(array("data" => "Cập nhật tin tức thành công."));
} else {
    http_response_code(400);
    echo json_encode(array("data" => "Không thể cập nhật tin tức."));
}

?>