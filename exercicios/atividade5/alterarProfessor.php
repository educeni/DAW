<?php
    $msg = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mat = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $end = $_POST['end'];

    $arq = fopen("professor.txt","r") or die("Erro ao abrir arquivo");
    $arq2 = fopen("profTemp.txt","w") or die("Erro ao criar arquivo");

    while(($linha=fgets($arq))!==false)
    {
        $colunaDados = explode(";", $linha);

        if(trim($colunaDados[0]) != $mat) {
            fprintf($arq2, "%s",$linha);
        }
        else {
            fprintf($arq2, "%s;%s;%s%s\n",$mat,$nome,$email,$end);
        }
    }

    fclose($arq);
    fclose($arq2);
    
    $arq = fopen("professor.txt","w") or die("Erro ao abrir arquivo");
    $arq2 = fopen("profTemp.txt","r") or die("Erro ao criar arquivo");

    while(($linha=fgets($arq2))!==false)
    {
        fprintf($arq, "%s",$linha);
    }
        fclose($arq);
        fclose($arq2);
        $msg = "Deu certo";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar professor</title>
</head>
<body>  
    <form action="alterarProfessor.php" method="POST">Insira as informações para alterar o professor
        <br><br>
        Matricula<input type="number" name="mat" id="mat" >
        Nome<input type="text" name="nome" id="nome" >
        Email<input type="text" name="email" id="email">
        Endereço<input type="text" name="end" id="end">
        <input type="submit" value="Confirmar alteração">
    </form>
    <?php echo "<h1>$msg</h1>";?>
    <br>      
</body>
</html>
