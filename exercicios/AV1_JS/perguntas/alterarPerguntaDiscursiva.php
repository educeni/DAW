<?php
    $msg = "";
    $idPergunta = "";
    $pergunta = "";
    $resposta = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $idPergunta = $_POST['idPergunta'];
        $pergunta = $_POST['pergunta'];
        $resposta = $_POST['resposta']; 

        $aPerguntas = fopen("perguntasDiscursivas.txt", "r") or die("ERRO ao abrir arquivo de perguntas. ");
        $aPerguntasTemp = fopen("perguntasTemp.txt", "w") or die("ERRO ao criar arquivo temp de perguntas. ");

        $aRespostas = fopen("respostasDiscursivas.txt", "r") or die("ERRO ao abrir arquivo de respostas. ");
        $aRespostasTemp = fopen("respostasTemp.txt", "w") or die("ERRO ao criar arquivo temp de respostas. ");

        // Ajeitando txt perguntas
        while(($linha = fgets($aPerguntas))!== false ){
            $colunaDados = explode(";",$linha);

            if($colunaDados[0] == $idPergunta){
                $linha = $idPergunta . ";" . $pergunta . "\n";
                fwrite($aPerguntasTemp, $linha);
            }else{
                fwrite($aPerguntasTemp, $linha);
            }
        }
        fclose($aPerguntas);
        fclose($aPerguntasTemp);

        // Ajeitando txt respostas
        while(($linha = fgets($aRespostas))!= false ){
            $colunaDados = explode(";",$linha);

            if($colunaDados[1] == $idPergunta){
                $linha = $colunaDados[0] . ";" . $idPergunta . ";" . $resposta . "\n";
                fwrite($aRespostasTemp, $linha);
            }else{
                fwrite($aRespostasTemp, $linha);
            }
        }
        fclose($aRespostas);
        fclose($aRespostasTemp);
        rename("perguntasTemp.txt", "perguntasDiscursivas.txt");
        rename("respostasTemp.txt", "respostasDiscursivas.txt");

        $msg = "Alteração realizada com sucesso!!!";
        echo $msg;
        exit();
    }
?>