<?php
    $msg = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sigla = $_POST['sigla'];

        $arq = fopen("disciplina.txt", "r") or die("Erro ao ler o arquivo");
        $arqTemp = fopen("temporario.txt", "w") or die("Erro ao criar o arquivo");

        while (($linha=fgets($arq))!== false) {
            if(trim($linha)== $sigla)
            {
                $msg = "Disciplina excluída com sucesso. ";
            }
            else {  
                fprintf($arqTemp, "%s", $linha);
            
            }
            
        }
        fclose($arq);
        fclose($arqTemp);

        $arq = fopen("disciplina.txt", "w") or die("Erro ao ler o arquivo");
        $arqTemp = fopen("temporario.txt", "r") or die("Erro ao criar o arquivo");

        while(($linha=fgets($arqTemp))!== false) {

            fprintf($arq, "%s", $linha);
        }
        fclose($arq);
        fclose($arqTemp);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Disciplina</title>
</head>
<body>
    <h1>Excluir disciplina</h1>
    <form action="excluirDisciplina.php" method="POST">
        <label for="">Forneca a sigla da Disciplina</label><input type="text" name="sigla" id="sigla">
        <input type="submit" value="Confirmar">
    </form>

    <?php echo $msg;?>
</body>
</html>