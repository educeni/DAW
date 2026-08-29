<?php
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mat = $_POST['mat'];
        
        $linha = "";

        $arq = fopen("alunos.txt", "r") or die("Erro ao ler o arquivo");
        $arq2 = fopen("alunos2.txt", "w") or die("Erro ao criar o arquivo temporário");

        while (($linha = fgets($arq)) !== false) {
            $dados = explode(";", $linha);
            
            // dados[2] é o terceiro elemento do array, contando um a cada vez que aparece um ponto e virgula. 
            if(isset($dados[2]) && trim($dados[2]) == $mat) {
                $msg = "Aluno excluido com sucesso!";
            }
            else {
                fprintf($arq2, "%s", $linha); 
            }
        } 
        fclose($arq);
        fclose($arq2);

        $arq2 = fopen("alunos2.txt", "r") or die("Erro ao ler o arquivo");
        $arq = fopen("alunos.txt", "w") or die("Erro ao criar o arquivo temporário");

        while (($linha = fgets($arq2)) !== false) {
            fprintf($arq, "%s", $linha); 
        } 
        fclose($arq);
        fclose($arq2);
    }
    echo $msg;
?> 