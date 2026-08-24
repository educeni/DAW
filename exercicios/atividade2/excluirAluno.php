<?php
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mat = $_POST['mat'];
        
        $linha = "";

        $arq = fopen("alunos.txt", "r") or die("Erro ao ler o arquivo");
        $arq2 = fopen("alunos2.txt", "w") or die("Erro ao criar o arquivo temporário");

        while(fscanf($arq, "%c", $linha)!=feof($arq)) {
            if($linha == $mat) {
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

        while(fscanf($arq2, "%c", $linha)!=feof($arq)) {
                fprintf($arq, "%s", $linha); 
            
        } 
        fclose($arq);
        fclose($arq2);
    }
    echo $msg;
?> 