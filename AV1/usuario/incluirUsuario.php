<?php
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $cpf = $_POST['cpf'];

        if(!file_exists("usuarios.txt")) {
            $arquivo = fopen("usuarios.txt", "w") or die("Erro ao criar arquivo de usuarios. ");
            $linha = "Cpf;Nome;Email;Senha\n";
            fwrite($arquivo, $linha);
            fclose($arquivo);
        }
        $arquivo = fopen("usuarios.txt", "a") or die("Erro ao abrir arquivo de usuarios. ");;
        $linha = $cpf . ";".  $nome . ";" . $email . ";" . $senha . "\n";
        fwrite($arquivo, $linha);
        fclose($arquivo);

        $msg = "Usuário incluído com sucesso!";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Usuario</title>
</head>
<body>
    <form action="incluirUsuario.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <label for="Cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        <br>
        <input type="submit" value="Incluir Usuario">
    </form>
    <?php echo $msg; ?>
    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>