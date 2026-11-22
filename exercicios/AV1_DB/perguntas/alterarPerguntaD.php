
<?php
    $idPergunta = "";
    $pergunta = "";
    $resposta = "";
    $encontrou = false;

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idPergunta'])) {

        require_once("../includes/conexao.php");

        $idPergunta = $_GET['idPergunta'];

        if (!filter_var($idPergunta, FILTER_VALIDATE_INT) || $idPergunta <= 0) {
            die("Código da pergunta inválido.");
        }

        $sql = "SELECT p.id_pergunta, p.pergunta, r.gabarito
                FROM perguntas_discursivas p
                INNER JOIN respostas_discursivas r
                ON p.id_pergunta = r.id_pergunta
                WHERE p.id_pergunta = ?";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $idPergunta);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($dados = $resultado->fetch_assoc()) {
            $pergunta = $dados['pergunta'];
            $resposta = $dados['gabarito'];
            $encontrou = true;
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
    <title>Alterar pergunta discursiva</title>
</head>
<body>
    <?php if ($encontrou) { ?>

        <script>
            function alterarPerguntaDiscursiva() {
                let idPergunta = document.getElementById("idPergunta").value;
                let pergunta = document.getElementById("pergunta").value;
                let resposta = document.getElementById("resposta").value;

                if (pergunta === "" || resposta === "") {
                    alert("Todos os campos são obrigatórios.");
                    return false;
                }

                let xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("msg").innerHTML = this.responseText;
                    }
                    else if (this.readyState == 4) {
                        document.getElementById("msg").innerHTML = "Erro ao alterar pergunta.";
                    }
                };

                console.log("Enviando dados para o servidor...");

                xmlhttp.open("POST", "alterarPerguntaDiscursiva.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xmlhttp.send(
                    "idPergunta=" + encodeURIComponent(idPergunta) +
                    "&pergunta=" + encodeURIComponent(pergunta) +
                    "&resposta=" + encodeURIComponent(resposta)
                );
            }
        </script>

        <form action="" method="POST">

            <input type="hidden" name="idPergunta" id="idPergunta"
                value="<?php echo htmlspecialchars($idPergunta); ?>">

            Pergunta:
            <input type="text" name="pergunta" id="pergunta"
                value="<?php echo htmlspecialchars($pergunta); ?>" required>

            <br><br>

            Resposta:
            <input type="text" name="resposta" id="resposta"
                value="<?php echo htmlspecialchars($resposta); ?>" required>

            <br><br>

            <input type="button" value="Confirmar alteração"
                onclick="alterarPerguntaDiscursiva()">

        </form>

        <p id="msg"></p>

    <?php } else { ?>

        <p>Pergunta discursiva não encontrada!</p>

    <?php } ?>

    <a href="alterarPerguntaDisc.html">Deseja enviar o código novamente?</a>
    <br>
    <a href="../index.html">Voltar para tela inicial</a>

</body>
</html>