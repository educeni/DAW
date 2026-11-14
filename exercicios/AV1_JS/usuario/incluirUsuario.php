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
        echo $msg;
        exit();
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
    <script>
        function IncluirUsuario() {
            let nome = document.getElementById("nome").value;
            let email = document.getElementById("email").value;
            let senha = document.getElementById("senha").value;
            let cpf = document.getElementById("cpf").value;

            console.log("Nome: " + nome);
            console.log("Email: " + email);
            console.log("CPF: " + cpf);

            if (nome === "" || email === "" || senha === "" || cpf === "") {
                console.log("Um ou mais campos estão vazios.");
                alert("Todos os campos são obrigatórios.");
                return false;
            }

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("msg").innerHTML = this.responseText;
                }
                else if (this.readyState == 4) {
                    document.getElementById("msg").innerHTML = "Erro ao incluir usuário.";
                }
            };
            console.log("Enviando dados para o servidor...");
            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/usuario/incluirUsuario.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("nome=" + encodeURIComponent(nome) + "&email=" + encodeURIComponent(email) + "&senha=" + encodeURIComponent(senha) + "&cpf=" + encodeURIComponent(cpf));
        }
    </script>

    <form action="" method="GET">
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
        <input type="button" value="Incluir Usuario" onclick="IncluirUsuario()">
    </form>
    <p id="msg"></p>
    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>