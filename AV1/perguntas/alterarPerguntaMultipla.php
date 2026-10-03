<?php
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idPergunta = $_POST['idPergunta'];
        $pergunta = $_POST['pergunta'];
        $alt =  $_POST['alt'];
        $alt2 = $_POST['alt2'];
        $alt3 = $_POST['alt3'];
        $alt4 = $_POST['alt4'];
        $certa = $_POST['certa'];

        $aPerguntas = fopen("perguntas.txt", "r") or die("ERRO ao abrir arquivo de perguntas. ");
        $aPerguntasTemp = fopen("perguntasTemp.txt", "w") or die("ERRO ao criar arquivo temp de perguntas. ");

        $aRespostas = fopen("respostas.txt", "r") or die("ERRO ao abrir arquivo de respostas. ");
        $aRespostasTemp = fopen("respostasTemp.txt", "w") or die("ERRO ao criar arquivo temp de respostas. ");

        // AJEITANDO PERGUNTAS ;o
        while(($linha = fgets($aPerguntas)) != false){
            $colunaDados = explode(";", trim($linha));

            if($colunaDados[0] == $idPergunta){
                $linha = $idPergunta . ";" . $pergunta . "\n";
                fwrite($aPerguntasTemp, $linha);
            }else{
                fwrite($aPerguntasTemp, $linha);
            }
        }
        fclose($aPerguntas);
        fclose($aPerguntasTemp);
        rename("perguntasTemp.txt", "perguntas.txt");

        //ALTERANDO RESPOSTAS!!!!
        while(($linha = fgets($aRespostas)) != false){
            $colunaDados = explode(";", trim($linha));

            if($colunaDados[1] == $idPergunta){
                switch ($colunaDados[0]) {
                    case 1:
                        $linha = "1;" . $idPergunta . ";" . $alt . ";" . ($certa == '1' ? '1' : '0') . "\n";
                        break;
                    case 2:
                        $linha = "2;" . $idPergunta . ";" . $alt2 . ";" . ($certa == '2' ? '1' : '0') . "\n";
                        break;
                    case 3:
                        $linha = "3;" . $idPergunta . ";" . $alt3 . ";" . ($certa == '3' ? '1' : '0') . "\n";
                        break;
                    case 4:
                        $linha = "4;" . $idPergunta . ";" . $alt4 . ";" . ($certa == '4' ? '1' : '0') . "\n";
                        break;
                    default:
                        echo("ERRO: id respostas invalido");
                        break;
                }
                fwrite($aRespostasTemp, $linha);
            }else{
                fwrite($aRespostasTemp, $linha);
            }
        }
        fclose($aRespostas);
        fclose($aRespostasTemp);
        rename("respostasTemp.txt", "respostas.txt");
        $msg = "Alteracao realizada  ebaa!!!!";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Pergunta Multipla Escolha</title>
</head>
<body>
    <h2><?php echo $msg; ?></h2>
    <a href="criarPergunta.html">Retornar para criação de Perguntas</a>
        <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>