<?php
    $msg="";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idPergunta = $_POST['idPergunta'];
        $pergunta = $_POST['pergunta'];
        $alt = $_POST['alt'];
        $alt2 = $_POST['alt2'];
        $alt3 = $_POST['alt3'];
        $alt4 = $_POST['alt4'];
        $certa = $_POST['certa'];

        if(!file_exists("perguntas.txt")){
            $p = fopen("perguntas.txt", "w") or die("Erro ao criar arquivo de perguntas. ");
            $linha = "ID;PERGUNTA\n";
            fwrite($p,$linha);
            fclose($p);
        }
        $p = fopen("perguntas.txt", "a") or die("Erro ao abrir arquivo de perguntas. ");
        $linha = $idPergunta . ";" . $pergunta . "\n";
        fwrite($p, $linha);
        fclose($p);

        if(!file_exists("respostas.txt")){
            $r = fopen("respostas.txt","w") or die("Erro ao criar arquivo de respostas.");
            $linha = "ID;IDPERGUNTA;RESPOSTA;CERTA\n";
            fwrite($r,$linha);
            fclose($r);
        }

        $r = fopen("respostas.txt", "a") or die("Erro ao abrir arquivo de respostas. ");

        if($certa==1){
            $linha =  "1;" . $idPergunta . ";" . $alt . ";1\n";
        }else{
            $linha = "1;" . $idPergunta . ";" . $alt . ";0\n";
        }
        fwrite($r, $linha);

        if($certa == 2){
            $linha = "2;" . $idPergunta . ";" . $alt2 . ";1\n";
        }
        else{
            $linha = "2;" . $idPergunta . ";" . $alt2 . ";0\n";
        }
        fwrite($r, $linha);

        if($certa == 3){
            $linha = "3;" . $idPergunta . ";" . $alt3 . ";1\n";
        }
        else{
            $linha = "3;" . $idPergunta . ";" . $alt3 . ";0\n";
        }
        fwrite($r, $linha);

        if($certa==4){
            $linha = "4;" . $idPergunta . ";" . $alt4 . ";1\n";
        }
        else{
            $linha = "4;" . $idPergunta . ";" . $alt4 . ";0\n";
        }
        fwrite($r, $linha);
        
        fclose($r);

        $msg = "Cadastro de pergunta deu certo";
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
    <a href="criarPergunta.html">Voltar para a criacao de perguntas</a>
        <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>
