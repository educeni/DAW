<?php
    $msg="";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idPergunta = $_POST['idPergunta'];
        $pergunta = $_POST['pergunta'];
        $certa = $_POST['certa'];
        $idResp = $_POST['idResp'];

        if(empty($idPergunta) || empty($pergunta) || empty($certa) || empty($idResp)){
            $msg = "Erro: Todos os campos devem ser preenchidos!";
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
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pergunta criada</title>
</head>
<body>
    <h1><?php echo $msg; ?></h1>
    <a href="criarPerguntaDiscursiva.html">Voltar para a criacao de perguntas</a>
        <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>
