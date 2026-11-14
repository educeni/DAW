<?php
    $msg = "";
    $cpf = "";
    $novoArquivo = "";
    $nomeArquivo = "usuarios.txt";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cpf = trim($_POST['cpf']);
        if (!file_exists($nomeArquivo)) {
            $msg = "Erro: Arquivo de usuários não encontrado.";
            echo $msg;
            exit();
        } else {
            $arqUsuarios = fopen("usuarios.txt", "r") or die("erro ao abrir arquivo");
            $encontrou = false;
            while(($linha=fgets($arqUsuarios)) != false){
                $colunaDados = explode(";", $linha);

                if($colunaDados[0] != $cpf){
                    $novoArquivo = $novoArquivo . $linha;
                } else {
                    $encontrou = true;
                }
            }
            fclose($arqUsuarios);
            $arqUsuarios = fopen("usuarios.txt", "w") or die("erro ao abrir arquivo");
            fwrite($arqUsuarios, $novoArquivo);
            fclose($arqUsuarios);

            if ($encontrou == true) {
                $msg = "Usuário excluído com sucesso!";
            }
            else {
                $msg = "Usuário não encontrado.";
            }
        
            echo $msg;
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuario</title>
</head>
<body>
    <script>
        function ExcluirUsuario() {
            let cpf = document.getElementById("cpf").value;

            if (cpf === "") {
                alert("O campo CPF é obrigatório.");
                return false;
            }

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("msg").innerHTML = this.responseText;
                }
                else if (this.readyState == 4) {
                    document.getElementById("msg").innerHTML = "Erro ao excluir usuário.";
                }
            };
            console.log("Enviando dados para o servidor...");
            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/usuario/excluirUsuario.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("cpf=" + encodeURIComponent(cpf));
        }

    </script>
    <h1>Excluir usuario</h1>

    <form action="" method="POST">
        Digite o cpf do usuario para a exclusão: <input type="number" name="cpf" id="cpf" required>
        <br><br>
        <input type="button" value="Excluir usuario" onclick="ExcluirUsuario()">
    </form>

    <p id="msg"></p>
    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>