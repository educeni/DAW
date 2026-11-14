<?php
    $msg="";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idPergunta = $_POST['idPergunta'];
        $pergunta = $_POST['pergunta'];
        $certa = $_POST['certa'];
        $idResp = $_POST['idResp'];

        if(empty($idPergunta) || empty($pergunta) || empty($certa) || empty($idResp)){
            $msg = "Erro: Todos os campos devem ser preenchidos!";
            exit();
        }else{

        if(!file_exists("perguntasDiscursivas.txt")){
            $p = fopen("perguntasDiscursivas.txt", "w") or die("Erro ao criar arquivo de perguntas. ");
            $linha = "ID;PERGUNTA\n";
            fwrite($p,$linha);
            fclose($p);
        }
        $p = fopen("perguntasDiscursivas.txt", "a") or die("Erro ao abrir arquivo de perguntas. ");
        $linha = $idPergunta . ";" . $pergunta . "\n";
        fwrite($p, $linha);
        fclose($p);

        if(!file_exists("respostasDiscursivas.txt")){
            $r = fopen("respostasDiscursivas.txt","w") or die("Erro ao criar arquivo de respostas.");
            $linha = "ID;IDPERGUNTA;GABARITO\n";
            fwrite($r,$linha);
            fclose($r);
        }

        $r = fopen("respostasDiscursivas.txt", "a") or die("Erro ao abrir arquivo de respostas. ");

        $linha =  $idResp . ";" . $idPergunta . ";" . $certa . "\n";
        fwrite($r, $linha);

        fclose($r);

        $msg = "Cadastro de pergunta deu certo";
        echo $msg;
        exit();
        }
    }
?>
