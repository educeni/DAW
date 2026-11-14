<?php
    $msg = "";
    $idPergunta = '';
    $tipo = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $idPergunta = $_POST['idPergunta'];
        $tipo = $_POST['tipo'];

        if(($tipo == 'M') || $tipo == 'm'){
            $a = fopen("perguntas.txt", "r") or die("Erro ao abrir o arquivo de perguntas ");
            $aTemp = fopen("perguntasTemp.txt", "w") or die("Erro ao abrir o arquivo temporario de perguntas ");
            $r = fopen("respostas.txt", "r") or die("Erro ao abrir o arquivo de respostas ");
            $rTemp = fopen("respostasTemp.txt", "w") or die("Erro ao abrir o arquivo temporario de respostas ");

            while(($linha = fgets($a)) !== false){
                $colunaDados = explode(";", $linha);

                if($colunaDados[0] != $idPergunta){
                    fwrite($aTemp, $linha);
                }

            }

            while(($linha = fgets($r)) !== false){
                $colunaDados = explode(";", $linha);

                if($colunaDados[1] != $idPergunta){
                    fwrite($rTemp, $linha);
                }

            }


            fclose($a);
            fclose($aTemp);
            fclose($r);
            fclose($rTemp);
            rename("perguntasTemp.txt", "perguntas.txt");
            rename("respostasTemp.txt", "respostas.txt");
        }


        else if(($tipo == "D") || $tipo == "d"){
            $a = fopen("perguntasDiscursivas.txt", "r") or die("Erro ao abrir o arquivo de perguntas discursivas");
            $aTemp = fopen("perguntasTemp.txt", "w") or die("Erro ao abrir o arquivo temporario de perguntas discursivas. ");
            $r = fopen("respostasDiscursivas.txt", "r") or die("Erro ao abrir o arquivo de respostas ");
            $rTemp = fopen("respostasTemp.txt", "w") or die("Erro ao abrir o arquivo temporario de respostas ");

            while(($linha = fgets($a)) !== false){
                $colunaDados = explode(";", $linha);

                if($colunaDados[0] != $idPergunta){
                    fwrite($aTemp, $linha);
                }

            }

            while(($linha = fgets($r)) !== false){
                $colunaDados = explode(";", $linha);

                if($colunaDados[1] != $idPergunta){
                    fwrite($rTemp, $linha);
                }

            }


            fclose($a);
            fclose($aTemp);
            fclose($r);
            fclose($rTemp);
            rename("perguntasTemp.txt", "perguntasDiscursivas.txt");
            rename("respostasTemp.txt", "respostasDiscursivas.txt");
        }
        else{
            $msg = "Tipo de pergunta invalido.";
            echo $msg;
            exit();
        }


        $msg = "Exclusão realizada com sucesso! ";
        echo($msg);
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
            }
            console.log("Enviado dados para o servidor...");
            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/perguntas/excluirPergunta.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("idPergunta=" + encodeURIComponent(idPergunta) + "&tipo=" + encodeURIComponent(tipo));
        }
    </script>

    <h1>Deseja excluir uma pergunta?</h1>
    <form action="" method="POST">
        <label for="idPergunta">Forneca o id da pergunta:</label>
        <input type="number" name="idPergunta" id="idPergunta">
        <label for="tipo">Forneca o tipo da pergunta (d ou m):</label>
        <select name="tipo" id="tipo">
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