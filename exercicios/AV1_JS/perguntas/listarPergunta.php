<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTAR PERGUNTA</title>
</head>
<body>
    <script>
        function listarPergunta(){
            let idPergunta = document.getElementById("idPergunta").value;
            let tipo = document.getElementById("tipo").value;

            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("msg").innerHTML = this.responseText;
                }
                else if(this.readyState == 4){
                    console.log("Requisição falhou.");
                }
            }
            console.log("Enviando dados para o servidor...");
            xmlhttp.open("GET", "http://localhost/DAW/exercicios/AV1_JS/perguntas/listarPergunta.php" + 
                        "?idPergunta=" + encodeURIComponent(idPergunta) + "&tipo=" + encodeURIComponent(tipo));
            xmlhttp.send();
        }
    </script>

    <h1>Deseja listar uma pergunta?</h1>
    <form action="" method="GET">
        <label for="idPergunta">Forneca o id da pergunta</label>
        <input type="text" name="idPergunta" id="idPergunta" required>
        <label for="tipo">Forneca o tipo da pergunta (d ou m)</label>
        <input type="text" name="tipo" id="tipo" required>
        <input type="button" value="Confirmar" onclick="listarPergunta()">
    </form>
    <br><br>

    <?php
        $msg = "";
        if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idPergunta'])){
            $idPergunta = trim($_GET['idPergunta']);
            $tipo = $_GET['tipo'];

            if(($tipo == 'd')||($tipo == 'D')) {
                $arq = fopen("perguntasDiscursivas.txt", "r") or die("erro ao abrir arquivo");
            }
            else if(($tipo == 'm')||($tipo == 'M')) { 
                $arq = fopen("perguntas.txt", "r") or die("erro ao abrir arquivo");
            }
            else {
                $msg = "Tipo de pergunta inválido!";
                echo "<p>" . $msg . "</p>";
                exit();
            }

            while(($linha = fgets($arq)) !== false){
                $colunaDados = explode(";", $linha);

                if (trim($colunaDados[0]) == $idPergunta) {
                    echo "Id Pergunta: " . $colunaDados[0] . "<br>" . "Pergunta:" . $colunaDados[1] . "<br>";
                    $msg = "Pergunta encontrada!";
                    break;
                }
            }
            if ($msg == "") {
                $msg = "Pergunta não encontrada!";
            }
            fclose($arq);
            echo "<p>" . $msg . "</p>";
            exit();
        }
    ?>
    <p id="msg"></p>
    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>