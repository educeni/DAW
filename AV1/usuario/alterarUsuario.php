<?php
    $cpf = "";
    $nome = "";
    $email = "";
    $senha = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cpf'])){
        $cpf = $_GET['cpf'];

        $arqUsuario = fopen("usuarios.txt", "r") or die("erro ao abrir arquivo");

        while(($linha=fgets($arqUsuario)) != false){

            $colunaDados = explode(";", $linha);

            if($colunaDados[0] == $cpf){
                $nome = $colunaDados[1];
                $email = $colunaDados[2];
                $senha = $colunaDados[3];
                break;
            }
        }
        fclose($arqUsuario);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Usuario</title>
</head>
<body>
    <form action="alterarUsuarioFinal.php" method="POST">
        <label for="cpf">Cpf</label>
        <input type="number" name="cpf" id="cpf" value="<?php echo $cpf; ?>" readonly>
        <br>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" >
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>" >
        <br>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" value="<?php echo $senha; ?>" >
        <br>
        <input type="submit" value="Confirmar alteracao">
        <br>
    </form>
    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>