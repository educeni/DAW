
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once("../includes/conexao.php");

        $idPergunta = $_POST['idPergunta'];
        $pergunta = $_POST['pergunta'];
        $certa = $_POST['certa'];
        $idResp = $_POST['idResp'];

        if (empty($idPergunta) || empty($pergunta) || empty($certa) || empty($idResp)) {
            echo "Erro: Todos os campos devem ser preenchidos!";
            exit();
        }

        // Inicia uma transação
        $con->begin_transaction();

        try {

            // CADASTRANDO A PERGUNTA
            $sql = "INSERT INTO perguntas_discursivas (id_pergunta, pergunta)
                    VALUES (?, ?)";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("is", $idPergunta, $pergunta);
            $stmt->execute();
            $stmt->close();


            // CADASTRANDO A RESPOSTA
            $sql = "INSERT INTO respostas_discursivas (id_resposta, id_pergunta, gabarito)
                    VALUES (?, ?, ?)";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("iis", $idResp, $idPergunta, $certa);
            $stmt->execute();
            $stmt->close();


            // Confirma os cadastros
            $con->commit();

            echo "Cadastro de pergunta discursiva realizado com sucesso!";

        } catch (Exception $e) {

            // Desfaz os cadastros caso ocorra algum erro
            $con->rollback();

            echo "Erro ao cadastrar pergunta: " . $e->getMessage();
        }

        $con->close();
        exit();
    }
?>
