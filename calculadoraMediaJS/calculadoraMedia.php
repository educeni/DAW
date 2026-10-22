<?php 
    $nome = $_GET['nome'];
    $mat = $_GET['mat'];
    $av1 = $_GET['av1'];
    $av2 = $_GET['av2'];
    
    $resultado = ($av1 + $av2) / 2;

    if(($av1>10)||($av2>10)||($av1>10)||($av2<0)){
        $msg = "Forneca notas validas";
    }else{
        if(($resultado >= 7) && ($resultado <= 10)){
            $msg = "Aprovado";
        }
        else if($resultado >= 5) {
            $msg = "Recuperacao";
        }
        else {
            $msg = "Reprovado";
        }
            echo $resultado . "\n";
    }

    echo $msg;
?>
