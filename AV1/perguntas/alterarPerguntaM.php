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
    <form action="alterarPerguntaMultipla.php" method="POST">
        <input type="hidden" name="idPergunta" value="<?php echo $idPergunta; ?>">

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

        <input type="submit" value="Confirmar alteração">

    </form>
    <a href="alterarPergunta.html">Voltar para alterar Pergunta</a>
        <a href="../../index.html">Voltar para tela inicial</a>
</body>
</html>