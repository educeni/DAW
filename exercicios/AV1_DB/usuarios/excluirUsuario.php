
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once("../includes/conexao.php");

        $cpf = trim($_POST['cpf']);

        $sql = "DELETE FROM usuarios WHERE cpf = ?";

        $stmt = $con->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar exclusão: " . $con->error);
        }

        $stmt->bind_param("s", $cpf);

        if ($stmt->execute()) {

            if ($stmt->affected_rows > 0) {
                echo "Usuário excluído com sucesso!";
            } else {
                echo "Usuário não encontrado.";
            }

        } else {
            echo "Erro ao excluir usuário: " . $stmt->error;
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
    <title>Excluir Usuario</title>
</head>
<body>

    <script>
        function ExcluirUsuario() {
            let cpf = document.getElementById("cpf").value;

            if (cpf === "") {
                alert("O campo CPF é obrigatório.");
                return false;
            }

            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("msg").innerHTML = this.responseText;
                }
                else if (this.readyState == 4) {
                    document.getElementById("msg").innerHTML = "Erro ao excluir usuário.";
                }
            };

            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/usuario/excluirUsuario.php", true);

            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlhttp.send("cpf=" + encodeURIComponent(cpf));
        }
    </script>

    <h1>Excluir usuario</h1>

    <form action="" method="POST">
        <label for="cpf">Digite o cpf do usuario para a exclusão</label>
        <input type="text" name="cpf" id="cpf" required>

        <br><br>

        <input type="button" value="Excluir usuario" onclick="ExcluirUsuario()">
    </form>

    <p id="msg"></p>

    <a href="../index.html">Voltar para tela inicial</a>

</body>
</html>