<?php 
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'connection.php';
    
    try {
        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";
        $fileName = $_FILES['image']['name'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
        move_uploaded_file($fileTmpName, $uploadPath);
        echo json_encode(
            // array(
            //     "error" => false,
            //     "message" => "Upload successful",
            //     "path" => "http://localhost:712/uploads/".$fileName
            // )
            array(
                "data" => "http://localhost:712/uploads/".$fileName
            )
        );
    } catch (Exception $e) {
        echo json_encode(
            array(
                "error" => true,
                "message" => "Upload failed",
                "path" => null
            )
        );
    }