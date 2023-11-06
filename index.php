<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    //đọc dữ liệu từ client gửi lên query string
    //http://127.0.0.1:8686/index.php?a=5&b=10
    $a = $_GET["a"];
    $b = $_GET["b"];
    $c = $_GET["c"];

    //tính delta
    $delta = $b*$b - 4*$a*$c;
    if ($delta < 0){
        $result = "Phương trình vô nghiệm";
    } else if ($delta == 0){
        $result = "Phương trình có nghiệm kép x1 = x2 = " . (-$b/2*$a);
    } else {
        $result = "Phương trình có 2 nghiệm phân biệt x1 = " . ((-$b + sqrt($delta))/2*$a) . " và x2 = " . ((-$b - sqrt($delta))/2*$a);
    }

    echo json_encode(
        array(
        "message" => $result
        )
    );
?>