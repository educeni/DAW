<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once("../includes/conexao.php");

        $idPergunta = $_POST['idPergunta'];
        $pergunta = $_POST['pergunta'];
        $alt = $_POST['alt'];
        $alt2 = $_POST['alt2'];
        $alt3 = $_POST['alt3'];
        $alt4 = $_POST['alt4'];
        $certa = $_POST['certa'];

        if ($certa < 1 || $certa > 4) {
            echo "Erro: Selecione uma alternativa válida!";
            exit();
        }

        $con->begin_transaction();

        $sql = "UPDATE perguntas
                SET pergunta = ?
                WHERE id_pergunta = ?";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("si", $pergunta, $idPergunta);
            $stmt->execute();


            // ALTERANDO AS ALTERNATIVAS
            $sql = "UPDATE respostas
                    SET resposta = ?, certa = ?
                    WHERE id_pergunta = ? AND id_resposta = ?";

            $stmt = $con->prepare($sql);

            // Alternativa 1
            $idResposta = 1;
            $correta = ($certa == 1) ? 1 : 0;

            $stmt->bind_param("siii", $alt, $correta, $idPergunta, $idResposta);
            $stmt->execute();

            // Alternativa 2
            $idResposta = 2;
            $correta = ($certa == 2) ? 1 : 0;

            $stmt->bind_param("siii", $alt2, $correta, $idPergunta, $idResposta);
            $stmt->execute();

            // Alternativa 3
            $idResposta = 3;
            $correta = ($certa == 3) ? 1 : 0;

            $stmt->bind_param("siii", $alt3, $correta, $idPergunta, $idResposta);
            $stmt->execute();

            // Alternativa 4
            $idResposta = 4;
            $correta = ($certa == 4) ? 1 : 0;

            $stmt->bind_param("siii", $alt4, $correta, $idPergunta, $idResposta);
            $stmt->execute();

            // Confirma todas as alterações
            $con->commit();

            echo "Alteração realizada com sucesso!";

        }

        $stmt->close();
        $con->close();  
?>