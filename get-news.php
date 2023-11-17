<?php
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: GET");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 include_once 'connection.php';

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;
    $query = "SELECT * FROM news LIMIT $limit OFFSET $offset";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // // if data is empty return with 404
    // if (empty($news)) {
    //     http_response_code(404);
    //     echo json_encode(
    //         array(
    //             "message" => "No news found."
    //         )
    //     );
    //     exit();
    // }
    echo json_encode(
        array(
            "data" => $news
        )
    )
 ?>