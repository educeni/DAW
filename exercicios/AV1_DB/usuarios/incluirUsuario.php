
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once("../includes/conexao.php");

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $cpf = $_POST['cpf'];

        // Preparando o comando SQL
        $sql = "INSERT INTO usuarios (cpf, nome, email, senha)
                VALUES (?, ?, ?, ?)";

        $stmt = $con->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar cadastro: " . $con->error);
        }

        $stmt->bind_param("ssss", $cpf, $nome, $email, $senha);

        if ($stmt->execute()) {
            echo "Usuário incluído com sucesso!";
        } else {
            if ($stmt->errno == 1062) {
                echo "Erro: CPF ou email já cadastrado.";
            } else {
                echo "Erro ao incluir usuário: " . $stmt->error;
            }
        }

        $stmt->close();
        $con->close();

        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
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

            if (nome === "" || email === "" || senha === "" || cpf === "") {
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

            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/usuario/incluirUsuario.php", true);

            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlhttp.send(
                "nome=" + encodeURIComponent(nome) +
                "&email=" + encodeURIComponent(email) +
                "&senha=" + encodeURIComponent(senha) +
                "&cpf=" + encodeURIComponent(cpf)
            );
        }
    </script>

    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        <br>

        <input type="button" value="Incluir Usuario" onclick="IncluirUsuario()">
    </form>

    <p id="msg"></p>

    <a href="../index.html">Voltar para tela inicial</a>

</body>
</html>
