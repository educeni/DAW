<?php
    $msg = "";
    $mat = "";
    $nome = "";
    $email = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mat = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $arq = fopen("alunos.txt","r") or die("Erro ao abrir arquivo");
    $arq2 = fopen("alunosTemp.txt","w") or die("Erro ao criar arquivo");

        while(($linha=fgets($arq))!==false)
        {
            $colunaDados = explode(";", $linha);

            if(trim($colunaDados[0]) != $mat) {
                fprintf($arq2, "%s",$linha);
            }
            else {
                fprintf($arq2, "%s;%s;%s\n",$mat,$nome,$email);
            }
        }

    fclose($arq);
    fclose($arq2);
    
    $arq = fopen("alunos.txt","w") or die("Erro ao abrir arquivo");
    $arq2 = fopen("alunosTemp.txt","r") or die("Erro ao criar arquivo");

        while(($linha=fgets($arq2))!==false)
        {
            fprintf($arq, "%s",$linha);
        }
        fclose($arq);
        fclose($arq2);
    }
    $msg = "Deu certo";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar aluno</title>
</head>
<body>
    <?php   
    if($_SERVER['REQUEST_METHOD'] === 'GET'&& isset($_GET['mat'])) {

    $mat = $_GET['mat'];

    $arq = fopen("alunos.txt","r") or die("Erro ao abrir arquivo");

        while(($linha=fgets($arq))!==false)
        {
            $colunaDados = explode(";", $linha);

            if(trim($colunaDados[0]) == $mat) {
                $nome = trim($colunaDados[1]);
                $email = trim($colunaDados[2]);
            }
        }

        fclose($arq);
    }
    ?>

    <form action="alterarAluno.php" method="POST">Insira as informações para alterar o aluno
        Matricula<input type="number" name="mat" id="mat" value = "<?php echo $mat ?>" readonly>
        Nome<input type="text" name="nome" id="nome" value = "<?php echo $nome ?>">
        Email<input type="text" value = "<?php echo $email ?>" name="email" id="email">
        <input type="submit" value="Confirmar alteração">
    </form>
    <?php echo "<h1>$msg</h1>";?>
    <br>
    <a href="listarAluno.php">Voltar para a listagem de alunos</a>        
</body>
</html>