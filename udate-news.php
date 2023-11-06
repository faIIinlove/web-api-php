<?php
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Methods: GET");
     header("Access-Control-Max-Age: 3600");
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(array("message" => "Phương thức không được hỗ trợ."));
        exit;
    }
     
    include_once 'connection.php';
    if (!empty($data['id']) && !empty($data['title']) && !empty($data['content']) && isset($data['topic_id']) && isset($data['user_id'])) {
        $id = $data['id'];
        $title = $data['title'];
        $content = $data['content'];
        $topic_id = $data['topic_id'];
        $user_id = $data['user_id'];
    
        $query = "UPDATE news SET title = ?, content = ?, topic_id = ?, user_id = ? WHERE id = ?";
        $stmt = $dbConn->prepare($query);
        
        if ($stmt->execute([$title, $content, $topic_id, $user_id, $id])) {
            echo json_encode(array("message" => "Cập nhật tin tức thành công."));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Không thể cập nhật tin tức."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Dữ liệu cần thiết không đầy đủ."));
    }
?>