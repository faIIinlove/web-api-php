<!-- thêm mới tin tức -->
<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';
$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'];
$content = $data['content'];
$image = $data['image'];
$topic_id = $data['topic_id'];
$user_id = $data['user_id'];

$query = "INSERT INTO news (title, content, image, topic_id, user_id, created_at) VALUES ('$title', '$content', '$image', '$topic_id', '$user_id', now())";
$stmt = $dbConn->prepare($query);
$stmt->execute();
echo json_encode(
    array(
        "data" => $data,
    )
)
    ?>