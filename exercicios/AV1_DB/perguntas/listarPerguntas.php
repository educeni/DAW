
<?php
    require_once("../includes/conexao.php");

    echo "<h1>Lista de Perguntas Multipla Escolha</h1>";

    $sql = "SELECT
                p.id_pergunta,
                p.pergunta,
                r.id_resposta,
                r.resposta,
                r.certa
            FROM perguntas p
            INNER JOIN respostas r
            ON p.id_pergunta = r.id_pergunta
            ORDER BY p.id_pergunta, r.id_resposta";

    $resultado = $con->query($sql);

    if (!$resultado) {
        die("Erro ao consultar perguntas: " . $con->error);
    }

    $idAtual = null;

    while ($linha = $resultado->fetch_assoc()) {

        if ($idAtual != $linha['id_pergunta']) {

            $idAtual = $linha['id_pergunta'];

            echo "<br>ID: " . htmlspecialchars($linha['id_pergunta']);
            echo "<br>Pergunta: " . htmlspecialchars($linha['pergunta']) . "<br><br>";
        }

        echo "Resposta: " . htmlspecialchars($linha['id_resposta']) . "<br>";
        echo "Resposta: " . htmlspecialchars($linha['resposta']) . "<br>";

        echo ($linha['certa'] == 1 ? "(CORRETA)" : "(ERRADA)") . "<br><br>";
    }

    $resultado->free();

    echo "<h1>Lista de Perguntas Discursivas</h1>";

    // Aqui adicionaremos a consulta das perguntas discursivas.
?>
