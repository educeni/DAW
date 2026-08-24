<?php
    $msg="";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mat = $_POST['mat'];
    $cpf = $_POST['cpf'];

    echo "nome: " . $nome . " email: " . $email . " mat: " . $mat . " cpf: " . $cpf;

    if(!file_exists("alunos.txt"))
    {
        $arqAlun = fopen("alunos.txt", "w") or die ("erro ao criar arquivo");
        $linha = "nome;email;mat;cpf\n";
        fwrite($arqAlun, $linha);
        fclose($arqAlun);
    }

    $arqAlun = fopen("alunos.txt", "a") or die ("erro ao abrir o arquivo");
    $linha = "$nome;$email;$mat;$cpf;\n";
    fwrite($arqAlun, $linha);
    $msg = "Deu certo!";
    fclose($arqAlun);
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Aluno</title>
</head>
<body>
    <header><strong>INCLUIR ALUNO</strong></header>
    <form action="incluirAluno.php" method="POST">
    <label for="">Forneça o nome:</label><input type="text" name="nome" id="nome">
    <label for="">Forneça o email:</label><input type="text" name="email" id="email">
    <label for="">Forneça a matrícula:</label><input type="number" name="mat" id="mat">
    <label for="">Forneça o CPF</label><input type="number" name="cpf" id="cpf">
    <input type="submit" value="Incluir novo aluno">
    </form>
    <p><?php echo $msg ?></p>


    <p>Deseja excluir um aluno?</p>
    <form action="excluirAluno.php" method="POST">
        <label for="">Forneca a matricula</label><input type="number" name="mat">>
        Confirme: <input type="submit" value="Excluir aluno">
    </form>
    <p><?php echo $msg ?></p>


</body>
</html>