<?php
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "av1_daw";

    $con = new mysqli($host, $usuario, $senha, $banco);

    if ($con->connect_error) {
        die("Erro na conexão: " . $con->connect_error);
    }

    $con->set_charset("utf8mb4");
?>