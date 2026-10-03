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

            if($colunaDados[0] == $cpf){
                $linha = $cpf . ";" . $nome . ";" . $email . ";" . $senha . "\n";
            }
            
            $novoArquivo = $novoArquivo . $linha;
        }

        fclose($arqUsuario);

        $arqUsuario = fopen("usuarios.txt", "w") or die("erro ao abrir arquivo");
        fwrite($arqUsuario, $novoArquivo);
        fclose($arqUsuario);

        $msg = "Deu tudo certo!!";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Usuario</title>
</head>
<body>
    <h1>Alterar Usuario</h1>

    <?php echo $msg ?>
    <a href="../../index.html">Voltar para tela inicial</a>
</body>
</html>