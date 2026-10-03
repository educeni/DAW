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


        $msg = "Exclusão realizada com sucesso! ";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Pergunta</title>
</head>
<body>
    <h1>Deseja excluir uma pergunta?</h1>
    <form action="excluirPergunta.php" method="POST">
        Forneca o id da pergunta: <input type="number" name="idPergunta" id="idPergunta">
        Forneca o tipo da pergunta (d ou m): <input type="text" name="tipo" id="tipo">
        <input type="submit" value="Confirme a exclusão">
    </form>
    <p><?php echo $msg ?></p>
    <a href="listarPergunta.php">Voltar para listagem</a>
        <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>