<?php
    $cpf = "";
    $nome = "";
    $email = "";
    $senha = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cpf'])) {

        require_once("../includes/conexao.php");

        $cpf = trim($_GET['cpf']);

        $sql = "SELECT * FROM usuarios WHERE cpf = ?";

        $stmt = $con->prepare($sql);

        $stmt->bind_param("s", $cpf);

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $usuario = $resultado->fetch_assoc();

            $nome = $usuario['nome'];
            $email = $usuario['email'];
            $senha = $usuario['senha'];

        } else {
            echo "Usuário não encontrado.";
        }

        $stmt->close();
        $con->close();
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
    <script>
        function AlterarUsuario() {

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
                    document.getElementById("msg").innerHTML = "Erro ao alterar usuário.";
                }
            };

            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/usuario/alterarUsuarioFinal.php", true);

            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlhttp.send(
                "nome=" + encodeURIComponent(nome) +
                "&email=" + encodeURIComponent(email) +
                "&senha=" + encodeURIComponent(senha) +
                "&cpf=" + encodeURIComponent(cpf)
            );
        }
    </script>

    <form action="alterarUsuarioFinal.php" method="POST">

        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf"
               value="<?php echo htmlspecialchars($cpf); ?>" readonly>
        <br>

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome"
               value="<?php echo htmlspecialchars($nome); ?>">
        <br>

        <label for="email">Email</label>
        <input type="text" name="email" id="email"
               value="<?php echo htmlspecialchars($email); ?>">
        <br>

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha"
               value="<?php echo htmlspecialchars($senha); ?>">
        <br>

        <input type="button" value="Confirmar alteracao" onclick="AlterarUsuario()">

    </form>

    <p id="msg"></p>

    <a href="../index.html">Voltar para tela inicial</a>

</body>
</html>