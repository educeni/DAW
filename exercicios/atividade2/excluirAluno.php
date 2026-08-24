<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mat = $_POST['mat'];
        $msg = "";

        if($mat == $i)
        {
            $arqAlun = fopen("alunos.txt", "a") or die ("erro ao criar arquivo");                
            fwrite($arqAlun, $linha);
            fclose($arqAlun);
            $msg = "Deu certo!";
        }
        $msg = "Deu Errado!";
    }
    echo $msg;
?> 