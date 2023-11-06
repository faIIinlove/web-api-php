<!-- thêm mới tin tức -->
<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    //INSERT INTO `news` (`id`, `title`, `content`, `created_at`, `topic_id`, `user_id`) VALUES (1, 'Tin tức 1', 'Nội dung tin tức 1', '2020-11-01 00:00:00', 1, 1),
    include_once 'connection.php';
    $data = json_decode(file_get_contents("php://input"), true);
    $title = $data['title'];
    $content = $data['content'];
    $topic_id = $data['topic_id'];
    $user_id = $data['user_id'];
    $query = "INSERT INTO news (title, content, topic_id, user_id, created_at) VALUES ('$title', '$content', '$topic_id', '$user_id', now())";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    echo json_encode(
        array(
            "message" => "Thêm mới tin tức thành công"
        )
    )
?>