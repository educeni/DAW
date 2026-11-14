<?php   
    header("Content-Type: application/json; charset=UTF-8");
    $v1 = $_GET["a"];
    $v2 = $_GET["b"];
    $operador = $_GET["op"];

    if ($operador == "+") {
        $result = $v1 + $v2;
    } elseif ($operador == "-") {
        $result = $v1 - $v2;
    } elseif ($operador == "*") {
        $result = $v1 * $v2;
    } elseif ($operador == "/") {
        if ($v2 != 0) {
            $result = $v1 / $v2;
        } else {
            echo "Error: Division by zero.";
            exit();
        }
    } else {
        echo "Error: Invalid operator.";
        exit();
    }

    $resposta = [
        "a" => $v1,
        "b" => $v2,
        "op" => $operador,
        "resultado" => $result
    ];

    echo json_encode($resposta);
    
?>