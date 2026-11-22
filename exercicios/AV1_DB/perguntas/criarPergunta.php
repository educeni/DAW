<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once("../includes/conexao.php");

        $idPergunta = $_POST['idPergunta'];
        $pergunta = $_POST['pergunta'];
        $alt = $_POST['alt'];
        $alt2 = $_POST['alt2'];
        $alt3 = $_POST['alt3'];
        $alt4 = $_POST['alt4'];
        $certa = $_POST['certa'];

        // Verifica se todos os campos foram preenchidos
        if (empty($idPergunta) || empty($pergunta) ||
            empty($alt) || empty($alt2) || empty($alt3) ||
            empty($alt4) || empty($certa)) {

            echo "Erro: Todos os campos devem ser preenchidos!";
            exit();
        }

        // Verifica se a alternativa correta é válida
        if ($certa < 1 || $certa > 4) {
            echo "Erro: Selecione uma alternativa válida!";
            exit();
        }

        // Organiza as alternativas em um array
        $alternativas = [
            1 => $alt,
            2 => $alt2,
            3 => $alt3,
            4 => $alt4
        ];

        $con->begin_transaction();

            // CADASTRANDO A PERGUNTA
            $sql = "INSERT INTO perguntas (id_pergunta, pergunta)
                    VALUES (?, ?)";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("is", $idPergunta, $pergunta);
            $stmt->execute();
            $stmt->close();


            // CADASTRANDO AS QUATRO ALTERNATIVAS
            $sql = "INSERT INTO respostas (id_pergunta, id_resposta, resposta, certa)
                    VALUES (?, ?, ?, ?)";

            $stmt = $con->prepare($sql);

            foreach ($alternativas as $idResposta => $resposta) {

                // Verifica se esta é a alternativa correta
                $correta = ($certa == $idResposta) ? 1 : 0;

                $stmt->bind_param("iisi", $idPergunta, $idResposta, $resposta, $correta);
                $stmt->execute();
            }

            $stmt->close();

            // Confirma os cadastros
            $con->commit();

            echo "Cadastro de pergunta realizado com sucesso!";
        
        $con->close();
        exit();
    }
?>
