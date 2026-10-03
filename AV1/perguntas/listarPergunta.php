<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTAR PERGUNTA</title>
</head>
<body>
    <h1>Deseja listar uma pergunta?</h1>
    <form action="listarPergunta.php" method="GET">
        <label for="idPergunta">Forneca o id da pergunta</label>
        <input type="text" name="idPergunta" id="idPergunta" required>
        <label for="tipo">Forneca o tipo da pergunta (d ou m)</label>
        <input type="text" name="tipo" id="tipo" required>
        <input type="submit" value="Confirmar">
    </form>
    <br><br>

    <?php
        if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idPergunta'])){
            $idPergunta = $_GET['idPergunta'];
            $tipo = $_GET['tipo'];

            if(($tipo == 'd')||($tipo == 'D')) {
                $arq = fopen("perguntasDiscursivas.txt", "r") or die("erro ao abrir arquivo");
            }
            else if(($tipo == 'm')||($tipo == 'M')) { 
                $arq = fopen("perguntas.txt", "r") or die("erro ao abrir arquivo");
            }

            while(($linha = fgets($arq)) !== false){
                $colunaDados = explode(";", $linha);

                if ($colunaDados[0] == $idPergunta) {
                    echo "Id Pergunta: " . $colunaDados[0] . "<br>" . "Pergunta:" . $colunaDados[1] . "<br>";
                    break;
                }
            }
            
            fclose($arq);
        }
    ?>
        <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>