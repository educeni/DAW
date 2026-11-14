<?php
    $idPergunta = '';
    $pergunta = "";
    $alt = "";
    $alt2 = "";
    $alt3 = "";
    $alt4 = "";
    $certa = "";

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idPergunta'])){
        $idPergunta = $_GET['idPergunta'];

        $aPerguntas = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo de perguntas. ");        
        $aRespostas = fopen("respostas.txt", "r") or die("Erro ao abrir arquivo de respostas. "); 

        while(($linha = fgets($aPerguntas)) != false){
            $colunaDados = explode(";", trim($linha));

            if($idPergunta == $colunaDados[0]){
                $pergunta = $colunaDados[1];
            }
            
        }
        fclose($aPerguntas);

        while(($linha = fgets($aRespostas)) != false){
            $colunaDados = explode(";", trim($linha));

            if($idPergunta == $colunaDados[1]){
                switch ($colunaDados[0]) {
                    case 1:
                        $alt = $colunaDados[2];
                        break;
                    case 2:
                        $alt2 = $colunaDados[2];
                        break;
                    case 3:
                        $alt3 = $colunaDados[2];
                        break;
                    case 4:
                        $alt4 = $colunaDados[2];
                        break;
                    default:
                        break;
                }
                if($colunaDados[3] == 1){
                    $certa = $colunaDados[0];
                }
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
            xmlhttp.send("idPergunta=" + encodeURIComponent(idPergunta) + "&pergunta=" + encodeURIComponent(pergunta) + 
                         "&alt=" + encodeURIComponent(alt) + "&alt2=" + encodeURIComponent(alt2) + 
                         "&alt3=" + encodeURIComponent(alt3) + "&alt4=" + encodeURIComponent(alt4) +
                         "&certa=" + encodeURIComponent(certa));
        }



    </script>
    <form action="" method="POST">
        <input type="hidden" name="idPergunta" id="idPergunta" value="<?php echo $idPergunta; ?>">
        

        Pergunta: <input type="text" id="pergunta" name="pergunta" value="<?php echo $pergunta ?>">
        <br><br>

        Alternativa 1: <input type="text" id="alt" name="alt" value="<?php echo $alt ?>">
        <br><br>

        Alternativa 2: <input type="text" id="alt2" name="alt2" value="<?php echo $alt2 ?>">
        <br><br>

        Alternativa 3: <input type="text" id="alt3" name="alt3" value="<?php echo $alt3 ?>">
        <br><br>

        Alternativa 4: <input type="text" id="alt4" name="alt4" value="<?php echo $alt4 ?>">
        <br><br>

        Resposta certa: <input type="number" id="certa" name="certa" required>
        <br><br>

        <input type="button" value="Confirmar alteração" onclick="alterarPergunta()">

    </form>
    <p id="msg"></p>
    <a href="alterarPergunta.html">Voltar para alterar Pergunta</a>
        <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>