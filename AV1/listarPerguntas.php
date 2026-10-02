<?php 

    echo "<h1>Lista de Perguntas Multipla Escolha</h1>";

    $a = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo de perguntas. \n");
    $a2 = fopen("respostas.txt", "r") or die("Erro ao abrir arquivo de respostas. \n");
    fgets($a);
    fgets($a2);
    while(($linha = fgets($a)) !== false) {
        $colunaDados = explode(";", trim($linha));
        echo "<br>ID: " . $colunaDados[0] . "<br>" . "Pergunta: " . $colunaDados[1] . "<br><br>";

        rewind($a2);
        while(($linhaResposta = fgets($a2)) !== false) {
            $dados  = explode(";", trim($linhaResposta));

            if($colunaDados[0] == $dados[1]) {
                echo "Resposta: " . $dados[0] . "<br>" . "Resposta: " . $dados[2] . "<br>" . ($dados[3] == '1' ? "(CORRETA)" : "(ERRADA)") . "<br><br>";
            }
        }   
    }   
    fclose($a);
    fclose($a2);

    echo "<h1>Lista de Perguntas Discursivas</h1>";
    $a = fopen("perguntasDiscursivas.txt", "r") or die("Erro ao abrir arquivo de perguntas discursivas. \n");
    $a2 = fopen("respostasDiscursivas.txt", "r") or die("Erro ao abrir arquivo de respostas discursivas. \n");

    fgets($a);
    fgets($a2);
    while(($linha = fgets($a)) !== false) {
        $colunaDados = explode(";", trim($linha));
        echo "ID: " . $colunaDados[0] . "<br>" . "Pergunta: " . $colunaDados[1] . "<br>";

        rewind($a2);
        while(($linhaResposta = fgets($a2)) !== false) {
            $dados = explode(";", trim($linhaResposta));

            if($colunaDados[0] == $dados[1]) {
                echo "Resposta: " . $dados[0] . "<br>" . "Resposta: " . $dados[2] . "<br><br>";
                break;
            }
        }   
    }   
    fclose($a);
    fclose($a2);
?>