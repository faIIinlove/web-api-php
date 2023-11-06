<?php
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Methods: GET");
     header("Access-Control-Max-Age: 3600");
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'connection.php';
    $news_id = $_GET["news_id"];
    $query = "DELETE FROM news WHERE id = $news_id";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    echo json_encode(
        array(
            "message" => "Xóa tin tức thành công"
        )
    )

    ?>