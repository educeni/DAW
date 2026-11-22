
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idPergunta'])) {

        require_once("../includes/conexao.php");

        $idPergunta = trim($_GET['idPergunta']);
        $tipo = strtoupper($_GET['tipo'] ?? '');

        if (!filter_var($idPergunta, FILTER_VALIDATE_INT) || $idPergunta <= 0) {
            echo "<p>ID da pergunta inválido!</p>";
            exit();
        }

        // Verifica o tipo da pergunta
        if ($tipo == 'D') {

            $sql = "SELECT id_pergunta, pergunta
                    FROM perguntas_discursivas
                    WHERE id_pergunta = ?";

        } else if ($tipo == 'M') {

            $sql = "SELECT id_pergunta, pergunta
                    FROM perguntas
                    WHERE id_pergunta = ?";

        } else {
            echo "<p>Tipo de pergunta inválido!</p>";
            exit();
        }

        // Executa a consulta
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $idPergunta);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $dados = $resultado->fetch_assoc();

            echo "ID Pergunta: " . htmlspecialchars($dados['id_pergunta']) . "<br>";
            echo "Pergunta: " . htmlspecialchars($dados['pergunta']) . "<br>";

            echo "<p>Pergunta encontrada!</p>";

        } else {

            echo "<p>Pergunta não encontrada!</p>";
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
    <title>Listar Pergunta</title>
</head>
<body>

    <script>
        function listarPergunta(){

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
                    console.log("Requisição falhou.");
                }
            };

            console.log("Enviando dados para o servidor...");

            xmlhttp.open("GET", "http://localhost/DAW/exercicios/AV1_JS/perguntas/listarPergunta.php" +
                        "?idPergunta=" + encodeURIComponent(idPergunta) +
                        "&tipo=" + encodeURIComponent(tipo), true);

            xmlhttp.send();
        }
    </script>

    <h1>Deseja listar uma pergunta?</h1>

    <form action="" method="GET">

        <label for="idPergunta">Forneça o ID da pergunta:</label>
        <input type="number" name="idPergunta" id="idPergunta" required>

        <label for="tipo">Forneça o tipo da pergunta (D ou M):</label>
        <select name="tipo" id="tipo">
            <option value="d">Discursiva</option>
            <option value="m">Múltipla escolha</option>
        </select>
        <input type="button" value="Confirmar" onclick="listarPergunta()">
    </form>
    <br><br>
    <p id="msg"></p>
    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>