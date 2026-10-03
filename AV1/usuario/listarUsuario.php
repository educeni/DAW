<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>

    <table>
        <tr><th>CPF</th><th>NOME</th><th>EMAIl</th><th>SENHA</th></tr>

        <?php 

            $arq = fopen("usuarios.txt", "r") or die("erro ao abrir arquivo");
            //fgets($arq);
            while(($linha=fgets($arq)) != false){

                $colunaDados = explode(";", $linha);

                if ($colunaDados[0] != "Cpf") {

                    echo "<tr><td>" . $colunaDados[0] . "</td>" .
                        "<td>" . $colunaDados[1] . "</td>" .
                        "<td>" . $colunaDados[2] . "</td>" .
                        "<td>" . $colunaDados[3] . "</td></tr>";
                }
            }
            fclose($arq);
        ?>
    </table>

    <a href="../../index.html">Voltar para tela inicial</a>
</body>
</html>