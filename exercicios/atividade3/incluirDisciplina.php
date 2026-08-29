<?php
    $msg="";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $sigla = $_POST['tag'];
    $carga = $_POST['carga'];

    echo "nome; " . $nome . " sigla; " . $sigla . " carga; " . $carga;

    if(!file_exists("disciplina.txt"))
    {
        $arqDisc = fopen("disciplina.txt", "w") or die ("erro ao criar arquivo");
        $linha = "nome;sigla;carga\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
    }

    $arqDisc = fopen("disciplina.txt", "a") or die ("erro ao abrir o arquivo");
    $linha = "$nome;$sigla;$carga\n";
    fwrite($arqDisc, $linha);
    $msg = "Deu certo!";
    fclose($arqDisc);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Disciplina</title>
</head>
<body>
    <header><strong>INCLUIR disciplina</strong></header>
    <form action="incluirDisciplina.php" method="POST">
    <label for="">Forneça a sigla:</label><input type="text" name="tag" id="tag">
    <label for="">Forneça o nome:</label><input type="text" name="nome" id="nome">
    <label for="">Forneça a carga:</label><input type="number" name="carga" id="carga">
    <input type="submit" value="Incluir nova disciplina">
    </form>
    <p><?php echo $msg ?></p>


    <p>Deseja excluir uma disciplina?</p>
    <form action="excluirDisciplina.php" method="POST">
        <label for="">Forneca a sigla da Disciplina</label><input type="text" name="sigla" id="sigla">
        <input type="submit" value="Confirmar">
    </form>
    <p><?php echo $msg ?></p>


</body>
</html>