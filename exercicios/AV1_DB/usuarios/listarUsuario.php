
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>

    <?php
        require_once("../includes/conexao.php");

        $sql = "SELECT cpf, nome, email, senha FROM usuarios";

        $resultado = mysqli_query($con, $sql);

        if (!$resultado) {
            die("Erro ao consultar usuarios: " . mysqli_error($con));
        }
    ?>

    <table>
        <tr>
            <th>CPF</th>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>SENHA</th>
        </tr>

        <?php
            while ($linha = mysqli_fetch_assoc($resultado)) {

                echo "<tr>
                        <td>" . htmlspecialchars($linha['cpf']) . "</td>
                        <td>" . htmlspecialchars($linha['nome']) . "</td>
                        <td>" . htmlspecialchars($linha['email']) . "</td>
                        <td>" . htmlspecialchars($linha['senha']) . "</td>
                      </tr>";
            }

            mysqli_free_result($resultado);
        ?>
    </table>

    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>
