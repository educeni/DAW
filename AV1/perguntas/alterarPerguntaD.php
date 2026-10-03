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

        while($linha = fgets($aRespostas) != false){
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
    <form action="alterarPerguntaDiscursiva.php" method="POST">
        <input type="hidden" name="idPergunta" id="idPergunta" value="<?php echo $idPergunta ?>">
        Pergunta: <input type="text" name="pergunta" id="pergunta" value="<?php echo $pergunta ?>">
        <br><br>
        Respostas: <input type="text" name="resposta" id="resposta" value="<?php echo $resposta ?>">
        <br><br>
        <input type="submit" value="Confirmar alteração">
    </form>
    <a href="alterarPerguntaDisc.html">Deseja enviar o codigo novamente?</a>
        <a href="../../index.html">Voltar para tela inicial</a>
</body>
</html>