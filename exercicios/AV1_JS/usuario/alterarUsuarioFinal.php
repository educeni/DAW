<?php
    $msg = "";
    $cpf = "";
    $nome = "";
    $email = "";
    $senha = "";
    $novoArquivo = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $arqUsuario = fopen("usuarios.txt", "r") or die("erro ao abrir arquivo");

        while(($linha=fgets($arqUsuario)) != false){
            $colunaDados = explode(";", $linha);

            if(trim($colunaDados[0]) == $cpf){
                $linha = $cpf . ";" . $nome . ";" . $email . ";" . $senha . "\n";
            }
            
            $novoArquivo = $novoArquivo . $linha;
        }

        fclose($arqUsuario);

        $arqUsuario = fopen("usuarios.txt", "w") or die("erro ao abrir arquivo");
        fwrite($arqUsuario, $novoArquivo);
        fclose($arqUsuario);

        $msg = "Deu tudo certo!!";
        echo $msg;
    }
?>