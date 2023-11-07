<?php
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: GET");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 include_once 'connection.php';
    // lấy danh sách news từ database
    $query = "SELECT * FROM news";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(
        array(
            "data" => $news
        )
    )
 ?>