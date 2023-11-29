<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connection.php';

try {
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
    $name = $data->name;
    $phone = $data->phone;
    $address = $data->address;

    $query = "UPDATE users SET email = '$email', name = '$name', phone = '$phone', address = '$address' WHERE id = $id";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    echo json_encode(
        array(
            http_response_code(200),
            "message" => "Account was updated."
        )
    );
} catch (Exception $e) {
    echo json_encode(
        array(
            http_response_code(500),
            "message" => "Account was not updated."
        )
    );
}

?>