<?php
    $idPergunta = "";
    $pergunta = "";
    $resposta = "";
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idPergunta'])){
        $idPergunta = $_GET['idPergunta'];

        $aPerguntas = fopen("perguntasDiscursivas.txt", "r") or die("Erro ao abrir arquivo de perguntas. \n");
        $aRespostas = fopen("respostasDiscursivas.txt","r") or die("Erro ao abrir arquivo de respostas. ");

        while(($linha = fgets($aPerguntas)) != false){
            $colunaDados = explode(";", trim($linha));

            if($colunaDados[0] == $idPergunta){
                $pergunta = $colunaDados[1];
            }
        }
        fclose($aPerguntas);

        while(($linha = fgets($aRespostas)) != false){
            $colunaDados = explode(";", trim($linha));

            if($colunaDados[1] == $idPergunta){
                $id = $idPergunta;
                $resposta = $colunaDados[2];
            }
        }
        fclose($aRespostas);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar pergunta discursiva</title>
</head>
<body>
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
            xmlhttp.send("idPergunta=" + encodeURIComponent(idPergunta) + "&pergunta=" + encodeURIComponent(pergunta) + "&resposta=" + encodeURIComponent(resposta));
        }
    </script>
    <form action="" method="POST">
        <input type="hidden" name="idPergunta" id="idPergunta" value="<?php echo $idPergunta ?>">
        Pergunta: <input type="text" name="pergunta" id="pergunta" value="<?php echo $pergunta ?>">
        <br><br>
        Respostas: <input type="text" name="resposta" id="resposta" value="<?php echo $resposta ?>">
        <br><br>
        <input type="button" value="Confirmar alteração" onclick="alterarPerguntaDiscursiva()">
    </form>
    <p id="msg"></p>
    <a href="alterarPerguntaDisc.html">Deseja enviar o codigo novamente?</a>
        <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>