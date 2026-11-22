
<?php
    $idPergunta = '';
    $pergunta = "";
    $alt = "";
    $alt2 = "";
    $alt3 = "";
    $alt4 = "";
    $certa = "";
    $msgErro = "";

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idPergunta'])) {

        require_once("../includes/conexao.php");

        $idPergunta = $_GET['idPergunta'];

        // Busca o enunciado da pergunta
        $sql = "SELECT pergunta FROM perguntas WHERE id_pergunta = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $idPergunta);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $dadosPergunta = $resultado->fetch_assoc();
            $pergunta = $dadosPergunta['pergunta'];

            // Busca as quatro alternativas da pergunta
            $sql = "SELECT id_resposta, resposta, certa
                    FROM respostas
                    WHERE id_pergunta = ?
                    ORDER BY id_resposta";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $idPergunta);
            $stmt->execute();

            $resultado = $stmt->get_result();

            while ($dados = $resultado->fetch_assoc()) {

                switch ($dados['id_resposta']) {
                    case 1:
                        $alt = $dados['resposta'];
                        break;

                    case 2:
                        $alt2 = $dados['resposta'];
                        break;

                    case 3:
                        $alt3 = $dados['resposta'];
                        break;

                    case 4:
                        $alt4 = $dados['resposta'];
                        break;
                }

                if ($dados['certa'] == 1) {
                    $certa = $dados['id_resposta'];
                }
            }

        } else {
            $msgErro = "Pergunta não encontrada.";
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
    <title>Alterar Pergunta</title>
</head>
<body>
    <script>
        function alterarPergunta() {
            let idPergunta = document.getElementsByName("idPergunta")[0].value;
            let pergunta = document.getElementById("pergunta").value;
            let alt = document.getElementById("alt").value;
            let alt2 = document.getElementById("alt2").value;
            let alt3 = document.getElementById("alt3").value;
            let alt4 = document.getElementById("alt4").value;
            let certa = document.getElementById("certa").value;

            if (pergunta === "" || alt === "" || alt2 === "" || alt3 === "" || alt4 === "" || certa === "") {
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

            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/perguntas/alterarPerguntaM.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlhttp.send("idPergunta=" + encodeURIComponent(idPergunta) +
                         "&pergunta=" + encodeURIComponent(pergunta) +
                         "&alt=" + encodeURIComponent(alt) +
                         "&alt2=" + encodeURIComponent(alt2) +
                         "&alt3=" + encodeURIComponent(alt3) +
                         "&alt4=" + encodeURIComponent(alt4) +
                         "&certa=" + encodeURIComponent(certa));
        }
    </script>

    <?php if ($msgErro != "") { ?>
        <p><?php echo htmlspecialchars($msgErro); ?></p>
    <?php } else { ?>

        <form action="" method="POST">
            <input type="hidden" name="idPergunta" id="idPergunta"
                   value="<?php echo htmlspecialchars($idPergunta); ?>">

            Pergunta:
            <input type="text" id="pergunta" name="pergunta"
                   value="<?php echo htmlspecialchars($pergunta); ?>">
            <br><br>

            Alternativa 1:
            <input type="text" id="alt" name="alt"
                   value="<?php echo htmlspecialchars($alt); ?>">
            <br><br>

            Alternativa 2:
            <input type="text" id="alt2" name="alt2"
                   value="<?php echo htmlspecialchars($alt2); ?>">
            <br><br>

            Alternativa 3:
            <input type="text" id="alt3" name="alt3"
                   value="<?php echo htmlspecialchars($alt3); ?>">
            <br><br>

            Alternativa 4:
            <input type="text" id="alt4" name="alt4"
                   value="<?php echo htmlspecialchars($alt4); ?>">
            <br><br>

            Resposta certa:
            <input type="number" id="certa" name="certa"
                   min="1" max="4" required
                   value="<?php echo htmlspecialchars($certa); ?>">
            <br><br>

            <input type="button" value="Confirmar alteração"
                   onclick="alterarPergunta()">
        </form>

    <?php } ?>
    <p id="msg"></p>

    <a href="alterarPergunta.html">Voltar para alterar Pergunta</a>
    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>