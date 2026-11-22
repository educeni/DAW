
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once("../includes/conexao.php");

        $idPergunta = $_POST['idPergunta'] ?? '';
        $tipo = strtoupper($_POST['tipo'] ?? '');

        // Verifica se o ID é válido
        if (!filter_var($idPergunta, FILTER_VALIDATE_INT) || $idPergunta <= 0) {
            echo "Erro: ID da pergunta inválido.";
            exit();
        }

        // Verifica o tipo da pergunta
        if ($tipo != 'M' && $tipo != 'D') {
            echo "Erro: Tipo de pergunta inválido.";
            exit();
        }

        // Inicia uma transação
        $con->begin_transaction();

        try {

            if ($tipo == 'M') {

                // EXCLUINDO AS ALTERNATIVAS
                $sql = "DELETE FROM respostas WHERE id_pergunta = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $idPergunta);
                $stmt->execute();
                $stmt->close();

                // EXCLUINDO A PERGUNTA
                $sql = "DELETE FROM perguntas WHERE id_pergunta = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $idPergunta);
                $stmt->execute();

            } else if ($tipo == 'D') {

                // EXCLUINDO A RESPOSTA DISCURSIVA
                $sql = "DELETE FROM respostas_discursivas WHERE id_pergunta = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $idPergunta);
                $stmt->execute();
                $stmt->close();

                // EXCLUINDO A PERGUNTA DISCURSIVA
                $sql = "DELETE FROM perguntas_discursivas WHERE id_pergunta = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $idPergunta);
                $stmt->execute();

            }

            if ($stmt->affected_rows > 0) {

                $con->commit();
                echo "Exclusão realizada com sucesso!";

            } else {

                $con->rollback();
                echo "Pergunta não encontrada.";
            }

            $stmt->close();

        } catch (Exception $e) {

            $con->rollback();

            echo "Erro ao excluir pergunta: " . $e->getMessage();
        }

        $con->close();
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Pergunta</title>
</head>
<body>
    <script>
        function excluirPergunta() {
            let idPergunta = document.getElementById("idPergunta").value;
            let tipo = document.getElementById("tipo").value;

            if (idPergunta === "" || tipo === "") {
                alert("Todos os campos são obrigatórios.");
                return false;
            }

            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("msg").innerHTML = this.responseText;
                }
                else if(this.readyState == 4){
                    console.log("Requisição falhou!");
                }
            };

            console.log("Enviando dados para o servidor...");

            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/perguntas/excluirPergunta.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlhttp.send("idPergunta=" + encodeURIComponent(idPergunta) +
                         "&tipo=" + encodeURIComponent(tipo));
        }
    </script>

    <h1>Deseja excluir uma pergunta?</h1>

    <form action="" method="POST">

        <label for="idPergunta">Forneça o ID da pergunta:</label>
        <input type="number" name="idPergunta" id="idPergunta" required>

        <label for="tipo">Forneça o tipo da pergunta:</label>

        <select name="tipo" id="tipo" required>
            <option value="d">Discursiva</option>
            <option value="m">Múltipla escolha</option>
        </select>

        <input type="button" value="Confirme a exclusão" onclick="excluirPergunta()">

    </form>

    <p id="msg"></p>

    <a href="listarPergunta.php">Voltar para listagem</a>
    <a href="../index.html">Voltar para tela inicial</a>

</body>
</html>