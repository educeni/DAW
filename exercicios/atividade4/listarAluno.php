<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar alunos</title>
</head>
<body>
    <table>
        <tr><th>MATRÍCULA</th><th>NOME</th><th>EMAIL</th><th>AÇÕES</th></tr> 
        <?php 
            
            $arq = fopen("alunos.txt", "r") or die("Erro ao ler o arquivo");

            while (($linha=fgets($arq))!== false) {
            $colunaDados = explode(";", $linha);

            echo "<tr><td>" . $colunaDados[0] . "</td>" .
                "<td>" . $colunaDados[1] . "</td>" .
                "<td>" . $colunaDados[2] . "</td>"; 

            echo '<td> 
                    <form action="alterarAluno.php" method="GET">
                    <label for="">Matricula do aluno</label><input type="text" value="' . $colunaDados[0] . '" name="mat" id="mat" readonly>
                    <button type="submit">Alterar</button><br><br></form>
                    <form action="excluirAluno.php" method="GET">
                    <label for="">Matricula do aluno</label><input type="text" value="' . $colunaDados[0] . '" name="mat" id="mat" readonly>
                    <button type="submit">Excluir</button>
                    </form><br><br>
                </td>';
            echo '</tr>';    
                }
                fclose($arq);

            $msg = "Deu certo!";
        ?>
    </table>
</body>
</html>
