<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once("../includes/conexao.php");

        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "UPDATE usuarios
                SET nome = ?, email = ?, senha = ?
                WHERE cpf = ?";

        $stmt = $con->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar atualização: " . $con->error);
        }

        $stmt->bind_param("ssss", $nome, $email, $senha, $cpf);

        if ($stmt->execute()) {

            if ($stmt->affected_rows > 0) {
                echo "Usuário alterado com sucesso!";
            } else {
                echo "Nenhuma alteração realizada. Verifique se o CPF existe ou se os dados foram modificados.";
            }

        } else {
            if ($stmt->errno == 1062) {
                echo "Erro: Este email já está cadastrado para outro usuário.";
            } else {
                echo "Erro ao alterar usuário: " . $stmt->error;
            }
        }

        $stmt->close();
        $con->close();
    }
?>