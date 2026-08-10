<?php 
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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3DAW</title>
</head>
<body>
    <?php echo "<h1>Resultado: $result</h1>";?>
    <hr>
    <strong>Continuar o calculo? </strong>
    <form action="calcular.php" method="GET">
        Forneca o valor: <input type="text" value="0" name="b"><br>
        Forneca o operador : <input type="text" value="0" name="op"><br>
            <input type="submit" value="Calcular"><br>
    </form>
</body>
</html>