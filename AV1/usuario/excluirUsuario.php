<?php
    $msg = "";
    $cpf = "";
    $novoArquivo = "";
    $nomeArquivo = "usuarios.txt";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cpf = trim($_POST['cpf']);
        if (!file_exists($nomeArquivo)) {
            $msg = "Erro: Arquivo de usuários não encontrado.";
        } else {
            $arqUsuarios = fopen("usuarios.txt", "r") or die("erro ao abrir arquivo");

            while(($linha=fgets($arqUsuarios)) != false){
                $colunaDados = explode(";", $linha);

                if($colunaDados[0] != $cpf){
                    $novoArquivo = $novoArquivo . $linha;
                }
            }
            fclose($arqUsuarios);
            $arqUsuarios = fopen("usuarios.txt", "w") or die("erro ao abrir arquivo");
            fwrite($arqUsuarios, $novoArquivo);
            fclose($arqUsuarios);

            $msg = "Deu tudo certo!!!";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuario</title>
</head>
<body>
    <h1>Excluir usuario</h1>

    <form action="excluirUsuario.php" method="POST">
        Digite o cpf do usuario para a exclusão: <input type="number" name="cpf">
        <br><br>
        <input type="submit" value="Excluir usuario">
    </form>

    <p><?php echo $msg ?></p>
    <a href="../../index.html">Voltar para tela inicial</a>
</body>
</html>