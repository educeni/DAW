<?php 
    $msg = "";
    $email = "";
    $mat = "";
    $nome = "";
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
    else if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['mat'])) {
        $mat = $_POST['mat'];

        $arq = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");
        $arq2 = fopen("alunosTemp.txt", "w") or die("Erro ao criar arquivo");

        while(($linha=fgets($arq))!==false)
        {
            $dados = explode(";",$linha);
            if($mat != trim($dados[0]))
            {
                fprintf($arq2, "%s", $linha);
            }
        }
        fclose($arq);
        fclose($arq2);

        rename("alunosTemp.txt", "alunos.txt");

        $msg = "Aluno excluído com sucesso!";
        $mat = ""; $nome = ""; $email = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Aluno</title>
</head>
<body>
    <form action="excluirAluno.php" method="POST"><h1><strong>Deseja realmente excluir esse aluno?</strong></h1>
    <h2>Nome: <?php echo $nome?><br></h2>
    <h2>Matricula:<?php echo $mat; ?></h2>
    <input type="hidden" name="mat" id="mat" value = "<?php echo $mat ?>">
    <h2>Email:<?php echo $email?><br></h2>
    <input type="submit" value="Confimar exclusão">
    <hr>
    <a href="listarAluno.php">Voltar para a listagem de alunos</a>
    </form>
</body>
</html>